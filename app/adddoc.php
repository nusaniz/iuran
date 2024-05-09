<!DOCTYPE html>
<html>
<head>
    <title>Form Upload Dokumen</title>
</head>
<body>
    <h2>Upload Dokumen</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="nama_dokumen">Nama Dokumen:</label>
        <input type="text" name="nama_dokumen" id="nama_dokumen"><br><br>
        <label for="file_dokumen">Pilih Dokumen:</label>
        <input type="file" name="file_dokumen" id="file_dokumen"><br><br>
        <label for="status_dokumen">Status Dokumen:</label>
        <select name="status_dokumen" id="status_dokumen">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select><br><br>
        <input type="submit" value="Upload Dokumen" name="submit">
    </form>
</body>
</html>