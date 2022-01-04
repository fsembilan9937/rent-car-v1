<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri = $id");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=galeri'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Galeri</h2>
  <form action="modul/galeri/option.php" method="post" enctype="multipart/form-data">
    <input class="form-control" type="hidden" name="id" value="<?= $ioy['id_galeri'] ?>">
    <input class="form-control" type="hidden" name="gambarLama" value="<?= $ioy['gambar'] ?>">

    <div class="row">
      <div class="col-12 col-sm-3">
        <img src="frontend/images/<?= $ioy['gambar'] ?>" alt="<?= $ioy['gambar'] ?>" class="img-fluid">
      </div>
      <div class="col-12 col-sm-9">
        <div class="form-group">
          <label for="id_kendaraan">Nama Kendaraan</label>
          <select class="form-control" name="id_kendaraan" id="id_kendaraan">
            <option value="">== Pilih Kendaraan ==</option>
            <?php $slolo = tampilData("SELECT * FROM mobil"); ?>
            <?php if ($slolo != null) : ?>
              <?php foreach ($slolo as $value) : ?>
                <option value="<?= $value['id_kendaraan']; ?>" <?= $ioy['id_mobil'] == $value['id_kendaraan'] ? 'selected' : ''; ?>><?= $value['nama_kendaraan']; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="gambar">Gambar</label>
          <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
      </div>
    </div>

    <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
  </form>
</div>