<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM detail_sewa WHERE id_dsewa = '$id'");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=prental'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Paket Rental</h2>
  <form action="modul/paket/option.php" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="id">ID Paket</label>
          <input class="form-control" type="text" name="id" value="<?= $ioy['id_dsewa'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inamakend">Nama Kendaraan</label>
          <select class="form-control" name="inamakend" id="inamakend">
            <option value="">== Pilih Kendaraan ==</option>
            <?php $slolo = tampilData("SELECT * FROM mobil"); ?>
            <?php if ($slolo != null) : ?>
              <?php foreach ($slolo as $value) : ?>
                <option value="<?= $value['id_kendaraan']; ?>" <?= $ioy['id_kendaraan'] == $value['id_kendaraan'] ? 'selected' : ''; ?>><?= $value['nama_kendaraan']; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="itsewa">Tipe Sewa</label>
          <select class="form-control" name="itsewa" id="itsewa">
            <option value="">== Pilih Tipe Sewa ==</option>
            <?php $slolo = tampilData("SELECT * FROM tipe_sewa"); ?>
            <?php if ($slolo != null) : ?>
              <?php foreach ($slolo as $value) : ?>
                <option value="<?= $value['id_tsewa']; ?>" <?= $ioy['id_tsewa'] == $value['id_tsewa'] ? 'selected' : ''; ?>><?= $value['durasi']; ?> || <?= $value['keterangan']; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="ibiaya">Biaya</label>
          <input class="form-control" type="number" name="ibiaya" id="ibiaya" value="<?= $ioy['biaya'] ?>" placeholder="Biaya">
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
  </form>
</div>