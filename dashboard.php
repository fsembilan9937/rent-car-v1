<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-copyright"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#brand" class="text-decoration-none">
                <h4>Brand</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="brand">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Brand</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = tampilData("SELECT * FROM brand_mobil");
                    ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Nama Brand</th>
                            <th>Logo</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['nama_brand'] ?></td>
                              <td><img width="75" src="frontend/images/<?= $value['logo'] ?>" alt="<?= $value['nama_brand'] ?>"></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= jumlahMerk() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="fas fa-car"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#tersedia" class="text-decoration-none">
                <h4>Kendaraan Tersedia</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="tersedia">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kendaraan Tersedia</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = tampilData("SELECT m.*, b.nama_brand FROM mobil m JOIN brand_mobil b ON m.id_merk=b.id_brand WHERE jumlah >= 1");
                    ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Nopol</th>
                            <th>Jumlah</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['nama_kendaraan'] ?></td>
                              <td><?= $value['nama_brand'] ?></td>
                              <td><?= $value['nopol'] ?></td>
                              <td><?= $value['jumlah'] ?></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= jumlahKendaraan() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-car-side"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#keluar" class="text-decoration-none">
                <h4>Kendaraan Keluar</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="keluar">
                <div class="modal-lg modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kendaraan Keluar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = tampilData("SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.status = '1' AND r.ket in('paid', 'due')");
                    ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>ID Paket</th>
                            <th>Kendaraan</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['customer'] ?></td>
                              <td><?= $value['tgl_pinjam'] ?></td>
                              <td><?= $value['tgl_kembali'] ?></td>
                              <td><?= $value['id_dsewa'] ?></td>
                              <td><?= $value['nama_kendaraan'] ?></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= kendaraanKeluar() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-clock"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#keterlambatan" class="text-decoration-none">
                <h4>Keterlambatan</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="keterlambatan">
                <div class="modal-lg modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Terlambat</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = keterlambatan(); ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>ID Paket</th>
                            <th>Kendaraan</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['customer'] ?></td>
                              <td><?= $value['tgl_pinjam'] ?></td>
                              <td><?= $value['tgl_kembali'] ?></td>
                              <td><?= $value['id_dsewa'] ?></td>
                              <td><?= $value['nama_kendaraan'] ?></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= count(keterlambatan()) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-secondary">
            <i class="fas fa-hourglass-half"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#pending" class="text-decoration-none">
                <h4>Pending</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="pending">
                <div class="modal-lg modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Pending</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = tampilData("SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.status = '1' AND r.ket = 'pending'") ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>ID Paket</th>
                            <th>Kendaraan</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['customer'] ?></td>
                              <td><?= $value['tgl_pinjam'] ?></td>
                              <td><?= $value['tgl_kembali'] ?></td>
                              <td><?= $value['id_dsewa'] ?></td>
                              <td><?= $value['nama_kendaraan'] ?></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= kendaraanPending() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <a href="" data-toggle="modal" data-target="#lunas" class="text-decoration-none">
                <h4>Lunas</h4>
              </a>
              <!-- modal -->
              <div class="modal fade" tabindex="-1" role="dialog" id="lunas">
                <div class="modal-lg modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Lunas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php $ssr = tampilData("SELECT r.*, u.nickname, m.nama_kendaraan, t.durasi, t.keterangan, d.biaya FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa WHERE r.status = '1' AND r.ket in('paid','done')") ?>

                    <div class="modal-body">
                      <?php
                      if ($ssr != null) :
                      ?>
                        <table class="table table-striped table-md">
                          <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>ID Paket</th>
                            <th>Kendaraan</th>
                          </tr>
                          <?php
                          $i = 1;
                          foreach ($ssr as $value) :
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $value['customer'] ?></td>
                              <td><?= $value['tgl_pinjam'] ?></td>
                              <td><?= $value['tgl_kembali'] ?></td>
                              <td><?= $value['id_dsewa'] ?></td>
                              <td><?= $value['nama_kendaraan'] ?></td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </table>
                      <?php else : ?>
                        <h4>Data Kosong.</h4>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= kendaraanLunas() ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>