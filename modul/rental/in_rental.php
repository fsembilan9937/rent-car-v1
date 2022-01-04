<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataRental($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=rental'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=rental&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data Rental</h2>
  <form action="" method="post">
    <div class="row">
      <div class="col-12 col-sm-4 form-group">
        <label for="customer">Customer / Instansi</label>
        <input class="form-control" type="text" name="customer" id="customer" placeholder="Customer" required>
      </div>
      <div class="col-12 col-sm-4 form-group">
        <label for="nama">Nama</label>
        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" required>
      </div>
      <div class="col-12 col-sm-4 form-group">
        <label for="Nomor HP">Nomor HP</label>
        <input class="form-control" type="text" name="nohp" id="nohp" placeholder="Nomor Handphone" required>
      </div>
    </div>

    <div class="row">
      <div class="col-12 form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="alamat" id="alamat" cols="20" rows="10" placeholder="Alamat Lengkap" required></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-4 form-group">
        <label for="iddsewa">Pilih Paket</label>
        <select class="form-control" name="iddsewa" id="iddsewa">
          <option value"" selected>== Pilih Paket Sewa ==</option>
          <?php $slolo = tampilData("SELECT d.id_dsewa, d.biaya, m.id_kendaraan, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa WHERE m.jumlah>0"); ?>
          <?php if ($slolo != null) : ?>
            <?php foreach ($slolo as $value) : ?>
              <option value="<?= $value['id_dsewa']; ?>"><?= $value['id_dsewa'] ?>: <?= $value['nama_kendaraan'] ?> => <?= $value['durasi'] ?> [<?= rupiah($value['biaya']) ?>] (<?= $value['keterangan'] ?>)</option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <input type="hidden" name="idkenda" id="idkenda" class="form-control" value="<?= $value['id_kendaraan'] ?>">
        <input type="hidden" name="jml" id="jml" class="form-control" value="<?= $value['jumlah'] ?>">
      </div>
      <div class="col-12 col-sm-4">
        <label for="pinjam">Tanggal Pinjam</label>
        <input class="form-control" type="datetime-local" name="pinjam" id="pinjam" required>
      </div>
      <div class="col-12 col-sm-4">
        <label for="kembali">Tanggal Kembali</label>
        <input class="form-control" type="datetime-local" name="kembali" id="kembali" required>
      </div>
    </div>

    <?php
    $nick = $_SESSION['dia'];
    $ty = tampilData("SELECT *FROM users WHERE nickname LIKE '%$nick%'");
    foreach ($ty as $value) : endforeach;
    ?>

    <div class="row">
      <div class="col-12 form-group">
        <input class="form-control" type="hidden" name="idusr" id="idusr" value="<?= $value['id_user'] ?>">
        <label for="nusr">Penindak</label>
        <input class="form-control" type="text" name="nusr" id="nusr" value="<?= ucfirst($_SESSION['dia']) ?>" readonly>
      </div>
    </div>

    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>