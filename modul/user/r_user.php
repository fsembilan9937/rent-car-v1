<?php
require "function.php";

// paginasi
$jumlahDataPerHal = 5;
$jumlahData = count(tampilData("SELECT * FROM users WHERE status = '1'"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

$ssr = tampilData("SELECT * FROM users WHERE status = '1' LIMIT $awalData, $jumlahDataPerHal");

if (isset($_POST['cari'])) :
  $ssr = cariDataUser($_POST['keyword'], $awalData, $jumlahDataPerHal);
  $jumlahData = count(cariDataUser($_POST['keyword'], $awalData, $jumlahDataPerHal));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
  $halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
  $awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

endif;
?>

<div class="section-body">
  <h2 class="section-title">Data User</h2>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><a class="font-weight-bold nav-link" href="index.php?pg=user&act=add"><i class="fas fa-plus">&nbsp;</i>Tambah Data</a></h4>
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
                  <th>Nickname</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>

                <?php
                $i = 1;
                foreach ($ssr as $value) :
                ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $value['nickname']; ?></td>
                    <td><?= $value['role']; ?></td>
                    <td><?= $value['status']; ?></td>
                    <td>
                      <a class="btn btn-warning" href="index.php?pg=user&act=edit&e=<?= $value['id_user'] ?>">Ubah</a>
                      <a class="btn btn-danger" href="modul/user/option.php?d=<?= $value['id_user'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
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
              <a class="page-link" href="?pg=user&hl=<?= $halAktif - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
                <a class="page-link" href="?pg=user&hl=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= $halAktif < $jumlahHalaman ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=user&hl=<?= $halAktif + 1 ?>"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  <?php else : ?>
    <h4>Data tidak ditemukan.</h4>
  <?php endif; ?>
</div>