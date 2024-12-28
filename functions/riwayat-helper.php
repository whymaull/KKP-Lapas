<?php
include_once 'config/database.php';

function getRiwayatKunjungan($conn, $id_user) {
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
                            WHERE kunjungan.id_user = :id_user
                            AND (kunjungan.status_kunjungan = 'selesai' OR kunjungan.status_kunjungan = 'dibatalkan')");
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getRiwayatBarang($conn, $id_user) {
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
                            WHERE pengiriman_barang.id_user = :id_user
                            AND (pengiriman_barang.status_pengiriman = 'selesai' OR pengiriman_barang.status_pengiriman = 'dibatalkan')");
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStatusBadgeClass($status) {
    switch ($status) {
        case 'selesai':
            return 'success';
        case 'dibatalkan':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>
