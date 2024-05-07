-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2024 pada 09.10
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
-- Database: `db_booking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'm', 'm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tanggal_penjemputan` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `kode_booking` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `nama`, `alamat`, `tanggal_penjemputan`, `status`, `kode_booking`, `email`) VALUES
(2, 'Nama 2', 'Alamat 2 uas', '2024-05-04', 'Disetujui', 'KB002', 'javuxily@pelagius.net'),
(3, 'Nama 3', 'Alamat 34sad', '2024-05-05', 'Disetujui', 'KB003', 'sadasd@lewsadenbo.com'),
(4, 'Nama 4', 'Alamat 4sd', '2024-05-06', 'Disetujui', 'KB004', 'tagar60384@lewenbo.com'),
(5, 'Nama 5', 'Alamat 5', '2024-05-07', 'Ditolak', 'KB005', 'tagar60384@lewenbo.com'),
(6, 'Nama 6', 'Alamat 6', '2024-05-08', 'Disetujui', 'KB006', 'tagar60384@lewenbo.com'),
(7, 'Nama 7', 'Alamat 7', '2024-05-09', 'Menunggu Persetujuan', 'KB007', 'tagar60384@lewenbo.com'),
(8, 'Nama 8', 'Alamat 8', '2024-05-10', 'Menunggu Persetujuan', 'KB008', 'tagar60384@lewenbo.com'),
(9, 'Nama 9', 'Alamat 9', '2024-05-11', 'Menunggu Persetujuan', 'KB009', 'tagar60384@lewenbo.com'),
(10, 'Nama 10', 'Alamat 10', '2024-05-12', 'Menunggu Persetujuan', 'KB010', 'tagar60384@lewenbo.com'),
(46, '1', '1', '2024-04-01', 'Menunggu Persetujuan', 'C7X59JFJ', 'tagar60384@lewenbo.com'),
(47, '2', '2', '2024-04-09', 'Menunggu Persetujuan', 'AMCPOVGB', 'tagar60384@lewenbo.com'),
(48, '3', '3', '2024-04-10', 'Menunggu Persetujuan', 'MRQG8DT1', 'tagar60384@lewenbo.com'),
(67, 'k', 'k', '2024-05-14', 'Menunggu Persetujuan', 'CIFLQH7U', 'tagar60384@lewenbo.com'),
(68, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'E71PAMHC', 'tagar60384@lewenbo.com'),
(69, 'k', 'k', '2024-05-14', 'Menunggu Persetujuan', '3V9HL4S8', 'tagar60384@lewenbo.com'),
(70, 'k', 'k', '2024-04-30', 'Menunggu Persetujuan', 'LKZ16L9V', 'tagar60384@lewenbo.com'),
(71, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'HD0FJ2P7', 'tagar60384@lewenbo.com'),
(72, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'SGMC18QB', 'tagar60384@lewenbo.com'),
(73, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'EHBFC0GY', 'tagar60384@lewenbo.com'),
(74, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'UQC7AG8A', 'tagar60384@lewenbo.com'),
(75, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'EJVDC29R', 'tagar60384@lewenbo.com'),
(76, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', '0EQ4P5OW', 'tagar60384@lewenbo.com'),
(77, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'IPO66LTV', 'tagar60384@lewenbo.com'),
(78, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'NLX08IUW', 'tagar60384@lewenbo.com'),
(79, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'DPIIO2IY', 'tagar60384@lewenbo.com'),
(80, 'sa', 's', '2024-05-07', 'Menunggu Persetujuan', '70MCNH1N', 'tagar60384@lewenbo.com'),
(81, 'indah', 'indonesia', '2024-05-07', 'Menunggu Persetujuan', 'B6AE0RFV', 'tagar60384@lewenbo.com'),
(82, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'YU0U157V', 'tagar60384@lewenbo.com'),
(83, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'A1763ENX', 'tagar60384@lewenbo.com'),
(84, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'Y3SPNJJH', 'tagar60384@lewenbo.com'),
(85, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'P813NNKQ', 'tagar60384@lewenbo.com'),
(86, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'DQPL8B41', 'tagar60384@lewenbo.com'),
(87, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'DU9US1GW', 'tagar60384@lewenbo.com'),
(88, 'k', 'k', '2024-05-08', 'Menunggu Persetujuan', '2YYA1GJQ', 'tagar60384@lewenbo.com'),
(89, 'k', 'k', '2024-05-14', 'Menunggu Persetujuan', '9XGPC4VW', 'tagar60384@lewenbo.com'),
(90, 'k', 'k', '2024-05-14', 'Menunggu Persetujuan', 'ZHGE8AL1', 'tagar60384@lewenbo.com'),
(91, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'D86G1H3A', 'tagar60384@lewenbo.com'),
(92, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'IR6LPJPN', 'tagar60384@lewenbo.com'),
(93, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'TJYKY4VU', 'tagar60384@lewenbo.com'),
(94, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'UGU6LAT8', 'tagar60384@lewenbo.com'),
(95, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', '9DB7VJ1W', 'tagar60384@lewenbo.com'),
(96, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'L87FIR07', 'tagar60384@lewenbo.com'),
(97, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'DAJBW9RF', 'tagar60384@lewenbo.com'),
(98, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', '26PUMP7V', 'tagar60384@lewenbo.com'),
(99, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'KG03BEY8', 'tagar60384@lewenbo.com'),
(100, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'ZVOGVC7W', 'tagar60384@lewenbo.com'),
(101, 'k', 'k', '2024-05-01', 'Menunggu Persetujuan', 'XZKLT9OK', 'tagar60384@lewenbo.com'),
(102, 'asd', 'kas', '2024-05-22', 'Menunggu Persetujuan', 'CTHVCYRX', 'tagar60384@lewenbo.com'),
(103, 'tagar', 'japan', '2024-05-01', 'Menunggu Persetujuan', 'QOINBD3V', 'tagar60384@lewenbo.com'),
(104, 'k', 'k', '2024-05-07', 'Menunggu Persetujuan', 'H6DRPYOC', 'tagar60384@lewenbo.com'),
(105, 'kkm', 'j', '2024-05-03', 'Menunggu Persetujuan', '1Y9I8TV1', 'tagar60384@lewenbo.com'),
(208, 'k', 'k', '2024-05-07', 'Menunggu Persetujuan', 'I0UERTN4', 'tagar60384@lewenbo.com'),
(209, 'joana', 'amerika', '2024-05-03', 'Menunggu Persetujuan', 'KN0NEDJI', 'tagar60384@lewenbo.com'),
(210, 'k', 'k', '2024-05-08', 'Menunggu Persetujuan', 'NVC7A4NQ', 'tagar60384@lewenbo.com'),
(211, 'k', 'k', '2024-05-15', 'Menunggu Persetujuan', '5YIBHK3W', 'tagar60384@lewenbo.com'),
(212, 'hanum', 'amerika', '2024-05-03', 'Menunggu Persetujuan', '4JDR9A9M', 'tagar60384@lewenbo.com'),
(213, 'indah', 'amerika', '2024-05-20', 'Menunggu Persetujuan', 'P9JG6V1J', 'tagar60384@lewenbo.com'),
(214, 'indah', 'amerika', '2024-05-22', 'Menunggu Persetujuan', '1DPDJ8T3', 'jelizibo@citmo.net'),
(215, 'indah', 'amerika', '2024-05-30', 'Menunggu Persetujuan', 'AKFOX00K', 'fehibi5026@togito.com'),
(216, 'indah', 'amerika', '0000-00-00', 'Disetujui', '60XPDOHV', 'fehibi5026@togito.com'),
(218, 'indah', 'amerika', '2024-05-03', 'Menunggu Persetujuan', '29K7YE7U', ''),
(219, 'indah', 'amerika', '2024-05-23', 'Menunggu Persetujuan', 'NRHZTQ78', 'tagar60384@lewenbo.com'),
(220, 'indah', 'amerika', '0000-00-00', 'Disetujui', 'DKWNS02J', ''),
(221, 'indah', 'amerika', '0000-00-00', 'Disetujui', 'ALSIIMQ1', 'tagar60384@lewenbo.com'),
(222, 'ANAIA', 'amerika', '0000-00-00', 'Disetujui', 'G8BFKDUM', 'javuxily@pelagius.net');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `kategori` enum('citra','opsa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `no_telp`, `kategori`) VALUES
(1, 'John Doe', '08123456789', 'opsa'),
(2, 'Jane Smith', '08567891234', 'citra'),
(3, 'Michael Johnson', '08901234567', 'citra'),
(4, 'Emily Davis', '08123456789', 'citra'),
(5, 'Christopher Wilson', '08567891234', 'citra'),
(6, 'Amanda Martinez', '08901234567', 'citra'),
(7, 'David Anderson', '08123456789', 'citra'),
(8, 'Sarah Taylor', '08567891234', 'citra'),
(9, 'Matthew Thomas', '08901234567', 'citra'),
(10, 'Jessica Garcia', '08123456789', 'citra'),
(11, 'John Doe', '1234567890', 'citra'),
(12, 'Jane Smith', '0987654321', 'citra'),
(13, 'Michael Johnson', '1112223333', 'citra'),
(14, 'Emily Williams', '4445556666', 'citra'),
(15, 'Christopher Brown', '7778889999', 'citra'),
(16, 'Jessica Miller', '0001112222', 'citra'),
(17, 'David Wilson', '3334445555', 'citra'),
(18, 'Sarah Anderson', '6667778888', 'citra'),
(19, 'James Taylor', '9990001111', 'citra'),
(20, 'Jennifer Thomas', '2223334444', 'citra'),
(21, 'Robert Jackson', '5556667777', 'citra'),
(22, 'Maria White', '8889990000', 'citra'),
(23, 'William Harris', '1112223333', 'citra'),
(24, 'Linda Martinez', '4445556666', 'citra'),
(25, 'Charles Robinson', '7778889999', 'citra'),
(26, 'Patricia Clark', '0001112222', 'citra'),
(27, 'Daniel Rodriguez', '3334445555', 'citra'),
(28, 'Karen Lewis', '6667778888', 'citra'),
(29, 'Mark Lee', '9990001111', 'citra'),
(30, 'Barbara Walker', '2223334444', 'citra'),
(31, 'Richard Hall', '5556667777', 'citra'),
(32, 'Lisa Young', '8889990000', 'citra'),
(33, 'Matthew Allen', '1112223333', 'citra'),
(34, 'Donna King', '4445556666', 'citra'),
(35, 'Anthony Scott', '7778889999', 'citra'),
(36, 'Dorothy Wright', '0001112222', 'citra'),
(37, 'Paul Green', '3334445555', 'citra'),
(38, 'Nancy Baker', '6667778888', 'citra'),
(39, 'Kevin Adams', '9990001111', 'citra'),
(40, 'Betty Hill', '2223334444', 'citra'),
(41, 'Edward Nelson', '5556667777', 'citra'),
(42, 'Helen Evans', '8889990000', 'citra'),
(43, 'Jason Gray', '1112223333', 'citra'),
(44, 'Ruth Wood', '4445556666', 'citra'),
(45, 'Ryan Hughes', '7778889999', 'citra'),
(46, 'Deborah Cook', '0001112222', 'citra'),
(47, 'Laura Rivera', '3334445555', 'citra'),
(48, 'Eric Cooper', '6667778888', 'citra'),
(49, 'Kimberly Rogers', '9990001111', 'citra'),
(50, 'Sharon Reed', '2223334444', 'citra'),
(51, 'Steven Bailey', '5556667777', 'citra'),
(52, 'Margaret Torres', '8889990000', 'citra'),
(53, 'Andrew Russell', '1112223333', 'citra'),
(54, 'Michelle Brooks', '4445556666', 'citra'),
(55, 'Timothy Ward', '7778889999', 'citra'),
(56, 'Amanda Powell', '0001112222', 'citra'),
(57, 'Brian Carter', '3334445555', 'citra'),
(58, 'Susan Collins', '6667778888', 'citra'),
(59, 'Jeffrey Wood', '9990001111', 'citra'),
(60, 'Angela Bell', '2223334444', 'citra'),
(61, 'Frank Morris', '5556667777', 'citra'),
(62, 'Kathleen Murphy', '8889990000', 'citra'),
(63, 'Gary Russell', '1112223333', 'citra'),
(64, 'Stephanie Long', '4445556666', 'citra'),
(65, 'Jerry Wright', '7778889999', 'citra'),
(66, 'Rebecca Foster', '0001112222', 'citra'),
(67, 'Sandra Gonzalez', '3334445555', 'citra'),
(68, 'Patrick Perry', '6667778888', 'citra'),
(69, 'Pamela Coleman', '9990001111', 'citra'),
(70, 'Terry Simmons', '2223334444', 'citra'),
(71, 'Christine Bryant', '5556667777', 'citra'),
(72, 'Roy Patterson', '8889990000', 'citra'),
(73, 'Julie Reed', '1112223333', 'citra'),
(74, 'Carl Ramirez', '4445556666', 'citra'),
(75, 'Diane Stewart', '7778889999', 'citra'),
(76, 'Alice Jenkins', '0001112222', 'citra'),
(77, 'Bruce Long', '3334445555', 'citra'),
(78, 'Julia Butler', '6667778888', 'citra'),
(79, 'Philip Barnes', '9990001111', 'citra'),
(80, 'Jacqueline Hughes', '2223334444', 'citra'),
(81, 'Billy Foster', '5556667777', 'citra'),
(82, 'Janet Coleman', '8889990000', 'citra'),
(83, 'Louis Simmons', '1112223333', 'citra'),
(84, 'Victoria Bryant', '4445556666', 'citra'),
(85, 'Marilyn Patterson', '7778889999', 'citra'),
(86, 'Roger Reed', '0001112222', 'citra'),
(87, 'Doris Ramirez', '3334445555', 'citra'),
(88, 'Gerald Stewart', '6667778888', 'citra'),
(89, 'Cheryl Jenkins', '9990001111', 'citra'),
(90, 'Eugene Long', '2223334444', 'citra'),
(91, 'Jean Butler', '5556667777', 'citra'),
(92, 'Tina Barnes', '8889990000', 'citra'),
(93, 'Howard Hughes', '1112223333', 'citra'),
(94, 'Frances Foster', '4445556666', 'citra'),
(95, 'Evelyn Coleman', '7778889999', 'citra'),
(96, 'Wayne Simmons', '0001112222', 'citra'),
(97, 'Evelyn Bryant', '3334445555', 'citra'),
(98, 'Harry Patterson', '6667778888', 'citra'),
(99, 'Amanda Reed', '9990001111', 'citra'),
(100, 'Jane Ramirez', '2223334444', 'citra'),
(101, 'Joe Stewart', '5556667777', 'citra'),
(102, 'Gloria Jenkins', '8889990000', 'citra'),
(103, 'Marie Long', '1112223333', 'citra'),
(104, 'Steve Butler', '4445556666', 'citra'),
(105, 'Grace Barnes', '7778889999', 'citra'),
(106, 'Randy Hughes', '0001112222', 'citra'),
(107, 'Theresa Ramirez', '3334445555', 'citra'),
(108, 'Ann Stewart', '6667778888', 'citra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bulk`
--

CREATE TABLE `tb_bulk` (
  `id` int(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `status_kirim_email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bulk`
--

INSERT INTO `tb_bulk` (`id`, `nama`, `email`, `status_kirim_email`) VALUES
(1, 'name', 'tagar60384@lewenbo.com', 'Sukses'),
(2, 'MOCHAMAD HERU PRASETYO', 'tagar60384@lewenbo.com', 'Sukses'),
(3, 'MUHAMMAD ROKHANIDIN', 'tagar60384@lewenbo.com', 'Sukses'),
(4, 'MUHAMMAD RAHMAN', 'tagar60384@lewenbo.com', 'Sukses'),
(5, 'Mia Dwi Amalia', 'tagar60384@lewenbo.com', 'Sukses'),
(6, 'LIDYA RIAN FERDIANA', 'tagar60384@lewenbo.com', 'Sukses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`) VALUES
(1, 'm', 'm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_booking` (`kode_booking`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_bulk`
--
ALTER TABLE `tb_bulk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT untuk tabel `tb_bulk`
--
ALTER TABLE `tb_bulk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
