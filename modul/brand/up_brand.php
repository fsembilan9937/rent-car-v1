<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM brand_mobil WHERE id_brand = $id");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=brand'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Brand</h2>
  <div class="row">
    <div class="col-12 col-sm-3">
      <img src="frontend/images/<?= $ioy['logo'] ?>" alt="<?= $ioy['nama_brand'] ?>" class="img-fluid">
    </div>
    <div class="col-12 col-sm-9">
      <form action="modul/brand/option.php" method="post" enctype="multipart/form-data">
        <input class="form-control" type="hidden" name="id" value="<?= $ioy['id_brand'] ?>">
        <input class="form-control" type="hidden" name="gambarLama" value="<?= $ioy['logo'] ?>">
        <div class="form-group">
          <label for="nama_brand">Nama Brand</label>
          <input class="form-control" type="text" name="nama_brand" id="nama_brand" placeholder="Nama Brand" value="<?= $ioy['nama_brand'] ?>" required>
        </div>
        <div class="form-group">
          <label for="gambar">Logo</label>
          <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>