<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM mobil WHERE id_kendaraan = '$id'");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=kendaraan'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Kendaraan</h2>
  <form action="modul/kendaraan/option.php" method="post">

    <div class="row">
      <div class="col-12 col-sm-2 form-group">
        <label for="id">ID</label>
        <input class="form-control" type="text" name="id" id="id" value="<?= $ioy['id_kendaraan'] ?>" readonly>
      </div>
      <div class="col-12 col-sm-5">
        <label for="nama_kendaraan">Nama Kendaraan</label>
        <input class="form-control" type="text" name="nama_kendaraan" id="nama_kendaraan" placeholder="Nama kendaraan" value="<?= $ioy['nama_kendaraan'] ?>" required>
      </div>
      <div class="col-12 col-sm-5">
        <label for="id_merk">Merk</label>
        <select class="form-control" name="id_merk" id="id_merk">
          <option value="">== Pilih Merk Mobil ==</option>
          <?php $slolo = tampilData("SELECT * FROM brand_mobil"); ?>
          <?php if ($slolo != null) : ?>
            <?php foreach ($slolo as $value) : ?>
              <option value="<?= $value['id_brand']; ?>" <?= $ioy['id_merk'] == $value['id_brand'] ? 'selected' : ''; ?>><?= $value['nama_brand']; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-3 form-group">
        <label for="nopol">Nopol</label>
        <input class="form-control" type="text" name="nopol" id="nopol" placeholder="Plat Nomor" value="<?= $ioy['nopol'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="tahun">Tahun</label>
        <input class="form-control" type="number" name="tahun" id="tahun" placeholder="Tahun" value="<?= $ioy['tahun'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="warna">Warna</label>
        <input class="form-control" type=" text" name="warna" id="warna" placeholder="Warna" value="<?= $ioy['warna'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="jumlah_kursi">Jumlah Kursi</label>
        <input class="form-control" type=" number" name="jumlah_kursi" id="jumlah_kursi" placeholder="Jumlah Kursi" value="<?= $ioy['jumlah_kursi'] ?>" required>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-3 form-group">
        <label for="bahan_bakar">Bahan Bakar</label>
        <input class="form-control" type=" text" name="bahan_bakar" id="bahan_bakar" placeholder="Bahan Bakar" value="<?= $ioy['bahan_bakar'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="no_rangka">Nomor Rangka</label>
        <input class="form-control" type=" text" name="no_rangka" id="no_rangka" placeholder="Nomor Rangka" value="<?= $ioy['no_rangka'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="no_mesin">Nomor Mesin</label>
        <input class="form-control" type=" text" name="no_mesin" id="no_mesin" placeholder="Nomor Mesin" value="<?= $ioy['no_mesin'] ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="jumlah">Jumlah</label>
        <input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?= $ioy['jumlah'] ?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-12 form-group">
        <label for="kondisi">Kondisi</label>
        <textarea class="form-control" name=" kondisi" id="kondisi" cols="20" rows="10" placeholder="Uraikan Kondisi Kendaraan dengan jelas..."><?= $ioy['kondisi'] ?></textarea>
      </div>
    </div>
    <button class="btn btn-primary" type=" submit" name="submit">Ubah</button>
  </form>
</div>