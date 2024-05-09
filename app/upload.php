<?php
include '../conf/db_connection.php';

// Koneksi ke database
// $host = 'localhost';
// $username = 'username'; // Ganti dengan username MySQL Anda
// $password = 'password'; // Ganti dengan password MySQL Anda
// $database = 'nama_database'; // Ganti dengan nama database Anda
// $conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if(isset($_POST["submit"])) {
    $nama_dokumen = $_POST['nama_dokumen'];
    $status_dokumen = $_POST['status_dokumen'];
    
    // Direktori penyimpanan dokumen
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file_dokumen"]["name"]);
    
    // Upload file
    if (move_uploaded_file($_FILES["file_dokumen"]["tmp_name"], $target_file)) {
        // Simpan informasi dokumen ke database
        $sql = "INSERT INTO tb_dokumen (nama, file_path, status) VALUES ('$nama_dokumen', '$target_file', '$status_dokumen')";
        if ($conn->query($sql) === TRUE) {
            echo "Dokumen berhasil diupload.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload dokumen.";
    }
}
// Tutup koneksi
$conn->close();
?>