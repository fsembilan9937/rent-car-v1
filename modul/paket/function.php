<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function cariDataPrental($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT d.id_dsewa, d.biaya, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa";
  } else {
    $query = "SELECT d.id_dsewa, d.biaya, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa WHERE durasi LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' OR jumlah LIKE '%$keyword%' OR nama_kendaraan LIKE '%$keyword%' OR biaya LIKE '%$keyword%' OR id_dsewa LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataPrental($data)
{
  global $conn;
  $idsewa = idUnik("SELECT COUNT(id_dsewa) AS kode FROM detail_sewa", "PKT");
  $ibiaya = htmlspecialchars($data['ibiaya']);
  $inamakend = htmlspecialchars($data['inamakend']);
  $itsewa = htmlspecialchars($data['itsewa']);
  //dst.
  $query = "INSERT INTO detail_sewa VALUES('$idsewa', '$inamakend', $itsewa, $ibiaya)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataPrental($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $ibiaya = htmlspecialchars($data['ibiaya']);
  $inamakend = htmlspecialchars($data['inamakend']);
  $itsewa = htmlspecialchars($data['itsewa']);
  $query = "UPDATE detail_sewa SET id_dsewa = '$id', id_kendaraan = '$inamakend', id_tsewa = $itsewa, biaya = $ibiaya WHERE id_dsewa = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataPrental($id)
{
  global $conn;
  $query = "DELETE FROM detail_sewa WHERE id_dsewa = '$id'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
