<?php
include '..\conf\db_connection.php';

// Periksa apakah parameter URL 'upload' memiliki nilai 'ok'
if (isset($_GET['upload']) && $_GET['upload'] === 'ok') {
    echo "<script>alert('Upload berhasil');</script>";
} 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Upload Dokumen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload Dokumen</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_dokumen">Nama Dokumen:</label>
                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen">
            </div>
            <div class="form-group">
                <label for="file_dokumen">Pilih Dokumen:</label>
                <input type="file" class="form-control-file" name="file_dokumen" id="file_dokumen">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan Dokumen:</label>
                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
            </div>

            <div class="form-group">
                <label for="role_dokumen">Role Dokumen:</label>
                <!-- <select name="role_dokumen[]" id="role_dokumen" multiple>
                    <option value="direktur">Direktur</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="nilai3">Nilai 3</option>
                    <option value="">NULL</option>
                </select> -->
                <?php
                // Ambil data enum dari kolom role_dokumen di tabel tb_dokumen
                $result = $conn->query("SHOW COLUMNS FROM tb_dokumen LIKE 'role_dokumen'");
                $row = $result->fetch_assoc();
                $enum_str = $row["Type"];
                preg_match_all("/'([^']+)'/", $enum_str, $matches);
                $enums = $matches[1];

                // Buat opsi <select> secara otomatis
                echo '<select name="role_dokumen[]" id="role_dokumen" multiple>';
                foreach ($enums as $enum) {
                    echo '<option value="' . $enum . '">' . $enum . '</option>';
                }
                echo '</select>';
                ?>
            </div>

            <!-- Checkbox for role_dokumen -->
            <!-- <input type="checkbox" name="role_dokumen[]" id="direktur" value="direktur">
            <label for="direktur">Direktur</label><br>

            <input type="checkbox" name="role_dokumen[]" id="pegawai" value="pegawai">
            <label for="pegawai">Pegawai</label><br>

            <input type="checkbox" name="role_dokumen[]" id="nilai3" value="nilai3">
            <label for="nilai3">Nilai 3</label><br>

            <input type="checkbox" name="role_dokumen[]" id="null" value="">
            <label for="null">NULL</label><br> -->

            <div class="form-group">
                <label for="status_dokumen">Status Dokumen:</label>
                <select class="selectpicker form-control" id="status_dokumen" name="status_dokumen" data-live-search="true">
                    <option value="" selected disabled>Pilih status dokumen</option>
                    <?php
                    // Query untuk mendapatkan nilai-nilai enum dari kolom status
                    $enum_query = "SHOW COLUMNS FROM tb_dokumen WHERE Field = 'status'";
                    $enum_result = mysqli_query($conn, $enum_query);
                    $enum_row = mysqli_fetch_assoc($enum_result);
                    // Mengambil nilai enum dari kolom status
                    $enum_values = explode("','", substr($enum_row['Type'], 6, -2));

                    // Buat opsi dropdown sesuai dengan nilai-nilai enum
                    foreach ($enum_values as $value) {
                        echo '<option value="' . $value . '">' . ucfirst($value) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Upload Dokumen</button>
        </form>
    </div>
</body>
</html>
