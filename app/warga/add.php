<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tambah Data Warga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Formulir Tambah Data Warga</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik">
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
        </div>
        <div class="form-group">
            <label for="no_hp">Nomor HP:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>

</body>
</html>

<?php
// Koneksi ke database
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "db_warga";
$koneksi = mysqli_connect($host, $db_username, $db_password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Proses input data warga
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // Query untuk memasukkan data ke tabel warga
    $query = "INSERT INTO tb_warga (nik, nama_lengkap, no_hp, alamat) VALUES ('$nik', '$nama_lengkap', '$no_hp', '$alamat')";

    if (mysqli_query($koneksi, $query)) {
        echo '<script>alert("Data warga berhasil ditambahkan.");</script>';
        header("Location: index.php");
    } else {
        echo '<script>alert("Error: ' . $query . '\n' . mysqli_error($koneksi) . '");</script>';
    }
}
?>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>
