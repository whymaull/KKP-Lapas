<?php
session_start();
include 'config-admin/database.php';
include 'functions/riwayat-admin.php';
include_once 'functions/auth-admin.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /kkp-lapas/login.php");
  exit;
}

// Fetch riwayat barang data
$riwayatData = getRiwayatBarang();

// Handle search
$search = isset($_POST['search']) ? $_POST['search'] : '';
if ($search) {
    $riwayatData = searchRiwayatBarang($search);
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- riwayat Barang -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/toggle.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo_lapas.png' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- navbar -->
      <?php include 'assets/components/navbar.php'; ?>

      <!-- sidebar -->
      <?php include 'assets/components/sidebar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Riwayat Pengiriman Barang</h4>
                  <div class="card-header-form">
                    <form method="POST" action="riwayat-barang.php">
                      <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo $_POST['search'] ?? ''; ?>">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table id="dataTable" class="table table-md table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengirim</th>
                                <th>Jenis Barang</th>
                                <th>Hubungan dengan WBP</th>
                                <th>WBP</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($riwayatData) > 0): ?>
                                <?php foreach ($riwayatData as $index => $pengiriman): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $pengiriman['nama_pengirim'] ?></td>
                                    <td><?= $pengiriman['jenis_barang'] ?></td>
                                    <td><?= $pengiriman['hubungan_wbp'] ?></td>
                                    <td><?= $pengiriman['nama_wbp'] ?></td>
                                    <td><?= $pengiriman['tanggal_pengiriman'] ?></td>
                                    <td>
                                      <div class="buttons">
                                      <a href="#" class="btn btn-outline-primary detail-btn" 
                                        data-id="<?= $pengiriman['id_pengiriman'] ?>"
                                        data-nama="<?= $pengiriman['nama_pengirim'] ?>"
                                        data-email="<?= $pengiriman['email'] ?? '' ?>"
                                        data-jenis-kelamin="<?= $pengiriman['jenis_kelamin'] ?? '' ?>"
                                        data-alamat="<?= $pengiriman['alamat'] ?? '' ?>"
                                        data-kabupaten="<?= $pengiriman['nama_kabupaten_kota'] ?? '' ?>"
                                        data-provinsi="<?= $pengiriman['nama_provinsi'] ?? '' ?>"
                                        data-no-ktp="<?= $pengiriman['no_ktp'] ?? '' ?>"
                                        data-no-telepon="<?= $pengiriman['no_telepon'] ?? '' ?>"
                                        data-jenis="<?= $pengiriman['jenis_barang'] ?? '' ?>"
                                        data-jumlah="<?= $pengiriman['jumlah_barang'] ?? '' ?>"
                                        data-desk="<?= $pengiriman['deskripsi_barang'] ?? '' ?>"
                                        data-hubungan="<?= $pengiriman['hubungan_wbp'] ?? '' ?>"
                                        data-nama-wbp="<?= $pengiriman['nama_wbp'] ?? '' ?>"
                                        data-tanggal="<?= $pengiriman['tanggal_pengiriman'] ?? '' ?>">Detail</a>
                                      </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-<?php echo getStatusBadge($pengiriman['status_pengiriman']); ?>">
                                        <?php echo ucfirst($pengiriman['status_pengiriman']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center">
                                        Tidak ada data riwayat pengiriman barang
                                    </td>
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
    </div>
    <!-- Modal untuk Detail -->
    <dialog id="detailDialog">
    <div class="dialog-header">
        <h5>Detail Riwayat Pengiriman Barang</h5>
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
        </section>
      </div>
      <!-- footer -->
      <?php include 'assets/components/footer.php'; ?>
    </div>
  </div>
  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/pagination.js"></script>
  <script src="assets/js/modalPengiriman.js"></script>
</body>

</html>