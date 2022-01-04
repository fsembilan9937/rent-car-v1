<?php
require "function.php";

// paginasi
$jumlahDataPerHal = 5;
$jumlahData = count(tampilData("SELECT * FROM mobil"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

$ssr = tampilData("SELECT * FROM mobil LIMIT $awalData, $jumlahDataPerHal");

if (isset($_POST['cari'])) :
  $ssr = cariDataKendaraan($_POST['keyword'], $awalData, $jumlahDataPerHal);
  $jumlahData = count(cariDataKendaraan($_POST['keyword'], $awalData, $jumlahDataPerHal));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
  $halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
  $awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

endif;
?>
<div class="section-body">
  <h2 class="section-title">Data Kendaraan</h2>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><a class="font-weight-bold nav-link" href="index.php?pg=kendaraan&act=add"><i class="fas fa-plus">&nbsp;</i>Tambah Data</a></h4>
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

  <?php if ($ssr != null) : ?>
    <?php $i = 1; ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Merk</th>
                  <th>Nopol</th>
                  <th>Jumlah</th>
                  <th>Opsi</th>
                </tr>
                <?php
                $i = 1;
                foreach ($ssr as $value) :
                ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $value['nama_kendaraan']; ?></td>

                    <?php $slolo = tampilData("SELECT * FROM brand_mobil"); ?>
                    <?php if ($slolo != null) : ?>
                      <?php foreach ($slolo as $valu) : ?>
                        <?php if ($value['id_merk'] == $valu['id_brand']) : ?>
                          <td><?= $valu['nama_brand']; ?></td>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>

                    <td><?= $value['nopol']; ?></td>
                    <td><?= $value['jumlah']; ?></td>
                    <td>
                      <!-- buttonModal -->
                      <a class="btn btn-info text-white" data-toggle="modal" data-target="#detail<?= $value['id_kendaraan'] ?>">Detail</a>
                      <!-- modalLayout -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="detail<?= $value['id_kendaraan'] ?>">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Detail Kendaraan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <table class="table table-hover table-bordered table-striped">
                                <tr>
                                  <th>ID</th>
                                  <td><?= $value['id_kendaraan'] ?></td>
                                </tr>
                                <tr>
                                  <th>Nama</th>
                                  <td><?= $value['nama_kendaraan'] ?></td>
                                </tr>
                                <tr>
                                  <th>Merk</th>
                                  <?php if ($slolo != null) : ?>
                                    <?php foreach ($slolo as $valu) : ?>
                                      <?php if ($value['id_merk'] == $valu['id_brand']) : ?>
                                        <td><?= $valu['nama_brand']; ?></td>
                                      <?php endif; ?>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                </tr>
                                <tr>
                                  <th>Nopol</th>
                                  <td><?= $value['nopol'] ?></td>
                                </tr>
                                <tr>
                                  <th>Jumlah</th>
                                  <td><?= $value['jumlah'] ?></td>
                                </tr>
                                <tr>
                                  <th>Tahun</th>
                                  <td><?= $value['tahun'] ?></td>
                                </tr>
                                <tr>
                                  <th>Warna</th>
                                  <td><?= $value['warna'] ?></td>
                                </tr>
                                <tr>
                                  <th>Jumlah Kursi</th>
                                  <td><?= $value['jumlah_kursi'] ?></td>
                                </tr>
                                <tr>
                                  <th>BBM</th>
                                  <td><?= $value['bahan_bakar'] ?></td>
                                </tr>
                                <tr>
                                  <th>Nomor Rangka</th>
                                  <td><?= $value['no_rangka'] ?></td>
                                </tr>
                                <tr>
                                  <th>Nomor Mesin</th>
                                  <td><?= $value['no_mesin'] ?></td>
                                </tr>
                                <tr>
                                  <th>Kondisi</th>
                                  <td align="justify"><?= $value['kondisi'] ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <a class="btn btn-warning" href="index.php?pg=kendaraan&act=edit&e=<?= $value['id_kendaraan'] ?>">Ubah</a>
                      <a class="btn btn-danger" href="modul/kendaraan/option.php?d=<?= $value['id_kendaraan'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
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
              <a class="page-link" href="?pg=kendaraan&hl=<?= $halAktif - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
                <a class="page-link" href="?pg=kendaraan&hl=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= $halAktif < $jumlahHalaman ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=kendaraan&hl=<?= $halAktif + 1 ?>"><i class="fas fa-chevron-right"></i></a>
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