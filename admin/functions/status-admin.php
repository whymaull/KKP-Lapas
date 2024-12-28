<?php
require_once 'config-admin/database.php';

// Function to get all Status kunjungan
function getStatusKunjungan() {
    global $conn;
    $stmt = $conn->prepare("SELECT kunjungan.*, 
                                    users.nama_lengkap AS nama_pengunjung, 
                                    users.email,
                                    users.jenis_kelamin,
                                    users.alamat,
                                    users.no_ktp,
                                    users.no_telepon,
                                    kabupaten_kota.nama_kabupaten_kota,
                                    provinsi.nama_provinsi,
                                    wbp.nama_wbp 
                            FROM kunjungan
                            JOIN users ON kunjungan.id_user = users.id_user
                            LEFT JOIN kabupaten_kota ON kunjungan.id_kabupaten_kota = kabupaten_kota.id_kabupaten_kota
                            LEFT JOIN provinsi ON kunjungan.id_provinsi = provinsi.id_provinsi
                            JOIN wbp ON kunjungan.id_wbp = wbp.id_wbp
                            WHERE kunjungan.status_kunjungan = 'diterima'"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get all Status barang
function getStatusBarang() {
    global $conn;
    $stmt = $conn->prepare("SELECT pengiriman_barang.*, 
                                    users.nama_lengkap AS nama_pengirim, 
                                    users.email,
                                    users.jenis_kelamin,
                                    users.alamat,
                                    users.no_ktp,
                                    users.no_telepon,
                                    kabupaten_kota.nama_kabupaten_kota,
                                    provinsi.nama_provinsi,
                                    jenis_barang. nama_jenis AS jenis_barang,
                                    wbp.nama_wbp 
                            FROM pengiriman_barang
                            JOIN users ON pengiriman_barang.id_user = users.id_user
                            LEFT JOIN kabupaten_kota ON pengiriman_barang.id_kabupaten_kota = kabupaten_kota.id_kabupaten_kota
                            LEFT JOIN provinsi ON pengiriman_barang.id_provinsi = provinsi.id_provinsi
                            JOIN jenis_barang ON pengiriman_barang.id_jenis = jenis_barang.id_jenis
                            JOIN wbp ON pengiriman_barang.id_wbp = wbp.id_wbp
                            WHERE pengiriman_barang.status_pengiriman = 'diterima'"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to search Status kunjungan based on search input
function searchStatusKunjungan($search) {
    global $conn;
    $stmt = $conn->prepare("SELECT kunjungan.*, 
                                   users.nama_lengkap AS nama_pengunjung, 
                                   users.email,
                                   users.jenis_kelamin,
                                   users.alamat,
                                   users.no_ktp,
                                   users.no_telepon,
                                   kabupaten_kota.nama_kabupaten_kota,
                                   provinsi.nama_provinsi,
                                   wbp.nama_wbp,
                                   kunjungan.hubungan_wbp
                            FROM kunjungan
                            JOIN users ON kunjungan.id_user = users.id_user
                            LEFT JOIN kabupaten_kota ON kunjungan.id_kabupaten_kota = kabupaten_kota.id_kabupaten_kota
                            LEFT JOIN provinsi ON kunjungan.id_provinsi = provinsi.id_provinsi
                            JOIN wbp ON kunjungan.id_wbp = wbp.id_wbp
                            WHERE users.nama_lengkap LIKE :search
                            OR wbp.nama_wbp LIKE :search
                            OR kunjungan.hubungan_wbp LIKE :search");
    $stmt->execute([':search' => '%' . $search . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to search Status pengiriman_barang based on search input
function searchStatusBarang($search) {
    global $conn;
    $stmt = $conn->prepare("SELECT pengiriman_barang.*, 
                                   users.nama_lengkap AS nama_pengirim, 
                                   users.email,
                                   users.jenis_kelamin,
                                   users.alamat,
                                   users.no_ktp,
                                   users.no_telepon,
                                   kabupaten_kota.nama_kabupaten_kota,
                                   provinsi.nama_provinsi,
                                   jenis_barang. nama_jenis AS jenis_barang,
                                   wbp.nama_wbp,
                                   pengiriman_barang.hubungan_wbp
                            FROM pengiriman_barang
                            JOIN users ON pengiriman_barang.id_user = users.id_user
                            LEFT JOIN kabupaten_kota ON pengiriman_barang.id_kabupaten_kota = kabupaten_kota.id_kabupaten_kota
                            LEFT JOIN provinsi ON pengiriman_barang.id_provinsi = provinsi.id_provinsi
                            JOIN jenis_barang ON pengiriman_barang.id_jenis = jenis_barang.id_jenis
                            JOIN wbp ON pengiriman_barang.id_wbp = wbp.id_wbp
                            WHERE users.nama_lengkap LIKE :search
                            OR wbp.nama_wbp LIKE :search
                            OR pengiriman_barang.hubungan_wbp LIKE :search");
    $stmt->execute([':search' => '%' . $search . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
