<?php
include_once 'config/database.php';

// Function to get status kunjungan from the database
function getStatusKunjungan($conn, $userId) {
    $query = "
        SELECT k.id_kunjungan, u.nama_lengkap as nama_pengunjung, k.hubungan_wbp, w.nama_wbp, k.sesi_kunjungan, 
               k.tanggal_kunjungan, k.status_kunjungan, k.kode_barcode
        FROM kunjungan k
        JOIN users u ON k.id_user = u.id_user
        JOIN wbp w ON k.id_wbp = w.id_wbp
        WHERE k.id_user = :id_user
        AND k.status_kunjungan IN ('menunggu', 'diterima', 'ditolak')
        ORDER BY k.tanggal_kunjungan DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id_user', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get status pengiriman barang from the database
function getStatusPengiriman($conn, $userId) {
    $query = "
        SELECT p.id_pengiriman, u.nama_lengkap as nama_pengirim, j.nama_jenis, p.hubungan_wbp, w.nama_wbp, 
               p.tanggal_pengiriman, p.status_pengiriman, p.kode_barcode
        FROM pengiriman_barang p
        JOIN users u ON p.id_user = u.id_user
        JOIN jenis_barang j ON p.id_jenis = j.id_jenis
        JOIN wbp w ON p.id_wbp = w.id_wbp
        WHERE p.id_user = :id_user
        AND p.status_pengiriman IN ('menunggu', 'diterima', 'ditolak')
        ORDER BY p.tanggal_pengiriman DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id_user', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to determine the badge class based on the status
function getStatusBadgeClass($status) {
    switch ($status) {
        case 'diterima':
            return 'success';
        case 'menunggu':
            return 'warning';
        case 'ditolak':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>
