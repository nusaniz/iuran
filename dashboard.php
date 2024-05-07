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

// Query untuk mengambil daftar pengguna
$query_users = "SELECT users.*, 
    SUM(CASE WHEN payments.status = 'lunas' THEN payments.amount ELSE 0 END) AS total_lunas, 
    SUM(CASE WHEN payments.status = 'belum dibayar' THEN payments.amount ELSE 0 END) AS total_belum_bayar,
    COUNT(CASE WHEN payments.status = 'belum dibayar' THEN payments.payment_id ELSE NULL END) AS jumlah_belum_bayar 
    FROM users 
    LEFT JOIN payments ON users.user_id = payments.user_id 
    GROUP BY users.user_id";
$result_users = mysqli_query($koneksi, $query_users);

// Search feature
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query_payments = "SELECT users.username, payments.amount, payments.invoice_date, payments.kode_transaksi, payments.status, payments.payment_date, payments.payment_id 
                    FROM users 
                    LEFT JOIN payments ON users.user_id = payments.user_id 
                    WHERE users.username LIKE '%$search%' OR payments.kode_transaksi LIKE '%$search%'";
$result_payments = mysqli_query($koneksi, $query_payments);
$total_records = mysqli_num_rows($result_payments);

// Batasi jumlah data per halaman
$records_per_page = 10;

// Hitung jumlah total halaman
$total_pages = ceil($total_records / $records_per_page);

// Tentukan halaman saat ini
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Pastikan halaman saat ini tidak lebih besar dari total halaman yang tersedia
if ($current_page > $total_pages) {
    $current_page = $total_pages;
}

// Pastikan halaman saat ini tidak kurang dari 1
if ($current_page < 1) {
    $current_page = 1;
}

// Hitung offset untuk query database
$offset = ($current_page - 1) * $records_per_page;

// Perbarui query untuk menambahkan LIMIT dan OFFSET
$query_payments .= " LIMIT $offset, $records_per_page";
$result_payments = mysqli_query($koneksi, $query_payments);
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

    <!-- Form untuk input data tagihan iuran -->
    <h3>Input Data Tagihan Iuran</h3>
    <form action="process_payment.php" method="post">
        <div class="form-group">
            <label for="user_id">Pilih Pengguna:</label>
            <select id="user_id" name="user_id" class="form-control" required>
                <?php 
                // Tampilkan daftar pengguna sebagai pilihan dropdown
                while ($row_users = mysqli_fetch_assoc($result_users)) {
                    echo "<option value='" . $row_users['user_id'] . "'>" . $row_users['username'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah Tagihan:</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>
        <input type="hidden" name="kode_transaksi" value="<?php echo generateTransactionCode($koneksi); ?>"> <!-- Tambahkan input hidden untuk kode transaksi -->
        <button type="submit" class="btn btn-primary">Input Tagihan</button>
    </form>

    <!-- Form untuk membuat tagihan untuk semua warga -->
    <form action="process_payment_all.php" method="post" class="mt-3">
        <input type="hidden" name="kode_transaksi" value="<?php echo generateTransactionCode($koneksi); ?>">
        <input type="number" name="amount" placeholder="Jumlah Tagihan untuk Semua Warga" class="form-control" required>
        <button type="submit" class="btn btn-primary mt-2">Input Tagihan untuk Semua Warga</button>
    </form>

    <!-- Form untuk pencarian -->
    <form action="" method="GET" class="mt-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." name="search" value="<?php echo $search; ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <!-- Menampilkan jumlah total data -->
    <p>Total data: <?php echo $total_records; ?></p>

    <!-- Menampilkan data tagihan setiap warga -->
    <h3 class="mt-4">Data Tagihan Setiap Warga</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama Pengguna</th>
                <th>Jumlah Tagihan</th>
                <th>Status</th>
                <th>Tgl Tagihan</th>
                <th>Tgl Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = ($current_page - 1) * $records_per_page + 1;
            while ($row_payments = mysqli_fetch_assoc($result_payments)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row_payments['kode_transaksi'] . "</td>";
                echo "<td>" . $row_payments['username'] . "</td>";
                echo "<td>" . $row_payments['amount'] . "</td>";
                echo "<td class='" . ($row_payments['status'] === 'lunas' ? 'lunas' : '') . "'>" . $row_payments['status'] . "</td>";
                echo "<td>" . $row_payments['invoice_date'] . "</td>";
                echo "<td>" . $row_payments['payment_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Tambahkan navigasi pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $current_page - 1 . ($search ? '&search=' . $search : ''); ?>">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i . ($search ? '&search=' . $search : ''); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $current_page + 1 . ($search ? '&search=' . $search : ''); ?>">Berikutnya</a>
        </li>
    </ul>

    <!-- Menampilkan total lunas dan belum bayar tiap pengguna -->
    <h3 class="mt-4">Total Lunas dan Belum Bayar Tiap Pengguna</h3>
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
            $no = 1;
            mysqli_data_seek($result_users, 0); // Reset pointer result set
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

</div>

<!-- Tutup koneksi -->
<?php
mysqli_close($koneksi);
?>

</body>
</html>
