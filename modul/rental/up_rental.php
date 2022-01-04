<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT r.*, d.biaya FROM rental r join detail_sewa d ON r.id_dsewa=d.id_dsewa WHERE r.id_rental = '$id' AND r.status = '1'");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=rental'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data Rental</h2>
  <form action="modul/rental/option.php" method="post">
    <div class="row">
      <div class="col-12 col-sm-3 form-group">
        <label for="id">ID Rental</label>
        <input class="form-control" type="text" name="id" value="<?= $ioy['id_rental'] ?>" readonly>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="customer">Customer / Instansi</label>
        <input class="form-control" type="text" name="customer" id="customer" value="<?= $ioy['customer'] ?>" placeholder="Customer" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="nama">Nama</label>
        <input class="form-control" type="text" name="nama" id="nama" value="<?= $ioy['nama'] ?>" placeholder="Nama" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="nohp">Nomor HP</label>
        <input class="form-control" type="text" name="nohp" id="nohp" value="<?= $ioy['nohp'] ?>" placeholder="Nomor Handphone" required>
      </div>
    </div>

    <div class="row">
      <div class="col-12 form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="alamat" id="alamat" cols="20" rows="10" placeholder="Alamat Lengkap" required><?= $ioy['alamat'] ?></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-4 form-group">
        <label for="iddsewa">Paket Rental</label>
        <select class="form-control" name="iddsewa" id="iddsewa">
          <option value"" selected>== Pilih Detail Sewa ==</option>
          <?php $slolo = tampilData("SELECT d.id_dsewa, d.biaya, m.id_kendaraan, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa"); ?>
          <?php if ($slolo != null) : ?>
            <?php foreach ($slolo as $value) : ?>
              <option value="<?= $value['id_dsewa']; ?>" <?= $ioy['id_dsewa'] == $value['id_dsewa'] ? 'selected' : ''; ?>><?= $value['id_dsewa'] ?>: <?= $value['nama_kendaraan'] ?> => <?= $value['durasi'] ?> [<?= rupiah($value['biaya']) ?>] (<?= $value['keterangan'] ?>)</option>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>

        <input type="hidden" name="idkenda" id="idkenda" class="form-control" value="<?= $value['id_kendaraan'] ?>">
        <input type="hidden" name="jml" id="jml" class="form-control" value="<?= $value['jumlah'] ?>">
        <input type="hidden" name="biaya" id="biaya" class="form-control" value="<?= $ioy['biaya'] ?>">

      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="pinjam">Tanggal Pinjam</label>
        <input class="form-control" type="datetime-local" name="pinjam" id="pinjam" value="<?= date('Y-m-d\TH:i:s', strtotime($ioy['tgl_pinjam'])) ?>" required>
      </div>
      <div class="col-12 col-sm-3 form-group">
        <label for="kembali">Tanggal Kembali</label>
        <input class="form-control" type="datetime-local" name="kembali" id="kembali" value="<?= date('Y-m-d\TH:i:s', strtotime($ioy['tgl_kembali'])) ?>" required>
      </div>
      <div class="col-12 col-sm-2 form-group">
        <label for="ket">Keterangan Transaksi</label>
        <select class="form-control" name="ket" id="ket">
          <option value="">== Pilih Keterangan Rental ==</option>
          <option value="Pending" <?= $ioy['ket'] == 'pending' ? 'selected' : '' ?>>Pending</option>
          <option value="Paid" <?= $ioy['ket'] == 'paid' ? 'selected' : '' ?>>Paid</option>
          <option value="Due" <?= $ioy['ket'] == 'due' ? 'selected' : '' ?>>Due</option>
          <option value="Done" <?= $ioy['ket'] == 'done' ? 'selected' : '' ?>>Done</option>
        </select>

      </div>
    </div>

    <?php
    $nick = $_SESSION['dia'];
    $ty = tampilData("SELECT *FROM users WHERE nickname LIKE '%$nick%'");
    foreach ($ty as $value) : endforeach;
    ?>

    <div class="row">
      <div class="col-4 form-group">
        <label for="dikembalikan">Dikembalikan</label>
        <?php if ($ioy['tgl_dikembalikan'] != null) : ?>
          <input class="form-control" type="datetime-local" name="dikembalikan" id="dikembalikan" value="<?= date('Y-m-d\TH:i:s', strtotime($ioy['tgl_dikembalikan'])) ?>" required>
        <?php else : ?>
          <input class="form-control" type="datetime-local" name="dikembalikan" id="dikembalikan" required>
        <?php endif; ?>
      </div>
      <div class="col-8 form-group">
        <input class="form-control" type="hidden" name="idusr" id="idusr" value="<?= $value['id_user'] ?>">
        <label for="nusr">Penindak</label>
        <input class="form-control" type="text" name="nusr" id="nusr" value="<?= ucfirst($_SESSION['dia']) ?>" readonly>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
  </form>
</div>