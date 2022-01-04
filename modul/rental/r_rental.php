<?php
require "function.php";

// paginasi
$jumlahDataPerHal = 5;
$jumlahData = count(tampilData("SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.status = '1'"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;

$ssr = tampilData("SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.status = '1' LIMIT $awalData, $jumlahDataPerHal");

if (isset($_POST['cari'])) :
  $ssr = cariDataRental($_POST['keyword'], $awalData, $jumlahDataPerHal);
  $jumlahData = count(cariDataRental($_POST['keyword'], $awalData, $jumlahDataPerHal));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHal);
  $halAktif = (isset($_GET['hl'])) ? $_GET['hl'] : 1;
  $awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Data Rental</h2>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><a class="font-weight-bold nav-link" href="index.php?pg=rental&act=add"><i class="fas fa-plus">&nbsp;</i>Tambah Data</a></h4>
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
                  <th>Customer</th>
                  <th>Pinjam</th>
                  <th>Harus Kembali</th>
                  <th>Dikembalikan</th>
                  <th>Denda</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>

                <?php
                $i = 1;
                foreach ($ssr as $value) :
                ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= strtoupper($value['customer']); ?></td>
                    <td><?= $value['tgl_pinjam']; ?></td>
                    <td><?= $value['tgl_kembali']; ?></td>
                    <td><?= $value['tgl_dikembalikan'] == null ? 'Belum' : $value['tgl_dikembalikan'] ?></td>
                    <td><?= $value['denda'] == null ? 'Tidak Ada' : rupiah($value['denda']) ?></td>

                    <?php
                    $cess = "";
                    if ($value['ket'] == 'pending') :
                      $cess = "badge-warning";
                    elseif ($value['ket'] == 'paid') :
                      $cess = "badge-success";
                    elseif ($value['ket'] == 'due') :
                      $cess = "badge-danger";
                    elseif ($value['ket'] == 'done') :
                      $cess = "badge-secondary";
                    endif; ?>

                    <td><span class="badge <?= $cess ?>"><?= $value['ket']; ?></span></td>

                    <td>
                      <a class="btn btn-warning" href="index.php?pg=rental&act=edit&e=<?= $value['id_rental'] ?>">Ubah</a>
                      <!-- buttonModal -->
                      <a class="btn btn-info text-white" data-toggle="modal" data-target="#detail<?= $value['id_rental'] ?>">Detail</a>

                      <!-- modalLayout -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="detail<?= $value['id_rental'] ?>">
                        <div class="modal-xl modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Detail Sewa</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <table class="table table-hover table-bordered table-striped">
                                <tr>
                                  <th>ID Rental</th>
                                  <td colspan="5"><?= $value['id_rental'] ?></td>
                                </tr>
                                <tr>
                                  <th>Customer</th>
                                  <td colspan="5"><?= $value['customer'] ?></td>
                                </tr>
                                <tr>
                                  <th>Nama</th>
                                  <td colspan="5"><?= $value['nama'] ?></td>
                                </tr>
                                <tr>
                                  <th>Nomor HP</th>
                                  <td colspan="5"><?= $value['nohp'] ?></td>
                                </tr>
                                <tr>
                                  <th>Alamat</th>
                                  <td colspan="5"><?= $value['alamat'] ?></td>
                                </tr>
                                <tr>
                                  <th>Tanggal Pinjam</th>
                                  <td colspan="5"><?= $value['tgl_pinjam'] ?></td>
                                </tr>
                                <tr>
                                  <th>Tanggal Kembali</th>
                                  <td colspan="5"><?= $value['tgl_kembali'] ?></td>
                                </tr>
                                <tr>
                                  <th>Tanggal Dikembalikan</th>
                                  <td colspan="5"><?= $value['tgl_dikembalikan'] == null ? 'Belum' : $value['tgl_dikembalikan'] ?></td>
                                </tr>
                                <tr>
                                  <th>Denda</th>
                                  <td colspan="5"><?= $value['denda'] == null ? 'Tidak Ada' : rupiah($value['denda']) ?></td>
                                </tr>
                                <tr>
                                  <th>Keterangan</th>
                                  <td colspan="5"><span class="badge <?= $cess ?>"><?= $value['ket'] ?></span></td>
                                </tr>
                                <tr>
                                  <th>Penindak</th>
                                  <td colspan="5"><?= $value['nickname'] ?></td>
                                </tr>
                                <tr>
                                  <th rowspan="2">Detail Pesanan</th>
                                  <th>ID Paket</th>
                                  <th>Kendaraan</th>
                                  <th>Durasi</th>
                                  <th>Detail Paket</th>
                                  <th>Biaya</th>
                                </tr>
                                <tr>
                                  <td><?= $value['id_dsewa'] ?></td>
                                  <td><?= $value['nama_kendaraan'] ?></td>
                                  <td><?= $value['durasi'] ?></td>
                                  <td><?= $value['keterangan'] ?></td>
                                  <td><?= rupiah($value['biaya']) ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                              <a href="modul/cetak/cetak.php?print=<?= $value['id_rental'] ?>" target="_blank" class="btn btn-primary">Cetak</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <a class="btn btn-danger" href="modul/rental/option.php?d=<?= $value['id_rental'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a> -->
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
              <a class="page-link" href="?pg=rental&hl=<?= $halAktif - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
                <a class="page-link" href="?pg=rental&hl=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= $halAktif < $jumlahHalaman ? '' : 'disabled' ?>">
              <a class="page-link" href="?pg=rental&hl=<?= $halAktif + 1 ?>"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  <?php else : ?>
    <h4>Data tidak ditemukan.</h4>
  <?php endif; ?>
</div>