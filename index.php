<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: app/");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database (ganti sesuai dengan pengaturan Anda)
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "db_iuran";
    $koneksi = mysqli_connect($host, $db_username, $db_password, $database);

    // Cek koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal: " . mysqli_connect_error();
        exit();
    }

    // Query untuk mencari user berdasarkan username dan password
    $query = "SELECT * FROM tb_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: app/");
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Pencatat Iuran Warga</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body>

<!-- <h2>Login - Aplikasi Pencatat Iuran Warga</h2> -->

<?php if (isset($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
            <h2 class="text-center mt-4 mb-4">Dusun Songgat</h2>
            <h2 class="text-center mt-4 mb-4">Login</h2>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


<footer class="footer mt-auto py-3">
    <div class="container text-center">
        <span class="text-muted">Developed by Warga &copy; <?php echo date("Y"); ?></span>
    </div>
</footer>


</body>
</html>
