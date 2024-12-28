<?php
session_start();
require_once 'config/database.php';
include_once 'functions/user.php';
require_once 'functions/form-helper.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

// Panggil fungsi untuk mendapatkan data pengguna
$userDetails = getUserDetails($conn, $_SESSION['id_user']);
$jadwalKunjungan = getVisitSessions();
?>
<!DOCTYPE html>
<html lang="en">

<!-- index.php -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Lapas Cipinang Jakarta</title>
  
  <!-- CSS -->
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
          
          <!-- Slider/Carousel Start -->
          <div class="card">
            <div class="card-body">
              <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/img/slider1.png" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="assets/img/slider2.png" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="assets/img/slider3.png" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <!-- Slider/Carousel End -->
          
          <!-- Feature Start -->
          <div class="row">
            <!-- Feature 1 -->
            <div class="col-12 col-md-4">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-18">Pendaftaran</h5>
                          <h2 class="mb-3 font-21">Online</h2>
                          <p class="mb-0"><span class="col-green">Lebih Cepat</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-12 col-md-4">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-18">Layanan</h5>
                          <h2 class="mb-3 font-21">24/7</h2>
                          <p class="mb-0"><span class="col-green">Siap Membantu</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-12 col-md-4">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-18">Keamanan</h5>
                          <h2 class="mb-3 font-21">Terjamin</h2>
                          <p class="mb-0"><span class="col-green">Sistem Terkini</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/secure.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Feature End -->

          <div class="row">
            <!-- Jadwal Kunjungan -->
            <div class="card col-md-4">
                <div class="card-header">
                    <h4>Jadwal Kunjungan (Hari Kerja)</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                    <thead>
                      <tr>
                          <th>Sesi</th>
                          <th>Jadwal</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      if (!empty($jadwalKunjungan)) {
                          foreach ($jadwalKunjungan as $jadwal) {
                              echo "<tr><td>Sesi 1</td><td>{$jadwal['sesi_1_mulai']} - {$jadwal['sesi_1_selesai']}</td></tr>";
                              echo "<tr><td>Sesi 2</td><td>{$jadwal['sesi_2_mulai']} - {$jadwal['sesi_2_selesai']}</td></tr>";
                              echo "<tr><td>Sesi 3</td><td>{$jadwal['sesi_3_mulai']} - {$jadwal['sesi_3_selesai']}</td></tr>";
                          }
                      } else {
                          echo "<tr><td colspan='2' class='text-center'>Tidak ada jadwal kunjungan tersedia</td></tr>";
                      }
                      ?>
                  </tbody>
                    </table>
                </div>
            </div>
            
            <!-- GMaps Start -->
              <div class="col-12 col-md-8">
                <div class="card">
                  <div class="card-body">
                    <iframe 
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.368915706672!2d106.88156358885499!3d-6.214982600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f49fd4051b83%3A0xdf3c38254b05d57c!2sLembaga%20Pemasyarakatan%20Kelas%201%20Cipinang!5e0!3m2!1sen!2sid!4v1732946107614!5m2!1sen!2sid" 
                      width="100%" 
                      height="350" 
                      style="border:0;" 
                      allowfullscreen="" 
                      loading="lazy">
                    </iframe>
                  </div>
                </div>
              </div>
            <!-- GMaps End -->
          </div>
        </section>
      </div>

      <!-- Footer -->
      <?php include 'assets/components/footer.php'; ?>
      
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/page/index.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>

</html>
