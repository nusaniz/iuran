<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Koneksi ke database (ganti sesuai dengan pengaturan Anda)
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "db_iuran";
$koneksi = mysqli_connect($host, $db_username, $db_password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Query untuk mengambil riwayat iuran pengguna berdasarkan user_id
$query = "SELECT * FROM payments WHERE user_id='$user_id'";
$result = mysqli_query($koneksi, $query);

// Hitung jumlah iuran lunas dan belum dibayar
$total_lunas = 0;
$total_belum_dibayar = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] == 'lunas') {
            $total_lunas += $row['amount'];
        } else {
            $total_belum_dibayar += $row['amount'];
        }
    }
}

// Tampilkan tabel daftar riwayat iuran
echo "<h2>Riwayat Iuran</h2>";
echo "<table border='1'>";
echo "<tr><th>No</th><th>Jumlah Tagihan</th><th>Status</th><th>Tanggal Pembayaran</th></tr>";
$no = 1;
$result = mysqli_query($koneksi, $query); // Query dijalankan kembali untuk mendapatkan data riwayat iuran
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['payment_date'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Tampilkan total iuran lunas dan belum dibayar
echo "<h2>Total Iuran</h2>";
echo "<p>Total Lunas: Rp " . $total_lunas . "</p>";
echo "<p>Total Belum Dibayar: Rp " . $total_belum_dibayar . "</p>";

// Tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Aplikasi Pencatat Iuran Warga</title>
</head>
<body>

<a href="logout.php">Logout</a>

</body>
</html>
