<?php
include '..\conf\db_connection.php';
// Koneksi ke database
// $conn = mysqli_connect("localhost", "root", "", "db_tagihan");

// Atur zona waktu ke GMT+7
date_default_timezone_set('Asia/Jakarta');

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Ambil data dari form
$username = $_POST['username'];
$amount = $_POST['amount'];
// $invoice_date = date("d-m-y"); // Tanggal tagihan saat ini
$invoice_date = date("Y-m-d H:i:s"); // Tanggal tagihan saat ini

// Buat kode transaksi unik
// $kode_transaksi = uniqid();
// Buat kode transaksi
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$kode_transaksi = "TRX" . date("dmy") . substr(str_shuffle($chars), 0, 8);


// Query untuk menyimpan tagihan ke dalam tabel tb_payments
$query = "INSERT INTO tb_payments (user_id, amount, invoice_date, status, kode_transaksi) 
          VALUES ((SELECT user_id FROM tb_users WHERE username = '$username'), '$amount', '$invoice_date', 'belum dibayar', '$kode_transaksi')";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    echo "Tagihan berhasil dibuat.";
    header("Location: dashboard.php");

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
