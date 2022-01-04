<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataBrand($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=brand'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=brand&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data Brand</h2>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama_brand">Nama Brand</label>
              <input type="text" name="nama_brand" id="nama_brand" placeholder="Nama Brand" required class="form-control">
            </div>
            <div class="form-group">
              <label for="gambar">Logo</label>
              <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>