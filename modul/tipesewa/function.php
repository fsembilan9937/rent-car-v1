<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function cariDataTsewa($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT * FROM tipe_sewa";
  } else {
    $query = "SELECT * FROM tipe_sewa WHERE durasi LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataTsewa($data)
{
  global $conn;
  $durasi = htmlspecialchars($data['durasi']);
  $ket = htmlspecialchars($data['keterangan']);
  //dst.
  $query = "INSERT INTO tipe_sewa (durasi, keterangan) VALUES('$durasi', '$ket')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataTsewa($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $durasi = htmlspecialchars($data['durasi']);
  $ket = htmlspecialchars($data['keterangan']);
  $query = "UPDATE tipe_sewa SET durasi = '$durasi', keterangan = '$ket' WHERE id_tsewa = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataTsewa($id)
{
  global $conn;
  $query = "DELETE FROM tipe_sewa WHERE id_tsewa = $id";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
