<?php
session_start();
include_once 'config/database.php';
include_once 'functions/auth.php';

// Inisialisasi variabel error
$error = null;

// Cek apakah form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = loginUser($email, $password);

  if (is_array($user)) {
      // Simpan data pengguna ke sesi
      $_SESSION['id_user'] = $user['id_user'];
      $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
      $_SESSION['role'] = $user['role'];

      // Redirect sesuai peran
      if ($user['role'] === 'admin') {
          header("Location: admin/index.php");
      } else {
          header("Location: index.php");
      }
      exit;
  } else {
      // Jika login gagal
      $error = $user;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_lapas.png" />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <!-- Display error message if login failed -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Masukan Email Anda" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Harap masukan email Anda
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgot-password.php" class="text-small">Lupa Password?</a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Masukan Password Anda" tabindex="2" required>
                    <div class="invalid-feedback">
                    Harap masukan password Anda
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Ingat saya</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Tidak memiliki akun? <a href="register.php">Buat Akun</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>
