<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; RENT-APP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>

<body>

  <?php
  session_start();

  require "functions/general.php";
  batasanLogin();

  if (isset($_POST['login'])) {
    $usr = $_POST['nickname'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE nickname = '$usr' AND status = '1'");
    $upw = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) != 1) {
      echo "<script>alert('Username atau Password Anda Salah!')</script>";
    } else {
      if (password_verify($pass, $upw['pw'])) {
        $_SESSION["verifikasi"] = true;
        $_SESSION["dia"] = $upw['nickname'];
        $_SESSION["hak"] = $upw['role'];
        echo "<script>
                alert('login berhasil');
                document.location.href='index.php'
            </script>";
      } else {
        echo "<script>alert('Username atau Password Anda Salah!')</script>";
      }
    }
  }
  ?>

  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="frontend/images/logo.jpeg" alt="logo" width="110" class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">CV ASRI</span></h4>
            <p class="text-muted">Sebelum menggunakan aplikasi, anda diharap untuk melakukan login terlebih dahulu.</p>
            <form method="POST" action="" class="needs-validation" novalidate="">
              <div class="form-group">
                <label for="nickname">Nama</label>
                <input id="nickname" type="text" class="form-control" name="nickname" tabindex="1" required autofocus autocomplete="off">
                <div class="invalid-feedback">
                  Nama masih kosong.
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  Password masih kosong.
                </div>
              </div>

              <div class="form-group text-right">
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Masuk
                </button>
              </div>
              <span>&nbsp;</span>
            </form>

            <div class="text-center mt-5 pt-4 text-small">
              Copyright &copy; Your Company. Made with 💙 by F9
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="frontend/images/erik-mclean-JR3etRoFj9o-unsplash.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold"><?= ucapan() ?></h1>
                <h5 class="font-weight-normal text-muted-transparent">Surabaya, Indonesia</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>

</html>