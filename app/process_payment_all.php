<?php
include '../conf/db_connection.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data tagihan dari formulir
    $amount = $_POST['amount'];
    $invoice_date = date("Y-m-d H:i:s"); // Waktu pembuatan tagihan

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

    // Query untuk mengambil daftar pengguna
    $query_tb_users = "SELECT * FROM tb_users";
    $result_tb_users = mysqli_query($conn, $query_tb_users);

    // Looping untuk membuat tagihan untuk setiap pengguna
    while ($row_tb_users = mysqli_fetch_assoc($result_tb_users)) {
        $user_id = $row_tb_users['user_id'];
        $kode_transaksi = generateTransactionCode(); // Generate kode transaksi baru untuk setiap tagihan
        
        // Query untuk menambahkan data tagihan ke dalam tabel tb_payments
        $query = "INSERT INTO tb_payments (user_id, amount, kode_transaksi, invoice_date) VALUES ('$user_id', '$amount', '$kode_transaksi', '$invoice_date')"; // Menambahkan kolom kode_transaksi dan invoice_date ke dalam query
        if (!mysqli_query($conn, $query)) {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    echo "Tagihan untuk semua warga berhasil dibuat.";
    header("Location: index.php?page=home");

    // Tutup conn
    mysqli_close($conn);
}
?>
