<?php
session_start();
include_once 'config/database.php';
include_once 'functions/user.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

// Panggil fungsi untuk mendapatkan data pengguna
$userData = getUserDetails($conn, $_SESSION['id_user']);

// Check if personal details are filled (harus belum terisi semua agar muncul 'Isi Personal Details')
$personal_details_filled = !empty($userData['jenis_kelamin']) && !empty($userData['tanggal_lahir']) && !empty($userData['no_ktp']) && !empty($userData['no_telepon']) && !empty($userData['alamat']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo_lapas.png' />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php include 'assets/components/navbar.php'; ?>
      <?php include 'assets/components/sidebar.php'; ?>

      <div class="main-content">
        <section class="section">
          <div class="section-body">
              <!-- Personal Details -->
              <div class="col-md-10 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Nama</div>
                      <div class="col-sm-8"><?php echo $userData['nama_lengkap'] ?: 'Belum Diisi'; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Email</div>
                      <div class="col-sm-8"><?php echo $userData['email']; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Jenis Kelamin</div>
                      <div class="col-sm-8"><?php echo $userData['jenis_kelamin'] ?: 'Belum Diisi'; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Tanggal Lahir</div>
                      <div class="col-sm-8"><?php echo $userData['tanggal_lahir'] ?: 'Belum Diisi'; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Nomor eKTP</div>
                      <div class="col-sm-8"><?php echo $userData['no_ktp'] ?: 'Belum Diisi'; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Nomor Telepon</div>
                      <div class="col-sm-8"><?php echo $userData['no_telepon'] ?: 'Belum Diisi'; ?></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4 text-muted">Alamat</div>
                      <div class="col-sm-8"><?php echo $userData['alamat'] ?: 'Belum Diisi'; ?></div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="reset-password.php" class="btn btn-primary">Reset Password</a>
                    <?php if (!$personal_details_filled): ?>
                      <a href="edit-profile.php" class="btn btn-primary">Isi Personal Details</a>
                    <?php else: ?>
                      <a href="edit-profile.php" class="btn btn-primary">Edit Profile</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include 'assets/components/footer.php'; ?>
    </div>
  </div>

  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>
