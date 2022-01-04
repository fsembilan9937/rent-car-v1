<?php

$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function uploadGambar()
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  if ($error === 4) {
    echo "<script>
            alert('Anda belum menginputkan gambar!')
          </script>";
    return false;
  }

  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar! Silahkan upload gambar kembali.')
    </script>";
    return false;
  }

  if ($ukuranFile > 2097152) {
    echo "<script>
            alert('Ukuran file terlalu besar! Silahkan upload gambar kembali.')
          </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  if (isset($_GET['act']) == "add") {
    move_uploaded_file($tmpName, 'frontend/images/' . $namaFileBaru);
  } else {
    move_uploaded_file($tmpName, '../../frontend/images/' . $namaFileBaru);
  }
  return $namaFileBaru;
}


function cariDataGaleri($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT g.id_galeri, m.nama_kendaraan, g.gambar FROM galeri g JOIN mobil m ON g.id_mobil=m.id_kendaraan";
  } else {
    $query = "SELECT g.id_galeri, m.nama_kendaraan, g.gambar FROM galeri g JOIN mobil m ON g.id_mobil=m.id_kendaraan WHERE m.nama_kendaraan LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataGaleri($data)
{
  global $conn;
  $id_kendaraan = htmlspecialchars($data['id_kendaraan']);
  $gambar = uploadGambar();
  if (!$gambar) {
    return false;
  }
  $query = "INSERT INTO galeri (id_mobil, gambar) VALUES('$id_kendaraan', '$gambar')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataGaleri($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $id_mobil = htmlspecialchars($data['id_kendaraan']);
  $gambarLama = htmlspecialchars($data['gambarLama']);

  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = uploadGambar();
  }
  $query = "UPDATE galeri SET id_mobil = '$id_mobil', gambar = '$gambar' WHERE id_galeri = $id";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataGaleri($id)
{
  global $conn;
  $query = "DELETE FROM galeri WHERE id_galeri = $id";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
