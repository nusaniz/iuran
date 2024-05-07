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

// Fungsi untuk generate kode transaksi otomatis
function generateTransactionCode() {
    // Mendapatkan tanggal dan waktu saat ini
    $currentDateTime = date("YmdHis");

    // Mendapatkan beberapa karakter acak untuk menambahkan ke kode transaksi
    $randomChars = substr(md5(uniqid(mt_rand(), true)), 0, 4);

    // Menggabungkan tanggal, waktu, dan karakter acak untuk membuat kode transaksi
    $transactionCode = "TRX-" . $currentDateTime . "-" . $randomChars;

    return $transactionCode;
}

// Query untuk mengambil daftar pengguna
$query_users = "SELECT users.*, 
    SUM(CASE WHEN payments.status = 'lunas' THEN payments.amount ELSE 0 END) AS total_lunas, 
    SUM(CASE WHEN payments.status = 'belum dibayar' THEN payments.amount ELSE 0 END) AS total_belum_bayar 
    FROM users 
    LEFT JOIN payments ON users.user_id = payments.user_id 
    GROUP BY users.user_id";
$result_users = mysqli_query($koneksi, $query_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Aplikasi Pencatat Iuran Warga</title>
    <style>
        .lunas {
            background-color: lightgreen;
        }
    </style>
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
        while ($row_users = mysqli_fetch_assoc($result_users)) {
            echo "<option value='" . $row_users['user_id'] . "'>" . $row_users['username'] . "</option>";
        }
        ?>
    </select><br>
    <label for="amount">Jumlah Tagihan:</label><br>
    <input type="number" id="amount" name="amount" required><br><br>
    <input type="hidden" name="kode_transaksi" value="<?php echo generateTransactionCode(); ?>"> <!-- Tambahkan input hidden untuk kode transaksi -->
    <input type="submit" value="Input Tagihan">
</form>

<!-- Form untuk membuat tagihan untuk semua warga -->
<form action="process_payment_all.php" method="post">
    <input type="hidden" name="kode_transaksi" value="<?php echo generateTransactionCode(); ?>">
    <input type="number" name="amount" placeholder="Jumlah Tagihan untuk Semua Warga" required>
    <input type="submit" value="Input Tagihan untuk Semua Warga">
</form>

<!-- Menampilkan data tagihan setiap warga -->
<h3>Data Tagihan Setiap Warga</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Kode Transaksi</th>
        <th>Nama Pengguna</th>
        <th>Jumlah Tagihan</th>
        <th>Status</th>
        <th>Tgl Tagihan</th>
        <th>Tgl Pembayaran</th>
        <th>Aksi</th> <!-- Tambah kolom aksi -->
    </tr>
    <?php
    // Query untuk mengambil data tagihan setiap warga
    $query_payments = "SELECT users.username, payments.amount,payments.invoice_date,payments.kode_transaksi, payments.status, payments.payment_date, payments.payment_id FROM users LEFT JOIN payments ON users.user_id = payments.user_id";
    $result_payments = mysqli_query($koneksi, $query_payments);
    $no = 1;
    while ($row_payments = mysqli_fetch_assoc($result_payments)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row_payments['kode_transaksi'] . "</td>";
        echo "<td>" . $row_payments['username'] . "</td>";
        echo "<td>" . $row_payments['amount'] . "</td>";
        echo "<td class='" . ($row_payments['status'] === 'lunas' ? 'lunas' : '') . "'>" . $row_payments['status'] . "</td>";
        echo "<td>" . $row_payments['invoice_date'] . "</td>";
        echo "<td>" . $row_payments['payment_date'] . "</td>";
        echo "<td>";
        echo "<form action='edit_payment.php' method='post'>";
        echo "<input type='hidden' name='payment_id' value='" . $row_payments['payment_id'] . "'>";
        echo "<input type='submit' name='edit_payment' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Menampilkan total lunas dan belum bayar tiap pengguna -->
<h3>Total Lunas dan Belum Bayar Tiap Pengguna</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Total Lunas</th>
        <th>Total Belum Bayar</th>
    </tr>
    <?php
    $no = 1;
    mysqli_data_seek($result_users, 0); // Reset pointer result set
    while ($row_users = mysqli_fetch_assoc($result_users)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row_users['username'] . "</td>";
        echo "<td>" . $row_users['total_lunas'] . "</td>";
        echo "<td>" . $row_users['total_belum_bayar'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Tutup koneksi -->
<?php
mysqli_close($koneksi);
?>

</body>
</html>
