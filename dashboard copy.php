<!-- dashboard.php -->

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

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

// Query untuk mengambil daftar pengguna
$query = "SELECT * FROM users";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Aplikasi Pencatat Iuran Warga</title>
</head>
<body>

<h2>Dashboard Admin - Aplikasi Pencatat Iuran Warga</h2>

<!-- Form untuk input data tagihan iuran -->
<h3>Input Data Tagihan Iuran</h3>
<form action="process_payment.php" method="post">
    <label for="user_id">Pilih Pengguna:</label><br>
    <select id="user_id" name="user_id" required>
        <?php 
        // Tampilkan daftar pengguna sebagai pilihan dropdown
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['user_id'] . "'>" . $row['username'] . "</option>";
        }
        ?>
    </select><br>
    <label for="amount">Jumlah Tagihan:</label><br>
    <input type="number" id="amount" name="amount" required><br><br>
    <input type="submit" value="Input Tagihan">
</form>

<!-- Tutup koneksi -->
<?php mysqli_close($koneksi); ?>

</body>
</html>
