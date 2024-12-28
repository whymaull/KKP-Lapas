<?php
session_start(); 
include_once 'config/database.php';
include_once 'functions/user.php';
include_once 'functions/form-helper.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}


// Panggil fungsi untuk mendapatkan data pengguna
$userDetails = getUserDetails($conn, $_SESSION['id_user']);

// Periksa apakah data personal detail kosong
$missingDetails = [];
if (empty($userDetails['nama_lengkap'])) $missingDetails[] = 'Nama Lengkap';
if (empty($userDetails['email'])) $missingDetails[] = 'Email';
if (empty($userDetails['alamat'])) $missingDetails[] = 'Alamat';
if (empty($userDetails['no_ktp'])) $missingDetails[] = 'Nomor KTP';
if (empty($userDetails['no_telepon'])) $missingDetails[] = 'Nomor Telepon';

// Jika data tidak lengkap, simpan pesan dalam sesi
if (!empty($missingDetails)) {
    $_SESSION['warning_message'] = "Mohon lengkapi profil Anda terlebih dahulu: " . implode(', ', $missingDetails) . ".";
}

$userId = $_SESSION['id_user'];
$kabupatenKotaList = getKabupatenKota();
$provinsiList = getProvinsi();
$wbpList = getWBP();
$visitSessions = getVisitSessions();

