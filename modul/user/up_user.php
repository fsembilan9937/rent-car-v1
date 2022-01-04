<?php
require "function.php";

if (isset($_GET['e'])) {

  $id = $_GET['e'];
  $yoi = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id");

  if (mysqli_num_rows($yoi) === 1) {
    $ioy = mysqli_fetch_assoc($yoi);
  } else {
    echo "<script>
    alert('Gagal Update Data!');
    document.location.href='index.php?pg=user'
    </script>";
  }
}
?>

<div class="section-body">
  <h2 class="section-title">Ubah Data User</h2>
  <form action="modul/user/option.php" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <input class="form-control" type="hidden" name="id" value="<?= $ioy['id_user'] ?>">
          <label for="nickname">Nickname</label>
          <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Nickname" value="<?= $ioy['nickname'] ?>" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" type="text" name="pw" id="pw" placeholder="Password" required autocomplete="off">
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <input class="form-control" type="number" name="status" id="status" value="<?= $ioy['status'] ?>" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" name="role" id="role">
            <option value="admin" <?= $ioy['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="superadmin" <?= $ioy['role'] == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
          </select>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Ubah</button>
  </form>
</div>