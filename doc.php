<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'conf/db_connection.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil dokumen yang memiliki status publish
$sql = "SELECT * FROM tb_dokumen WHERE status='aktif'";

// Inisialisasi variabel untuk pencarian dan pagination
$search = isset($_GET['search']) ? $_GET['search'] : '';
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 1;
$limit = 5; // Jumlah data per halaman
// $offset = ($page - 1) * $limit;
$offset = max(0, ($hal - 1) * $limit);

// Query untuk mencari data berdasarkan nama
// $query_search = "SELECT * FROM tb_dokumen WHERE nama LIKE '%$search%'";
$query_search = "SELECT * FROM tb_dokumen WHERE nama LIKE '%$search%' AND status='aktif'";

// Query untuk menghitung jumlah total data
$query_count = "SELECT COUNT(*) as total FROM tb_dokumen WHERE nama LIKE '%$search%' AND status='aktif'";
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];

// Hitung jumlah halaman
$total_pages = ceil($total_data / $limit);

// Query untuk menampilkan data dengan pagination
$query = $query_search . " LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokumen yang Dapat Diunduh</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Daftar Dokumen yang Dapat Diunduh</h2>
                <!-- Form pencarian -->
                <!-- <form action="doc.php" method="GET" class="mb-3"> -->
                <form action="" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari berdasarkan nama" name="page" value="dokumen" hidden>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan nama" name="search" value="<?php echo $search; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>

                <!-- http://localhost/iuran/app/index.php?page=viewdoc&&search=asd -->

                <!-- total data -->
                <p>Total data: <?php echo $total_data; ?></p>
                
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor_urut = $offset + 1; // Inisialisasi nomor urut

                        // Tampilkan daftar dokumen dalam bentuk tabel
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $nomor_urut++ . "</td>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td>" . $row['keterangan'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                // echo "<td><a href='" . $row['file_path'] . "' download>Unduh</a></td>";
                                echo "<td><a href='app/download.php?file=" . basename($row['file_path']) . "' download>Unduh</a></td>";
                                echo "</tr>";
                                // localhost/iuran/app/download.php?file=Book4.csv
                            }
                        } else {
                            echo "<tr><td colspan='3'>Tidak ada dokumen yang dapat diunduh saat ini.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo ($hal <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=dokumen&&hal=<?php echo ($hal <= 1) ? 1 : ($hal - 1); ?>&search=<?php echo $search; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($i = max(1, $hal - 1); $i <= min($hal + 1, $total_pages); $i++) { ?>
                            <li class="page-item <?php echo ($hal == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=dokumen&&hal=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo ($hal >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=dokumen&&hal=<?php echo ($hal >= $total_pages) ? $total_pages : ($hal + 1); ?>&search=<?php echo $search; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
