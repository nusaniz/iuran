<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../user_dashboard.php");
    exit();
}

// Koneksi ke database
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

if (isset($_POST['delete_payment'])) {
    $payment_id = $_POST['payment_id'];

    // Query untuk menghapus data pembayaran berdasarkan payment_id
    $query_delete_payment = "DELETE FROM tb_payments WHERE payment_id = $payment_id";

    if (mysqli_query($koneksi, $query_delete_payment)) {
        echo "Data pembayaran berhasil dihapus.";
        header("Location: index.php?page=home&&hapus=ok");
    } else {
        echo "Gagal menghapus data pembayaran: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi
mysqli_close($koneksi);


?>
