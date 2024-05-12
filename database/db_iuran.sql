-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2024 pada 09.02
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
  `role_dokumen` set('direktur','pegawai','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `nama`, `file_path`, `status`, `role_dokumen`, `created_at`, `keterangan`) VALUES
(7, 'tes dokumen aja', 'uploads/test dokumen.txt', 'aktif', 'direktur,pegawai', '2024-05-09 11:25:14', 'halo tes keterangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id`, `nama`, `latitude`, `longitude`) VALUES
(1, 'bali', -8.340500, 115.092003),
(3, 'pt tjiwi', -7.437464, 112.479294),
(4, 'home', -7.441629, 112.495300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_payments`
--

CREATE TABLE `tb_payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `status` enum('belum dibayar','lunas') NOT NULL DEFAULT 'belum dibayar',
  `kode_transaksi` varchar(20) NOT NULL,
  `invoice_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_payments`
--

INSERT INTO `tb_payments` (`payment_id`, `user_id`, `amount`, `payment_date`, `status`, `kode_transaksi`, `invoice_date`) VALUES
(1, 163, '5000', '0000-00-00 00:00:00', 'belum dibayar', 'TRX11052451MJIGF3', '2024-05-11 15:45:27'),
(2, 163, '10000', '2024-05-12 01:47:56', 'lunas', 'TRX110524XATVCOKG', '2024-05-11 15:47:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','staf') NOT NULL DEFAULT 'user',
  `jabatan` enum('direktur','pegawai','') DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `total_lunas` decimal(10,2) DEFAULT 0.00,
  `total_belum_bayar` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `username`, `password`, `role`, `jabatan`, `nik`, `nama_lengkap`, `no_hp`, `alamat`, `total_lunas`, `total_belum_bayar`, `created_at`) VALUES
(1, 'admin', '', 'admin', NULL, '', 'Admin', '', '', '0.00', '0.00', '2024-05-08 06:48:03'),
(140, 'john_doe', '', 'admin', 'direktur', '1234567890', 'John Doe', '081234567890', 'Jl. Contoh No. 1', '0.00', '0.00', '2024-05-08 06:37:52'),
(141, 'jane_doe', '', 'user', NULL, '0987654321', 'Jane Doe', '081234567891', 'Jl. Contoh No. 2', '0.00', '0.00', '2024-05-08 06:37:52'),
(142, 'alice_smith', '', '', 'direktur', '2345678901', 'Alice Smith', '081234567892', 'Jl. Contoh No. 3', '0.00', '0.00', '2024-05-08 06:37:52'),
(143, 'bob_johnson', '', 'user', NULL, '3456789012', 'Bob Johnson', '081234567893', 'Jl. Contoh No. 4', '0.00', '0.00', '2024-05-08 06:37:52'),
(144, 'emily_brown', '', 'user', NULL, '4567890123', 'Emily Brown', '081234567894', 'Jl. Contoh No. 5', '0.00', '0.00', '2024-05-08 06:37:52'),
(145, 'michael_wilson', '', 'user', NULL, '5678901234', 'Michael Wilson', '081234567895', 'Jl. Contoh No. 6', '0.00', '0.00', '2024-05-08 06:37:52'),
(146, 'sarah_garcia', '', 'admin', NULL, '6789012345', 'Sarah Garcia', '081234567896', 'Jl. Contoh No. 7', '0.00', '0.00', '2024-05-08 06:37:52'),
(147, 'david_martinez', '', 'user', NULL, '7890123456', 'David Martinez', '081234567897', 'Jl. Contoh No. 8', '0.00', '0.00', '2024-05-08 06:37:52'),
(148, 'lisa_robinson', '', 'user', NULL, '8901234567', 'Lisa Robinson', '081234567898', 'Jl. Contoh No. 9', '0.00', '0.00', '2024-05-08 06:37:52'),
(149, 'paul_clark', '', 'user', NULL, '9012345678', 'Paul Clark', '081234567899', 'Jl. Contoh No. 10', '0.00', '0.00', '2024-05-08 06:37:52'),
(150, 'jessica_lewis', '', 'user', NULL, '0123456789', 'Jessica Lewis', '081234567800', 'Jl. Contoh No. 11', '0.00', '0.00', '2024-05-08 06:37:52'),
(151, 'kevin_lee', '', 'user', NULL, '5432109876', 'Kevin Lee', '081234567801', 'Jl. Contoh No. 12', '0.00', '0.00', '2024-05-08 06:37:52'),
(152, 'amanda_walker', '', 'user', NULL, '6543210987', 'Amanda Walker', '081234567802', 'Jl. Contoh No. 13', '0.00', '0.00', '2024-05-08 06:37:52'),
(153, 'daniel_hall', '', 'user', NULL, '7654321098', 'Daniel Hall', '081234567803', 'Jl. Contoh No. 14', '0.00', '0.00', '2024-05-08 06:37:52'),
(154, 'ashley_young', '', 'user', 'pegawai', '8765432109', 'Ashley Young', '081234567804', 'Jl. Contoh No. 15', '0.00', '0.00', '2024-05-08 06:37:52'),
(155, 'matthew_hernandez', '', 'user', NULL, '9876543210', 'Matthew Hernandez', '081234567805', 'Jl. Contoh No. 16', '0.00', '0.00', '2024-05-08 06:37:52'),
(156, 'jennifer_king', '', 'user', NULL, '3210987654', 'Jennifer King', '081234567806', 'Jl. Contoh No. 17', '0.00', '0.00', '2024-05-08 06:37:52'),
(157, 'joshua_wright', '', 'user', NULL, '4321098765', 'Joshua Wright', '081234567807', 'Jl. Contoh No. 18', '0.00', '0.00', '2024-05-08 06:37:52'),
(158, 'nicole_lopez', '', 'user', NULL, '2109876543', 'Nicole Lopez', '081234567808', 'Jl. Contoh No. 19', '0.00', '0.00', '2024-05-08 06:37:52'),
(159, 'hill', '', 'user', NULL, '1098765432', 'Andrew Hill', '081234567809', 'Jl. Contoh No. 20', '0.00', '0.00', '2024-05-08 06:37:52'),
(163, 'kia', '', 'user', 'direktur', '', 'nama kia', '', '', '0.00', '0.00', '2024-05-08 07:08:08'),
(164, 'citra', '', 'user', 'pegawai', '', 'Citra', '', '', '0.00', '0.00', '2024-05-08 07:17:08'),
(165, 'saya', '', 'user', 'pegawai', '', 'saya', '', '', '0.00', '0.00', '2024-05-09 10:55:37'),
(169, 'mana', '', 'user', 'pegawai', '213781239123', 'Mana Lagi', '0298309123', 'aasdadasdasdsad', '0.00', '0.00', '2024-05-12 02:02:21');

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
-- Indeks untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_payments`
--
ALTER TABLE `tb_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `tb_warga`
--
ALTER TABLE `tb_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
