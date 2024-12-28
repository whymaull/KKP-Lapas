<?php
session_start();
include_once 'config/database.php';
include_once 'functions/status-helper.php';

$userId = $_SESSION['id_user'];

$kunjunganList = getStatusKunjungan($conn, $userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Status Kunjungan - Lapas Cipinang Jakarta</title>
  <!-- Include necessary CSS files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/toggle.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_lapas.png" />
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
          <!-- Table Status Kunjungan -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Status Kunjungan</h4>
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
                        <th>Sesi</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                        <th>Barcode</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (count($kunjunganList) > 0): ?>
                      <?php foreach ($kunjunganList as $index => $kunjungan): ?>
                        <tr>
                          <td><?php echo $index + 1; ?></td>
                          <td><?php echo $kunjungan['nama_pengunjung']; ?></td>
                          <td><?php echo $kunjungan['hubungan_wbp']; ?></td>
                          <td><?php echo $kunjungan['nama_wbp']; ?></td>
                          <td><?php echo $kunjungan['sesi_kunjungan']; ?></td>
                          <td><?php echo $kunjungan['tanggal_kunjungan']; ?></td>
                          <td>
                            <div class="badge badge-<?php echo getStatusBadgeClass($kunjungan['status_kunjungan']); ?>">
                              <?php echo ucfirst($kunjungan['status_kunjungan']); ?>
                            </div>
                          </td>
                          <td>
                            <?php if ($kunjungan['status_kunjungan'] == 'diterima'): ?>
                              <img src="generate_barcode.php?code=<?php echo $kunjungan['kode_barcode']; ?>" alt="barcode">
                              <a href="generate_pdf.php?code=<?php echo $kunjungan['kode_barcode']; ?>" target="_blank">Download PDF</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="12" class="text-center">Tidak ada data status kunjungan</td>
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
        </section>
      </div>

      <!-- Footer -->
      <?php include 'assets/components/footer.php'; ?>
    </div>
  </div>

  <!-- JS -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/pagination.js"></script>
</body>

</html>
