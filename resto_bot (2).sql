-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 03:23 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_login`
--

CREATE TABLE `akses_login` (
  `id` int(3) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(254) NOT NULL,
  `akses` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_login`
--

INSERT INTO `akses_login` (`id`, `nama`, `username`, `password`, `akses`) VALUES
(1, 'Adi Subuhadir', 'adi', 'dfc87a8a900d23c665de66efee2248b6881b7771', 'admin'),
(2, 'Kasir', 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_menu`
--

CREATE TABLE `daftar_menu` (
  `id` int(11) NOT NULL,
  `url_gambar` text DEFAULT NULL,
  `varian_menu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_menu`
--

INSERT INTO `daftar_menu` (`id`, `url_gambar`, `varian_menu`) VALUES
(1, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/menu1.png', 'var1'),
(2, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/menu2.png', 'seafood');

-- --------------------------------------------------------

--
-- Table structure for table `gambar_qris`
--

CREATE TABLE `gambar_qris` (
  `id` int(11) NOT NULL,
  `url_gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_qris`
--

INSERT INTO `gambar_qris` (`id`, `url_gambar`) VALUES
(1, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/qr.png');

-- --------------------------------------------------------

--
-- Table structure for table `jam_buka_resto`
--

CREATE TABLE `jam_buka_resto` (
  `id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_buka` varchar(5) NOT NULL,
  `jam_tutup` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jam_buka_resto`
--

INSERT INTO `jam_buka_resto` (`id`, `hari`, `jam_buka`, `jam_tutup`) VALUES
(1, 'Minggu', '10:00', '22:00'),
(2, 'Senin', '08:00', '20:00'),
(3, 'Selasa', '08:00', '22:00'),
(4, 'Rabu', '08:00', '23:50'),
(5, 'Kamis', '08:00', '22:00'),
(6, 'Jumat', '08:00', '23:00'),
(7, 'Sabtu', '09:00', '23:00');

-- --------------------------------------------------------

--
-- Table structure for table `opsi_pengiriman`
--

CREATE TABLE `opsi_pengiriman` (
  `id` int(11) NOT NULL,
  `delivery_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opsi_pengiriman`
--

INSERT INTO `opsi_pengiriman` (`id`, `delivery_active`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_kodeunik`
--

CREATE TABLE `pembayaran_kodeunik` (
  `kode_pesanan` varchar(35) NOT NULL,
  `total_asli` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `status` enum('Menunggu Pembayaran','Dibayar','Dibatalkan') NOT NULL,
  `tanggal_code` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_masuk`
--

CREATE TABLE `pembayaran_masuk` (
  `id_pmbmsk` int(11) NOT NULL,
  `kode_pesanan` varchar(30) NOT NULL,
  `nominal_tagihan` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `penerima` varchar(35) NOT NULL,
  `jenis_pemb` enum('Cash','QRIS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(10) DEFAULT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `daftar_kode_menu` text DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `metode_pengambilan` enum('Dine In','Take Away','Delivery') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_meja` varchar(10) DEFAULT NULL,
  `metode_pembayaran` enum('Cash','QRIS') DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Dibayar','Sedang dibuat','Selesai','Dibatalkan') DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `biaya_delivery` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `nomor_wa`, `daftar_kode_menu`, `total_harga`, `metode_pengambilan`, `alamat`, `no_meja`, `metode_pembayaran`, `status`, `tanggal`, `created_at`, `biaya_delivery`) VALUES
(1, 'ORD001', '6281234567890@c.us', '1x2,3x1,5x1', 45000, 'Dine In', NULL, 'A1', 'Cash', 'Sedang dibuat', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(2, 'ORD002', '6282234567891@c.us', '2x1,4x2', 70000, 'Take Away', NULL, NULL, 'QRIS', 'Dibayar', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(3, 'ORD003', '6283234567892@c.us', '1x1,2x1,3x2', 60000, 'Delivery', 'Jl. Merdeka No.10', NULL, 'QRIS', 'Dibayar', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '5000.00'),
(4, 'ORD004', '6284234567893@c.us', '5x1,3x3', 75000, 'Dine In', NULL, 'B2', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(5, 'ORD005', '6285234567894@c.us', '2x2,4x1', 55000, 'Take Away', NULL, NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(6, 'ORD006', '6286234567895@c.us', '1x3,5x2', 80000, 'Delivery', 'Jl. Mawar No.2', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '8000.00'),
(7, 'ORD007', '6287234567896@c.us', '2x1,3x1', 40000, 'Dine In', NULL, 'C1', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(8, 'ORD008', '6288234567897@c.us', '4x2,1x1', 65000, 'Take Away', NULL, NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(9, 'ORD009', '6289234567898@c.us', '5x3', 90000, 'Delivery', 'Jl. Kenanga No.12', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '7000.00'),
(10, 'ORD010', '6280334567899@c.us', '1x2,3x2', 70000, 'Dine In', NULL, 'D3', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(11, 'ORD011', '6281334567800@c.us', '2x2,4x1', 55000, 'Take Away', NULL, NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(12, 'ORD012', '6282334567801@c.us', '1x1,5x1', 45000, 'Delivery', 'Jl. Sudirman No.7', NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '5000.00'),
(13, 'ORD013', '6283334567802@c.us', '3x3,2x1', 75000, 'Dine In', NULL, 'E4', 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(14, 'ORD014', '6284334567803@c.us', '4x2', 50000, 'Take Away', NULL, NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(15, 'ORD015', '6285334567804@c.us', '1x2,5x1', 55000, 'Delivery', 'Jl. Anggrek No.22', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '9000.00'),
(16, 'ORD016', '6286334567805@c.us', '2x1,3x2', 60000, 'Dine In', NULL, 'F1', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(17, 'ORD017', '6287334567806@c.us', '5x1,4x2', 70000, 'Take Away', NULL, NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(18, 'ORD018', '6288334567807@c.us', '1x3', 45000, 'Delivery', 'Jl. Cendana No.4', NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '6000.00'),
(19, 'ORD019', '6289334567808@c.us', '2x1,3x3', 75000, 'Dine In', NULL, 'G5', 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(20, 'ORD020', '6280434567809@c.us', '4x2,1x2', 65000, 'Take Away', NULL, NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(21, 'ORD021', '6281534567810@c.us', '5x2', 60000, 'Delivery', 'Jl. Melati No.5', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '7000.00'),
(22, 'ORD022', '6282534567811@c.us', '1x2,3x1', 50000, 'Dine In', NULL, 'H6', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(23, 'ORD023', '6283534567812@c.us', '2x2,5x1', 60000, 'Take Away', NULL, NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(24, 'ORD024', '6284534567813@c.us', '3x3', 75000, 'Delivery', 'Jl. Teratai No.8', NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '10000.00'),
(25, 'ORD025', '6285534567814@c.us', '1x1,2x1,4x2', 70000, 'Dine In', NULL, 'I7', 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(26, 'ORD026', '6286534567815@c.us', '5x1,3x2', 65000, 'Take Away', NULL, NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(27, 'ORD027', '6287534567816@c.us', '1x3,4x1', 60000, 'Delivery', 'Jl. Kamboja No.19', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '8000.00'),
(28, 'ORD028', '6288534567817@c.us', '2x1,3x1,5x1', 55000, 'Dine In', NULL, 'J8', 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(29, 'ORD029', '6289534567818@c.us', '1x2,2x2', 60000, 'Take Away', NULL, NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '0.00'),
(30, 'ORD030', '6280634567819@c.us', '4x3,3x1', 80000, 'Delivery', 'Jl. Dahlia No.6', NULL, 'Cash', 'Menunggu Pembayaran', '2025-06-17 08:09:08', '2025-06-15 00:04:33', '9000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_masuk`
--

CREATE TABLE `pesan_masuk` (
  `id` int(11) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `isi_pesan` text DEFAULT NULL,
  `tanggal_jam` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan_masuk`
--

INSERT INTO `pesan_masuk` (`id`, `nomor_wa`, `isi_pesan`, `tanggal_jam`) VALUES
(1, '6289651253545@c.us', 'hai', '2025-06-13 09:43:36'),
(2, '6289651253545@c.us', 'daftar', '2025-06-13 09:43:42'),
(3, '6289651253545@c.us', 'bima', '2025-06-13 09:43:50'),
(4, '6289651253545@c.us', 'pesan', '2025-06-13 09:44:45'),
(5, '6289651253545@c.us', '#1', '2025-06-13 09:44:47'),
(6, '6289651253545@c.us', '#2', '2025-06-13 09:44:49'),
(7, '6289651253545@c.us', '#6', '2025-06-13 09:44:51'),
(8, '6289651253545@c.us', '#7', '2025-06-13 09:44:55'),
(9, '6289651253545@c.us', '#9', '2025-06-13 09:44:58'),
(10, '6289651253545@c.us', 'selesai', '2025-06-13 09:45:00'),
(11, '6289651253545@c.us', 'ya', '2025-06-13 09:45:03'),
(12, '6289651253545@c.us', 'dine in', '2025-06-13 09:45:06'),
(13, '6289651253545@c.us', '1', '2025-06-13 09:45:08'),
(14, '6289651253545@c.us', 'cash', '2025-06-13 09:45:10'),
(15, '6289651253545@c.us', 'menu', '2025-06-13 11:06:14'),
(16, '6289651253545@c.us', 'pesan', '2025-06-13 11:07:59'),
(17, '6289651253545@c.us', 'batal', '2025-06-13 11:08:04'),
(18, '6289651253545@c.us', 'pesan', '2025-06-13 11:08:45'),
(19, '6289651253545@c.us', '#1x2', '2025-06-13 11:09:13'),
(20, '6289651253545@c.us', '$5', '2025-06-13 11:09:45'),
(21, '6289651253545@c.us', '#5', '2025-06-13 11:09:47'),
(22, '6289651253545@c.us', 'selesai', '2025-06-13 11:09:51'),
(23, '6289651253545@c.us', 'selesai', '2025-06-13 11:10:18'),
(24, '6289651253545@c.us', 'ya', '2025-06-13 11:12:12'),
(25, '6287794699404@c.us', 'Hari ini libur', '2025-06-13 14:19:52'),
(26, '6289651253545@c.us', 'tes', '2025-06-13 14:19:53'),
(27, '62895376940853@c.us', 'Pripon mba hada?', '2025-06-13 14:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `table_menu`
--

CREATE TABLE `table_menu` (
  `kode_menu` varchar(10) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `alias` varchar(235) NOT NULL DEFAULT '',
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(45) NOT NULL DEFAULT 'null',
  `varians` varchar(55) NOT NULL DEFAULT 'null',
  `tersedia` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_menu`
--

INSERT INTO `table_menu` (`kode_menu`, `nama_menu`, `alias`, `harga`, `kategori`, `varians`, `tersedia`) VALUES
('1', 'CHICKEN STEAK MEDIUM', '', 50000, 'FOOD', 'CHICKEN', 1),
('10', 'HOT TEA', 'teh anget,teh hangat,teh panas', 20000, 'DRINK', 'TEA', 1),
('11', 'HOT LEMON', '', 20000, 'DRINK', 'LEMON', 1),
('12', 'ICE LEMON', '', 25000, 'DRINK', 'LEMON', 1),
('13', 'SEA SCALLOP', '', 200000, 'FOOD', 'SEA FOOD', 1),
('14', 'SPICY CRAB', '', 210000, 'FOOD', 'SEA FOOD', 1),
('15', 'SPINY LOBSTER', '', 220000, 'FOOD', 'SEA FOOD', 1),
('16', 'GRILLED LOBSTER', '', 230000, 'FOOD', 'SEA FOOD', 1),
('17', 'OYSTER', '', 240000, 'FOOD', 'SEA FOOD', 1),
('18', 'PRAWN SOUP', '', 250000, 'FOOD', 'SEA FOOD', 1),
('19', 'GRILLED SQUID', '', 260000, 'FOOD', 'SEA FOOD', 1),
('2', 'CHICKEN TERIYAKI', '', 60000, 'FOOD', 'CHICKEN', 1),
('20', 'SPICY PRAWN CRISP', '', 100000, 'SNACK', 'SNACK', 1),
('21', 'SALTED OYSTER CRISP', '', 110000, 'SNACK', 'SNACK', 1),
('22', 'CRABS CHIPS', '', 120000, 'SNACK', 'SNACK', 1),
('23', 'SQUID TAKOYAKI', '', 130000, 'SNACK', 'SNACK', 1),
('24', 'PRAWN DIM SUM', '', 150000, 'SNACK', 'SNACK', 1),
('3', 'FRIED CHICKEN TALIWANG', '', 70000, 'FOOD', 'CHICKEN', 1),
('4', 'SPICY STEAK MANADO', '', 120000, 'FOOD', 'CHICKEN', 1),
('5', 'BEEF STEAK MEDIUM', '', 65000, 'FOOD', 'BEEF', 1),
('6', 'BLACK PEPPER BEEF', '', 75000, 'FOOD', 'BEEF', 0),
('7', 'GRILLED BEEF', '', 80000, 'FOOD', 'BEEF', 1),
('8', 'OXTAIL SOUP', '', 100000, 'FOOD', 'BEEF', 0),
('9', 'ICE TEA', 'esteh,es teh,s teh,teh es es', 15000, 'DRINK', 'TEA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nomor_wa`, `nama`, `tanggal_daftar`) VALUES
(1, '6289651253545@c.us', 'BIMA', '2025-06-13 09:43:50'),
(2, '6281234567890@c.us', 'Andi', '2025-06-14 23:57:59'),
(3, '6282234567891@c.us', 'Budi', '2025-06-14 23:57:59'),
(4, '6283234567892@c.us', 'Citra', '2025-06-14 23:57:59'),
(5, '6284234567893@c.us', 'Dewi', '2025-06-14 23:57:59'),
(6, '6285234567894@c.us', 'Eka', '2025-06-14 23:57:59'),
(7, '6286234567895@c.us', 'Fajar', '2025-06-14 23:57:59'),
(8, '6287234567896@c.us', 'Gita', '2025-06-14 23:57:59'),
(9, '6288234567897@c.us', 'Hana', '2025-06-14 23:57:59'),
(10, '6289234567898@c.us', 'Irfan', '2025-06-14 23:57:59'),
(11, '6280334567899@c.us', 'Joko', '2025-06-14 23:57:59'),
(12, '6281334567800@c.us', 'Kiki', '2025-06-14 23:57:59'),
(13, '6282334567801@c.us', 'Lina', '2025-06-14 23:57:59'),
(14, '6283334567802@c.us', 'Made', '2025-06-14 23:57:59'),
(15, '6284334567803@c.us', 'Nina', '2025-06-14 23:57:59'),
(16, '6285334567804@c.us', 'Omar', '2025-06-14 23:57:59'),
(17, '6286334567805@c.us', 'Putri', '2025-06-14 23:57:59'),
(18, '6287334567806@c.us', 'Qori', '2025-06-14 23:57:59'),
(19, '6288334567807@c.us', 'Rian', '2025-06-14 23:57:59'),
(20, '6289334567808@c.us', 'Siska', '2025-06-14 23:57:59'),
(21, '6280434567809@c.us', 'Tomi', '2025-06-14 23:57:59'),
(22, '6281534567810@c.us', 'Umi', '2025-06-14 23:57:59'),
(23, '6282534567811@c.us', 'Vira', '2025-06-14 23:57:59'),
(24, '6283534567812@c.us', 'Wawan', '2025-06-14 23:57:59'),
(25, '6284534567813@c.us', 'Xena', '2025-06-14 23:57:59'),
(26, '6285534567814@c.us', 'Yani', '2025-06-14 23:57:59'),
(27, '6286534567815@c.us', 'Zaki', '2025-06-14 23:57:59'),
(28, '6287534567816@c.us', 'Aulia', '2025-06-14 23:57:59'),
(29, '6288534567817@c.us', 'Bayu', '2025-06-14 23:57:59'),
(30, '6289534567818@c.us', 'Cahya', '2025-06-14 23:57:59'),
(31, '6280634567819@c.us', 'Dian', '2025-06-14 23:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `zona_kelurahan`
--

CREATE TABLE `zona_kelurahan` (
  `id` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) NOT NULL,
  `zona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zona_kelurahan`
--

INSERT INTO `zona_kelurahan` (`id`, `nama_kelurahan`, `zona_id`) VALUES
(1, 'Kauman', 1),
(2, 'Kergon', 1),
(3, 'Degayu', 2),
(4, 'Kramat', 2),
(5, 'Kuripan', 3),
(6, 'Sampangan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `zona_pengiriman`
--

CREATE TABLE `zona_pengiriman` (
  `id` int(11) NOT NULL,
  `nama_zona` varchar(50) NOT NULL,
  `biaya_ongkir` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zona_pengiriman`
--

INSERT INTO `zona_pengiriman` (`id`, `nama_zona`, `biaya_ongkir`) VALUES
(1, 'Pusat Kota', '5000.00'),
(2, 'Pinggiran Timur', '10000.00'),
(3, 'Pinggiran Barat', '12000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_login`
--
ALTER TABLE `akses_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_qris`
--
ALTER TABLE `gambar_qris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jam_buka_resto`
--
ALTER TABLE `jam_buka_resto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opsi_pengiriman`
--
ALTER TABLE `opsi_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_masuk`
--
ALTER TABLE `pembayaran_masuk`
  ADD PRIMARY KEY (`id_pmbmsk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`);

--
-- Indexes for table `pesan_masuk`
--
ALTER TABLE `pesan_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_menu`
--
ALTER TABLE `table_menu`
  ADD PRIMARY KEY (`kode_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_wa` (`nomor_wa`);

--
-- Indexes for table `zona_kelurahan`
--
ALTER TABLE `zona_kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indexes for table `zona_pengiriman`
--
ALTER TABLE `zona_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_login`
--
ALTER TABLE `akses_login`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gambar_qris`
--
ALTER TABLE `gambar_qris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jam_buka_resto`
--
ALTER TABLE `jam_buka_resto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran_masuk`
--
ALTER TABLE `pembayaran_masuk`
  MODIFY `id_pmbmsk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pesan_masuk`
--
ALTER TABLE `pesan_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `zona_kelurahan`
--
ALTER TABLE `zona_kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zona_pengiriman`
--
ALTER TABLE `zona_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zona_kelurahan`
--
ALTER TABLE `zona_kelurahan`
  ADD CONSTRAINT `zona_kelurahan_ibfk_1` FOREIGN KEY (`zona_id`) REFERENCES `zona_pengiriman` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
