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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Ambil data dari formulir
    $payment_id = $_POST['payment_id'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

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

    // Query untuk memperbarui data pembayaran
    $query_update_payment = "UPDATE payments SET amount='$amount', status='$status' WHERE payment_id='$payment_id'";
    if (mysqli_query($koneksi, $query_update_payment)) {
        echo "Data pembayaran berhasil diperbarui.";
    } else {
        echo "Error: " . $query_update_payment . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>
