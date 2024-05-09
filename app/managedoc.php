<?php
include '../conf/db_connection.php';

// Inisialisasi variabel untuk pencarian dan pagination
$search = isset($_GET['search']) ? $_GET['search'] : '';
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 1;
$limit = 5; // Jumlah data per halaman
// $offset = ($page - 1) * $limit;
$offset = max(0, ($hal - 1) * $limit);

// Query untuk mencari data berdasarkan nama
// $query_search = "SELECT id, nama, file_path, status, created_at FROM tb_dokumen WHERE nama LIKE '%$search%'";
$query_search = "SELECT * FROM tb_dokumen WHERE nama LIKE '%$search%'";

// Query untuk menghitung jumlah total data
$query_count = "SELECT COUNT(*) as total FROM tb_dokumen WHERE nama LIKE '%$search%'";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokumen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
// Periksa apakah parameter URL 'update' memiliki nilai 'ok'
if (isset($_GET['update']) && $_GET['update'] === 'ok') {
    echo "<script>alert('Perubahan data berhasil');</script>";
}
?>

<div class="container mt-5">
    <h2>Data Dokumen</h2>
    <!-- Form pencarian -->
    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari berdasarkan nama" name="page" value="dokumen" hidden>
            <input type="text" class="form-control" placeholder="Cari berdasarkan nama" name="search" value="<?php echo $search; ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <!-- Tombol tambah data dokumen -->
    <a href="index.php?page=adddokumen" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
    <!-- http://localhost/iuran/app/index.php?page=adddokumen -->

    <!-- total data -->
    <p>Total data: <?php echo $total_data; ?></p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>File Path</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $nomor_urut = $offset + 1; // Inisialisasi nomor urut

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $nomor_urut++ . "</td>"; // Kolom No. increment
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['file_path'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-primary' href='index.php?page=editdoc&&id=" . $row["id"] . "'>Edit</a> ";
                        // http://localhost/iuran/app/index.php?page=dokumen&&hal=1&search=s
                        // echo "<a class='btn btn-danger' href='?page=dokumen&&hapus_id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                        echo "<a class='btn btn-danger' href='?page=dokumen&&hal=" . $hal . "&&search=". $search . "&&hapus_id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data yang tersedia.</td></tr>";
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

</body>
</html>

<?php
// Proses penghapusan data jika ada permintaan hapus
if (isset($_GET["hapus_id"])) {
    $hapus_id = $_GET["hapus_id"];
    $query_hapus = "DELETE FROM tb_dokumen WHERE id = $hapus_id";
    if (mysqli_query($conn, $query_hapus)) {
        echo "<script>alert('Data " . $hapus_id . " berhasil dihapus');</script>";
        echo "<script>window.location.href='index.php?page=dokumen&&hal=$hal&search=$search';</script>";
        // http://localhost/iuran/app/index.php?page=dokumen&&hal=1&search=s
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
        echo "<script>window.location.href='index.php?page=dokumen&&hal=$hal&search=$search';</script>";
    }
}
// Tutup koneksi
mysqli_close($conn);
?>

<!-- http://localhost/iuran/app/index.php?page=dokumen
http://localhost/iuran/app/index.php?page=editdoc&&id=7 -->