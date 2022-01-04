<?php
require "function.php";

if (isset($_POST['submit'])) :
  if (tambahDataUser($_POST) === 1) :
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href='index.php?pg=user'
    </script>";
  else :
    echo "<script>
    alert('Data gagal ditambahkan! Periksa inputan anda!');
    document.location.href='index.php?pg=user&act=add'
    </script>";
  endif;
endif;
?>

<div class="section-body">
  <h2 class="section-title">Tambah Data User</h2>
  <form action="" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="nickname">Nickname</label>
          <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Nickname" required>
        </div>
        <div class="form-group">
          <label for="pw">Password</label>
          <input class="form-control" type="password" name="pw" id="pw" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" name="role" id="role">
            <option value="">== Pilih Hak Akses ==</option>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
          </select>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
  </form>
</div>