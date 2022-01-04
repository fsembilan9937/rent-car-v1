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


function cariDataBrand($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT * FROM brand_mobil";
  } else {
    $query = "SELECT * FROM brand_mobil WHERE nama_brand LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataBrand($data)
{
  global $conn;
  $nama_brand = htmlspecialchars($data['nama_brand']);
  $logo = uploadGambar();
  if (!$logo) {
    return false;
  }
  $query = "INSERT INTO brand_mobil (nama_brand, logo) VALUES('$nama_brand', '$logo')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataBrand($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $nama_brand = htmlspecialchars($data['nama_brand']);
  $gambarLama = htmlspecialchars($data['gambarLama']);

  if ($_FILES['gambar']['error'] === 4) {
    $logo = $gambarLama;
  } else {
    $logo = uploadGambar();
  }
  $query = "UPDATE brand_mobil SET nama_brand = '$nama_brand', logo = '$logo' WHERE id_brand = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataBrand($id)
{
  global $conn;
  $query = "DELETE FROM brand_mobil WHERE id_brand = $id";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
