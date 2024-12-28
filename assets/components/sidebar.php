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
            <li class="dropdown <?php echo isActive('form-kunjungan.php') || isActive('form-barang.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Formulir</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('form-kunjungan.php'); ?>" href="form-kunjungan.php">Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('form-barang.php'); ?>" href="form-barang.php">Kirim Barang</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo isActive('chat.php') || isActive('portfolio.php') ? 'active' : ''; ?>">
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

            <li class="menu-header">Pengaturan</li>
            <li><a class="nav-link <?php echo isActive('profile.php'); ?>" href="profile.php"><i data-feather="user"></i><span>Profile</span></a></li>
            <li class="dropdown <?php echo isActive('syarat-ketentuan.php') || isActive('proses-pendaftaran.php') || isActive('jadwal-kunjungan.php') || isActive('larangan.php') ? 'active' : ''; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="info"></i><span>Informasi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo isActive('syarat-ketentuan.php'); ?>" href="syarat-ketentuan.php">Syarat dan Ketentuan</a></li>
                    <li><a class="nav-link <?php echo isActive('proses-pendaftaran.php'); ?>" href="proses-pendaftaran.php">Proses Pendaftaran Online</a></li>
                    <li><a class="nav-link <?php echo isActive('jadwal-kunjungan.php'); ?>" href="jadwal-kunjungan.php">Jadwal Kunjungan</a></li>
                    <li><a class="nav-link <?php echo isActive('larangan.php'); ?>" href="larangan.php">Larangan dan Ketentuan</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
