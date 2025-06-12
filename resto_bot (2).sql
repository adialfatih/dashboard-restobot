-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 02:42 AM
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

--
-- Dumping data for table `pembayaran_kodeunik`
--

INSERT INTO `pembayaran_kodeunik` (`kode_pesanan`, `total_asli`, `kode_unik`, `total_tagihan`, `status`, `tanggal_code`) VALUES
('OR001', 225000, 827, 225827, 'Menunggu Pembayaran', '2025-06-08 00:23:55'),
('OR002', 65000, 122, 65122, 'Menunggu Pembayaran', '2025-06-08 00:23:55');

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
(2, 'OR002', '6287713614538@c.us', '1x1,9x1', 65000, 'Dine In', NULL, '02', 'QRIS', 'Menunggu Pembayaran', '2025-06-06 10:25:26', '2025-06-06 10:25:26', '0.00'),
(4, 'OR004', '6285643130806@c.us', '1x1,2x2,9x1,10x1,21x1', 315000, 'Dine In', NULL, '7', 'Cash', 'Menunggu Pembayaran', '2025-06-07 13:10:27', '2025-06-07 13:10:27', '0.00'),
(5, 'OR003', '6289651253545@c.us', '1x1,2x1', 110000, 'Dine In', NULL, '20', 'Cash', 'Dibatalkan', '2025-06-11 22:49:00', '2025-06-11 22:49:00', '0.00');

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
(1, '6289651253545@c.us', 'tes', '2025-06-04 13:57:41'),
(2, '6289651253545@c.us', 'hai', '2025-06-04 13:57:50'),
(3, '6289651253545@c.us', 'halo', '2025-06-04 13:57:59'),
(4, '6289651253545@c.us', 'hai', '2025-06-04 13:59:14'),
(5, '6289651253545@c.us', 'halo', '2025-06-04 13:59:19'),
(6, '6289651253545@c.us', 'daftar', '2025-06-04 13:59:27'),
(7, '6289651253545@c.us', 'Ronaldo', '2025-06-04 13:59:36'),
(8, '6289651253545@c.us', 'menu', '2025-06-04 13:59:41'),
(9, '6289651253545@c.us', 'help', '2025-06-04 13:59:58'),
(10, '6289651253545@c.us', 'pesan', '2025-06-04 14:00:08'),
(11, '6289651253545@c.us', '#1', '2025-06-04 14:00:13'),
(12, '6289651253545@c.us', '#2 x2', '2025-06-04 14:00:20'),
(13, '6289651253545@c.us', 'es teh', '2025-06-04 14:00:27'),
(14, '6289651253545@c.us', 'teh hangat x2', '2025-06-04 14:00:36'),
(15, '6289651253545@c.us', 'selesai', '2025-06-04 14:00:41'),
(16, '6289651253545@c.us', 'ya', '2025-06-04 14:00:46'),
(17, '6289651253545@c.us', 'delivery', '2025-06-04 14:00:53'),
(18, '6289651253545@c.us', 'Jl. Hos Cokroaminoto Gg.2 Kuripan Kidul No.312', '2025-06-04 14:01:13'),
(19, '6289651253545@c.us', 'qris', '2025-06-04 14:01:17'),
(20, '6289651253545@c.us', 'status', '2025-06-04 14:32:59'),
(21, '6289651253545@c.us', 'hai', '2025-06-04 14:33:15'),
(22, '6289651253545@c.us', 'batal', '2025-06-04 14:33:37'),
(23, '6289651253545@c.us', 'tidak', '2025-06-04 14:33:40'),
(24, '6289651253545@c.us', 'pesan', '2025-06-04 14:34:44'),
(25, '6287713614538@c.us', '', '2025-06-04 14:39:53'),
(26, '6287713614538@c.us', '', '2025-06-04 14:39:53'),
(27, '6287713614538@c.us', 'Ciken', '2025-06-04 14:39:53'),
(28, '6287713614538@c.us', 'Menu', '2025-06-04 14:40:06'),
(29, '6287713614538@c.us', 'Daftar', '2025-06-04 14:40:18'),
(30, '6287713614538@c.us', 'Husein', '2025-06-04 14:40:24'),
(31, '6287713614538@c.us', 'Menu', '2025-06-04 14:40:30'),
(32, '6287713614538@c.us', 'Ciken', '2025-06-04 14:40:45'),
(33, '6287713614538@c.us', '13', '2025-06-04 14:40:54'),
(34, '6287713614538@c.us', 'Menu', '2025-06-04 14:41:04'),
(35, '6287713614538@c.us', 'Chicken', '2025-06-04 14:41:15'),
(36, '6287713614538@c.us', 'Pay', '2025-06-04 14:41:24'),
(37, '6289651253545@c.us', 'tes', '2025-06-04 14:50:08'),
(38, '6287713614538@c.us', 'Pesan', '2025-06-04 14:50:38'),
(39, '6289651253545@c.us', 'status', '2025-06-04 14:50:48'),
(40, '6287713614538@c.us', 'Selesai', '2025-06-04 14:51:03'),
(41, '6287713614538@c.us', 'Menu', '2025-06-04 14:51:13'),
(42, '6287713614538@c.us', 'Sea scallop', '2025-06-04 14:51:30'),
(43, '6287713614538@c.us', 'Hot tea', '2025-06-04 14:51:43'),
(44, '6287713614538@c.us', 'Total', '2025-06-04 14:51:51'),
(45, '6287713614538@c.us', 'Total', '2025-06-04 14:52:01'),
(46, '6289651253545@c.us', 'cara pesan', '2025-06-04 15:51:10'),
(47, '6289651253545@c.us', 'pesan bagaimana', '2025-06-04 15:52:11'),
(48, '6289651253545@c.us', 'batal', '2025-06-04 15:53:03'),
(49, '6289651253545@c.us', 'ya', '2025-06-04 15:53:07'),
(50, '6289651253545@c.us', 'pesan', '2025-06-04 15:53:11'),
(51, '6289651253545@c.us', 'ciken', '2025-06-04 15:53:18'),
(52, '6289651253545@c.us', 'beef', '2025-06-04 15:53:23'),
(53, '6289651253545@c.us', 'list', '2025-06-04 15:53:26'),
(54, '6289651253545@c.us', 'esteh x2', '2025-06-04 15:53:41'),
(55, '6289651253545@c.us', 'coret grilled beef', '2025-06-04 15:53:51'),
(56, '6289651253545@c.us', 'list', '2025-06-04 15:53:54'),
(57, '6289651253545@c.us', 'selesai', '2025-06-04 15:54:00'),
(58, '6289651253545@c.us', 'udah', '2025-06-04 15:54:05'),
(59, '6289651253545@c.us', 'y', '2025-06-04 15:54:21'),
(60, '6289651253545@c.us', 'help', '2025-06-04 15:56:02'),
(61, '6289651253545@c.us', 'h', '2025-06-04 15:56:05'),
(62, '6289651253545@c.us', 'cara pesan', '2025-06-04 15:56:18'),
(63, '6289651253545@c.us', 'help', '2025-06-04 15:56:31'),
(64, '6289651253545@c.us', 'status', '2025-06-04 15:56:42'),
(65, '6287713614538@c.us', 'Totalnya', '2025-06-04 18:46:21'),
(66, '6289651253545@c.us', 'status', '2025-06-04 23:40:01'),
(67, '6289651253545@c.us', 'hai', '2025-06-04 23:45:05'),
(68, '6289651253545@c.us', 'info', '2025-06-04 23:45:20'),
(69, '6289651253545@c.us', 'cara pesan', '2025-06-04 23:45:28'),
(70, '6289651253545@c.us', 'bisa banget pak, 😁', '2025-06-05 08:35:27'),
(71, '6289651253545@c.us', 'bisa buat pemesanan batik berbasis AI smart customer care', '2025-06-05 08:35:52'),
(72, '6289651253545@c.us', 'hai', '2025-06-05 12:50:50'),
(73, '6285201127759@c.us', 'Status', '2025-06-05 22:02:27'),
(74, '6285201127759@c.us', 'Daftar', '2025-06-05 22:04:06'),
(75, '6285201127759@c.us', 'Fatimah', '2025-06-05 22:04:10'),
(76, '6287713614538@c.us', 'Menu', '2025-06-06 04:45:53'),
(77, '6287713614538@c.us', '#1', '2025-06-06 04:46:14'),
(78, '6287713614538@c.us', 'Cara', '2025-06-06 04:46:23'),
(79, '6287713614538@c.us', 'Cara pesan', '2025-06-06 04:46:26'),
(80, '6287713614538@c.us', '#1', '2025-06-06 04:46:52'),
(81, '6287713614538@c.us', 'Help', '2025-06-06 04:47:02'),
(82, '6287713614538@c.us', '#pesan', '2025-06-06 04:47:15'),
(83, '6287713614538@c.us', 'Menu', '2025-06-06 04:47:22'),
(84, '6287713614538@c.us', '#20', '2025-06-06 04:47:33'),
(85, '6287713614538@c.us', 'Pesan #20', '2025-06-06 04:47:41'),
(86, '6287713614538@c.us', 'Pembayaran', '2025-06-06 04:48:01'),
(87, '6287713614538@c.us', 'Cara pesan', '2025-06-06 09:33:25'),
(88, '6287713614538@c.us', 'Menu', '2025-06-06 09:33:51'),
(89, '6287713614538@c.us', '#1', '2025-06-06 09:34:15'),
(90, '6287713614538@c.us', '1', '2025-06-06 09:34:20'),
(91, '6287713614538@c.us', '2', '2025-06-06 09:34:24'),
(92, '6287713614538@c.us', '#4', '2025-06-06 09:34:28'),
(93, '6287713614538@c.us', 'Menu', '2025-06-06 09:34:50'),
(94, '6287713614538@c.us', 'Pesan 12', '2025-06-06 09:34:57'),
(95, '6287713614538@c.us', 'Menu', '2025-06-06 09:51:33'),
(96, '6287713614538@c.us', 'Spicy crab', '2025-06-06 09:51:47'),
(97, '6287713614538@c.us', 'Pesan dulu', '2025-06-06 10:20:47'),
(98, '6287713614538@c.us', 'Cara pesan', '2025-06-06 10:21:05'),
(99, '6287713614538@c.us', 'Menu', '2025-06-06 10:21:23'),
(100, '6287713614538@c.us', 'Pesan #20', '2025-06-06 10:21:34'),
(101, '6287713614538@c.us', 'Pesan', '2025-06-06 10:22:41'),
(102, '6287713614538@c.us', '#1', '2025-06-06 10:24:31'),
(103, '6287713614538@c.us', '#es teh', '2025-06-06 10:24:42'),
(104, '6287713614538@c.us', 'Jumlah', '2025-06-06 10:24:53'),
(105, '6287713614538@c.us', 'Selesai', '2025-06-06 10:24:58'),
(106, '6287713614538@c.us', 'Sudah', '2025-06-06 10:25:09'),
(107, '6287713614538@c.us', 'Dine in', '2025-06-06 10:25:16'),
(108, '6287713614538@c.us', '02', '2025-06-06 10:25:22'),
(109, '6287713614538@c.us', 'Qris', '2025-06-06 10:25:26'),
(110, '6289651253545@c.us', 'help', '2025-06-06 14:22:12'),
(111, '6289651253545@c.us', 'pesan', '2025-06-06 14:23:37'),
(112, '6289651253545@c.us', '#1', '2025-06-06 14:23:46'),
(113, '6289651253545@c.us', '#2x2', '2025-06-06 14:23:57'),
(114, '6289651253545@c.us', '#3x1', '2025-06-06 14:24:05'),
(115, '6289651253545@c.us', 'Ice tea', '2025-06-06 14:24:17'),
(116, '6289651253545@c.us', 'teh hanget x 3', '2025-06-06 14:24:57'),
(117, '6289651253545@c.us', 'list', '2025-06-06 14:25:01'),
(118, '6289651253545@c.us', 'coret hot tea', '2025-06-06 14:26:26'),
(119, '6289651253545@c.us', 'list', '2025-06-06 14:26:31'),
(120, '6289651253545@c.us', 'hot tea x2', '2025-06-06 14:26:39'),
(121, '6289651253545@c.us', 'selesai', '2025-06-06 14:26:44'),
(122, '6289651253545@c.us', 'ya', '2025-06-06 14:26:52'),
(123, '6289651253545@c.us', 'take away', '2025-06-06 14:30:18'),
(124, '6289651253545@c.us', 'cash', '2025-06-06 14:30:22'),
(125, '6289651253545@c.us', 'status', '2025-06-06 14:30:33'),
(126, '6289651253545@c.us', 'tes', '2025-06-07 11:34:58'),
(127, '6289651253545@c.us', 'hai', '2025-06-07 11:35:02'),
(128, '6289651253545@c.us', 'halo', '2025-06-07 13:03:47'),
(129, '6289651253545@c.us', 'hi', '2025-06-07 13:03:51'),
(130, '6285643130806@c.us', 'Hay', '2025-06-07 13:04:00'),
(131, '6285643130806@c.us', 'Daftar', '2025-06-07 13:04:16'),
(132, '6285643130806@c.us', 'Rembo', '2025-06-07 13:04:38'),
(133, '6285643130806@c.us', 'Menu', '2025-06-07 13:05:57'),
(134, '6285643130806@c.us', 'Help', '2025-06-07 13:06:33'),
(135, '6285643130806@c.us', 'Pesan', '2025-06-07 13:06:46'),
(136, '6285643130806@c.us', '#1', '2025-06-07 13:06:57'),
(137, '6285643130806@c.us', '#2x', '2025-06-07 13:07:11'),
(138, '6285643130806@c.us', '#2x2', '2025-06-07 13:07:28'),
(139, '6285643130806@c.us', 'Es teh', '2025-06-07 13:07:40'),
(140, '6285643130806@c.us', 'Teh anget', '2025-06-07 13:08:02'),
(141, '6285643130806@c.us', 'List', '2025-06-07 13:08:13'),
(142, '6285643130806@c.us', 'Beef', '2025-06-07 13:08:31'),
(143, '6285643130806@c.us', 'List', '2025-06-07 13:08:41'),
(144, '6285643130806@c.us', 'Coret', '2025-06-07 13:08:56'),
(145, '6285643130806@c.us', 'Coret grilled beef', '2025-06-07 13:09:11'),
(146, '6285643130806@c.us', 'Liat', '2025-06-07 13:09:25'),
(147, '6285643130806@c.us', 'List', '2025-06-07 13:09:38'),
(148, '6285643130806@c.us', 'Selesai', '2025-06-07 13:09:46'),
(149, '6285643130806@c.us', 'Ya', '2025-06-07 13:09:55'),
(150, '6285643130806@c.us', 'Dine in', '2025-06-07 13:10:10'),
(151, '6285643130806@c.us', '7', '2025-06-07 13:10:14'),
(152, '6285643130806@c.us', 'Cash', '2025-06-07 13:10:27'),
(153, '6285643130806@c.us', 'Status', '2025-06-07 13:10:56'),
(154, '6285643130806@c.us', 'Pesan', '2025-06-07 13:11:05'),
(155, '6285643130806@c.us', 'Batal', '2025-06-07 13:11:30'),
(156, '6285643130806@c.us', 'Ya', '2025-06-07 13:11:39'),
(157, '6289651253545@c.us', 'hai', '2025-06-10 22:34:59'),
(158, '6289651253545@c.us', 'help', '2025-06-10 22:35:12'),
(159, '6289651253545@c.us', 'info', '2025-06-10 22:35:14'),
(160, '6289651253545@c.us', 'cara pesan', '2025-06-10 22:35:22'),
(161, '6289651253545@c.us', 'pesan', '2025-06-10 22:35:26'),
(162, '6289651253545@c.us', 'batal', '2025-06-10 22:35:31'),
(163, '6289651253545@c.us', 'wow', '2025-06-10 22:35:41'),
(164, '6289651253545@c.us', 'status', '2025-06-10 22:35:46'),
(165, '6289651253545@c.us', 'pesan', '2025-06-10 22:35:53'),
(166, '6289651253545@c.us', 'status', '2025-06-10 22:35:58'),
(167, '62816670016@c.us', 'AssalamU’alaikum mbak hada', '2025-06-11 21:45:20'),
(168, '62816670016@c.us', 'Kalo azka bulan ini mau libur lesnya', '2025-06-11 21:45:20'),
(169, '62816670016@c.us', 'Besok insyaallah anak2 cewek mau les', '2025-06-11 21:45:20'),
(170, '6289651253545@c.us', 'tes', '2025-06-11 21:46:59'),
(171, '6289651253545@c.us', 'pesan', '2025-06-11 21:47:04'),
(172, '6289651253545@c.us', 'daftar', '2025-06-11 21:47:08'),
(173, '6289651253545@c.us', 'Adi ganteng', '2025-06-11 21:47:14'),
(174, '6289651253545@c.us', 'pesan', '2025-06-11 21:47:19'),
(175, '6289651253545@c.us', '#1', '2025-06-11 21:47:23'),
(176, '6289651253545@c.us', '#2 x2', '2025-06-11 21:47:26'),
(177, '6289651253545@c.us', 'ice tea', '2025-06-11 21:47:29'),
(178, '6289651253545@c.us', 'es jeruk', '2025-06-11 21:47:36'),
(179, '6289651253545@c.us', 'list', '2025-06-11 21:47:44'),
(180, '6289651253545@c.us', 'selesai', '2025-06-11 21:47:48'),
(181, '6289651253545@c.us', 'yes', '2025-06-11 21:47:51'),
(182, '6289651253545@c.us', 'delivery', '2025-06-11 21:47:55'),
(183, '6289651253545@c.us', 'jalan sunan ampel gg.14 no 25', '2025-06-11 21:48:06'),
(184, '6289651253545@c.us', 'medono', '2025-06-11 21:48:14'),
(185, '6289651253545@c.us', 'kuripan', '2025-06-11 21:48:30'),
(186, '6289651253545@c.us', 'pesan', '2025-06-11 21:48:41'),
(187, '6289651253545@c.us', 'selesai', '2025-06-11 21:48:45'),
(188, '6289651253545@c.us', 'pesna', '2025-06-11 21:56:47'),
(189, '6289651253545@c.us', 'pesan', '2025-06-11 21:56:49'),
(190, '6289651253545@c.us', '#1', '2025-06-11 21:56:53'),
(191, '6289651253545@c.us', '#4', '2025-06-11 21:56:56'),
(192, '6289651253545@c.us', 'selesai', '2025-06-11 21:56:59'),
(193, '6289651253545@c.us', 'sudah', '2025-06-11 21:57:02'),
(194, '6289651253545@c.us', 'delivery', '2025-06-11 21:57:08'),
(195, '6289651253545@c.us', 'jalan sunnan ampel gg.14', '2025-06-11 21:57:19'),
(196, '6289651253545@c.us', 'medono', '2025-06-11 21:57:23'),
(197, '6289651253545@c.us', 'zona antar', '2025-06-11 22:13:40'),
(198, '6289651253545@c.us', 'pesan', '2025-06-11 22:48:29'),
(199, '6289651253545@c.us', '#1', '2025-06-11 22:48:32'),
(200, '6289651253545@c.us', '#a', '2025-06-11 22:48:34'),
(201, '6289651253545@c.us', '#2', '2025-06-11 22:48:37'),
(202, '6289651253545@c.us', 'selesai', '2025-06-11 22:48:39'),
(203, '6289651253545@c.us', 'ya', '2025-06-11 22:48:41'),
(204, '6289651253545@c.us', 'delivery', '2025-06-11 22:48:44'),
(205, '6289651253545@c.us', 'dine in', '2025-06-11 22:48:55'),
(206, '6289651253545@c.us', '20', '2025-06-11 22:48:57'),
(207, '6289651253545@c.us', 'cash', '2025-06-11 22:49:00'),
(208, '6289651253545@c.us', 'ya', '2025-06-11 22:49:08'),
(209, '6289651253545@c.us', 'status', '2025-06-11 22:49:18'),
(210, '6289651253545@c.us', 'batal', '2025-06-11 22:52:53'),
(211, '6289651253545@c.us', 'ya', '2025-06-11 22:52:57'),
(212, '6289651253545@c.us', 'pesan', '2025-06-11 22:53:00'),
(213, '6289651253545@c.us', '#1', '2025-06-11 22:53:03'),
(214, '6289651253545@c.us', 'batal', '2025-06-11 22:53:06'),
(215, '6289651253545@c.us', '#2', '2025-06-11 22:53:43'),
(216, '6289651253545@c.us', 'batal', '2025-06-11 22:54:53'),
(217, '6289651253545@c.us', 'pesan', '2025-06-11 22:55:01'),
(218, '6289651253545@c.us', '#1', '2025-06-11 22:55:03'),
(219, '6289651253545@c.us', '#2', '2025-06-11 22:55:07'),
(220, '6289651253545@c.us', 'batal', '2025-06-11 22:55:09'),
(221, '6289651253545@c.us', 'batal', '2025-06-11 22:55:15'),
(222, '6289651253545@c.us', 'status', '2025-06-11 22:55:19'),
(223, '6289651253545@c.us', 'batal', '2025-06-11 22:56:30'),
(224, '6289651253545@c.us', 'pesan', '2025-06-11 23:15:03'),
(225, '6289651253545@c.us', '#2', '2025-06-11 23:15:31'),
(226, '6289651253545@c.us', '#8', '2025-06-11 23:15:33'),
(227, '6289651253545@c.us', 'BLACK PEPPER BEEF', '2025-06-11 23:15:45'),
(228, '6289651253545@c.us', 'PRAWN DIM SUM', '2025-06-11 23:15:52'),
(229, '6289651253545@c.us', 'FRIED CHICKEN TALIWANG', '2025-06-11 23:16:17'),
(230, '6289651253545@c.us', '#6', '2025-06-11 23:16:24'),
(231, '6289651253545@c.us', '#2', '2025-06-11 23:16:39'),
(232, '6289651253545@c.us', '#6', '2025-06-11 23:16:42'),
(233, '6289651253545@c.us', 'list', '2025-06-11 23:16:53'),
(234, '6289651253545@c.us', 'batal', '2025-06-11 23:16:58'),
(235, '6289651253545@c.us', 'pesan', '2025-06-11 23:16:59'),
(236, '6289651253545@c.us', '#4', '2025-06-11 23:17:02'),
(237, '6289651253545@c.us', 'PRAWN DIM SUM', '2025-06-11 23:17:13'),
(238, '6289651253545@c.us', '#24', '2025-06-11 23:17:32'),
(239, '6289651253545@c.us', 'batal', '2025-06-11 23:22:44'),
(240, '6289651253545@c.us', 'pesan', '2025-06-11 23:22:48'),
(241, '6289651253545@c.us', 'PRAWN DIM SUM', '2025-06-11 23:22:53'),
(242, '6289651253545@c.us', '#24', '2025-06-11 23:22:59'),
(243, '6289651253545@c.us', 'BLACK PEPPER BEEF', '2025-06-11 23:23:12'),
(244, '6289651253545@c.us', '#6', '2025-06-11 23:23:20'),
(245, '6289651253545@c.us', 'SEA SCALLOP', '2025-06-11 23:23:34'),
(246, '6289651253545@c.us', 'batal', '2025-06-11 23:24:33'),
(247, '6289651253545@c.us', 'pesan', '2025-06-11 23:24:36'),
(248, '6289651253545@c.us', 'SEA SCALLOP', '2025-06-11 23:24:42'),
(249, '6289651253545@c.us', 'OXTAIL SOUP', '2025-06-11 23:24:51'),
(250, '6289651253545@c.us', '#8', '2025-06-11 23:24:58'),
(251, '6289651253545@c.us', 'ICE LEMON', '2025-06-11 23:25:08'),
(252, '6289651253545@c.us', 'list', '2025-06-11 23:25:09'),
(253, '6289651253545@c.us', '#4', '2025-06-11 23:25:18'),
(254, '6289651253545@c.us', 'list', '2025-06-11 23:25:21');

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
(2, '6287713614538@c.us', 'HUSEIN', '2025-06-04 14:40:24'),
(3, '6285201127759@c.us', 'FATIMAH', '2025-06-05 22:04:10'),
(4, '6285643130806@c.us', 'REMBO', '2025-06-07 13:04:38'),
(5, '6289651253545@c.us', 'ADI GANTENG', '2025-06-11 21:47:14');

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
  MODIFY `id_pmbmsk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan_masuk`
--
ALTER TABLE `pesan_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
