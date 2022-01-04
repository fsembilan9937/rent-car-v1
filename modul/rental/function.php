<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function cariDataRental($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT r.*, u.nickname FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user WHERE r.status = '1'";
  } else {
    $query = "SELECT r.*, u.nickname FROM rental r 
              JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa 
              JOIN users u ON r.id_user=u.id_user 
              WHERE r.status = '1' AND 
              r.id_rental LIKE '%$keyword%' OR 
              r.customer LIKE '%$keyword%' OR 
              r.nama LIKE '%$keyword%' OR 
              r.alamat LIKE '%$keyword%' OR 
              r.nohp LIKE '%$keyword%' OR 
              r.id_dsewa LIKE '%$keyword%' OR 
              r.ket LIKE '%$keyword%' OR 
              r.tgl_pinjam LIKE '%$keyword%' OR 
              r.tgl_kembali LIKE '%$keyword%' OR 
              u.nickname LIKE '%$keyword%' 
              LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataRental($data)
{
  global $conn;
  $id = idUnik("SELECT COUNT(id_rental) AS kode FROM rental", "RENT");
  $customer = htmlspecialchars($data['customer']);
  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $nohp = htmlspecialchars($data['nohp']);
  $iddsewa = htmlspecialchars($data['iddsewa']);
  $pinjam = htmlspecialchars($data['pinjam']);
  $kembali = htmlspecialchars($data['kembali']);
  $idusr = htmlspecialchars($data['idusr']);
  $idkenda = htmlspecialchars($data['idkenda']);
  $jml = htmlspecialchars($data['jml']);
  $jmlnow = $jml - 1;

  $query = "INSERT INTO rental (id_rental, customer, nama, alamat, nohp, id_dsewa, ket, tgl_pinjam, tgl_kembali, id_user, status) VALUES('$id', '$customer', '$nama', '$alamat', '$nohp', '$iddsewa', 'pending', '$pinjam', '$kembali', $idusr, '1')";

  $query2 = "UPDATE mobil SET jumlah = $jmlnow WHERE id_kendaraan = '$idkenda'";

  mysqli_query($conn, $query2);
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataRental($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $customer = htmlspecialchars($data['customer']);
  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $nohp = htmlspecialchars($data['nohp']);
  $iddsewa = htmlspecialchars($data['iddsewa']);
  $ket = htmlspecialchars($data['ket']);
  $pinjam = htmlspecialchars($data['pinjam']);
  $kembali = htmlspecialchars($data['kembali']);
  $dikembalikan = htmlspecialchars($data['dikembalikan']);
  $idusr = htmlspecialchars($data['idusr']);
  $idkenda = htmlspecialchars($data['idkenda']);
  $jml = htmlspecialchars($data['jml']);
  $biaya = htmlspecialchars($data['biaya']);
  $jmlnow = $jml + 1;

  $first = date_create($kembali);
  $last = date_create($dikembalikan);
  $diff = date_diff($first, $last);

  if ($diff->d >= 1) {
    $hitungDenda = 0.2  * $diff->d;
    if ($diff->h >= 12) {
      $hitungDenda = $hitungDenda + 0.1;
      $hitungDenda = $hitungDenda * $biaya;
      $denda = $biaya + $hitungDenda;
    } else {
      $hitungDenda = $hitungDenda * $biaya;
      $denda = $biaya + $hitungDenda;
    }
  }

  $query = "UPDATE rental 
            SET customer = '$customer', 
            nama = '$nama', 
            alamat = '$alamat', 
            nohp = '$nohp', 
            id_dsewa = '$iddsewa', 
            ket = '$ket', 
            tgl_pinjam = '$pinjam', 
            tgl_kembali = '$kembali',
            tgl_dikembalikan = '$dikembalikan',
            denda = '$denda',
            id_user = $idusr 
            WHERE id_rental = '$id'";

  if ($ket == 'Done') {
    $query2 = "UPDATE mobil SET jumlah = $jmlnow WHERE id_kendaraan = '$idkenda'";
    mysqli_query($conn, $query2);
  }

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataRental($id)
{
  global $conn;
  $query = "UPDATE rental SET status = '0' WHERE id_rental = '$id'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
