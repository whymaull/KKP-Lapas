-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2024 pada 11.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lapas_cipinang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` varchar(36) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `kategori` enum('tentang_kami','syarat_ketentuan','prosedur','larangan','pengumuman') NOT NULL,
  `status_informasi` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_kunjungan`
--

CREATE TABLE `jadwal_kunjungan` (
  `id_jadwal` varchar(36) NOT NULL,
  `sesi_1_mulai` time DEFAULT NULL,
  `sesi_1_selesai` time DEFAULT NULL,
  `sesi_2_mulai` time DEFAULT NULL,
  `sesi_2_selesai` time DEFAULT NULL,
  `sesi_3_mulai` time DEFAULT NULL,
  `sesi_3_selesai` time DEFAULT NULL,
  `kuota_per_sesi` int(11) DEFAULT 50,
  `status_jadwal` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_kunjungan`
--

INSERT INTO `jadwal_kunjungan` (`id_jadwal`, `sesi_1_mulai`, `sesi_1_selesai`, `sesi_2_mulai`, `sesi_2_selesai`, `sesi_3_mulai`, `sesi_3_selesai`, `kuota_per_sesi`, `status_jadwal`) VALUES
('c4c5aa6f-c38c-11ef-87a0-74d02b464983', '09:00:00', '10:00:00', '10:30:00', '11:30:00', '13:00:00', '14:00:00', 30, 'aktif'),
('c4c9d679-c38c-11ef-87a0-74d02b464983', '09:00:00', '10:00:00', '10:30:00', '11:30:00', '13:00:00', '14:00:00', 20, 'aktif'),
('c4c9d9fa-c38c-11ef-87a0-74d02b464983', '09:00:00', '10:00:00', '10:30:00', '11:30:00', '13:00:00', '14:00:00', 15, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` varchar(36) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `status_jenis` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `nama_jenis`, `status_jenis`) VALUES
('199655b8-c36f-11ef-87a0-74d02b464983', 'Makanan', 'aktif'),
('19985744-c36f-11ef-87a0-74d02b464983', 'Pakaian', 'aktif'),
('19985b48-c36f-11ef-87a0-74d02b464983', 'Buku', 'aktif'),
('19985d28-c36f-11ef-87a0-74d02b464983', 'Elektronik', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten_kota`
--

CREATE TABLE `kabupaten_kota` (
  `id_kabupaten_kota` varchar(36) NOT NULL,
  `nama_kabupaten_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kabupaten_kota`
--

INSERT INTO `kabupaten_kota` (`id_kabupaten_kota`, `nama_kabupaten_kota`) VALUES
('dd5352a1-c363-11ef-87a0-74d02b464983', 'Kabupaten Agam'),
('dd567d5a-c363-11ef-87a0-74d02b464983', 'Kabupaten Banyumas'),
('dd567e91-c363-11ef-87a0-74d02b464983', 'Kabupaten Bandung'),
('dd567eee-c363-11ef-87a0-74d02b464983', 'Kabupaten Bangka'),
('dd567f41-c363-11ef-87a0-74d02b464983', 'Kabupaten Bima'),
('dd567f90-c363-11ef-87a0-74d02b464983', 'Kabupaten Cianjur'),
('dd5819cb-c363-11ef-87a0-74d02b464983', 'Kabupaten Cilacap'),
('dd581add-c363-11ef-87a0-74d02b464983', 'Kabupaten Deli Serdang'),
('dd581dcc-c363-11ef-87a0-74d02b464983', 'Kabupaten Gorontalo'),
('dd581e9b-c363-11ef-87a0-74d02b464983', 'Kabupaten Indramayu'),
('dd581f62-c363-11ef-87a0-74d02b464983', 'Kabupaten Karawang'),
('dd581fde-c363-11ef-87a0-74d02b464983', 'Kabupaten Kediri'),
('dd582033-c363-11ef-87a0-74d02b464983', 'Kabupaten Lumajang'),
('dd58207d-c363-11ef-87a0-74d02b464983', 'Kabupaten Malang'),
('dd5820c7-c363-11ef-87a0-74d02b464983', 'Kabupaten Mataram'),
('dd58210e-c363-11ef-87a0-74d02b464983', 'Kota Banda Aceh'),
('dd58215a-c363-11ef-87a0-74d02b464983', 'Kota Banjarbaru'),
('dd5821a4-c363-11ef-87a0-74d02b464983', 'Kota Banjarmasin'),
('dd582249-c363-11ef-87a0-74d02b464983', 'Kota Batam'),
('dd582293-c363-11ef-87a0-74d02b464983', 'Kota Bekasi'),
('dd5822dd-c363-11ef-87a0-74d02b464983', 'Kota Bogor'),
('dd582324-c363-11ef-87a0-74d02b464983', 'Kota Denpasar'),
('dd58236a-c363-11ef-87a0-74d02b464983', 'Kota Jakarta'),
('dd5823af-c363-11ef-87a0-74d02b464983', 'Kota Jayapura'),
('dd5823f6-c363-11ef-87a0-74d02b464983', 'Kota Makassar'),
('dd582441-c363-11ef-87a0-74d02b464983', 'Kota Malang'),
('dd582486-c363-11ef-87a0-74d02b464983', 'Kota Medan'),
('dd5824cb-c363-11ef-87a0-74d02b464983', 'Kota Semarang'),
('dd58250f-c363-11ef-87a0-74d02b464983', 'Kota Surabaya'),
('dd582553-c363-11ef-87a0-74d02b464983', 'Kota Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `id_wbp` varchar(36) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `sesi_kunjungan` enum('Sesi 1','Sesi 2','Sesi 3') NOT NULL,
  `hubungan_wbp` varchar(50) NOT NULL,
  `pengikut_laki` int(11) DEFAULT 0,
  `pengikut_wanita` int(11) DEFAULT 0,
  `pengikut_anak` int(11) DEFAULT 0,
  `barang_bawaan` text DEFAULT NULL,
  `status_kunjungan` enum('menunggu','diterima','ditolak','selesai','dibatalkan') DEFAULT 'menunggu',
  `kode_barcode` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_kabupaten_kota` varchar(36) DEFAULT NULL,
  `id_provinsi` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `id_user`, `id_wbp`, `tanggal_kunjungan`, `sesi_kunjungan`, `hubungan_wbp`, `pengikut_laki`, `pengikut_wanita`, `pengikut_anak`, `barang_bawaan`, `status_kunjungan`, `kode_barcode`, `created_at`, `id_kabupaten_kota`, `id_provinsi`) VALUES
