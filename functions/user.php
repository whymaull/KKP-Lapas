<?php
// Include database connection
include_once 'config/database.php';
include_once 'functions/auth.php';

// Fetch user details by user ID
function getUserDetails($conn, $userId) {
    $query = "SELECT * FROM users WHERE id_user = :id_user";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id_user', $userId);
    $stmt->execute();

        // Ambil hasilnya sebagai array asosiatif
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Periksa apakah data ditemukan
        if ($userData) {
            return $userData; // Mengembalikan data pengguna
        } else {
            return null; // Mengembalikan null jika pengguna tidak ditemukan
        }
}

// Update user profile
function updateUserProfile($id, $name, $email, $gender, $birthdate, $ktp, $phone, $address) {
    global $conn;
    $sql = "UPDATE users SET 
                nama_lengkap = :name,
                email = :email,
                jenis_kelamin = :gender,
                tanggal_lahir = :birthdate,
                no_ktp = :ktp,
                no_telepon = :phone,
                alamat = :address
            WHERE id_user = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':gender' => $gender,
        ':birthdate' => $birthdate,
        ':ktp' => $ktp,
        ':phone' => $phone,
        ':address' => $address,
        ':id' => $id,
    ]);
}



?>
