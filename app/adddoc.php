<?php
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
                <select name="role_dokumen[]" id="role_dokumen" multiple>
                    <option value="direktur">Direktur</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="nilai3">Nilai 3</option>
                    <option value="">NULL</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_dokumen">Status Dokumen:</label>
                <select class="form-control" name="status_dokumen" id="status_dokumen">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Upload Dokumen</button>
        </form>
    </div>

</body>
</html>
