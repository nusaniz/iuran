<?php
include '../conf/db_connection.php';

// Periksa apakah parameter id telah diberikan
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    // Periksa apakah form telah disubmit
    if(isset($_POST["submit"])) {
        $nama_dokumen = $_POST['nama_dokumen'];
        $status_dokumen = $_POST['status_dokumen'];
        
        // Periksa apakah file baru diunggah
        if(isset($_FILES['file_dokumen']) && $_FILES['file_dokumen']['error'] === UPLOAD_ERR_OK) {
            $nama_file = $_FILES['file_dokumen']['name'];
            $lokasi_file = $_FILES['file_dokumen']['tmp_name'];
            $folder_upload = "uploads/";
            $file_baru = $folder_upload . basename($nama_file);

            // Pindahkan file yang diunggah ke folder upload
            if(move_uploaded_file($lokasi_file, $file_baru)) {
                // Kueri database untuk memperbarui informasi dokumen
                $query = "UPDATE tb_dokumen SET nama = '$nama_dokumen', file_path = '$file_baru', status = '$status_dokumen' WHERE id = $id";

                if (mysqli_query($conn, $query)) {
                    echo "Data dokumen berhasil diperbarui.";
                    header("Location: index.php?page=dokumen&&update=ok");
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                    header("Location: index.php?page=dokumen&&update=failed");
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan file path sebelumnya
            $query_get_file_path = "SELECT file_path FROM tb_dokumen WHERE id = $id";
            $result_get_file_path = mysqli_query($conn, $query_get_file_path);
            $row_get_file_path = mysqli_fetch_assoc($result_get_file_path);
            $file_path_sebelumnya = $row_get_file_path['file_path'];

            // Kueri database untuk memperbarui informasi dokumen
            $query = "UPDATE tb_dokumen SET nama = '$nama_dokumen', file_path = '$file_path_sebelumnya', status = '$status_dokumen' WHERE id = $id";

            if (mysqli_query($conn, $query)) {
                echo "Data dokumen berhasil diperbarui.";
                header("Location: index.php?page=dokumen&&update=ok");
            } else {
                echo "Error updating record: " . mysqli_error($conn);
                header("Location: index.php?page=dokumen&&update=failed");
            }
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
