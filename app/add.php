<?php
// session_start();
// Memeriksa apakah user sudah login atau belum
// if (!isset($_SESSION['userusername'])) {
//     header("Location: ../login/");
//     exit();
// }
// ?>

<?php
include '../conf/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate ticket_code secara otomatis
    // $ticket_code = generateTicketCode();

    // Ambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Ambil nama file foto
    // $role = $_FILES['role']['username']; // Ambil nama file foto

    // // Upload foto ke server
    // $target_dir = "../uploads/"; // Direktori tempat menyimpan foto
    // $target_file = $target_dir . baseusername($_FILES["role"]["username"]);
    // move_uploaded_file($_FILES["role"]["tmp_username"], $target_file);

    // Insert data baru ke dalam tabel
    $sql = "INSERT INTO tb_users ( username, password, role) VALUES ( '$username', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        echo "Data baru berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fungsi untuk menghasilkan ticket_code secara acak
// function generateTicketCode() {
//     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $ticket_code = '';
//     $length = 8; // Panjang ticket_code yang diinginkan

//     // Generate ticket_code secara acak dengan panjang yang ditentukan
//     for ($i = 0; $i < $length; $i++) {
//         $ticket_code .= $characters[rand(0, strlen($characters) - 1)];
//     }

//     return $ticket_code;
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta username="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Baru</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col">
      <h2>Tambah Data User Baru</h2>
      <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label for="username">Nama:</label>
              <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
              <label for="role">Role:</label>
              <select class="selectpicker form-control" id="role" name="role" data-live-search="true">
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
              </select>
          </div>
      <!-- <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>"> -->
          <button type="submit" class="btn btn-primary">Tambah Data</button>
      </form>
    </div>
  </div>
</div>

    
</body>
</html>