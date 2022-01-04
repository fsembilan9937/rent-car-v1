<?php
require "function.php";

// paginasi
$jumlahDataPerHal = 5;
$jumlahData = count(tampilData("SELECT g.id_galeri, m.nama_kendaraan, g.gambar FROM galeri g JOIN mobil m ON g.id_mobil=m.id_kendaraan"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

$ssr = tampilData("SELECT g.id_galeri, m.nama_kendaraan, g.gambar FROM galeri g JOIN mobil m ON g.id_mobil=m.id_kendaraan LIMIT $awalData, $jumlahDataPerHal");

if (isset($_POST['cari'])) :
  $ssr = cariDataGaleri($_POST['keyword'], $awalData, $jumlahDataPerHal);
  $jumlahData = count(cariDataGaleri($_POST['keyword'], $awalData, $jumlahDataPerHal));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
  $halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
  $awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

endif;
?>

<div class="section-body">
  <h2 class="section-title">Data Galeri</h2>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><a class="font-weight-bold nav-link" href="index.php?pg=galeri&act=add"><i class="fas fa-plus">&nbsp;</i>Tambah Data</a></h4>
          <div class="card-header-form">
            <form action="" method="POST">
              <div class="input-group">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari..." autofocus autocomplete="off">
                <div class="input-group-btn">
                  <button type="submit" name="cari" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  if ($ssr != null) : ?>
    <?php $i = 1; ?>
    <div class="row">
      <?php foreach ($ssr as $value) : ?>
        <div class="col-12 col-md-4 col-sm-4">
          <div class="card">
            <div class="card-header">
              <h4><?= $value['nama_kendaraan']; ?></h4>
              <div class="card-header-action">
                <a href="index.php?pg=galeri&act=edit&e=<?= $value['id_galeri'] ?>" class="btn btn-warning">Ubah</a>
                <a href="modul/galeri/option.php?d=<?= $value['id_galeri'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger">Hapus</a>
              </div>
            </div>
            <div class="card-body">
              <div class="chocolat-parent">
                <a href="frontend/images/<?= $value['gambar']; ?>" class="chocolat-image" title="<?= $value['nama_kendaraan']; ?>">
                  <div data-crop-image="250">
                    <img src="frontend/images/<?= $value['gambar']; ?>" alt="<?= $value['nama_kendaraan']; ?>" class="img-fluid">
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php endforeach; ?>
    </div>

    <div class="row pb-5">
      <div class="col-12 text-center">
        <nav class="d-inline-block">
          <ul class="pagination mb-0">
            <li class="page-item  <?= $halAktif > 1 ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=galeri&hl=<?= $halAktif - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
                <a class="page-link" href="?pg=galeri&hl=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= $halAktif < $jumlahHalaman ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=galeri&hl=<?= $halAktif + 1 ?>"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  <?php else : ?>
    <div class="col-12">
      <h6>Data tidak ditemukan.</h6>
    </div>
  <?php endif; ?>
</div>