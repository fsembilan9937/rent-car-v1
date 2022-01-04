<?php
require "function.php";

if (isset($_POST['submit'])) :

  if (ubahDataKendaraan($_POST) === 1) :
    echo "<script>
    alert('Data berhasil diubah!');
    document.location.href='../../index.php?pg=kendaraan'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='../../index.php?pg=kendaraan'
    </script>";
  endif;

elseif (isset($_GET['d'])) :

  $id = $_GET['d'];
  if (hapusDataKendaraan($id) === 1) :
    echo "<script>
      alert('Data berhasil dihapus!');
      document.location.href='../../index.php?pg=kendaraan';
      </script>";
  else :
    echo "<script>
      alert('Data gagal dihapus!');
      document.location.href='../../index.php?pg=kendaraan';
      </script>";
  endif;

else :

  echo "<script>
    alert('Terjadi masalah jaringan! Silahkan cek koneksi anda.');
    document.location.href='../../index.php?pg=kendaraan';
    </script>";

endif;
