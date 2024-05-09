<?php
include '../conf/db_connection.php';
// Koneksi ke database
// $host = 'localhost';
// $username = 'username'; // Ganti dengan username MySQL Anda
// $password = 'password'; // Ganti dengan password MySQL Anda
// $database = 'nama_database'; // Ganti dengan nama database Anda
// $conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil dokumen yang memiliki status publish
$sql = "SELECT * FROM tb_dokumen WHERE status='aktif'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokumen yang Dapat Diunduh</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Daftar Dokumen yang Dapat Diunduh</h2>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Inisialisasi nomor urut
                    $nomor_urut = 1;

                    // Tampilkan daftar dokumen dalam bentuk tabel
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $nomor_urut++ . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td><a href='" . $row['file_path'] . "' download>Unduh</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada dokumen yang dapat diunduh saat ini.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>