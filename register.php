<?php
session_start();
// Include file koneksi database dan auth
include_once 'config/database.php';
include_once 'functions/auth.php';

$error = "";

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];

    // Validasi form
    if (empty($full_name) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = "Semua field harus diisi.";
    } elseif ($password !== $password_confirm) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Panggil fungsi registerUser untuk memasukkan data
        $registerResult = registerUser($full_name, $email, $password);

        if ($registerResult === true) {
            // Redirect ke halaman login setelah berhasil registrasi
            header("Location: login.php");
            exit();
        } else {
            $error = $registerResult; // Jika gagal, tampilkan pesan error
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <?php if ($error) { ?>
                  <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="full_name">Nama Lengkap</label>
                      <input id="full_name" type="text" class="form-control" name="full_name" placeholder="Masukan Nama Lengkap Anda" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email" placeholder="Masukan Email Anda" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" placeholder="Masukan Password Anda" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password-confirm" placeholder="Masukan Password Anda Kembali" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">Saya setuju dengan syarat dan ketentuan</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Sudah memiliki akun? <a href="login.php">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="assets/js/page/auth-register.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>
