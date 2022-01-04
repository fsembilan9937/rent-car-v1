<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataGaleri($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=galeri'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=galeri&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data Galeri</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-12 form-group">
        <label for="id_kendaraan">Nama Kendaraan</label>
        <select class="form-control" name="id_kendaraan" id="id_kendaraan">
          <option value"" selected>== Pilih Kendaraan ==</option>
          <?php $slolo = tampilData("SELECT * FROM mobil"); ?>
          <?php if ($slolo != null) : ?>
            <?php foreach ($slolo as $value) : ?>
              <option value="<?= $value['id_kendaraan']; ?>"><?= $value['nama_kendaraan']; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-12 form-group">
        <label for="gambar">Gambar</label>
        <input class="form-control" type="file" name="gambar" id="gambar">
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>