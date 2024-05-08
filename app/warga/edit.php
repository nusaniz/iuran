<?php
// Koneksi ke database
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "db_iuran";
$koneksi = mysqli_connect($host, $db_username, $db_password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel
$id = $nik = $nama_lengkap = $no_hp = $alamat = "";

// Periksa apakah parameter id ada dan valid
if (!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo "ID tidak valid.";
    exit();
}

$id = $_GET["id"];

// Proses update data warga
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST["nik"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];

    $query_update = "UPDATE tb_warga SET nik='$nik', nama_lengkap='$nama_lengkap', no_hp='$no_hp', alamat='$alamat' WHERE id = $id";

    if (mysqli_query($koneksi, $query_update)) {
        // header("Location: index.php");
        header("Location: index.php?page=warga");
        exit();
    } else {
        echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
    }
}
// http://localhost/iuran/app/index.php?page=warga
// http://localhost/iuran/app/?page=editwarga&&id=6
// http://localhost/iuran/app/index.php?page=warga

// Query untuk mengambil data warga berdasarkan ID
$query = "SELECT * FROM tb_warga WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nik = $row["nik"];
    $nama_lengkap = $row["nama_lengkap"];
    $no_hp = $row["no_hp"];
    $alamat = $row["alamat"];
} else {
    echo "Data warga tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Data Warga</h2>
    <!-- <form method="post" action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
    ) . "?id=$id"; ?>"> -->
    <form method="post" action="">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?php echo htmlspecialchars(
                $nik
            ); ?>">
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars(
                $nama_lengkap
            ); ?>">
        </div>
        <div class="form-group">
            <label for="no_hp">Nomor HP:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars(
                $no_hp
            ); ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat"><?php echo htmlspecialchars(
                $alamat
            ); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>

</body>
</html>

<?php // Tutup koneksi
mysqli_close($koneksi);
?>
