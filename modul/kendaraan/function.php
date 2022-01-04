<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function cariDataKendaraan($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT * FROM mobil";
  } else {
    $query = "SELECT * FROM mobil 
              WHERE id_kendaraan LIKE '%$keyword%' 
              OR nama_kendaraan LIKE '%$keyword%' 
              OR nopol = '$keyword' 
              OR tahun = '$keyword' 
              OR warna LIKE '%$keyword%' 
              OR jumlah_kursi LIKE '%$keyword%' 
              OR bahan_bakar LIKE '%$keyword%' 
              OR no_rangka = '$keyword' 
              OR no_mesin = '$keyword' 
              OR kondisi LIKE '%$keyword%' 
              OR jumlah LIKE '%$keyword%' 
              LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataKendaraan($data)
{
  global $conn;

  $nama_kendaraan = htmlspecialchars($data['nama_kendaraan']);
  $nopol = htmlspecialchars($data['nopol']);
  $id_kendaraan = strtoupper(substr($nama_kendaraan, 0, 3));
  $id_kendaraan .= strtoupper(substr($nopol, 3, 2));

  $id_merk = htmlspecialchars($data['id_merk']);
  $tahun = htmlspecialchars($data['tahun']);
  $warna = htmlspecialchars($data['warna']);
  $jumlah_kursi = htmlspecialchars($data['jumlah_kursi']);
  $bahan_bakar = htmlspecialchars($data['bahan_bakar']);
  $no_rangka = htmlspecialchars($data['no_rangka']);
  $no_mesin = htmlspecialchars($data['no_mesin']);
  $kondisi = htmlspecialchars($data['kondisi']);
  $jumlah = htmlspecialchars($data['jumlah']);

  $query = "INSERT INTO mobil VALUES('$id_kendaraan','$id_merk','$nama_kendaraan','$nopol','$tahun','$warna','$jumlah_kursi','$bahan_bakar','$no_rangka','$no_mesin','$kondisi','$jumlah')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataKendaraan($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $id_merk = htmlspecialchars($data['id_merk']);
  $nama_kendaraan = htmlspecialchars($data['nama_kendaraan']);
  $nopol = htmlspecialchars($data['nopol']);
  $tahun = htmlspecialchars($data['tahun']);
  $warna = htmlspecialchars($data['warna']);
  $jumlah_kursi = htmlspecialchars($data['jumlah_kursi']);
  $bahan_bakar = htmlspecialchars($data['bahan_bakar']);
  $no_rangka = htmlspecialchars($data['no_rangka']);
  $no_mesin = htmlspecialchars($data['no_mesin']);
  $kondisi = htmlspecialchars($data['kondisi']);
  $jumlah = htmlspecialchars($data['jumlah']);
  $query = "UPDATE mobil SET id_merk = '$id_merk', nama_kendaraan = '$nama_kendaraan', nopol = '$nopol', tahun = '$tahun', warna = '$warna', jumlah_kursi = '$jumlah_kursi', bahan_bakar = '$bahan_bakar', no_rangka = '$no_rangka', no_mesin = '$no_mesin', kondisi = '$kondisi', jumlah = '$jumlah'  WHERE id_kendaraan = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataKendaraan($id)
{
  global $conn;
  $query = "DELETE FROM mobil WHERE id_kendaraan = '$id'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
