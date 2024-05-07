<?php
// Koneksi ke database
require "../conf/db_connection.php";

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah ada parameter ID yang dikirimkan
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengeksekusi query untuk mendapatkan data berdasarkan ID
    $sql = "SELECT * FROM users WHERE user_id = $id";
    $result = $conn->query($sql);

    // Memeriksa apakah data ditemukan
    if ($result->num_rows > 0) {
        // Mendapatkan data dari hasil query
        $row = $result->fetch_assoc();
        // $nama = $row['nama'];
        // $alamat = $row['alamat'];
        // $email = $row['email'];
        $username = $row['username'];
        $password = $row['password'];
        $role = $row['role'];

        // Periksa apakah ada pesan dari halaman update
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
        }
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>
    <h2>Edit Data</h2>
    <?php if(isset($message)): ?>
        <p class="alert alert-success" role="alert"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <!-- <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        </div> -->

        <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
</div>
<!-- <div class="form-group">
    <label for="role">Role</label>
    <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>">
</div> -->
<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="selectpicker form-control" data-live-search="true">
        <option value="admin" id="role" name="role">admin</option>
        <option value="user" id="role" name="role">user</option>
    </select>
    <!-- <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>"> -->
</div>




        <button type="submit" class="btn btn-primary mt-4"><i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan</button>
    </form>
    <a href="index.php?page=user" class="btn btn-secondary mt-2"><i class="fa-regular fa-circle-left"></i> Kembali</a>
</body>
</html>
