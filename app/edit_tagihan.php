<?php
include '..\conf\db_connection.php';

// Atur zona waktu ke GMT+7
date_default_timezone_set('Asia/Jakarta');

// Periksa apakah parameter payment_id ada dalam URL
if(isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];

    // Query untuk mendapatkan data tagihan berdasarkan payment_id
    $query = "SELECT tb_payments.payment_id, tb_payments.kode_transaksi, tb_payments.user_id, tb_users.username, tb_users.nama_lengkap, tb_payments.amount, tb_payments.status, tb_payments.invoice_date
              FROM tb_payments
              INNER JOIN tb_users ON tb_payments.user_id = tb_users.user_id
              WHERE tb_payments.payment_id = $payment_id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data tagihan ditemukan
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $payment_id = $row['payment_id'];
        $kode_transaksi = $row['kode_transaksi'];
        $user_id = $row['user_id'];
        $username = $row['username'];
        $nama_lengkap = $row['nama_lengkap'];
        $amount = $row['amount'];
        $status = $row['status'];
        $invoice_date = $row['invoice_date'];
    } else {
        echo "Data tagihan tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter payment_id tidak diberikan.";
    exit();
}

// Jika form disubmit dengan method POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai baru dari form
    $new_amount = $_POST['amount'];
    $new_status = $_POST['status'];
    $tanggal_pembayaran = ($new_status == 'lunas') ? date("Y-m-d H:i:s") : NULL;

    // Query untuk mengupdate data tagihan
    $update_query = "UPDATE tb_payments 
                     SET amount = '$new_amount', status = '$new_status', payment_date = '$tanggal_pembayaran' 
                     WHERE payment_id = $payment_id";

    // Eksekusi query update
    if(mysqli_query($conn, $update_query)) {
        echo "Data tagihan berhasil diperbarui.";
        // header("Location: dashboard.php");
        header("Location: index.php?page=home");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tagihan</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Tagihan</h2>
        <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?payment_id=' . $payment_id; ?>" method="post"> -->
        <form action="" method="post">
            <div class="form-group">
                <label for="payment_id">Payment ID:</label>
                <input type="text" class="form-control" id="payment_id" name="payment_id" value="<?php echo $payment_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="kode_transaksi">Kode Transaksi:</label>
                <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="amount">Amount Tagihan:</label>
                <input type="number" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="belum dibayar" <?php if($status == 'belum dibayar') echo 'selected'; ?>>belum dibayar</option>
                    <option value="lunas" <?php if($status == 'lunas') echo 'selected'; ?>>lunas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="invoice_date">Tanggal Tagihan:</label>
                <input type="text" class="form-control" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Tambahkan link JavaScript Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
// Tutup koneksi
mysqli_close($conn);
?>
