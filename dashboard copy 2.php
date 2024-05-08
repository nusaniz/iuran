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
$query_tb_users = "SELECT * FROM tb_users";
$result_tb_users = mysqli_query($koneksi, $query_tb_users);
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
        while ($row_tb_users = mysqli_fetch_assoc($result_tb_users)) {
            echo "<option value='" . $row_tb_users['user_id'] . "'>" . $row_tb_users['username'] . "</option>";
        }
        ?>
    </select><br>
    <label for="amount">Jumlah Tagihan:</label><br>
    <input type="number" id="amount" name="amount" required><br><br>
    <input type="submit" value="Input Tagihan">
</form>

<!-- Menampilkan data tagihan setiap warga -->
<h3>Data Tagihan Setiap Warga</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Jumlah Tagihan</th>
        <th>Status</th>
        <th>Tanggal Pembayaran</th>
        <th>Aksi</th> <!-- Tambah kolom aksi -->
    </tr>
    <?php
    // Query untuk mengambil data tagihan setiap warga
    $query_tb_payments = "SELECT tb_users.username, tb_payments.amount, tb_payments.status, tb_payments.payment_date, tb_payments.payment_id FROM tb_users LEFT JOIN tb_payments ON tb_users.user_id = tb_payments.user_id";
    $result_tb_payments = mysqli_query($koneksi, $query_tb_payments);
    $no = 1;
    while ($row_tb_payments = mysqli_fetch_assoc($result_tb_payments)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row_tb_payments['username'] . "</td>";
        echo "<td>" . $row_tb_payments['amount'] . "</td>";
        echo "<td>" . $row_tb_payments['status'] . "</td>";
        echo "<td>" . $row_tb_payments['payment_date'] . "</td>";
        echo "<td>";
        // Tambahkan kondisi untuk menampilkan tombol aksi sesuai status pembayaran
        if ($row_tb_payments['status'] == 'belum dibayar') {
            echo "<form action='update_payment_status.php' method='post'>";
            echo "<input type='hidden' name='payment_id' value='" . $row_tb_payments['payment_id'] . "'>";
            echo "<input type='submit' name='update_status' value='Ubah Status Lunas'>";
            echo "</form>";
        } elseif ($row_tb_payments['status'] == 'lunas') {
            echo "<form action='update_payment_status.php' method='post'>";
            echo "<input type='hidden' name='payment_id' value='" . $row_tb_payments['payment_id'] . "'>";
            echo "<input type='submit' name='update_status' value='Ubah Status Belum Dibayar'>";
            echo "</form>";
        } else {
            echo "Sudah Lunas";
        }
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Tutup koneksi -->
<?php mysqli_close($koneksi); ?>

</body>
</html>
