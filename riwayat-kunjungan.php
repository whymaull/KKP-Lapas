<?php
session_start();
include_once 'config/database.php';
include_once 'functions/riwayat-helper.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION['id_user'];
$riwayatKunjungan = getRiwayatKunjungan($conn, $id_user);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Riwayat Kunjungan -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="admin/assets/css/modal.css">
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
          
          <!-- Table Riwayat Kunjungan -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Riwayat Kunjungan</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-md table-hover text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Hubungan dengan WBP</th>
                        <th>WBP</th>
                        <th>Sesi Kunjungan</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (count($riwayatKunjungan) > 0): ?>
                          <?php foreach ($riwayatKunjungan as $index => $kunjungan): ?>
                              <tr>
                                <td><?= $index + 1 ?></td>
                                    <td><?= $kunjungan['nama_pengunjung'] ?></td>
                                    <td><?= $kunjungan['hubungan_wbp'] ?></td>
                                    <td><?= $kunjungan['nama_wbp'] ?></td>
                                    <td><?= $kunjungan['sesi_kunjungan'] ?></td>
                                    <td><?= $kunjungan['tanggal_kunjungan'] ?></td>
                                  <td>
                                      <div class="badge badge-<?= getStatusBadgeClass($kunjungan['status_kunjungan']) ?>">
                                          <?= ucfirst($kunjungan['status_kunjungan']) ?>
                                      </div>
                                  </td>
                                  <td>
                                      <div class="buttons">
                                      <a href="#" class="btn btn-outline-primary detail-btn" 
                                        data-id="<?= $kunjungan['id_kunjungan'] ?>"
                                        data-nama="<?= $kunjungan['nama_pengunjung'] ?>"
                                        data-email="<?= $kunjungan['email'] ?? '' ?>"
                                        data-jenis-kelamin="<?= $kunjungan['jenis_kelamin'] ?? '' ?>"
                                        data-alamat="<?= $kunjungan['alamat'] ?? '' ?>"
                                        data-kabupaten="<?= $kunjungan['nama_kabupaten_kota'] ?? '' ?>"
                                        data-provinsi="<?= $kunjungan['nama_provinsi'] ?? '' ?>"
                                        data-no-ktp="<?= $kunjungan['no_ktp'] ?? '' ?>"
                                        data-no-telepon="<?= $kunjungan['no_telepon'] ?? '' ?>"
                                        data-pengikut-laki="<?= $kunjungan['pengikut_laki'] ?? '' ?>"
                                        data-pengikut-wanita="<?= $kunjungan['pengikut_wanita'] ?? '' ?>"
                                        data-pengikut-anak="<?= $kunjungan['pengikut_anak'] ?? '' ?>"
                                        data-hubungan="<?= $kunjungan['hubungan_wbp'] ?? '' ?>"
                                        data-nama-wbp="<?= $kunjungan['nama_wbp'] ?? '' ?>"
                                        data-barang-bawaan="<?= $kunjungan['barang_bawaan'] ?? '' ?>"
                                        data-sesi="<?= $kunjungan['sesi_kunjungan'] ?? '' ?>"
                                        data-tanggal="<?= $kunjungan['tanggal_kunjungan'] ?? '' ?>">Detail</a>
                                      </div>
                                    </td>
                              </tr>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="12" class="text-center">Tidak ada data kunjungan</td>
                          </tr>
                      <?php endif; ?>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer text-right">
                <nav class="d-inline-block">
                  <ul class="pagination mb-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <!-- Modal untuk Detail -->
          <dialog id="detailDialog">
            <div class="dialog-header">
                <h5>Detail Pengunjung</h5>
                <button class="dialog-close-btn" aria-label="Close">&times;</button>
            </div>
            <div class="dialog-content">
                <p><strong>Nama:</strong> <span id="dialogNama"></span></p>
                <p><strong>Email:</strong> <span id="dialogEmail"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="dialogJenisKelamin"></span></p>
                <p><strong>Alamat:</strong> <span id="dialogAlamat"></span></p>
                <p><strong>Kabupaten/Kota:</strong> <span id="dialogKabKota"></span></p>
                <p><strong>Provinsi:</strong> <span id="dialogProvinsi"></span></p>
                <p><strong>No. KTP:</strong> <span id="dialogKTP"></span></p>
                <p><strong>No. Telepon:</strong> <span id="dialogTelepon"></span></p>
                <p><strong>Hubungan dengan WBP:</strong> <span id="dialogHubungan"></span></p>
                <p><strong>Pengikut Laki-laki:</strong> <span id="dialogPengikutLaki"></span></p>
                <p><strong>Pengikut Wanita:</strong> <span id="dialogPengikutWanita"></span></p>
                <p><strong>Pengikut Anak:</strong> <span id="dialogPengikutAnak"></span></p>
                <p><strong>Barang Bawaan:</strong> <span id="dialogBarang"></span></p>
                <p><strong>WBP:</strong> <span id="dialogWBP"></span></p>
                <p><strong>Sesi Kunjungan:</strong> <span id="dialogSesi"></span></p>
                <p><strong>Tanggal Kunjungan:</strong> <span id="dialogTanggal"></span></p>
            </div>
            </dialog>
        </section>
      </div>
      
      <!-- Footer -->
      <?php include 'assets/components/footer.php'; ?>
      
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/pagination.js"></script>
  <script src="admin/assets/js/modal.js"></script>
</body>

</html>
