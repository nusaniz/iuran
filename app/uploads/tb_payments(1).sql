-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2024 pada 13.22
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
-- Database: `db_iurancoba10`
--

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
(1, 1, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-8', '2024-05-08 01:24:14'),
(2, 94, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-2', '2024-05-08 01:24:14'),
(3, 99, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-c', '2024-05-08 01:24:14'),
(4, 100, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-9', '2024-05-08 01:24:14'),
(5, 101, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-f', '2024-05-08 01:24:14'),
(6, 102, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-1', '2024-05-08 01:24:14'),
(7, 103, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-b', '2024-05-08 01:24:14'),
(8, 104, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-a', '2024-05-08 01:24:14'),
(9, 105, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-2', '2024-05-08 01:24:14'),
(10, 106, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-b', '2024-05-08 01:24:14'),
(11, 107, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-2', '2024-05-08 01:24:14'),
(12, 108, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-d', '2024-05-08 01:24:14'),
(13, 109, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-7', '2024-05-08 01:24:14'),
(14, 110, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-e', '2024-05-08 01:24:14'),
(15, 111, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-7', '2024-05-08 01:24:14'),
(16, 112, '1', '2024-05-08 06:24:14', 'belum dibayar', 'TRX-20240508082414-9', '2024-05-08 01:24:14'),
(17, 113, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-e', '2024-05-08 01:24:14'),
(18, 114, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-b', '2024-05-08 01:24:14'),
(19, 115, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-e', '2024-05-08 01:24:14'),
(20, 116, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-4', '2024-05-08 01:24:14'),
(21, 117, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-3', '2024-05-08 01:24:14'),
(22, 118, '1', '2024-05-08 06:24:15', 'belum dibayar', 'TRX-20240508082415-0', '2024-05-08 01:24:14'),
(23, 1, '2', '2024-05-08 06:24:17', 'belum dibayar', 'TRX-20240508082417-0', '2024-05-08 01:24:17'),
(24, 94, '2', '2024-05-08 06:24:17', 'belum dibayar', 'TRX-20240508082417-e', '2024-05-08 01:24:17'),
(25, 99, '2', '2024-05-08 06:24:17', 'belum dibayar', 'TRX-20240508082417-9', '2024-05-08 01:24:17'),
(26, 100, '2', '2024-05-08 06:24:17', 'belum dibayar', 'TRX-20240508082417-2', '2024-05-08 01:24:17'),
(27, 101, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-a', '2024-05-08 01:24:17'),
(28, 102, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-0', '2024-05-08 01:24:17'),
(29, 103, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-6', '2024-05-08 01:24:17'),
(30, 104, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-e', '2024-05-08 01:24:17'),
(31, 105, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-a', '2024-05-08 01:24:17'),
(32, 106, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-c', '2024-05-08 01:24:17'),
(33, 107, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-1', '2024-05-08 01:24:17'),
(34, 108, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-5', '2024-05-08 01:24:17'),
(35, 109, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-9', '2024-05-08 01:24:17'),
(36, 110, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-3', '2024-05-08 01:24:17'),
(37, 111, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-c', '2024-05-08 01:24:17'),
(38, 112, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-f', '2024-05-08 01:24:17'),
(39, 113, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-a', '2024-05-08 01:24:17'),
(40, 114, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-3', '2024-05-08 01:24:17'),
(41, 115, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-6', '2024-05-08 01:24:17'),
(42, 116, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-4', '2024-05-08 01:24:17'),
(43, 117, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-4', '2024-05-08 01:24:17'),
(44, 118, '2', '2024-05-08 06:24:18', 'belum dibayar', 'TRX-20240508082418-b', '2024-05-08 01:24:17'),
(45, 1, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-7', '2024-05-08 01:24:22'),
(46, 94, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-3', '2024-05-08 01:24:22'),
(47, 99, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-5', '2024-05-08 01:24:22'),
(48, 100, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-6', '2024-05-08 01:24:22'),
(49, 101, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-4', '2024-05-08 01:24:22'),
(50, 102, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-9', '2024-05-08 01:24:22'),
(51, 103, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-f', '2024-05-08 01:24:22'),
(52, 104, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-d', '2024-05-08 01:24:22'),
(53, 105, '3', '2024-05-08 06:24:22', 'belum dibayar', 'TRX-20240508082422-5', '2024-05-08 01:24:22'),
(54, 106, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-c', '2024-05-08 01:24:22'),
(55, 107, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-7', '2024-05-08 01:24:22'),
(56, 108, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-a', '2024-05-08 01:24:22'),
(57, 109, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-f', '2024-05-08 01:24:22'),
(58, 110, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-7', '2024-05-08 01:24:22'),
(59, 111, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-f', '2024-05-08 01:24:22'),
(60, 112, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-9', '2024-05-08 01:24:22'),
(61, 113, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-a', '2024-05-08 01:24:22'),
(62, 114, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-e', '2024-05-08 01:24:22'),
(63, 115, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-0', '2024-05-08 01:24:22'),
(64, 116, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-0', '2024-05-08 01:24:22'),
(65, 117, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-f', '2024-05-08 01:24:22'),
(66, 118, '3', '2024-05-08 06:24:23', 'belum dibayar', 'TRX-20240508082423-4', '2024-05-08 01:24:22'),
(67, 1, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-4', '2024-05-08 01:24:26'),
(68, 94, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-1', '2024-05-08 01:24:26'),
(69, 99, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-5', '2024-05-08 01:24:26'),
(70, 100, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-f', '2024-05-08 01:24:26'),
(71, 101, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-5', '2024-05-08 01:24:26'),
(72, 102, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-7', '2024-05-08 01:24:26'),
(73, 103, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-8', '2024-05-08 01:24:26'),
(74, 104, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-7', '2024-05-08 01:24:26'),
(75, 105, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-a', '2024-05-08 01:24:26'),
(76, 106, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-5', '2024-05-08 01:24:26'),
(77, 107, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-b', '2024-05-08 01:24:26'),
(78, 108, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-b', '2024-05-08 01:24:26'),
(79, 109, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-5', '2024-05-08 01:24:26'),
(80, 110, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-2', '2024-05-08 01:24:26'),
(81, 111, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-e', '2024-05-08 01:24:26'),
(82, 112, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-2', '2024-05-08 01:24:26'),
(83, 113, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-d', '2024-05-08 01:24:26'),
(84, 114, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-f', '2024-05-08 01:24:26'),
(85, 115, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-6', '2024-05-08 01:24:26'),
(86, 116, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-d', '2024-05-08 01:24:26'),
(87, 117, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-3', '2024-05-08 01:24:26'),
(88, 118, '4', '2024-05-08 06:24:26', 'belum dibayar', 'TRX-20240508082426-2', '2024-05-08 01:24:26'),
(89, 1, '5', '2024-05-08 06:24:28', 'belum dibayar', 'TRX-20240508082426-b', '2024-05-08 01:24:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  ADD CONSTRAINT `tb_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;