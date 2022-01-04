<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function cariDataUser($keyword, $awalData, $jumlahDataPerHal)
{
  global $conn;

  if ($keyword == null) {
    $query = "SELECT * FROM users WHERE status = '1'";
  } else {
    $query = "SELECT * FROM users WHERE status = '1' AND nickname LIKE '%$keyword%' OR role LIKE '%$keyword%' OR status = '$keyword' LIMIT $awalData, $jumlahDataPerHal";
  }
  return tampilData($query);
}

function tambahDataUser($data)
{
  global $conn;
  $nick = htmlspecialchars($data['nickname']);
  $pw = htmlspecialchars(password_hash($data['pw'], PASSWORD_DEFAULT));
  $role = htmlspecialchars($data['role']);
  //dst.
  $query = "INSERT INTO USERS (nickname, pw, role, status) VALUES('$nick','$pw','$role', '1')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahDataUser($data)
{
  global $conn;
  $id = htmlspecialchars($data['id']);
  $nick = htmlspecialchars($data['nickname']);
  $pw = htmlspecialchars(password_hash($data['pw'], PASSWORD_DEFAULT));
  $stat = htmlspecialchars($data['status']);
  $role = htmlspecialchars($data['role']);
  $query = "UPDATE users SET nickname = '$nick', pw = '$pw', status = '$stat', role = '$role' WHERE id_user = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapusDataUser($id)
{
  global $conn;
  // $query = "DELETE FROM users WHERE id_user = $id";
  $query = "UPDATE users SET status = '0' WHERE id_user = $id";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
