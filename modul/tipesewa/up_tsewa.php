<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM tipe_sewa WHERE id_tsewa = $id");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=tsewa'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Tipe Sewa</h2>
  <form action="modul/tipesewa/option.php" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <input class="form-control" type="hidden" name="id" value="<?= $ioy['id_tsewa'] ?>">
          <input class="form-control" type="text" name="durasi" id="durasi" placeholder="Durasi" value="<?= $ioy['durasi'] ?>" required>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="keterangan" id="keterangan" cols="20" rows="10"><?= $ioy['keterangan'] ?></textarea>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
  </form>
</div>