(5, '676bea4bedf6e2.98434581', '98f0eb34-c361-11ef-87a0-74d02b464983', '2024-12-09', 'Sesi 3', 'Saudara', 2, 3, 0, 'Parfum', 'selesai', NULL, '2024-12-27 10:06:24', 'dd582293-c363-11ef-87a0-74d02b464983', 'ee45bf00-c36e-11ef-87a0-74d02b464983'),
(6, '676bea4bedf6e2.98434581', '98f0ef75-c361-11ef-87a0-74d02b464983', '2024-12-17', 'Sesi 2', 'Pengacara', 2, 1, 2, 'Dokumen', 'dibatalkan', NULL, '2024-12-27 11:35:01', 'dd567e91-c363-11ef-87a0-74d02b464983', 'ee45bdf3-c36e-11ef-87a0-74d02b464983'),
(7, '676f535ab0d417.03707061', '98f0f193-c361-11ef-87a0-74d02b464983', '2024-11-10', 'Sesi 2', 'Orang Tua', 3, 1, 1, 'Tas', 'selesai', NULL, '2024-12-28 01:40:09', 'dd58210e-c363-11ef-87a0-74d02b464983', 'ee45b67a-c36e-11ef-87a0-74d02b464983'),
(8, '676fc08b18cca6.74941534', '98f0eb34-c361-11ef-87a0-74d02b464983', '2024-12-28', 'Sesi 3', 'Anak', 3, 2, 1, 'Tas dan handphone', 'dibatalkan', NULL, '2024-12-28 09:15:15', 'dd567e91-c363-11ef-87a0-74d02b464983', 'ee45be94-c36e-11ef-87a0-74d02b464983');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` varchar(36) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_barang`
--