// If form is submitted, process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
      'id_user' => $userId,
      'id_wbp' => $_POST['wbp'],
      'id_kabupaten_kota' => $_POST['kabKota'],
      'id_provinsi' => $_POST['provinsi'],
      'tanggal_kunjungan' => $_POST['tanggalKunjungan'],
      'sesi_kunjungan' => $_POST['sesiKunjungan'],
      'hubungan_wbp' => $_POST['hubunganWbp'],
      'pengikut_laki' => $_POST['pengikutLaki'],
      'pengikut_wanita' => $_POST['pengikutWanita'],
      'pengikut_anak' => $_POST['pengikutAnak'],
      'barang_bawaan' => $_POST['barangBawaan']
  ];

  if (insertVisit($data, $conn)) {
      $_SESSION['success_message'] = "Kunjungan berhasil didaftarkan!";
      header('Location: form-kunjungan.php');
      exit;
  } else {
      $_SESSION['error_message'] = "Terjadi kesalahan saat mendaftarkan kunjungan.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Formulir Kunjungan Online</title>
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_lapas.png">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Navbar -->
      <?php include 'assets/components/navbar.php'; ?>

      <!-- Sidebar -->
      <?php include 'assets/components/sidebar.php'; ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="card">
            <div class="card-header">
              <h4>Formulir Kunjungan</h4>
            </div>
            <div class="card-body">
              <!-- Pesan Peringatan -->
              <?php if (isset($_SESSION['warning_message'])): ?>
                <div class="alert alert-warning">
                  <?= $_SESSION['warning_message']; unset($_SESSION['warning_message']); ?>
                </div>
              <?php endif; ?>
              <!-- Pesan Sukses -->
              <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                  <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
              <?php endif; ?>
              <!-- Pesan Error -->
              <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger">
                  <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                </div>
              <?php endif; ?>
              <!-- Formulir -->
              <form id="formKunjungan" action="form-kunjungan.php" method="POST">
                <div class="form-row">
                  <!-- Nama Pengunjung -->
                  <div class="form-group col-md-6">
                    <label for="pengunjung">Nama Pengunjung</label>
                    <input type="text" class="form-control" id="pengunjung" name="pengunjung" placeholder="Nama Pengunjung" value="<?php echo $userDetails['nama_lengkap']; ?>" readonly>
                  </div>
                  <!-- Email -->
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $userDetails['email']; ?>" readonly>
                  </div>
                </div>

                <div class="form-row">
                  <!-- Jenis Kelamin -->
                  <div class="form-group col-md-4">
                    <label for="jenisKelamin">Jenis Kelamin</label>
                    <div class="d-flex align-items-center mt-2" style="gap: 20px;">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenisKelaminLaki" name="jenisKelamin" value="Laki-laki" required>
                        <label class="form-check-label" for="jenisKelaminLaki">Laki-laki</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="jenisKelaminPerempuan" name="jenisKelamin" value="Perempuan" required>
                        <label class="form-check-label" for="jenisKelaminPerempuan">Perempuan</label>
                      </div>
                    </div>
                  </div>
                  <!-- Alamat -->
                  <div class="form-group col-md-8">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="2" name="alamat" placeholder="Alamat Lengkap" readonly><?= $userDetails['alamat'] ?></textarea>
                  </div>
                </div>

                <div class="form-row">
                  <!-- Kabupaten/Kota -->
                  <div class="form-group  col-md-6">
                    <label for="kabKota">Kabupaten/Kota</label>
                    <select class="form-control" id="kabKota" name="kabKota" required>
                      <?php foreach ($kabupatenKotaList as $kabupaten): ?>
                        <option value="<?php echo $kabupaten['id_kabupaten_kota']; ?>"><?php echo $kabupaten['nama_kabupaten_kota']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                
                  <!-- Provinsi -->
                  <div class="form-group  col-md-6">
                  <label for="provinsi">Provinsi</label>
                    <select class="form-control" id="provinsi" name="provinsi" required>
                      <?php foreach ($provinsiList as $provinsi): ?>
                        <option value="<?php echo $provinsi['id_provinsi']; ?>"><?php echo $provinsi['nama_provinsi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <!-- Nomor eKTP -->
                  <div class="form-group col-md-6">
                    <label for="noEktp">Nomor eKTP</label>
                    <input type="text" class="form-control" id="noEktp" name="noEktp" placeholder="Nomor eKTP" value="<?= $userDetails['no_ktp'] ?>" readonly>
                  </div>
                  <!-- Nomor Telepon -->
                  <div class="form-group col-md-6">
                    <label for="noTelepon">Nomor Telepon</label>
                    <input type="text" class="form-control" id="noTelepon" name="noTelepon" placeholder="Nomor Telepon" value="<?= $userDetails['no_telepon'] ?>" readonly>
                  </div>
                </div>
                <!-- Pengikut -->
                <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="pengikutLaki">Pengikut Laki-laki</label>
                      <input type="number" class="form-control" id="pengikutLaki" name="pengikutLaki" placeholder="Masukan Angka Pengikut">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="pengikutWanita">Pengikut Wanita</label>
                      <input type="number" class="form-control" id="pengikutWanita" name="pengikutWanita" placeholder="Masukan Angka Pengikut">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="pengikutAnak">Pengikut Anak</label>
                      <input type="number" class="form-control" id="pengikutAnak" name="pengikutAnak" placeholder="Masukan Angka Pengikut">
                    </div>
                </div>
                
                <div class="form-row">
                  <!-- Hubungan dengan WBP -->
                  <div class="form-group col-md-6">
                    <label for="hubunganWbp">Hubungan dengan WBP</label>
                    <select class="form-control" id="hubunganWbp" name="hubunganWbp" required>
                      <option value="" disabled selected>Pilih...</option>
                      <option value="Istri">Istri</option>
                      <option value="Anak">Anak</option>
                      <option value="Saudara">Saudara</option>
                      <option value="Orang Tua">Orang Tua</option>
                      <option value="Pengacara">Pengacara</option>
                      <option value="Lain-lain">Lain-lain</option>
                    </select>
                  </div>
                  <!-- WBP -->
                  <div class="form-group  col-md-6">
                    <label for="wbp">WBP</label>
                    <select class="form-control" id="wbp" name="wbp" required>
                      <?php foreach ($wbpList as $wbp): ?>
                        <option value="<?php echo $wbp['id_wbp']; ?>"><?php echo $wbp['nama_wbp']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                

                <!-- Deskripsi Barang Bawaan -->
                <div class="form-group">
                  <label for="barangBawaan">Deskripsi Barang Bawaan</label>
                  <textarea class="form-control" id="barangBawaan" name="barangBawaan" rows="3" placeholder="Deskripsikan Barang Bawaan" required></textarea>
                </div>

                <!-- Visit Session -->
                <div class="form-group">
                    <label for="sesiKunjungan">Sesi Kunjungan</label>
                    <select class="form-control" id="sesiKunjungan" name="sesiKunjungan" required>
                        <?php if (!empty($visitSessions)): ?>
                            <option value="Sesi 1">Sesi 1: <?= $visitSessions[0]['sesi_1_mulai']; ?> - <?= $visitSessions[0]['sesi_1_selesai']; ?></option>
                            <option value="Sesi 2">Sesi 2: <?= $visitSessions[0]['sesi_2_mulai']; ?> - <?= $visitSessions[0]['sesi_2_selesai']; ?></option>
                            <option value="Sesi 3">Sesi 3: <?= $visitSessions[0]['sesi_3_mulai']; ?> - <?= $visitSessions[0]['sesi_3_selesai']; ?></option>
                        <?php else: ?>
                            <option value="">Tidak ada sesi kunjungan tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Tanggal Kunjungan -->
                <div class="form-group">
                  <label for="tanggalKunjungan">Tanggal Kunjungan</label>
                  <input type="date" class="form-control" id="tanggalKunjungan" name="tanggalKunjungan" required>
                </div>

                <!-- Checkbox Persetujuan -->
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="persetujuan" required>
                  <label class="form-check-label" for="persetujuan">
                    Saya menyetujui syarat dan ketentuan kunjungan.
                  </label>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
      <?php include 'assets/components/footer.php'; ?>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>

</html>
