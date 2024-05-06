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

    // Query untuk menambahkan data tagihan ke dalam tabel payments
    $query = "INSERT INTO payments (user_id, amount) VALUES ('$user_id', '$amount')";
    if (mysqli_query($koneksi, $query)) {
        echo "Data tagihan berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>