CREATE TABLE `pengiriman_barang` (
  `id_pengiriman` int(11) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `id_wbp` varchar(36) NOT NULL,
  `id_jenis` varchar(36) NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `hubungan_wbp` varchar(50) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `deskripsi_barang` text DEFAULT NULL,
  `status_pengiriman` enum('menunggu','diterima','ditolak','selesai','dibatalkan') DEFAULT 'menunggu',
  `kode_barcode` varchar(100) DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_kabupaten_kota` varchar(36) DEFAULT NULL,
  `id_provinsi` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman_barang`
--

INSERT INTO `pengiriman_barang` (`id_pengiriman`, `id_user`, `id_wbp`, `id_jenis`, `tanggal_pengiriman`, `hubungan_wbp`, `jumlah_barang`, `deskripsi_barang`, `status_pengiriman`, `kode_barcode`, `foto_bukti`, `created_at`, `id_kabupaten_kota`, `id_provinsi`) VALUES
(1, '676bea4bedf6e2.98434581', '98f0ef75-c361-11ef-87a0-74d02b464983', '19985b48-c36f-11ef-87a0-74d02b464983', '2024-12-15', 'Anak', 2, 'Buku PR', 'menunggu', NULL, NULL, '2024-12-26 16:11:06', 'dd567e91-c363-11ef-87a0-74d02b464983', 'ee45bdf3-c36e-11ef-87a0-74d02b464983'),
(2, '676bea4bedf6e2.98434581', '98f0f350-c361-11ef-87a0-74d02b464983', '19985d28-c36f-11ef-87a0-74d02b464983', '2024-12-03', 'Anak', 1, 'Laptop', 'selesai', NULL, NULL, '2024-12-27 12:48:33', 'dd567f90-c363-11ef-87a0-74d02b464983', 'ee45bf17-c36e-11ef-87a0-74d02b464983'),
(3, '676bea4bedf6e2.98434581', '98eefab2-c361-11ef-87a0-74d02b464983', '19985744-c36f-11ef-87a0-74d02b464983', '2024-12-12', 'Pengacara', 2, 'Baju tidur', 'diterima', NULL, NULL, '2024-12-27 12:53:53', 'dd58236a-c363-11ef-87a0-74d02b464983', 'ee45bc35-c36e-11ef-87a0-74d02b464983'),
(4, '676f535ab0d417.03707061', '98f0f193-c361-11ef-87a0-74d02b464983', '19985b48-c36f-11ef-87a0-74d02b464983', '2024-11-15', 'Orang Tua', 3, 'Buku novel', 'diterima', NULL, NULL, '2024-12-28 01:41:28', 'dd58210e-c363-11ef-87a0-74d02b464983', 'ee45b67a-c36e-11ef-87a0-74d02b464983'),
(5, '676fc08b18cca6.74941534', '98eefab2-c361-11ef-87a0-74d02b464983', '19985b48-c36f-11ef-87a0-74d02b464983', '2024-12-26', 'Anak', 2, 'buku novel', 'ditolak', NULL, NULL, '2024-12-28 09:19:22', 'dd567e91-c363-11ef-87a0-74d02b464983', 'ee45bf17-c36e-11ef-87a0-74d02b464983');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` varchar(36) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `id_kabupaten_kota` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`, `id_kabupaten_kota`) VALUES
('ee45b67a-c36e-11ef-87a0-74d02b464983', 'Aceh', 'dd58210e-c363-11ef-87a0-74d02b464983'),
('ee45b8c4-c36e-11ef-87a0-74d02b464983', 'Bali', 'dd582324-c363-11ef-87a0-74d02b464983'),
('ee45b96e-c36e-11ef-87a0-74d02b464983', 'Bangka Belitung', 'dd567eee-c363-11ef-87a0-74d02b464983'),
('ee45bb49-c36e-11ef-87a0-74d02b464983', 'DI Yogyakarta', 'dd582553-c363-11ef-87a0-74d02b464983'),
('ee45bc35-c36e-11ef-87a0-74d02b464983', 'DKI Jakarta', 'dd58236a-c363-11ef-87a0-74d02b464983'),
('ee45bcf2-c36e-11ef-87a0-74d02b464983', 'Gorontalo', 'dd581dcc-c363-11ef-87a0-74d02b464983'),
('ee45bdf3-c36e-11ef-87a0-74d02b464983', 'Jawa Barat', 'dd567e91-c363-11ef-87a0-74d02b464983'),
('ee45be4b-c36e-11ef-87a0-74d02b464983', 'Jawa Barat', 'dd567f90-c363-11ef-87a0-74d02b464983'),
('ee45be94-c36e-11ef-87a0-74d02b464983', 'Jawa Barat', 'dd581f62-c363-11ef-87a0-74d02b464983'),
('ee45bf00-c36e-11ef-87a0-74d02b464983', 'Jawa Barat', 'dd582293-c363-11ef-87a0-74d02b464983'),
('ee45bf17-c36e-11ef-87a0-74d02b464983', 'Jawa Barat', 'dd5822dd-c363-11ef-87a0-74d02b464983'),
('ee45bfc5-c36e-11ef-87a0-74d02b464983', 'Jawa Tengah', 'dd567d5a-c363-11ef-87a0-74d02b464983'),
('ee45c009-c36e-11ef-87a0-74d02b464983', 'Jawa Tengah', 'dd5819cb-c363-11ef-87a0-74d02b464983'),
('ee45c0ca-c36e-11ef-87a0-74d02b464983', 'Jawa Tengah', 'dd5824cb-c363-11ef-87a0-74d02b464983'),
('ee45c190-c36e-11ef-87a0-74d02b464983', 'Jawa Timur', 'dd581fde-c363-11ef-87a0-74d02b464983'),
('ee45c1ae-c36e-11ef-87a0-74d02b464983', 'Jawa Timur', 'dd582033-c363-11ef-87a0-74d02b464983'),
('ee45c22f-c36e-11ef-87a0-74d02b464983', 'Jawa Timur', 'dd582441-c363-11ef-87a0-74d02b464983'),
('ee45c259-c36e-11ef-87a0-74d02b464983', 'Jawa Timur', 'dd58250f-c363-11ef-87a0-74d02b464983'),
('ee45c326-c36e-11ef-87a0-74d02b464983', 'Kalimantan Selatan', 'dd58215a-c363-11ef-87a0-74d02b464983'),
('ee45c35d-c36e-11ef-87a0-74d02b464983', 'Kalimantan Selatan', 'dd5821a4-c363-11ef-87a0-74d02b464983'),
('ee45c491-c36e-11ef-87a0-74d02b464983', 'Kepulauan Riau', 'dd582249-c363-11ef-87a0-74d02b464983'),
('ee45c556-c36e-11ef-87a0-74d02b464983', 'Nusa Tenggara Barat', 'dd567f41-c363-11ef-87a0-74d02b464983'),
('ee45c70a-c36e-11ef-87a0-74d02b464983', 'Papua', 'dd5823af-c363-11ef-87a0-74d02b464983'),
('ee45c82b-c36e-11ef-87a0-74d02b464983', 'Sulawesi Selatan', 'dd5823f6-c363-11ef-87a0-74d02b464983'),
('ee45c89f-c36e-11ef-87a0-74d02b464983', 'Sumatera Barat', 'dd5352a1-c363-11ef-87a0-74d02b464983'),
('ee45ca00-c36e-11ef-87a0-74d02b464983', 'Sumatera Utara', 'dd581add-c363-11ef-87a0-74d02b464983'),
('ee45caae-c36e-11ef-87a0-74d02b464983', 'Sumatera Utara', 'dd582486-c363-11ef-87a0-74d02b464983');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset_password`
--

CREATE TABLE `reset_password` (
  `id_reset` varchar(36) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_token` enum('aktif','terpakai','expired') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` varchar(36) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_ktp` varchar(16) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_kabupaten_kota` varchar(36) DEFAULT NULL,
  `id_provinsi` varchar(36) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`, `jenis_kelamin`, `tanggal_lahir`, `no_ktp`, `no_telepon`, `alamat`, `id_kabupaten_kota`, `id_provinsi`, `role`, `status_akun`, `created_at`, `updated_at`) VALUES
