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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $ktp = $_POST['ktp'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Panggil fungsi update profil
    updateUserProfile($_SESSION['id_user'], $name, $email, $gender, $birthdate, $ktp, $phone, $address);
    header("Location: profile.php"); // Redirect setelah update
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_lapas.png" />
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
              <div class="col-md-10 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Profile</h4>
                  </div>
                  <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label text-muted">Nama</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $userData['nama_lengkap'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-muted">Email</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="gender" class="col-sm-4 col-form-label text-muted">Jenis Kelamin</label>
                        <div class="col-sm-8">
                          <select class="form-control" id="gender" name="gender">
                            <option value="Perempuan" <?php echo $userData['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            <option value="Laki-laki" <?php echo $userData['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="birthdate" class="col-sm-4 col-form-label text-muted">Tanggal Lahir</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($userData['tanggal_lahir']); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="ktp" class="col-sm-4 col-form-label text-muted">Nomor eKTP</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="ktp" name="ktp" value="<?php echo $userData['no_ktp'];?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label text-muted">Nomor Telepon</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="phone" value="<?php echo $userData['no_telepon']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-4 col-form-label text-muted">Alamat</label>
                        <div class="col-sm-8">
                          <textarea name="address" class="form-control"><?php echo $userData['alamat']; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                      <a href="profile.php" class="btn btn-secondary">Batal</a>
                    </div>
                  </form>
                </div>
              </div>
             
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>
