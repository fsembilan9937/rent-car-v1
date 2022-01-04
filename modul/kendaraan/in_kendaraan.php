<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataKendaraan($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=kendaraan'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=kendaraan&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data Kendaraan</h2>
  <form action="" method="post">
    <div class="row">
      <div class="col-12 col-sm-6 form-group">
        <label for="nama_kendaraan">Nama</label>
        <input class="form-control" type="text" name="nama_kendaraan" id="nama_kendaraan" placeholder="Nama kendaraan" required>
      </div>
      <div class="col-12 col-sm-6 form-group">
        <label for="id_merk">Merk</label>
        <select class="form-control" name="id_merk" id="id_merk">
          <option value"" selected>== Pilih Merk Mobil ==</option>
          <?php $slolo = tampilData("SELECT * FROM brand_mobil"); ?>
          <?php if ($slolo != null) : ?>
            <?php foreach ($slolo as $value) : ?>
              <option value="<?= $value['id_brand']; ?>"><?= $value['nama_brand']; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-3 form-group">
        <label for="nopol">Nopol</label>
        <input class="form-control" type="text" name="nopol" id="nopol" placeholder="Plat Nomor" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="tahun">Tahun</label>
        <input class="form-control" type="number" name="tahun" id="tahun" placeholder="Tahun" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="warna">Warna</label>
        <input class="form-control" type="text" name="warna" id="warna" placeholder="Warna" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="jumlah_kursi">Jumlah Kursi</label>
        <input class="form-control" type="number" name="jumlah_kursi" id="jumlah_kursi" placeholder="Jumlah Kursi" required>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-3 form-group">
        <label for="bahan_bakar">Bahan Bakar</label>
        <input class="form-control" type="text" name="bahan_bakar" id="bahan_bakar" placeholder="Bahan Bakar" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="no_rangka">Nomor Rangka</label>
        <input class="form-control" type="text" name="no_rangka" id="no_rangka" placeholder="Nomor Rangka" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="no_mesin">Nomor Mesin</label>
        <input class="form-control" type="text" name="no_mesin" id="no_mesin" placeholder="Nomor Mesin" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="jumlah">Jumlah</label>
        <input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah" required>
      </div>
    </div>

    <div class="row">
      <div class="col-12 form-group">
        <label for="kondisi">Kondisi</label>
        <textarea class="form-control" name="kondisi" id="kondisi" rows="4" placeholder="Uraikan Kondisi Kendaraan dengan jelas..."></textarea>
      </div>
    </div>

    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>