('676bea4bedf6e2.98434581', 'Dean Aura', 'deanaura58@gmail.com', '$2y$10$.9hzks98fkJyFqyzPrQF8.9mrQxA57wARyQND/wHoBswHKWQL0BkC', 'perempuan', '2024-12-03', '123456789012343', '81212821516', 'Jl. Manggarai', NULL, NULL, 'user', 'aktif', '2024-12-25 11:19:40', '2024-12-26 07:06:38'),
('676e0b531b5640.98531831', 'admin', 'admin123@gmail.com', '$2y$10$VCrh8JTiSZsXPWdDzYITGOFpW0yvhMywBlxQnOoKZqmdwVsaQvb0i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2024-12-27 02:05:07', '2024-12-27 05:42:52'),
('676eb949aee061.12795506', 'admin', 'admin@gmail.com', '$2y$10$Ws1220W5OFyCCRHafSBjPO7zuFt9I50dkpN/aunWI7O5GamauXRDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2024-12-27 14:27:21', '2024-12-27 14:28:16'),
('676f535ab0d417.03707061', 'Kamila', 'kamil@gmail.com', '$2y$10$VoyoZN1pqJ1YkIMk0ZeWyOKDW4Jfqx8OnQir2JVoj3H7P6CJmWSJi', 'laki-laki', '1980-06-10', '3457927655678', '(0123)123456789', 'Jl. Pengairan', NULL, NULL, 'user', 'aktif', '2024-12-28 01:24:43', '2024-12-28 01:30:36'),
('676f57f63dda63.91343321', 'Opik', 'opik@gmail.com', '$2y$10$znMIjDwBbRjCJWaF6MxxH.MdmaAmmHKn.l7ihRnKrE9w9/3YCC.42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'aktif', '2024-12-28 01:44:22', '2024-12-28 01:44:22'),
('676fc08b18cca6.74941534', 'rehan', 'rehan123@gmail.com', '$2y$10$2bH/7gEBjU6fDsUarkbPtOjXPhhwMKjXVLjmmZS7hPTLIYy6oHsOi', 'laki-laki', '2014-02-04', '12345678901667', '81212824367', 'Jl. Semanto', NULL, NULL, 'user', 'aktif', '2024-12-28 09:10:35', '2024-12-28 09:13:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wbp`
--

CREATE TABLE `wbp` (
  `id_wbp` varchar(36) NOT NULL,
  `nama_wbp` varchar(100) NOT NULL,
  `blok` varchar(50) NOT NULL,
  `tipe_blok` varchar(50) NOT NULL,
  `status_wbp` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wbp`
--

INSERT INTO `wbp` (`id_wbp`, `nama_wbp`, `blok`, `tipe_blok`, `status_wbp`, `created_at`) VALUES
('98eefab2-c361-11ef-87a0-74d02b464983', 'Budi Pertomo', 'A', 'Umum', 'aktif', '2024-12-26 08:15:41'),
('98f0eb34-c361-11ef-87a0-74d02b464983', 'Ira Irmansyah', 'B', 'Umum', 'aktif', '2024-12-26 08:15:41'),
('98f0ef75-c361-11ef-87a0-74d02b464983', 'Ali Ahmad', 'C', 'Khusus', 'aktif', '2024-12-26 08:15:41'),
('98f0f193-c361-11ef-87a0-74d02b464983', 'Sarah Devi', 'D', 'Khusus', 'aktif', '2024-12-26 08:15:41'),
('98f0f350-c361-11ef-87a0-74d02b464983', 'Rina Kusuma', 'A', 'Umum', 'aktif', '2024-12-26 08:15:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `jadwal_kunjungan`
--
ALTER TABLE `jadwal_kunjungan`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD PRIMARY KEY (`id_kabupaten_kota`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_wbp` (`id_wbp`),
  ADD KEY `id_kabupaten_kota` (`id_kabupaten_kota`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_wbp` (`id_wbp`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `fk_id_kabupaten_kota` (`id_kabupaten_kota`),
  ADD KEY `fk_id_provinsi` (`id_provinsi`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`),
  ADD KEY `fk_kabupaten_kota` (`id_kabupaten_kota`);

--
-- Indeks untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id_reset`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`),
  ADD KEY `id_kabupaten_kota` (`id_kabupaten_kota`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indeks untuk tabel `wbp`
--
ALTER TABLE `wbp`
  ADD PRIMARY KEY (`id_wbp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`id_wbp`) REFERENCES `wbp` (`id_wbp`),
  ADD CONSTRAINT `kunjungan_ibfk_3` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id_kabupaten_kota`),
  ADD CONSTRAINT `kunjungan_ibfk_4` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`);

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD CONSTRAINT `fk_id_kabupaten_kota` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id_kabupaten_kota`),
  ADD CONSTRAINT `fk_id_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`),
  ADD CONSTRAINT `pengiriman_barang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `pengiriman_barang_ibfk_2` FOREIGN KEY (`id_wbp`) REFERENCES `wbp` (`id_wbp`),
  ADD CONSTRAINT `pengiriman_barang_ibfk_3` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_barang` (`id_jenis`);

--
-- Ketidakleluasaan untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD CONSTRAINT `fk_kabupaten_kota` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id_kabupaten_kota`);

--
-- Ketidakleluasaan untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `reset_password_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id_kabupaten_kota`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
