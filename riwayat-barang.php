<?php
session_start();
include_once 'config/database.php';
include_once 'functions/riwayat-helper.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION['id_user'];
$riwayatBarang = getRiwayatBarang($conn, $id_user);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Riwayat Pengiriman -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/toggle.css">
  <link rel="stylesheet" href="assets/css/modal.css">
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
          
          <!-- Table Status Pengiriman -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Riwayat Pengiriman Barang</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-md table-hover text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pengirim</th>
                        <th>Jenis Barang</th>
                        <th>Hubungan dengan WBP</th>
                        <th>WBP</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (count($riwayatBarang) > 0): ?>
                        <?php foreach ($riwayatBarang as $index => $barang): ?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td><?= $barang['nama_pengirim'] ?></td>
                          <td><?= $barang['jenis_barang'] ?></td>
                          <td><?= $barang['hubungan_wbp'] ?></td>
                          <td><?= $barang['nama_wbp'] ?></td>
                          <td><?= $barang['tanggal_pengiriman'] ?></td>
                          <td>
                            <div class="badge badge-<?= $barang['status_pengiriman'] === 'selesai' ? 'success' : 'danger' ?>">
                              <?= ucfirst($barang['status_pengiriman']) ?>
                            </div>
                          </td>
                          <td>
                                      <div class="buttons">
                                      <a href="#" class="btn btn-outline-primary detail-btn" 
                                        data-id="<?= $barang['id_pengiriman'] ?>"
                                        data-nama="<?= $barang['nama_pengirim'] ?>"
                                        data-email="<?= $barang['email'] ?? '' ?>"
                                        data-jenis-kelamin="<?= $barang['jenis_kelamin'] ?? '' ?>"
                                        data-alamat="<?= $barang['alamat'] ?? '' ?>"
                                        data-kabupaten="<?= $barang['nama_kabupaten_kota'] ?? '' ?>"
                                        data-provinsi="<?= $barang['nama_provinsi'] ?? '' ?>"
                                        data-no-ktp="<?= $barang['no_ktp'] ?? '' ?>"
                                        data-no-telepon="<?= $barang['no_telepon'] ?? '' ?>"
                                        data-jenis="<?= $barang['jenis_barang'] ?? '' ?>"
                                        data-jumlah="<?= $barang['jumlah_barang'] ?? '' ?>"
                                        data-desk="<?= $barang['deskripsi_barang'] ?? '' ?>"
                                        data-hubungan="<?= $barang['hubungan_wbp'] ?? '' ?>"
                                        data-nama-wbp="<?= $barang['nama_wbp'] ?? '' ?>"
                                        data-tanggal="<?= $barang['tanggal_pengiriman'] ?? '' ?>">Detail</a>
                                      </div>
                                    </td>
                          <td>
                            <button class="btn btn-info btn-sm" onclick="showImageModal('<?= htmlspecialchars($barang['foto_bukti']) ?>')">
                              <i class="fas fa-camera"></i>
                            </button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="12" class="text-center">Tidak ada riwayat pengiriman barang</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Pagination -->
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
              <h5>Detail Pengiriman Barang</h5>
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
              <p><strong>Jenis Barang:</strong> <span id="dialogJenis"></span></p>
              <p><strong>Jumlah Barang:</strong> <span id="dialogJumlah"></span></p>
              <p><strong>Deskripsi Barang:</strong> <span id="dialogDesk"></span></p>
              <p><strong>Hubungan dengan WBP:</strong> <span id="dialogHubungan"></span></p>
              <p><strong>WBP:</strong> <span id="dialogWBP"></span></p>
              <p><strong>Tanggal Pengiriman:</strong> <span id="dialogTanggal"></span></p>
          </div>
          </dialog>
          <!-- Modal untuk Menampilkan Gambar -->
          <div id="imageModal" class="image-modal" onclick="closeImageModal()">
            <div class="modal-content">
              <span class="close" onclick="closeImageModal()">&times;</span>
              <img id="modalImage" src="" alt="Bukti Penerimaan">
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
  <script src="assets/js/pagination.js"></script>
  <script src="assets/js/modal.js"></script>
  <script src="admin/assets/js/modalPengiriman.js"></script>

</body>
</html>
