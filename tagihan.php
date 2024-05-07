<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

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

// Fungsi untuk generate kode transaksi otomatis
function generateTransactionCode($koneksi) {
    // Mendapatkan tanggal dan waktu saat ini
    $currentDateTime = date("YmdHis");

    // Mendapatkan beberapa karakter acak untuk menambahkan ke kode transaksi
    $randomChars = substr(md5(uniqid(mt_rand(), true)), 0, 4);

    // Menggabungkan tanggal, waktu, dan karakter acak untuk membuat kode transaksi
    $transactionCode = "TRX-" . $currentDateTime . "-" . $randomChars;

    // Periksa keberadaan kode transaksi dalam database
    $query_check_duplicate = "SELECT COUNT(*) AS total FROM payments WHERE kode_transaksi='$transactionCode'";
    $result_check_duplicate = mysqli_query($koneksi, $query_check_duplicate);
    $row_check_duplicate = mysqli_fetch_assoc($result_check_duplicate);
    $total_duplicates = $row_check_duplicate['total'];

    // Jika kode transaksi duplikat, panggil fungsi kembali untuk menghasilkan kode baru
    if ($total_duplicates > 0) {
        return generateTransactionCode($koneksi);
    } else {
        return $transactionCode;
    }
}

// Search feature untuk tabel Total Lunas dan Belum Bayar Tiap Pengguna
$search_users = isset($_GET['search_users']) ? $_GET['search_users'] : '';

// Query untuk mengambil daftar pengguna dengan filter pencarian
$query_users = "SELECT users.*, 
    SUM(CASE WHEN payments.status = 'lunas' THEN payments.amount ELSE 0 END) AS total_lunas, 
    SUM(CASE WHEN payments.status = 'belum dibayar' THEN payments.amount ELSE 0 END) AS total_belum_bayar,
    COUNT(CASE WHEN payments.status = 'belum dibayar' THEN payments.payment_id ELSE NULL END) AS jumlah_belum_bayar 
    FROM users 
    LEFT JOIN payments ON users.user_id = payments.user_id ";

// Tambahkan kondisi pencarian jika ada
if ($search_users != '') {
    $query_users .= "WHERE users.username LIKE '%$search_users%'";
}

$query_users .= " GROUP BY users.user_id";

$result_users = mysqli_query($koneksi, $query_users);

// Total data yang sesuai dengan hasil pencarian
$total_records_search = mysqli_num_rows($result_users);

// Pagination
$records_per_page = 10;
$total_pages = ceil($total_records_search / $records_per_page);
$current_page = isset($_GET['halaman']) && is_numeric($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$current_page = max(1, min($total_pages, $current_page));
$offset = ($current_page - 1) * $records_per_page;

$query_users .= " LIMIT $offset, $records_per_page";
$result_users = mysqli_query($koneksi, $query_users);

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

    <!-- Form untuk pencarian pada tabel Total Lunas dan Belum Bayar Tiap Pengguna -->
    <form action="" method="GET" class="mt-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." name="search_users" value="<?php echo $search_users; ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <!-- Menampilkan total lunas dan belum bayar tiap pengguna -->
    <h3 class="mt-4">Total Lunas dan Belum Bayar Tiap Pengguna</h3>
    <p>Total data: <?php echo $total_records_search; ?></p>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Total Lunas</th>
                <th>Total Belum Bayar</th>
                <th>Jumlah Belum Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = ($current_page - 1) * $records_per_page + 1;
            while ($row_users = mysqli_fetch_assoc($result_users)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row_users['username'] . "</td>";
                echo "<td>" . $row_users['total_lunas'] . "</td>";
                echo "<td>" . $row_users['total_belum_bayar'] . "</td>";
                echo "<td>" . $row_users['jumlah_belum_bayar'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="admin.php?page=tagihan&halaman=<?php echo $current_page - 1 . ($search_users ? '&search_users=' . $search_users : ''); ?>">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="admin.php?page=tagihan&halaman=<?php echo $i . ($search_users ? '&search_users=' . $search_users : ''); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
            <a class="page-link" href="admin.php?page=tagihan&halaman=<?php echo $current_page + 1 . ($search_users ? '&search_users=' . $search_users : ''); ?>">Berikutnya</a>
        </li>
    </ul>

</div>

<!-- Tutup koneksi -->
<?php
mysqli_close($koneksi);
?>

</body>
</html>
