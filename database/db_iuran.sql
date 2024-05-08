-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2024 pada 03.30
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
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum dibayar','lunas') NOT NULL DEFAULT 'belum dibayar',
  `kode_transaksi` varchar(20) NOT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `amount`, `payment_date`, `status`, `kode_transaksi`, `invoice_date`) VALUES
(2, 94, '5000', '2024-05-07 14:35:09', 'lunas', 'TRX-20240507163509-6', '2024-05-07 09:35:09'),
(4, 94, '5000', '2024-05-07 14:39:00', 'lunas', 'TRX-20240507163900-5', '2024-05-07 09:39:00'),
(6, 94, '5000', '2024-05-07 14:39:07', 'belum dibayar', 'TRX-20240507163907-3', '2024-05-07 09:39:07'),
(7, 1, '3', '2024-05-07 14:41:57', 'belum dibayar', 'TRX-20240507164157-a', '2024-05-07 09:41:57'),
(8, 94, '3', '2024-05-07 14:41:57', 'belum dibayar', 'TRX-20240507164157-2', '2024-05-07 09:41:57'),
(9, 1, '3', '2024-05-07 14:42:03', 'belum dibayar', 'TRX-20240507164203-b', '2024-05-07 09:42:03'),
(10, 94, '3', '2024-05-07 14:42:03', 'belum dibayar', 'TRX-20240507164203-9', '2024-05-07 09:42:03'),
(11, 1, '3', '2024-05-07 14:42:11', 'belum dibayar', 'TRX-20240507164211-b', '2024-05-07 09:42:11'),
(12, 94, '3', '2024-05-07 14:42:11', 'belum dibayar', 'TRX-20240507164211-7', '2024-05-07 09:42:11'),
(13, 1, '3', '2024-05-07 14:42:14', 'belum dibayar', 'TRX-20240507164214-4', '2024-05-07 09:42:14'),
(14, 94, '3', '2024-05-07 14:42:14', 'belum dibayar', 'TRX-20240507164214-9', '2024-05-07 09:42:14'),
(15, 1, '5', '2024-05-07 14:42:32', 'belum dibayar', 'TRX-20240507164232-0', '2024-05-07 09:42:32'),
(16, 94, '5', '2024-05-07 14:42:32', 'belum dibayar', 'TRX-20240507164232-e', '2024-05-07 09:42:32'),
(17, 1, '3', '2024-05-07 14:42:36', 'belum dibayar', 'TRX-20240507164236-3', '2024-05-07 09:42:36'),
(18, 94, '3', '2024-05-07 14:42:36', 'belum dibayar', 'TRX-20240507164236-5', '2024-05-07 09:42:36'),
(19, 1, '5', '2024-05-07 14:42:38', 'belum dibayar', 'TRX-20240507164238-7', '2024-05-07 09:42:38'),
(20, 94, '5', '2024-05-07 14:42:38', 'belum dibayar', 'TRX-20240507164238-a', '2024-05-07 09:42:38'),
(21, 1, '5', '2024-05-07 14:42:40', 'belum dibayar', 'TRX-20240507164240-7', '2024-05-07 09:42:40'),
(22, 94, '5', '2024-05-07 14:42:40', 'belum dibayar', 'TRX-20240507164240-d', '2024-05-07 09:42:40'),
(23, 1, '5', '2024-05-07 14:42:42', 'belum dibayar', 'TRX-20240507164242-7', '2024-05-07 09:42:42'),
(24, 94, '5', '2024-05-07 14:42:42', 'belum dibayar', 'TRX-20240507164242-8', '2024-05-07 09:42:42');

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
(35, '0123456789', 'Nicole Nguyen', '020123456789', 'Jl. Contoh No. 012', '2024-05-07 18:02:31'),
(38, '21', 'hanum', 'asd', 'asd', '2024-05-08 00:32:26'),
(39, '', 'permata', '', '', '2024-05-08 01:09:53'),
(40, '', 'elya', '', '', '2024-05-08 01:11:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `total_lunas` decimal(10,2) DEFAULT 0.00,
  `total_belum_bayar` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `total_lunas`, `total_belum_bayar`) VALUES
(1, 'admin', '', 'admin', '0.00', '0.00'),
(94, 'intan', '', 'user', '0.00', '0.00'),
(96, 'hanum', '', 'user', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
