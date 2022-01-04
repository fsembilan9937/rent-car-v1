<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataTsewa($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=tsewa'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=tsewa&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data Tipe Sewa</h2>
  <form action="" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="durasi">Durasi</label>
          <input class="form-control" type="text" name="durasi" id="durasi" placeholder="Durasi" required>
        </div>
        <div class="form-group">
          <label for="durasi">Detail Tipe Sewa</label>
          <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukkan keterangan dengan jelas..."></textarea>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>