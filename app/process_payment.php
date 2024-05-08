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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data tagihan dari formulir
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $kode_transaksi = $_POST['kode_transaksi']; // Menangkap kode transaksi dari formulir
    $invoice_date = date("Y-m-d H:i:s"); // Waktu pembuatan tagihan

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

    // Query untuk menambahkan data tagihan ke dalam tabel tb_payments
    $query = "INSERT INTO tb_payments (user_id, amount, kode_transaksi, invoice_date) VALUES ('$user_id', '$amount', '$kode_transaksi', '$invoice_date')"; // Menambahkan kolom kode_transaksi dan invoice_date ke dalam query
    if (mysqli_query($koneksi, $query)) {
        echo "Data tagihan berhasil ditambahkan.";
        header("Location: index.php?page=home");

        // Update invoice_date jika status lunas
        $status = "belum dibayar"; // Ubah status sesuai dengan kondisi aplikasi Anda
        if ($status === "lunas") {
            $invoice_date = date("Y-m-d H:i:s"); // Waktu pembayaran
            $payment_id = mysqli_insert_id($koneksi); // Mendapatkan ID pembayaran terbaru

            // Query untuk memperbarui invoice_date
            $update_query = "UPDATE tb_payments SET invoice_date = '$invoice_date' WHERE payment_id = $payment_id";
            mysqli_query($koneksi, $update_query);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>
