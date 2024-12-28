<?php
include_once 'config/database.php';


// Fungsi untuk melakukan registrasi
function registerUser($full_name, $email, $password) {
    global $conn;

    $id_user = uniqid('', true);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (id_user, nama_lengkap, email, password, status_akun) 
              VALUES (:id_user, :nama_lengkap, :email, :password, 'aktif')";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nama_lengkap', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    try {
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

// Fungsi untuk login pengguna
function loginUser($email, $password) {
    global $conn;

    // Query untuk mendapatkan data pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email = :email AND status_akun = 'aktif'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email); // Gunakan bindParam untuk PDO
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            return $user; // Kembalikan data pengguna
        } else {
            return "Password salah!";
        }
    } else {
        return "Email tidak ditemukan atau akun tidak aktif!";
    }
}



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
    header('Location: login.php'); 
    exit;
}

?>