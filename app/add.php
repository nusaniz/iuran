<?php
// session_start();
// Memeriksa apakah user sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: ../login/");
    exit();
}
?>

<?php
include '../conf/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate ticket_code secara otomatis
    $ticket_code = generateTicketCode();

    // Ambil data dari formulir
    $name = $_POST['name'];
    $seat = $_POST['seat'];
    $photo = $_FILES['photo']['name']; // Ambil nama file foto

    // Upload foto ke server
    $target_dir = "../uploads/"; // Direktori tempat menyimpan foto
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    // Insert data baru ke dalam tabel
    $sql = "INSERT INTO halo (ticket_code, name, seat, photo) VALUES ('$ticket_code', '$name', '$seat', '$photo')";
    if (mysqli_query($conn, $sql)) {
        echo "Data baru berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fungsi untuk menghasilkan ticket_code secara acak
function generateTicketCode() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $ticket_code = '';
    $length = 8; // Panjang ticket_code yang diinginkan

    // Generate ticket_code secara acak dengan panjang yang ditentukan
    for ($i = 0; $i < $length; $i++) {
        $ticket_code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $ticket_code;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Baru</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>
    <h2>Tambah Data Baru</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name"><br>
        <label for="seat">Seat:</label>
        <input type="text" id="seat" name="seat" ><br>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo" accept="image/*" ><br>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</body>
</html>





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h2>Tambah Data Baru</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name"><br>
        <label for="seat">Seat:</label>
        <input type="text" id="seat" name="seat" ><br>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo" accept="image/*" ><br>
        <button type="submit" class="btn btn-primary">Tambah Data</button>

        <form>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
    <small id="nameHelp" class="form-text text-muted">Enter your name.</small>
  </div>
  <div class="form-group">
    <label for="seat">Seat</label>
    <input type="text" class="form-control" id="seat" name="seat">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </div>
</form>
    </div>
  </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../bootstrap/js/jquery-3.5.1.min.js"></script>