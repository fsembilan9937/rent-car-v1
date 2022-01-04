<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataPrental($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=prental'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=prental&act=add'
    </script>";
  endif;
endif;
?>
<div class="section-body">
  <h2 class="section-title">Tambah Data Paket Rental</h2>
  <form action="" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="inamakend">Nama Kendaraan</label>
          <select class="form-control" name="inamakend" id="inamakend">
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
    </div>

    <div class="form-group">
      <label for="itsewa">Tipe Sewa</label>
      <select class="form-control" name="itsewa" id="itsewa">
        <option value"" selected>== Pilih Tipe Sewa ==</option>
        <?php $slolo = tampilData("SELECT * FROM tipe_sewa"); ?>
        <?php if ($slolo != null) : ?>
          <?php foreach ($slolo as $value) : ?>
            <option value="<?= $value['id_tsewa']; ?>"><?= $value['durasi']; ?> || <?= $value['keterangan']; ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="ibiaya">Biaya</label>
      <input class="form-control" type="number" name="ibiaya" id="ibiaya" placeholder="Biaya" required>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>