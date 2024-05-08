-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2024 pada 09.24
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
(1, 1, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-d', '2024-05-08 01:53:26'),
(2, 140, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-5', '2024-05-08 01:53:26'),
(3, 141, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-7', '2024-05-08 01:53:26'),
(4, 142, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-4', '2024-05-08 01:53:26'),
(5, 143, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-6', '2024-05-08 01:53:26'),
(6, 144, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-9', '2024-05-08 01:53:26'),
(7, 145, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-e', '2024-05-08 01:53:26'),
(8, 146, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-4', '2024-05-08 01:53:26'),
(9, 147, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-f', '2024-05-08 01:53:26'),
(10, 148, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-6', '2024-05-08 01:53:26'),
(11, 149, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-9', '2024-05-08 01:53:26'),
(12, 150, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-0', '2024-05-08 01:53:26'),
(13, 151, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-b', '2024-05-08 01:53:26'),
(14, 152, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-2', '2024-05-08 01:53:26'),
(15, 153, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-0', '2024-05-08 01:53:26'),
(16, 154, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-0', '2024-05-08 01:53:26'),
(17, 155, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-2', '2024-05-08 01:53:26'),
(18, 156, '1', '2024-05-08 06:53:26', 'belum dibayar', 'TRX-20240508085326-e', '2024-05-08 01:53:26'),
(19, 157, '1', '2024-05-08 06:53:27', 'belum dibayar', 'TRX-20240508085327-a', '2024-05-08 01:53:26'),
(20, 158, '1', '2024-05-08 06:53:27', 'belum dibayar', 'TRX-20240508085327-7', '2024-05-08 01:53:26'),
(21, 159, '1', '2024-05-08 06:53:27', 'belum dibayar', 'TRX-20240508085327-2', '2024-05-08 01:53:26');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `username`, `password`, `role`, `total_lunas`, `total_belum_bayar`, `nik`, `nama_lengkap`, `no_hp`, `alamat`, `created_at`) VALUES
(1, 'admin', '', 'admin', '0.00', '0.00', '', 'Admin', '', '', '2024-05-08 06:48:03'),
(140, 'john_doe', '', 'user', '0.00', '0.00', '1234567890', 'John Doe', '081234567890', 'Jl. Contoh No. 1', '2024-05-08 06:37:52'),
(141, 'jane_doe', '', 'user', '0.00', '0.00', '0987654321', 'Jane Doe', '081234567891', 'Jl. Contoh No. 2', '2024-05-08 06:37:52'),
(142, 'alice_smith', '', 'user', '0.00', '0.00', '2345678901', 'Alice Smith', '081234567892', 'Jl. Contoh No. 3', '2024-05-08 06:37:52'),
(143, 'bob_johnson', '', 'user', '0.00', '0.00', '3456789012', 'Bob Johnson', '081234567893', 'Jl. Contoh No. 4', '2024-05-08 06:37:52'),
(144, 'emily_brown', '', 'user', '0.00', '0.00', '4567890123', 'Emily Brown', '081234567894', 'Jl. Contoh No. 5', '2024-05-08 06:37:52'),
(145, 'michael_wilson', '', 'user', '0.00', '0.00', '5678901234', 'Michael Wilson', '081234567895', 'Jl. Contoh No. 6', '2024-05-08 06:37:52'),
(146, 'sarah_garcia', '', 'admin', '0.00', '0.00', '6789012345', 'Sarah Garcia', '081234567896', 'Jl. Contoh No. 7', '2024-05-08 06:37:52'),
(147, 'david_martinez', '', 'user', '0.00', '0.00', '7890123456', 'David Martinez', '081234567897', 'Jl. Contoh No. 8', '2024-05-08 06:37:52'),
(148, 'lisa_robinson', '', 'user', '0.00', '0.00', '8901234567', 'Lisa Robinson', '081234567898', 'Jl. Contoh No. 9', '2024-05-08 06:37:52'),
(149, 'paul_clark', '', 'user', '0.00', '0.00', '9012345678', 'Paul Clark', '081234567899', 'Jl. Contoh No. 10', '2024-05-08 06:37:52'),
(150, 'jessica_lewis', '', 'user', '0.00', '0.00', '0123456789', 'Jessica Lewis', '081234567800', 'Jl. Contoh No. 11', '2024-05-08 06:37:52'),
(151, 'kevin_lee', '', 'user', '0.00', '0.00', '5432109876', 'Kevin Lee', '081234567801', 'Jl. Contoh No. 12', '2024-05-08 06:37:52'),
(152, 'amanda_walker', '', 'user', '0.00', '0.00', '6543210987', 'Amanda Walker', '081234567802', 'Jl. Contoh No. 13', '2024-05-08 06:37:52'),
(153, 'daniel_hall', '', 'user', '0.00', '0.00', '7654321098', 'Daniel Hall', '081234567803', 'Jl. Contoh No. 14', '2024-05-08 06:37:52'),
(154, 'ashley_young', '', 'user', '0.00', '0.00', '8765432109', 'Ashley Young', '081234567804', 'Jl. Contoh No. 15', '2024-05-08 06:37:52'),
(155, 'matthew_hernandez', '', 'user', '0.00', '0.00', '9876543210', 'Matthew Hernandez', '081234567805', 'Jl. Contoh No. 16', '2024-05-08 06:37:52'),
(156, 'jennifer_king', '', 'user', '0.00', '0.00', '3210987654', 'Jennifer King', '081234567806', 'Jl. Contoh No. 17', '2024-05-08 06:37:52'),
(157, 'joshua_wright', '', 'user', '0.00', '0.00', '4321098765', 'Joshua Wright', '081234567807', 'Jl. Contoh No. 18', '2024-05-08 06:37:52'),
(158, 'nicole_lopez', '', 'user', '0.00', '0.00', '2109876543', 'Nicole Lopez', '081234567808', 'Jl. Contoh No. 19', '2024-05-08 06:37:52'),
(159, 'andrew_hill', '', 'user', '0.00', '0.00', '1098765432', 'Andrew Hill', '081234567809', 'Jl. Contoh No. 20', '2024-05-08 06:37:52'),
(163, 'kia', 'passkia', 'user', '0.00', '0.00', '', 'nama kia', '', '', '2024-05-08 07:08:08'),
(164, 'citra', '', 'user', '0.00', '0.00', '', 'Citra', '', '', '2024-05-08 07:17:08');

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
-- AUTO_INCREMENT untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
