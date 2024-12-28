<?php
function isActive($fileName) {
    return basename($_SERVER['PHP_SELF']) === $fileName ? 'active' : '';
}
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php">
                <img alt="image" src="assets/img/logo_lapas.png" class="header-logo" /> 
                <span class="logo-name">Lapas Cipinang Jakarta</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Utama</li>
            <li class="dropdown <?php echo isActive('index.php'); ?>">
                <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php echo isActive('pengajuan-kunjungan.php') || isActive('pengajuan-barang.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Pengajuan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('pengajuan-kunjungan.php'); ?>" href="pengajuan-kunjungan.php">Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('pengajuan-barang.php'); ?>" href="pengajuan-barang.php">Kirim Barang</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo isActive('status-kunjungan.php') || isActive('status-barang.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="check-circle"></i><span>Status</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('status-kunjungan.php'); ?>" href="status-kunjungan.php">Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('status-barang.php'); ?>" href="status-barang.php">Kirim Barang</a></li>
                </ul>
            </li>

            <li class="menu-header">Data</li>
            <li class="dropdown <?php echo isActive('riwayat-kunjungan.php') || isActive('riwayat-barang.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="archive"></i><span>Riwayat</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('riwayat-kunjungan.php'); ?>" href="riwayat-kunjungan.php">Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('riwayat-barang.php'); ?>" href="riwayat-barang.php">Kirim Barang</a></li>
                </ul>
            </li>

            <li class="menu-header">Report</li>
            <li class="dropdown <?php echo isActive('lap-statistik.php') || isActive('lap-pengunjung.php') || isActive('lap-kiriman.php') || isActive('lap-demografi.php') || isActive('lap-wbp.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="info"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('lap-statistik.php'); ?>" href="lap-statistik.php">Statistik Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('lap-pengunjung.php'); ?>" href="lap-pengunjung.php">Kunjungan Terdaftar</a></li>
                    <li><a class="nav-link <?php echo isActive('lap-kiriman.php'); ?>" href="lap-kiriman.php">Kiriman Barang</a></li>
                    <li><a class="nav-link <?php echo isActive('lap-demografi.php'); ?>" href="lap-demografi.php">Demografi Pengunjung</a></li>
                    <li><a class="nav-link <?php echo isActive('lap-wbp.php'); ?>" href="lap-wbp.php">WBP Terkunjungi</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
