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
    <?php if (
        isset($_GET["page"]) &&
        isset($_GET["add"]) &&
        $_GET["page"] == "addwarga" &&
        $_GET["add"] == "ok"
    ) {
        echo '<div class="alert alert-success mt-3" role="alert">Data warga berhasil ditambahkan.</div>';
    } ?>

    <!-- <?php if (isset($_GET["page"]) && $_GET["add"] == "ok") {
        echo '<div class="alert alert-success mt-3" role="alert">Data warga berhasil ditambahkan.</div>';
    } ?> -->

    <h2 class="mt-4">Formulir Tambah Data Warga</h2>
    <!-- <form method="post" action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
    ); ?>"> -->
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
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
        <div class="form-group">
              <label for="role">Role:</label>
              <select class="selectpicker form-control" id="role" name="role" data-live-search="true">
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
              </select>
          </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>

</body>
</html>

<?php
include '../conf/db_connection.php';
// conn ke database
// $host = "localhost";
// $db_username = "root";
// $db_password = "";
// $database = "db_iuran";
// $conn = mysqli_connect($host, $db_username, $db_password, $database);

// Cek conn
if (mysqli_connect_errno()) {
    die("conn database gagal: " . mysqli_connect_error());
}

// Proses input data warga
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nik = $_POST["nik"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];
    $role = $_POST["role"];

    // Query untuk memasukkan data ke tabel warga
    $query = "INSERT INTO tb_users (username, password, nik, nama_lengkap, no_hp, alamat, role) VALUES ('$username','$password','$nik', '$nama_lengkap', '$no_hp', '$alamat', '$role')";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data warga berhasil ditambahkan.");</script>';
        // header("Location: index.php");
        header("Location: index.php?page=addwarga&&add=ok");
    } else {
        echo '<script>alert("Error: ' .
            $query .
            '\n' .
            mysqli_error($conn) .
            '");</script>';
    }
}
?>

<?php // Tutup conn
mysqli_close($conn);
?>
