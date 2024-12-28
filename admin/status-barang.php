<?php
session_start();
include 'config-admin/database.php';
include 'functions/status-admin.php';
include_once 'functions/auth-admin.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /kkp-lapas/login.php");
  exit;
}

// Fetch status barang data
$statusData = getStatusBarang();

// Handle search
$search = isset($_POST['search']) ? $_POST['search'] : '';
if ($search) {
    $statusData = searchStatusBarang($search);
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id_pengiriman = $_GET['id'];
    
    if ($action == 'selesai') {
        // Update status ke 'selesai'
        $stmt = $conn->prepare("UPDATE pengiriman_barang SET status_pengiriman = 'selesai' WHERE id_pengiriman = ?");
        $stmt->execute([$id_pengiriman]);
    } elseif ($action == 'dibatalkan') {
        // Update status ke 'dibatalkan'
        $stmt = $conn->prepare("UPDATE pengiriman_barang SET status_pengiriman = 'dibatalkan' WHERE id_pengiriman = ?");
        $stmt->execute([$id_pengiriman]);
    }
  
    header('Location: status-barang.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">


<!-- Status Barang -->
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
                  <h4>Status Pengiriman Barang</h4>
                  <div class="card-header-form">
                    <form method="POST" action="status-barang.php">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($statusData) > 0): ?>
                                <?php foreach ($statusData as $index => $pengiriman): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $pengiriman['nama_pengirim'] ?></td>
                                    <td><?= $pengiriman['jenis_barang'] ?></td>
                                    <td><?= $pengiriman['hubungan_wbp'] ?></td>
                                    <td><?= $pengiriman['nama_wbp'] ?></td>
                                    <td><?= $pengiriman['tanggal_pengiriman'] ?></td>
                                    <td>
                                      <div class="buttons">
                                        <a href="status-barang.php?action=selesai&id=<?= $pengiriman['id_pengiriman'] ?>" class="btn btn-icon btn-success" title="selesai">
                                          <i class="fas fa-check"></i>
                                        </a>
                                        <a href="status-barang.php?action=dibatalkan&id=<?= $pengiriman['id_pengiriman'] ?>" class="btn btn-icon btn-danger" title="Dibatalkan">
                                          <i class="fas fa-times"></i>
                                        </a>
                                      </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center">
                                        Tidak ada data status pengiriman barang
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
</body>

</html>