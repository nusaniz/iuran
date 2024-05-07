<!-- edit_payment.php -->

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_payment'])) {
    // Ambil payment_id dari formulir
    $payment_id = $_POST['payment_id'];

    // Query untuk mengambil data pembayaran berdasarkan payment_id
    $query_payment_detail = "SELECT * FROM payments WHERE payment_id='$payment_id'";
    $result_payment_detail = mysqli_query($koneksi, $query_payment_detail);
    $row_payment_detail = mysqli_fetch_assoc($result_payment_detail);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pembayaran</title>
</head>
<body>

<h2>Edit Data Pembayaran</h2>

<form action="update_payment.php" method="post">
    <input type="hidden" name="payment_id" value="<?php echo $row_payment_detail['payment_id']; ?>">
    <label for="amount">Jumlah Tagihan:</label><br>
    <input type="number" id="amount" name="amount" value="<?php echo $row_payment_detail['amount']; ?>" required><br><br>
    <label for="status">Status:</label><br>
    <select id="status" name="status" required>
        <option value="lunas" <?php if ($row_payment_detail['status'] == 'lunas') echo 'selected'; ?>>Lunas</option>
        <option value="belum dibayar" <?php if ($row_payment_detail['status'] == 'belum dibayar') echo 'selected'; ?>>Belum Dibayar</option>
    </select><br><br>
    <input type="submit" name="submit" value="Simpan Perubahan">
</form>

<!-- Tutup koneksi -->
<?php mysqli_close($koneksi); ?>

</body>
</html>
