<?php
// Koneksi ke database
include 'config-admin/database.php';

// Query untuk data kunjungan
$sql_kunjungan = "SELECT kunjungan.tanggal_kunjungan, users.nama_lengkap AS nama_pengunjung 
                  FROM kunjungan
                  JOIN users ON kunjungan.id_user = users.id_user";

// Query untuk data pengiriman
$sql_pengiriman = "SELECT pengiriman_barang.tanggal_pengiriman, users.nama_lengkap AS nama_pengirim 
                   FROM pengiriman_barang
                   JOIN users ON pengiriman_barang.id_user = users.id_user";


?>
