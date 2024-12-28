<?php
session_start();
include_once 'config/database.php';
include_once 'functions/status-helper.php';

$userId = $_SESSION['id_user'];

$pengirimanList = getStatusPengiriman($conn, $userId);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head Section -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  <!-- CSS Links -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
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
          
          <!-- Status Pengiriman Table -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Status Pengiriman Barang</h4>
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
                        <th>Barcode</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (count($pengirimanList) > 0): ?>
                      <?php foreach ($pengirimanList as $index => $pengiriman): ?>
                        <tr>
                          <td><?php echo $index + 1; ?></td>
                          <td><?php echo $pengiriman['nama_pengirim']; ?></td>
                          <td><?php echo $pengiriman['nama_jenis']; ?></td>
                          <td><?php echo $pengiriman['hubungan_wbp']; ?></td>
                          <td><?php echo $pengiriman['nama_wbp']; ?></td>
                          <td><?php echo $pengiriman['tanggal_pengiriman']; ?></td>
                          <td>
                            <div class="badge badge-<?php echo getStatusBadgeClass($pengiriman['status_pengiriman']); ?>">
                              <?php echo ucfirst($pengiriman['status_pengiriman']); ?>
                            </div>
                          </td>
                          <td>
                            <?php if ($pengiriman['status_pengiriman'] == 'diterima'): ?>
                              <img src="generate_barcode.php?code=<?php echo $pengiriman['kode_barcode']; ?>" alt="barcode">
                              <a href="generate_pdf.php?code=<?php echo $pengiriman['kode_barcode']; ?>" target="_blank">Download PDF</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="12" class="text-center">Tidak ada data status barang</td>
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

  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/pagination.js"></script>
</body>

</html>
