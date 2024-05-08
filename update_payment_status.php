<?php
include 'conf/db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    // Ambil payment_id dari formulir
    $payment_id = $_POST['payment_id'];

    // conn ke database (ganti sesuai dengan pengaturan Anda)
    // $host = "localhost";
    // $db_username = "root";
    // $db_password = "";
    // $database = "db_iuran";
    // $conn = mysqli_connect($host, $db_username, $db_password, $database);

    // Cek conn
    if (mysqli_connect_errno()) {
        echo "conn database gagal: " . mysqli_connect_error();
        exit();
    }

    // Query untuk mengambil status pembayaran saat ini
    $query_get_status = "SELECT status FROM tb_payments WHERE payment_id='$payment_id'";
    $result_get_status = mysqli_query($conn, $query_get_status);
    $row_get_status = mysqli_fetch_assoc($result_get_status);
    $current_status = $row_get_status['status'];

    // Update status pembayaran sesuai kondisi
    if ($current_status == 'belum dibayar') {
        $new_status = 'lunas';
    } elseif ($current_status == 'lunas') {
        $new_status = 'belum dibayar';
    } else {
        echo "Status pembayaran tidak valid.";
        exit();
    }

    $query_update_status = "UPDATE tb_payments SET status='$new_status', payment_date=NOW() WHERE payment_id='$payment_id'";
    if (mysqli_query($conn, $query_update_status)) {
        echo "Status pembayaran berhasil diubah menjadi " . $new_status . ".";
    } else {
        echo "Error: " . $query_update_status . "<br>" . mysqli_error($conn);
    }

    // Tutup conn
    mysqli_close($conn);
}
?>
