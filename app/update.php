<?php
session_start();

require "../conf/db_connection.php";

// Koneksi ke database
// $servername = "localhost";
// $username = "root"; // Ganti dengan username MySQL Anda
// $password = ""; // Ganti dengan password MySQL Anda
// $database = "db_booking"; // Ganti dengan username database Anda

// Membuat koneksi
// $conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Mengeksekusi query untuk memperbarui data berdasarkan ID
    $sql = "UPDATE tb_users SET username='$username', password='$password', role='$role' WHERE user_id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Data berhasil diperbarui.";
        header("Location: index.php?page=user&&id=".$id."&message=Data+berhasil+diperbarui");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: index.php?page=user&&id=".$id."&message=Error");
        exit();
    }
}

// Menutup koneksi database
$conn->close();
?>
