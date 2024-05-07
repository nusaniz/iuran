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

    // Query untuk mengambil data pembayaran berdasarkan payment_id dan menggabungkan dengan data dari tabel users
    $query_payment_detail = "SELECT payments.*, users.username FROM payments JOIN users ON payments.user_id = users.user_id WHERE payment_id='$payment_id'";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Edit Data Pembayaran</h2>

    <form action="update_payment.php" method="post">
        <input type="hidden" name="payment_id" value="<?php echo $row_payment_detail['payment_id']; ?>">
        <div class="form-group">
            <label for="kode_transaksi">Kode Transaksi:</label>
            <input type="text" id="kode_transaksi" name="kode_transaksi" value="<?php echo $row_payment_detail['kode_transaksi']; ?>" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row_payment_detail['username']; ?>" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah Tagihan:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $row_payment_detail['amount']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="lunas" <?php if ($row_payment_detail['status'] == 'lunas') echo 'selected'; ?>>Lunas</option>
                <option value="belum dibayar" <?php if ($row_payment_detail['status'] == 'belum dibayar') echo 'selected'; ?>>Belum Dibayar</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <?php mysqli_close($koneksi); ?>

</div>

</body>
</html>
