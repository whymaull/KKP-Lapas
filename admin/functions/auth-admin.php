<?php
include_once 'config-admin/database.php';

// Fungsi untuk mengambil data pengguna berdasarkan ID pengguna
function getUserData($conn, $userId) {
    $query = "SELECT id_user, nama_lengkap, email, jenis_kelamin, tanggal_lahir, no_ktp, no_telepon, alamat, status_akun FROM users WHERE id_user = :id_user";
    
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(':id_user', $userId);
    
    $stmt->execute();
    
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($userData) {
        return $userData; 
    } else {
        return null; 
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_unset(); 
    session_destroy(); 
    header('Location: ../login.php'); 
    exit;
}

?>

