<?php include '..\conf\db_connection.php';?>

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
        <!-- <div class="form-group">
            <label for="role">Role:</label>
            <select class="selectpicker form-control" id="role" name="role" data-live-search="true">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div> -->
        <div class="form-group">
        <label for="role">Role:</label>
        <select class="selectpicker form-control" id="role" name="role" data-live-search="true">
        <option value="" selected disabled>Pilih role</option>
        <?php
            // Query untuk mendapatkan nilai-nilai enum dari kolom role
            $enum_query = "SHOW COLUMNS FROM tb_users WHERE Field = 'role'";
            $enum_result = mysqli_query($conn, $enum_query);
            $enum_row = mysqli_fetch_assoc($enum_result);
            // Mengambil nilai enum dari kolom role
            $enum_values = explode("','", substr($enum_row['Type'], 6, -2));
            
            // Buat opsi dropdown sesuai dengan nilai-nilai enum
            foreach ($enum_values as $value) {
                echo '<option value="' . $value . '">' . ucfirst($value) . '</option>';
            }
            ?>
        </select>
        </div>
        <!-- <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <select class="selectpicker form-control" id="jabatan" name="jabatan" data-live-search="true">
                <option value="direktur">direktur</option>
                <option value="pegawai">pegawai</option>
            </select>
        </div> -->
        <div class="form-group">
            <label for="jabatan">Jabatan:</label> <!-- Ubah label -->
            <select class="selectpicker form-control" id="jabatan" name="jabatan" data-live-search="true">
            <option value="" selected disabled>Pilih jabatan</option>
                <?php
                // Query untuk mendapatkan nilai-nilai enum dari kolom jabatan
                $enum_query = "SHOW COLUMNS FROM tb_users WHERE Field = 'jabatan'"; // Ubah 'role' menjadi 'jabatan'
                $enum_result = mysqli_query($conn, $enum_query);
                $enum_row = mysqli_fetch_assoc($enum_result);
                // Mengambil nilai enum dari kolom jabatan
                $enum_values = explode("','", substr($enum_row['Type'], 6, -2));
                
                // Buat opsi dropdown sesuai dengan nilai-nilai enum
                foreach ($enum_values as $value) {
                    echo '<option value="' . $value . '">' . ucfirst($value) . '</option>';
                }
                ?>
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
    $jabatan = $_POST["jabatan"];

    // Query untuk memasukkan data ke tabel warga
    $query = "INSERT INTO tb_users (username, password, nik, nama_lengkap, no_hp, alamat, role, jabatan) VALUES ('$username','$password','$nik', '$nama_lengkap', '$no_hp', '$alamat', '$role', '$jabatan')";

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
