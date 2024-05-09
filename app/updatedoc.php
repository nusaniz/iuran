<?php
include '../conf/db_connection.php';

// Periksa apakah parameter id telah diberikan
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    // Periksa apakah form telah disubmit
    if(isset($_POST["submit"])) {
        $nama_dokumen = $_POST['nama_dokumen'];
        $status_dokumen = $_POST['status_dokumen'];
        
        // Kueri database untuk memperbarui informasi dokumen
        $query = "UPDATE tb_dokumen SET nama = '$nama_dokumen', status = '$status_dokumen' WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "Data dokumen berhasil diperbarui.";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Form tidak disubmit.";
    }
} else {
    echo "ID Dokumen tidak diberikan.";
}

// Tutup koneksi
mysqli_close($conn);
?>
