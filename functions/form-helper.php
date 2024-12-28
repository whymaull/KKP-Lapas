<?php
// Include the database connection
include_once 'config/database.php';


// Get kabupaten/kota list
function getKabupatenKota() {
    global $conn;
    $query = "SELECT * FROM kabupaten_kota ORDER BY nama_kabupaten_kota";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get provinsi list
function getProvinsi() {
    global $conn;
    $query = "SELECT * FROM provinsi ORDER BY nama_provinsi";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get WBP list
function getWBP() {
    global $conn;
    $query = "SELECT * FROM wbp ORDER BY nama_wbp";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get Jenis Barang list
function getJenisBarang() {
    global $conn;
    $query = "SELECT * FROM jenis_barang ORDER BY nama_jenis";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get visit sessions (Sesi 1, Sesi 2, Sesi 3)
function getVisitSessions() {
    global $conn;
    $query = "
        SELECT DISTINCT 
            sesi_1_mulai, sesi_1_selesai, 
            sesi_2_mulai, sesi_2_selesai, 
            sesi_3_mulai, sesi_3_selesai 
        FROM jadwal_kunjungan
        WHERE status_jadwal = 'aktif'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Insert a new visit record
function insertVisit($data, $conn)
{
    $sql = "INSERT INTO kunjungan 
            (id_user, id_wbp, id_kabupaten_kota, id_provinsi, tanggal_kunjungan, sesi_kunjungan, hubungan_wbp, pengikut_laki, pengikut_wanita, pengikut_anak, barang_bawaan)
            VALUES (:id_user, :id_wbp, :id_kabupaten_kota, :id_provinsi, :tanggal_kunjungan, :sesi_kunjungan, :hubungan_wbp, :pengikut_laki, :pengikut_wanita, :pengikut_anak, :barang_bawaan)";

    $stmt = $conn->prepare($sql);

    // Bind parameters using the execute() method with an associative array
    return $stmt->execute([
        ':id_user' => $data['id_user'],
        ':id_wbp' => $data['id_wbp'],
        ':id_kabupaten_kota' => $data['id_kabupaten_kota'],
        ':id_provinsi' => $data['id_provinsi'],
        ':tanggal_kunjungan' => $data['tanggal_kunjungan'],
        ':sesi_kunjungan' => $data['sesi_kunjungan'],
        ':hubungan_wbp' => $data['hubungan_wbp'],
        ':pengikut_laki' => $data['pengikut_laki'],
        ':pengikut_wanita' => $data['pengikut_wanita'],
        ':pengikut_anak' => $data['pengikut_anak'],
        ':barang_bawaan' => $data['barang_bawaan'] ?? '' // Handle optional field
    ]);
}

function insertGoods($goods, $conn)
{
    $sql = "INSERT INTO pengiriman_barang 
            (id_user, id_wbp, id_jenis, id_kabupaten_kota, id_provinsi, tanggal_pengiriman, hubungan_wbp, jumlah_barang, deskripsi_barang)
            VALUES (:id_user, :id_wbp, :id_jenis, :id_kabupaten_kota, :id_provinsi, :tanggal_pengiriman, :hubungan_wbp, :jumlah_barang, :deskripsi_barang)";

    $stmt = $conn->prepare($sql);

    // Bind parameters using the execute() method with an associative array
    return $stmt->execute([
        ':id_user' => $goods['id_user'],
        ':id_wbp' => $goods['id_wbp'],
        ':id_jenis' => $goods['id_jenis'],
        ':id_kabupaten_kota' => $goods['id_kabupaten_kota'],
        ':id_provinsi' => $goods['id_provinsi'],
        ':tanggal_pengiriman' => $goods['tanggal_pengiriman'],
        ':hubungan_wbp' => $goods['hubungan_wbp'],
        ':jumlah_barang' => $goods['jumlah_barang'],
        ':deskripsi_barang' => $goods['deskripsi_barang'] 
    ]);
}

?>
