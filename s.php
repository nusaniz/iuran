<?php
// Koneksi ke database
$host = "localhost"; // Ganti dengan host Anda
$username = "root"; // Ganti dengan username Anda
$password = ""; // Ganti dengan password Anda
$database = "db_booking"; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Jumlah data per halaman
$per_halaman = 10;

// Halaman aktif
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$mulai = ($halaman - 1) * $per_halaman;

// Query data dengan limit
$query = "SELECT * FROM bookings LIMIT $mulai, $per_halaman";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bookings</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Data Bookings</h2>
    <table class="table table-hover" border=0 style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Penjemputan</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['kode_booking'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['tanggal_penjemputan'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <?php
    $query = "SELECT COUNT(*) AS total FROM bookings";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    $total_halaman = ceil($data['total'] / $per_halaman);

    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $total_halaman; $i++) {
        echo "<li class='page-item'><a class='page-link' href='?halaman=$i'>$i</a></li>";
    }
    echo "</ul>";
    ?>
</div>

</body>
</html>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>
