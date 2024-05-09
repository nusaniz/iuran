<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Dokumen</title>
</head>
<body>
    <?php
    include '../conf/db_connection.php';

    // Periksa apakah parameter id telah diberikan
    if(isset($_GET["id"])) {
        $id = $_GET["id"];

        // Kueri database untuk mendapatkan informasi dokumen berdasarkan ID
        $query = "SELECT * FROM tb_dokumen WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nama_dokumen = $row["nama"];
            $status_dokumen = $row["status"];
        } else {
            echo "Dokumen tidak ditemukan.";
            exit();
        }
    } else {
        echo "ID Dokumen tidak diberikan.";
        exit();
    }
    ?>

    <h2>Edit Dokumen</h2>
    <form action="updatedoc.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nama_dokumen">Nama Dokumen:</label>
        <input type="text" name="nama_dokumen" id="nama_dokumen" value="<?php echo $nama_dokumen; ?>"><br><br>
        <label for="status_dokumen">Status Dokumen:</label>
        <select name="status_dokumen" id="status_dokumen">
            <option value="aktif" <?php if($status_dokumen == "aktif") echo "selected"; ?>>Aktif</option>
            <option value="nonaktif" <?php if($status_dokumen == "nonaktif") echo "selected"; ?>>Nonaktif</option>
        </select><br><br>
        <input type="submit" value="Simpan Perubahan" name="submit">
    </form>
</body>
</html>
