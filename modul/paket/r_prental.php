<?php
require "function.php";

// paginasi
$jumlahDataPerHal = 5;
$jumlahData = count(tampilData("SELECT d.id_dsewa, d.biaya, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

$ssr = tampilData("SELECT d.id_dsewa, d.biaya, m.nama_kendaraan, m.jumlah, t.durasi, t.keterangan FROM detail_sewa d join mobil m on d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t on d.id_tsewa=t.id_tsewa LIMIT $awalData, $jumlahDataPerHal");

if (isset($_POST['cari'])) :
  $ssr = cariDataPrental($_POST['keyword'], $awalData, $jumlahDataPerHal);
  $jumlahData = count(cariDataPrental($_POST['keyword'], $awalData, $jumlahDataPerHal));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
  $halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
  $awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Data Paket</h2>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><a class="font-weight-bold nav-link" href="index.php?pg=prental&act=add"><i class="fas fa-plus">&nbsp;</i>Tambah Data</a></h4>
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
  if ($ssr != null) :
  ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tr>
                  <th>No.</th>
                  <th>ID Paket</th>
                  <th>Biaya</th>
                  <th>Kendaraan</th>
                  <th>Jumlah</th>
                  <th>Durasi</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>

                <?php
                $i = 1;
                foreach ($ssr as $value) :
                ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $value['id_dsewa']; ?></td>
                    <td><?= rupiah($value['biaya']); ?></td>
                    <td><?= $value['nama_kendaraan']; ?></td>
                    <td><?= $value['jumlah']; ?></td>
                    <td><?= $value['durasi']; ?></td>
                    <td><?= $value['keterangan']; ?></td>
                    <td>
                      <a class="btn btn-warning" href="index.php?pg=prental&act=edit&e=<?= $value['id_dsewa'] ?>">Ubah</a> <br>
                      <a class="btn btn-danger mt-1" href="modul/paket/option.php?d=<?= $value['id_dsewa'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php
                  $i++;
                endforeach;
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row pb-5">
      <div class="col-12 text-center">
        <nav class="d-inline-block">
          <ul class="pagination mb-0">
            <li class="page-item  <?= $halAktif > 1 ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=prental&hl=<?= $halAktif - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
                <a class="page-link" href="?pg=prental&hl=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= $halAktif < $jumlahHalaman ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=prental&hl=<?= $halAktif + 1 ?>"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  <?php else : ?>
    <h4>Data tidak ditemukan.</h4>
  <?php endif; ?>
</div>