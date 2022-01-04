<?php
$conn = mysqli_connect("localhost", "root", "qwerty", "db_rental_mobil_v1");

function batasan()
{
  if (!isset($_SESSION['verifikasi'])) {
    header("Location:login.php");
  }
}

function bulanTeks($bulan)
{
  if ($bulan == '01') {
    $output = 'Januari';
  } elseif ($bulan == '02') {
    $output = 'Februari';
  } elseif ($bulan == '03') {
    $output = 'Maret';
  } elseif ($bulan == '04') {
    $output = 'April';
  } elseif ($bulan == '05') {
    $output = 'Mei';
  } elseif ($bulan == '06') {
    $output = 'Juni';
  } elseif ($bulan == '07') {
    $output = 'Juli';
  } elseif ($bulan == '08') {
    $output = 'Agustus';
  } elseif ($bulan == '09') {
    $output = 'September';
  } elseif ($bulan == '10') {
    $output = 'Oktober';
  } elseif ($bulan == '11') {
    $output = 'November';
  } elseif ($bulan == '12') {
    $output = 'Desember';
  }
  return $output;
}

function penyebut($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}

function terbilang($nilai)
{
  if ($nilai < 0) {
    $hasil = "minus " . trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }
  return $hasil;
}

function batasanLogin()
{
  if (isset($_SESSION['verifikasi'])) {
    header("Location:index.php");
  }
}

function ucapan()
{
  date_default_timezone_set("Asia/Jakarta");

  $jam = date('H:i');

  if ($jam > '05:30' && $jam < '10:00') {
    $salam = 'Pagi';
  } elseif ($jam >= '10:00' && $jam < '15:00') {
    $salam = 'Siang';
  } elseif ($jam < '18:00') {
    $salam = 'Sore';
  } else {
    $salam = 'Malam';
  }

  return 'Selamat ' . $salam;
}

function rupiah($angka)
{
  $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasil_rupiah;
}

function idUnik($q, $h)
{
  global $conn;
  $query = mysqli_query($conn, $q);
  $data = mysqli_fetch_array($query);
  $kode = $data['kode'];
  $kode++;

  $huruf = $h;
  $kode = $huruf . sprintf("%03s", $kode);
  return $kode;
}

function tampilData($query)
{
  global $conn;
  $take = mysqli_query($conn, $query);
  $row = [];
  while ($chest = mysqli_fetch_assoc($take)) :
    $row[] = $chest;
  endwhile;
  return $row;
}

function jumlahMerk()
{
  global $conn;
  $query = mysqli_query($conn, "SELECT COUNT(*) MERK FROM BRAND_MOBIL");
  $merk = mysqli_fetch_assoc($query);
  return $merk['MERK'];
}

function jumlahKendaraan()
{
  global $conn;
  $query = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM mobil");
  $kendaraan = mysqli_fetch_assoc($query);
  return $kendaraan['total'];
}

function kendaraanKeluar()
{
  global $conn;
  $query = mysqli_query($conn, "SELECT COUNT(id_rental) AS total  FROM rental WHERE ket in('paid', 'due') AND status = 1");
  $kendaraan = mysqli_fetch_assoc($query);
  return $kendaraan['total'];
}

function kendaraanPending()
{
  global $conn;
  $query = mysqli_query($conn, "SELECT COUNT(id_rental) AS total  FROM rental WHERE ket = 'pending' AND status = 1");
  $kendaraan = mysqli_fetch_assoc($query);
  return $kendaraan['total'];
}

function kendaraanLunas()
{
  global $conn;
  $query = mysqli_query($conn, "SELECT COUNT(id_rental) AS total  FROM rental WHERE ket in('paid','done')");
  $kendaraan = mysqli_fetch_assoc($query);
  return $kendaraan['total'];
}

function keterlambatan()
{
  global $conn;
  $today = date("Y-m-d H:i:s");
  $query = mysqli_query($conn, "SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.ket != 'done' AND r.status = 1");
  $row = [];
  while ($chest = mysqli_fetch_assoc($query)) :
    if (strtotime($chest['tgl_kembali']) <= strtotime($today)) {
      $row[] = $chest;
    }
  endwhile;
  return $row;
}
