-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2024 pada 13.26
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_iuran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'nonaktif',
  `role_dokumen` set('direktur','pegawai') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `nama`, `file_path`, `status`, `role_dokumen`, `created_at`, `keterangan`) VALUES
(7, 'tes dokumen aja', 'uploads/test dokumen.txt', 'aktif', 'direktur', '2024-05-09 11:25:14', 'halo tes keterangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_payments`
--

CREATE TABLE `tb_payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum dibayar','lunas') NOT NULL DEFAULT 'belum dibayar',
  `kode_transaksi` varchar(20) NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_payments`
--

INSERT INTO `tb_payments` (`payment_id`, `user_id`, `amount`, `payment_date`, `status`, `kode_transaksi`, `invoice_date`) VALUES
(1, 1, '5000', '2024-05-08 11:23:45', 'lunas', 'TRX-20240508132345-b', '2024-05-08 06:23:45'),
(2, 140, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-4', '2024-05-08 06:23:45'),
(3, 141, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-9', '2024-05-08 06:23:45'),
(4, 142, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-b', '2024-05-08 06:23:45'),
(5, 143, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-5', '2024-05-08 06:23:45'),
(6, 144, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-c', '2024-05-08 06:23:45'),
(7, 145, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-1', '2024-05-08 06:23:45'),
(8, 146, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-1', '2024-05-08 06:23:45'),
(9, 147, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-c', '2024-05-08 06:23:45'),
(10, 148, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-3', '2024-05-08 06:23:45'),
(11, 149, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-1', '2024-05-08 06:23:45'),
(12, 150, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-b', '2024-05-08 06:23:45'),
(13, 151, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-8', '2024-05-08 06:23:45'),
(14, 152, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-2', '2024-05-08 06:23:45'),
(15, 153, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-f', '2024-05-08 06:23:45'),
(16, 154, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-e', '2024-05-08 06:23:45'),
(17, 155, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-9', '2024-05-08 06:23:45'),
(18, 156, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-8', '2024-05-08 06:23:45'),
(19, 157, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-3', '2024-05-08 06:23:45'),
(20, 158, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-4', '2024-05-08 06:23:45'),
(21, 159, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-9', '2024-05-08 06:23:45'),
(22, 163, '5000', '2024-05-08 11:23:46', 'lunas', 'TRX-20240508132346-7', '2024-05-08 06:23:45'),
(23, 164, '5000', '2024-05-08 11:23:47', 'lunas', 'TRX-20240508132347-7', '2024-05-08 06:23:45'),
(24, 1, '5000', '2024-05-08 11:28:25', 'lunas', 'TRX-20240508132825-5', '2024-05-08 06:28:25'),
(25, 140, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-7', '2024-05-08 06:28:25'),
(26, 141, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-1', '2024-05-08 06:28:25'),
(27, 142, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-b', '2024-05-08 06:28:25'),
(28, 143, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-3', '2024-05-08 06:28:25'),
(29, 144, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-c', '2024-05-08 06:28:25'),
(30, 145, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-5', '2024-05-08 06:28:25'),
(31, 146, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-d', '2024-05-08 06:28:25'),
(32, 147, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-b', '2024-05-08 06:28:25'),
(33, 148, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-4', '2024-05-08 06:28:25'),
(34, 149, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-2', '2024-05-08 06:28:25'),
(35, 150, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-5', '2024-05-08 06:28:25'),
(36, 151, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-c', '2024-05-08 06:28:25'),
(37, 152, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-d', '2024-05-08 06:28:25'),
(38, 153, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-8', '2024-05-08 06:28:25'),
(39, 154, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-5', '2024-05-08 06:28:25'),
(40, 155, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-3', '2024-05-08 06:28:25'),
(41, 156, '5000', '2024-05-08 11:28:26', 'lunas', 'TRX-20240508132826-e', '2024-05-08 06:28:25'),
(42, 157, '5000', '2024-05-08 11:28:27', 'lunas', 'TRX-20240508132827-c', '2024-05-08 06:28:25'),
(43, 158, '5000', '2024-05-08 11:28:27', 'lunas', 'TRX-20240508132827-d', '2024-05-08 06:28:25'),
(44, 159, '5000', '2024-05-08 11:28:27', 'lunas', 'TRX-20240508132827-e', '2024-05-08 06:28:25'),
(45, 163, '5000', '2024-05-08 11:28:27', 'lunas', 'TRX-20240508132827-a', '2024-05-08 06:28:25'),
(46, 164, '5000', '2024-05-08 11:28:27', 'lunas', 'TRX-20240508132827-9', '2024-05-08 06:28:25'),
(47, 1, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-a', '2024-05-08 06:35:34'),
(48, 140, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-5', '2024-05-08 06:35:34'),
(49, 141, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-0', '2024-05-08 06:35:34'),
(50, 142, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-1', '2024-05-08 06:35:34'),
(51, 143, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-9', '2024-05-08 06:35:34'),
(52, 144, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-3', '2024-05-08 06:35:34'),
(53, 145, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-a', '2024-05-08 06:35:34'),
(54, 146, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-0', '2024-05-08 06:35:34'),
(55, 147, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-b', '2024-05-08 06:35:34'),
(56, 148, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-b', '2024-05-08 06:35:34'),
(57, 149, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-1', '2024-05-08 06:35:34'),
(58, 150, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-0', '2024-05-08 06:35:34'),
(59, 151, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-3', '2024-05-08 06:35:34'),
(60, 152, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-f', '2024-05-08 06:35:34'),
(61, 153, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-b', '2024-05-08 06:35:34'),
(62, 154, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-c', '2024-05-08 06:35:34'),
(63, 155, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-7', '2024-05-08 06:35:34'),
(64, 156, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-d', '2024-05-08 06:35:34'),
(65, 157, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-9', '2024-05-08 06:35:34'),
(66, 158, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-f', '2024-05-08 06:35:34'),
(67, 159, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133534-1', '2024-05-08 06:35:34'),
(68, 163, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133535-d', '2024-05-08 06:35:34'),
(69, 164, '5000', '2024-05-19 17:00:00', 'lunas', 'TRX-20240508133535-b', '2024-05-08 06:35:34'),
(70, 1, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145426-a', '2024-05-08 07:54:26'),
(71, 140, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145426-7', '2024-05-08 07:54:26'),
(72, 141, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-1', '2024-05-08 07:54:26'),
(73, 142, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-6', '2024-05-08 07:54:26'),
(74, 143, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-0', '2024-05-08 07:54:26'),
(75, 144, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-7', '2024-05-08 07:54:26'),
(76, 145, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-9', '2024-05-08 07:54:26'),
(77, 146, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-2', '2024-05-08 07:54:26'),
(78, 147, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-0', '2024-05-08 07:54:26'),
(79, 148, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-5', '2024-05-08 07:54:26'),
(80, 149, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-4', '2024-05-08 07:54:26'),
(81, 150, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-f', '2024-05-08 07:54:26'),
(82, 151, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-e', '2024-05-08 07:54:26'),
(83, 152, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-2', '2024-05-08 07:54:26'),
(84, 153, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-d', '2024-05-08 07:54:26'),
(85, 154, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-a', '2024-05-08 07:54:26'),
(86, 155, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-7', '2024-05-08 07:54:26'),
(87, 156, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-e', '2024-05-08 07:54:26'),
(88, 157, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-1', '2024-05-08 07:54:26'),
(89, 158, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-8', '2024-05-08 07:54:26'),
(90, 159, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-7', '2024-05-08 07:54:26'),
(91, 163, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-3', '2024-05-08 07:54:26'),
(92, 164, '5000', '2024-06-19 17:00:00', 'lunas', 'TRX-20240508145427-4', '2024-05-08 07:54:26'),
(93, 1, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-e', '2024-05-08 08:07:45'),
(94, 140, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-0', '2024-05-08 08:07:45'),
(95, 141, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-4', '2024-05-08 08:07:45'),
(96, 142, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-a', '2024-05-08 08:07:45'),
(97, 143, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-7', '2024-05-08 08:07:45'),
(98, 144, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-6', '2024-05-08 08:07:45'),
(99, 145, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-4', '2024-05-08 08:07:45'),
(100, 146, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-e', '2024-05-08 08:07:45'),
(101, 147, '1000', '2024-05-08 13:07:45', '', 'TRX-20240508150745-e', '2024-05-08 08:07:45'),
(102, 148, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-d', '2024-05-08 08:07:45'),
(103, 149, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-a', '2024-05-08 08:07:45'),
(104, 150, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-1', '2024-05-08 08:07:45'),
(105, 151, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-6', '2024-05-08 08:07:45'),
(106, 152, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-e', '2024-05-08 08:07:45'),
(107, 153, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-5', '2024-05-08 08:07:45'),
(108, 154, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-0', '2024-05-08 08:07:45'),
(109, 155, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-5', '2024-05-08 08:07:45'),
(110, 156, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-0', '2024-05-08 08:07:45'),
(111, 157, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-2', '2024-05-08 08:07:45'),
(112, 158, '1000', '2024-05-08 13:07:46', '', 'TRX-20240508150746-8', '2024-05-08 08:07:45'),
(113, 159, '1000', '2024-05-08 13:07:47', '', 'TRX-20240508150747-3', '2024-05-08 08:07:45'),
(114, 163, '1000', '2024-05-08 13:07:47', 'lunas', 'TRX-20240508150747-8', '2024-05-08 08:07:45'),
(115, 164, '1000', '2024-05-08 13:07:47', '', 'TRX-20240508150747-f', '2024-05-08 08:07:45'),
(116, 1, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-c', '2024-05-08 08:38:42'),
(117, 140, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-f', '2024-05-08 08:38:42'),
(118, 141, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-0', '2024-05-08 08:38:42'),
(119, 142, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-8', '2024-05-08 08:38:42'),
(120, 143, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-a', '2024-05-08 08:38:42'),
(121, 144, '9', '2024-05-08 13:38:42', '', 'TRX-20240508153842-c', '2024-05-08 08:38:42'),
(122, 145, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-b', '2024-05-08 08:38:42'),
(123, 146, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-7', '2024-05-08 08:38:42'),
(124, 147, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-3', '2024-05-08 08:38:42'),
(125, 148, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-b', '2024-05-08 08:38:42'),
(126, 149, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-b', '2024-05-08 08:38:42'),
(127, 150, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-4', '2024-05-08 08:38:42'),
(128, 151, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-2', '2024-05-08 08:38:42'),
(129, 152, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-4', '2024-05-08 08:38:42'),
(130, 153, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-6', '2024-05-08 08:38:42'),
(131, 154, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-b', '2024-05-08 08:38:42'),
(132, 155, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-d', '2024-05-08 08:38:42'),
(133, 156, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-7', '2024-05-08 08:38:42'),
(134, 157, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-b', '2024-05-08 08:38:42'),
(135, 158, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-7', '2024-05-08 08:38:42'),
(136, 159, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-3', '2024-05-08 08:38:42'),
(137, 163, '9', '2024-05-08 13:38:43', 'belum dibayar', 'TRX-20240508153843-6', '2024-05-08 08:38:42'),
(138, 164, '9', '2024-05-08 13:38:43', '', 'TRX-20240508153843-1', '2024-05-08 08:38:42'),
(139, 1, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-6', '2024-05-08 08:40:37'),
(140, 140, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-0', '2024-05-08 08:40:37'),
(141, 141, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-3', '2024-05-08 08:40:37'),
(142, 142, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-b', '2024-05-08 08:40:37'),
(143, 143, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-e', '2024-05-08 08:40:37'),
(144, 144, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154037-1', '2024-05-08 08:40:37'),
(145, 145, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-8', '2024-05-08 08:40:37'),
(146, 146, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-1', '2024-05-08 08:40:37'),
(147, 147, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-8', '2024-05-08 08:40:37'),
(148, 148, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-d', '2024-05-08 08:40:37'),
(149, 149, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-0', '2024-05-08 08:40:37'),
(150, 150, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-b', '2024-05-08 08:40:37'),
(151, 151, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-f', '2024-05-08 08:40:37'),
(152, 152, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-9', '2024-05-08 08:40:37'),
(153, 153, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-5', '2024-05-08 08:40:37'),
(154, 154, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-a', '2024-05-08 08:40:37'),
(155, 155, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-6', '2024-05-08 08:40:37'),
(156, 156, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-f', '2024-05-08 08:40:37'),
(157, 157, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-3', '2024-05-08 08:40:37'),
(158, 158, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-a', '2024-05-08 08:40:37'),
(159, 159, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-6', '2024-05-08 08:40:37'),
(160, 163, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-c', '2024-05-08 08:40:37'),
(161, 164, '2', '2024-06-29 17:00:00', 'lunas', 'TRX-20240508154038-f', '2024-05-08 08:40:37'),
(162, 1, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-a', '2024-05-08 08:42:54'),
(163, 140, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-8', '2024-05-08 08:42:54'),
(164, 141, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-8', '2024-05-08 08:42:54'),
(165, 142, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-f', '2024-05-08 08:42:54'),
(166, 143, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-b', '2024-05-08 08:42:54'),
(167, 144, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-8', '2024-05-08 08:42:54'),
(168, 145, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-2', '2024-05-08 08:42:54'),
(169, 146, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-5', '2024-05-08 08:42:54'),
(170, 147, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-7', '2024-05-08 08:42:54'),
(171, 148, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-c', '2024-05-08 08:42:54'),
(172, 149, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-a', '2024-05-08 08:42:54'),
(173, 150, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-1', '2024-05-08 08:42:54'),
(174, 151, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-5', '2024-05-08 08:42:54'),
(175, 152, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-7', '2024-05-08 08:42:54'),
(176, 153, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-d', '2024-05-08 08:42:54'),
(177, 154, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-a', '2024-05-08 08:42:54'),
(178, 155, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-2', '2024-05-08 08:42:54'),
(179, 156, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-d', '2024-05-08 08:42:54'),
(180, 157, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-9', '2024-05-08 08:42:54'),
(181, 158, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-f', '2024-05-08 08:42:54'),
(182, 159, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154254-8', '2024-05-08 08:42:54'),
(183, 163, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154255-8', '2024-05-08 08:42:54'),
(184, 164, '2', '2024-07-09 17:00:00', 'lunas', 'TRX-20240508154255-2', '2024-05-08 08:42:54'),
(185, 1, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-f', '2024-05-08 08:43:32'),
(186, 140, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-4', '2024-05-08 08:43:32'),
(187, 141, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-6', '2024-05-08 08:43:32'),
(188, 142, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-c', '2024-05-08 08:43:32'),
(189, 143, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-f', '2024-05-08 08:43:32'),
(190, 144, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154332-f', '2024-05-08 08:43:32'),
(191, 145, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-5', '2024-05-08 08:43:32'),
(192, 146, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-d', '2024-05-08 08:43:32'),
(193, 147, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-b', '2024-05-08 08:43:32'),
(194, 148, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-9', '2024-05-08 08:43:32'),
(195, 149, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-5', '2024-05-08 08:43:32'),
(196, 150, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-3', '2024-05-08 08:43:32'),
(197, 151, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-b', '2024-05-08 08:43:32'),
(198, 152, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-d', '2024-05-08 08:43:32'),
(199, 153, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-f', '2024-05-08 08:43:32'),
(200, 154, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-d', '2024-05-08 08:43:32'),
(201, 155, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-f', '2024-05-08 08:43:32'),
(202, 156, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-3', '2024-05-08 08:43:32'),
(203, 157, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-1', '2024-05-08 08:43:32'),
(204, 158, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-d', '2024-05-08 08:43:32'),
(205, 159, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-7', '2024-05-08 08:43:32'),
(206, 163, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-d', '2024-05-08 08:43:32'),
(207, 164, '1', '2024-07-19 17:00:00', 'lunas', 'TRX-20240508154333-4', '2024-05-08 08:43:32'),
(208, 1, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-6', '2024-05-08 09:00:04'),
(209, 140, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-2', '2024-05-08 09:00:04'),
(210, 141, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-3', '2024-05-08 09:00:04'),
(211, 142, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-4', '2024-05-08 09:00:04'),
(212, 143, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-6', '2024-05-08 09:00:04'),
(213, 144, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-1', '2024-05-08 09:00:04'),
(214, 145, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-6', '2024-05-08 09:00:04'),
(215, 146, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-a', '2024-05-08 09:00:04'),
(216, 147, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-8', '2024-05-08 09:00:04'),
(217, 148, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-c', '2024-05-08 09:00:04'),
(218, 149, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-5', '2024-05-08 09:00:04'),
(219, 150, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-7', '2024-05-08 09:00:04'),
(220, 151, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-1', '2024-05-08 09:00:04'),
(221, 152, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-9', '2024-05-08 09:00:04'),
(222, 153, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-e', '2024-05-08 09:00:04'),
(223, 154, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-7', '2024-05-08 09:00:04'),
(224, 155, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-8', '2024-05-08 09:00:04'),
(225, 156, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-e', '2024-05-08 09:00:04'),
(226, 157, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-a', '2024-05-08 09:00:04'),
(227, 158, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-6', '2024-05-08 09:00:04'),
(228, 159, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-5', '2024-05-08 09:00:04'),
(229, 163, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-2', '2024-05-08 09:00:04'),
(230, 164, '2', '2024-05-08 14:00:04', 'belum dibayar', 'TRX-20240508160004-d', '2024-05-08 09:00:04'),
(231, 1, '2000', '2024-05-08 14:04:39', 'belum dibayar', 'TRX-20240508160439-6', '2024-05-08 09:04:39'),
(232, 140, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-5', '2024-05-08 09:04:39'),
(233, 141, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-6', '2024-05-08 09:04:39'),
(234, 142, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-8', '2024-05-08 09:04:39'),
(235, 143, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-e', '2024-05-08 09:04:39'),
(236, 144, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-f', '2024-05-08 09:04:39'),
(237, 145, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-0', '2024-05-08 09:04:39'),
(238, 146, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-8', '2024-05-08 09:04:39'),
(239, 147, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-d', '2024-05-08 09:04:39'),
(240, 148, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-c', '2024-05-08 09:04:39'),
(241, 149, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-6', '2024-05-08 09:04:39'),
(242, 150, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-3', '2024-05-08 09:04:39'),
(243, 151, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-c', '2024-05-08 09:04:39'),
(244, 152, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-9', '2024-05-08 09:04:39'),
(245, 153, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-1', '2024-05-08 09:04:39'),
(246, 154, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-b', '2024-05-08 09:04:39'),
(247, 155, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-9', '2024-05-08 09:04:39'),
(248, 156, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-d', '2024-05-08 09:04:39'),
(249, 157, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-f', '2024-05-08 09:04:39'),
(250, 158, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-e', '2024-05-08 09:04:39'),
(251, 159, '2000', '2024-05-08 14:04:40', 'belum dibayar', 'TRX-20240508160440-1', '2024-05-08 09:04:39'),
(252, 163, '2000', '2024-05-08 14:04:41', 'belum dibayar', 'TRX-20240508160441-1', '2024-05-08 09:04:39'),
(253, 164, '2000', '2024-05-08 14:04:41', 'belum dibayar', 'TRX-20240508160441-6', '2024-05-08 09:04:39'),
(254, 1, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-e', '2024-05-08 09:06:47'),
(255, 140, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-c', '2024-05-08 09:06:47'),
(256, 141, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-6', '2024-05-08 09:06:47'),
(257, 142, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-0', '2024-05-08 09:06:47'),
(258, 143, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-7', '2024-05-08 09:06:47'),
(259, 144, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-7', '2024-05-08 09:06:47'),
(260, 145, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-4', '2024-05-08 09:06:47'),
(261, 146, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-2', '2024-05-08 09:06:47'),
(262, 147, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-c', '2024-05-08 09:06:47'),
(263, 148, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-6', '2024-05-08 09:06:47'),
(264, 149, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-1', '2024-05-08 09:06:47'),
(265, 150, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-7', '2024-05-08 09:06:47'),
(266, 151, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-b', '2024-05-08 09:06:47'),
(267, 152, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-7', '2024-05-08 09:06:47'),
(268, 153, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-d', '2024-05-08 09:06:47'),
(269, 154, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-e', '2024-05-08 09:06:47'),
(270, 155, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-1', '2024-05-08 09:06:47'),
(271, 156, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-5', '2024-05-08 09:06:47'),
(272, 157, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-f', '2024-05-08 09:06:47'),
(273, 158, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-8', '2024-05-08 09:06:47'),
(274, 159, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-a', '2024-05-08 09:06:47'),
(275, 163, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-3', '2024-05-08 09:06:47'),
(276, 164, '89', '2024-05-08 14:06:47', 'belum dibayar', 'TRX-20240508160647-f', '2024-05-08 09:06:47'),
(277, 163, '12', '2024-05-09 04:25:13', 'belum dibayar', 'TRX-20240509062446-a', '2024-05-08 23:25:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `total_lunas` decimal(10,2) DEFAULT 0.00,
  `total_belum_bayar` decimal(10,2) DEFAULT 0.00,
  `nik` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jabatan` enum('direktur','pegawai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `username`, `password`, `role`, `total_lunas`, `total_belum_bayar`, `nik`, `nama_lengkap`, `no_hp`, `alamat`, `created_at`, `jabatan`) VALUES
(1, 'admin', '', 'admin', '0.00', '0.00', '', 'Admin', '', '', '2024-05-08 06:48:03', NULL),
(140, 'john_doe', '', 'user', '0.00', '0.00', '1234567890', 'John Doe', '081234567890', 'Jl. Contoh No. 1', '2024-05-08 06:37:52', NULL),
(141, 'jane_doe', '', 'user', '0.00', '0.00', '0987654321', 'Jane Doe', '081234567891', 'Jl. Contoh No. 2', '2024-05-08 06:37:52', NULL),
(142, 'alice_smith', '', 'user', '0.00', '0.00', '2345678901', 'Alice Smith', '081234567892', 'Jl. Contoh No. 3', '2024-05-08 06:37:52', 'pegawai'),
(143, 'bob_johnson', '', 'user', '0.00', '0.00', '3456789012', 'Bob Johnson', '081234567893', 'Jl. Contoh No. 4', '2024-05-08 06:37:52', NULL),
(144, 'emily_brown', '', 'user', '0.00', '0.00', '4567890123', 'Emily Brown', '081234567894', 'Jl. Contoh No. 5', '2024-05-08 06:37:52', NULL),
(145, 'michael_wilson', '', 'user', '0.00', '0.00', '5678901234', 'Michael Wilson', '081234567895', 'Jl. Contoh No. 6', '2024-05-08 06:37:52', NULL),
(146, 'sarah_garcia', '', 'admin', '0.00', '0.00', '6789012345', 'Sarah Garcia', '081234567896', 'Jl. Contoh No. 7', '2024-05-08 06:37:52', NULL),
(147, 'david_martinez', '', 'user', '0.00', '0.00', '7890123456', 'David Martinez', '081234567897', 'Jl. Contoh No. 8', '2024-05-08 06:37:52', NULL),
(148, 'lisa_robinson', '', 'user', '0.00', '0.00', '8901234567', 'Lisa Robinson', '081234567898', 'Jl. Contoh No. 9', '2024-05-08 06:37:52', NULL),
(149, 'paul_clark', '', 'user', '0.00', '0.00', '9012345678', 'Paul Clark', '081234567899', 'Jl. Contoh No. 10', '2024-05-08 06:37:52', NULL),
(150, 'jessica_lewis', '', 'user', '0.00', '0.00', '0123456789', 'Jessica Lewis', '081234567800', 'Jl. Contoh No. 11', '2024-05-08 06:37:52', NULL),
(151, 'kevin_lee', '', 'user', '0.00', '0.00', '5432109876', 'Kevin Lee', '081234567801', 'Jl. Contoh No. 12', '2024-05-08 06:37:52', NULL),
(152, 'amanda_walker', '', 'user', '0.00', '0.00', '6543210987', 'Amanda Walker', '081234567802', 'Jl. Contoh No. 13', '2024-05-08 06:37:52', NULL),
(153, 'daniel_hall', '', 'user', '0.00', '0.00', '7654321098', 'Daniel Hall', '081234567803', 'Jl. Contoh No. 14', '2024-05-08 06:37:52', NULL),
(154, 'ashley_young', '', 'user', '0.00', '0.00', '8765432109', 'Ashley Young', '081234567804', 'Jl. Contoh No. 15', '2024-05-08 06:37:52', NULL),
(155, 'matthew_hernandez', '', 'user', '0.00', '0.00', '9876543210', 'Matthew Hernandez', '081234567805', 'Jl. Contoh No. 16', '2024-05-08 06:37:52', NULL),
(156, 'jennifer_king', '', 'user', '0.00', '0.00', '3210987654', 'Jennifer King', '081234567806', 'Jl. Contoh No. 17', '2024-05-08 06:37:52', NULL),
(157, 'joshua_wright', '', 'user', '0.00', '0.00', '4321098765', 'Joshua Wright', '081234567807', 'Jl. Contoh No. 18', '2024-05-08 06:37:52', NULL),
(158, 'nicole_lopez', '', 'user', '0.00', '0.00', '2109876543', 'Nicole Lopez', '081234567808', 'Jl. Contoh No. 19', '2024-05-08 06:37:52', NULL),
(159, 'hill', '', 'user', '0.00', '0.00', '1098765432', 'Andrew Hill', '081234567809', 'Jl. Contoh No. 20', '2024-05-08 06:37:52', NULL),
(163, 'kia', '', 'user', '0.00', '0.00', '', 'nama kia', '', '', '2024-05-08 07:08:08', 'direktur'),
(164, 'citra', '', 'user', '0.00', '0.00', '', 'Citra', '', '', '2024-05-08 07:17:08', 'pegawai'),
(165, 'saya', '', 'user', '0.00', '0.00', '', 'saya', '', '', '2024-05-09 10:55:37', 'pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warga`
--

CREATE TABLE `tb_warga` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warga`
--

INSERT INTO `tb_warga` (`id`, `nik`, `nama_lengkap`, `no_hp`, `alamat`, `created_at`) VALUES
(6, '1234567890', 'John David', '081234567890', 'Jl. Contoh No. 123', '2024-05-07 18:02:31'),
(7, '2345678901', 'Jane Smith', '082345678901', 'Jl. Contoh No. 234', '2024-05-07 18:02:31'),
(8, '3456789012', 'David Johnson', '083456789012', 'Jl. Contoh No. 345', '2024-05-07 18:02:31'),
(9, '4567890123', 'Mary Williams', '084567890123', 'Jl. Contoh No. 456', '2024-05-07 18:02:31'),
(10, '5678901234', 'Michael Brown', '085678901234', 'Jl. Contoh No. 567', '2024-05-07 18:02:31'),
(11, '6789012345', 'Jennifer Miller', '086789012345', 'Jl. Contoh No. 678', '2024-05-07 18:02:31'),
(12, '7890123456', 'James Taylor', '087890123456', 'Jl. Contoh No. 789', '2024-05-07 18:02:31'),
(13, '8901234567', 'Linda Wilson', '088901234567', 'Jl. Contoh No. 890', '2024-05-07 18:02:31'),
(14, '9012345678', 'William Moore', '089012345678', 'Jl. Contoh No. 901', '2024-05-07 18:02:31'),
(15, '0123456789', 'Patricia Jackson', '090123456789', 'Jl. Contoh No. 012', '2024-05-07 18:02:31'),
(16, '1234509876', 'Richard White', '091234567890', 'Jl. Contoh No. 123', '2024-05-07 18:02:31'),
(17, '2345609876', 'Jessica Harris', '092345678901', 'Jl. Contoh No. 234', '2024-05-07 18:02:31'),
(18, '3456709876', 'Thomas Martin', '093456789012', 'Jl. Contoh No. 345', '2024-05-07 18:02:31'),
(19, '4567809876', 'Elizabeth Thompson', '094567890123', 'Jl. Contoh No. 456', '2024-05-07 18:02:31'),
(20, '5678901234', 'Charles Garcia', '095678901234', 'Jl. Contoh No. 567', '2024-05-07 18:02:31'),
(21, '6789012345', 'Karen Martinez', '096789012345', 'Jl. Contoh No. 678', '2024-05-07 18:02:31'),
(22, '7890123456', 'Matthew Robinson', '097890123456', 'Jl. Contoh No. 789', '2024-05-07 18:02:31'),
(23, '8901234567', 'Amanda Clark', '098901234567', 'Jl. Contoh No. 890', '2024-05-07 18:02:31'),
(24, '9012345678', 'Laura Rodriguez', '099012345678', 'Jl. Contoh No. 901', '2024-05-07 18:02:31'),
(25, '0123456789', 'Ryan Lewis', '010123456789', 'Jl. Contoh No. 012', '2024-05-07 18:02:31'),
(26, '1234567890', 'Kimberly Lee', '011234567890', 'Jl. Contoh No. 123', '2024-05-07 18:02:31'),
(27, '2345678901', 'Jason Walker', '012345678901', 'Jl. Contoh No. 234', '2024-05-07 18:02:31'),
(28, '3456789012', 'Deborah Perez', '013456789012', 'Jl. Contoh No. 345', '2024-05-07 18:02:31'),
(29, '4567890123', 'Mark Hill', '014567890123', 'Jl. Contoh No. 456', '2024-05-07 18:02:31'),
(30, '5678901234', 'Michelle Young', '015678901234', 'Jl. Contoh No. 567', '2024-05-07 18:02:31'),
(31, '6789012345', 'Steven Allen', '016789012345', 'Jl. Contoh No. 678', '2024-05-07 18:02:31'),
(32, '7890123456', 'Emily King', '017890123456', 'Jl. Contoh No. 789', '2024-05-07 18:02:31'),
(33, '8901234567', 'Brian Scott', '018901234567', 'Jl. Contoh No. 890', '2024-05-07 18:02:31'),
(34, '9012345678', 'Jessica Perez', '019012345678', 'Jl. Contoh No. 901', '2024-05-07 18:02:31'),
(35, '0123456789', 'Nicole Nguyen', '020123456789', 'Jl. Contoh No. 012', '2024-05-07 18:02:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
