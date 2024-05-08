<?php
include '../conf/db_connection.php';

// session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../user_dashboard.php");
    exit();
}

// conn ke database (ganti sesuai dengan pengaturan Anda)
// $host = "localhost";
// $db_username = "root";
// $db_password = "";
// $database = "db_iuran";
// $conn = mysqli_connect($host, $db_username, $db_password, $database);

// Cek conn
if (mysqli_connect_errno()) {
    echo "conn database gagal: " . mysqli_connect_error();
    exit();
}

// Pagination
$records_per_page = 10;
$current_page = isset($_GET['pagee']) && is_numeric($_GET['pagee']) ? (int)$_GET['pagee'] : 1;

// Tambahkan logika pencarian jika ada kata kunci pencarian yang diberikan
$where_clause = "";
$search_keyword = "";
if(isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
    $where_clause = " WHERE username LIKE '%$keyword%'";
    $search_keyword = "&keyword=" . urlencode($keyword);
}

// Query untuk mengambil jumlah total data sesuai dengan kriteria pencarian
$query_count = "SELECT COUNT(*) AS total_records FROM tb_users" . $where_clause;
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total_records'];

// Menghitung total halaman berdasarkan jumlah total data yang sesuai dengan kriteria pencarian
$total_pages = ceil($total_records / $records_per_page);

// Menyesuaikan halaman saat ini agar tidak melampaui halaman terakhir setelah pencarian
$current_page = min($current_page, $total_pages);

// Menghitung offset kembali berdasarkan halaman saat ini
$offset = ($current_page - 1) * $records_per_page;

// Query untuk mengambil daftar pengguna dengan total lunas, total belum bayar, dan jumlah belum bayar sesuai dengan kriteria pencarian
$query_tb_users = "SELECT tb_users.*, 
    SUM(CASE WHEN tb_payments.status = 'lunas' THEN tb_payments.amount ELSE 0 END) AS total_lunas, 
    SUM(CASE WHEN tb_payments.status = 'belum dibayar' THEN tb_payments.amount ELSE 0 END) AS total_belum_bayar,
    COUNT(CASE WHEN tb_payments.status = 'belum dibayar' THEN tb_payments.payment_id ELSE NULL END) AS jumlah_belum_bayar, 
    COUNT(CASE WHEN tb_payments.status = 'lunas' THEN tb_payments.payment_id ELSE NULL END) AS jumlah_lunas 
    FROM tb_users 
    LEFT JOIN tb_payments ON tb_users.user_id = tb_payments.user_id "
    . $where_clause .
    "GROUP BY tb_users.user_id
    LIMIT $offset, $records_per_page";

$result_tb_users = mysqli_query($conn, $query_tb_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Aplikasi Pencatat Iuran Warga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .lunas {
            background-color: lightgreen;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Dashboard Admin - Aplikasi Pencatat Iuran Warga</h2>

    <!-- Formulir Pencarian -->
    <form method="GET" action="index.php">
        <input type="hidden" name="page" value="tagihan">
        <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="Cari Nama Pengguna">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- Menampilkan total lunas dan belum bayar tiap pengguna -->
    <h3 class="mt-4">Total Lunas dan Belum Bayar Tiap Pengguna</h3>
    <p>Total data: <?php echo $total_records; ?></p>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Id</th>
                <th>Nama Pengguna</th>
                <th>Nama Lengkap</th>
                <th>Total Lunas</th>
                <th>Total Belum Bayar</th>
                <th>Jumlah Lunas</th>
                <th>Jumlah Belum Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = ($current_page - 1) * $records_per_page + 1;
            while ($row_tb_users = mysqli_fetch_assoc($result_tb_users)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row_tb_users['user_id'] . "</td>";
                echo "<td>" . $row_tb_users['username'] . "</td>";
                echo "<td>" . $row_tb_users['nama_lengkap'] . "</td>";
                echo "<td>" . $row_tb_users['total_lunas'] . "</td>";
                echo "<td>" . $row_tb_users['total_belum_bayar'] . "</td>";
                echo "<td>" . $row_tb_users['jumlah_lunas'] . "</td>";
                echo "<td>" . $row_tb_users['jumlah_belum_bayar'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="index.php?page=tagihan&pagee=<?php echo $current_page - 1 . $search_keyword; ?>">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?page=tagihan&pagee=<?php echo $i . $search_keyword; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
            <a class="page-link" href="index.php?page=tagihan&pagee=<?php echo $current_page + 1 . $search_keyword; ?>">Berikutnya</a>
        </li>
    </ul>
</div>

<!-- Tutup conn -->
<?php
mysqli_close($conn);
?>

</body>
</html>
