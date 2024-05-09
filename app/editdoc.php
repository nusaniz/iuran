<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Dokumen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

<div class="container mt-5">
        <h2>Edit Dokumen</h2>
        <form action="updatedoc.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">Id Dokumen:</label>
                <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama_dokumen">Nama Dokumen:</label>
                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" value="<?php echo $nama_dokumen; ?>">
            </div>
    
            <div class="form-group">
                <label for="file_dokumen">Pilih File Dokumen Baru:</label>
                <input type="file" class="form-control-file" name="file_dokumen" id="file_dokumen">
            </div>
            <div class="form-group">
                <label for="status_dokumen">Status Dokumen:</label>
                <select class="form-control" name="status_dokumen" id="status_dokumen">
                    <option value="aktif" <?php if($status_dokumen == "aktif") echo "selected"; ?>>Aktif</option>
                    <option value="nonaktif" <?php if($status_dokumen == "nonaktif") echo "selected"; ?>>Nonaktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
