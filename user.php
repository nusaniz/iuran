<?php
include 'conf/db_connection.php';
// session_start();

// Pastikan pengguna sudah login sebelum menampilkan halaman
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// conn ke database (sesuaikan dengan pengaturan Anda)
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

// Ambil data pengguna dari sesi
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Pagination
$records_per_page = 5; // Menampilkan 5 data per halaman
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 1; // Konversi nilai $_GET['page'] menjadi integer
// $start_from = ($page - 1) * $records_per_page;
$start_from = max(0, ($hal - 1) * $records_per_page); // Pastikan $start_from tidak kurang dari 0

// Inisialisasi variabel pencarian
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil data riwayat iuran pengguna berdasarkan user_id dan diurutkan berdasarkan tanggal pembayaran terbaru
$query = "SELECT * FROM tb_payments WHERE user_id='$user_id'";
// Tambahkan kondisi pencarian jika query pencarian tidak kosong
if (!empty($search_query)) {
    // $query .= " AND kode_transaksi LIKE '%$search_query%'";
    $query .=  "AND (kode_transaksi LIKE '%$search_query%' OR status LIKE '%$search_query%')";
}
$query .= " ORDER BY payment_date DESC LIMIT $start_from, $records_per_page";

$result = mysqli_query($conn, $query);

// Query untuk menghitung jumlah total record
$total_rows_query = "SELECT COUNT(*) AS total_rows FROM tb_payments WHERE user_id='$user_id'";
// Tambahkan kondisi pencarian jika query pencarian tidak kosong
if (!empty($search_query)) {
    $total_rows_query .= " AND kode_transaksi LIKE '%$search_query%'";
}
$total_rows_result = mysqli_query($conn, $total_rows_query);
$total_rows_data = mysqli_fetch_assoc($total_rows_result);
$total_rows = $total_rows_data['total_rows'];

// Query untuk menghitung jumlah tagihan belum dibayar pengguna
$query_belum_dibayar = "SELECT COUNT(*) AS jumlah_belum_dibayar, SUM(amount) AS total_nominal_belum_dibayar FROM tb_payments WHERE user_id='$user_id' AND status='belum dibayar'";
$result_belum_dibayar = mysqli_query($conn, $query_belum_dibayar);
$row_belum_dibayar = mysqli_fetch_assoc($result_belum_dibayar);
$total_belum_dibayar = $row_belum_dibayar['jumlah_belum_dibayar'];
$total_nominal_belum_dibayar = $row_belum_dibayar['total_nominal_belum_dibayar'];

// Query untuk menghitung jumlah tagihan yang telah lunas
$query_lunas = "SELECT COUNT(*) AS jumlah_lunas, SUM(amount) AS total_nominal_lunas FROM tb_payments WHERE user_id='$user_id' AND status='lunas'";
$result_lunas = mysqli_query($conn, $query_lunas);
$row_lunas = mysqli_fetch_assoc($result_lunas);
$total_lunas = $row_lunas['jumlah_lunas'];
$total_nominal_lunas = $row_lunas['total_nominal_lunas'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Aplikasi Pencatat Iuran Warga</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row mt-3">
            <div class="col">
                <h2>Selamat datang, <?php echo $username; ?>!</h2>
            </div>
        </div>

        <!-- Form Pencarian -->
        <div class="row">
            <div class="col-md-6">
                <form action="" method="GET" class="form-inline">
                    <input type="text" name="page" class="form-control mb-2 mr-sm-2" placeholder="Cari berdasarkan kode transaksi..." value="home" hidden>
                    <input type="text" name="search" class="form-control mb-2 mr-sm-2" placeholder="Cari berdasarkan kode transaksi..." value="<?php echo $search_query; ?>">
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2>Riwayat Iuran</h2>
                <?php
                // Hitung data yang ditampilkan
                $end_from = min($start_from + $records_per_page, $total_rows);
                ?>
                <p>Menampilkan <?php echo $start_from + 1; ?> sampai <?php echo $end_from; ?> dari <?php echo $total_rows; ?> data</p>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Jumlah Tagihan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = $start_from + 1; 
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['kode_transaksi']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['payment_date']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php 
                        // Hitung jumlah halaman
                        $total_pages = ceil($total_rows / $records_per_page);
                        
                        // Tentukan halaman "Sebelumnya" dan "Selanjutnya"
                        $prev_page = max(1, $hal - 1);
                        $next_page = min($total_pages, $hal + 1);

                        // Tampilkan tombol "Sebelumnya"
                        echo "<li class='page-item'><a class='page-link' href='?page=home&&hal=$prev_page&search=$search_query'>Sebelumnya</a></li>";

                        // Tentukan rentang pagination yang akan ditampilkan
                        $start_range = max(1, $hal - 1);
                        $end_range = min($total_pages, $hal + 1);

                        // Tampilkan pagination
                        for ($i = $start_range; $i <= $end_range; $i++) {
                            // Tambahkan kelas 'active' pada halaman aktif
                            $active_class = ($i == $hal) ? 'active' : '';
                            echo "<li class='page-item $active_class'><a class='page-link' href='?page=home&&hal=$i&search=$search_query'>$i</a></li>";
                        }

                        // Tampilkan tombol "Selanjutnya"
                        echo "<li class='page-item'><a class='page-link' href='?page=home&&hal=$next_page&search=$search_query'>Selanjutnya</a></li>";
                        ?>
                    </ul>
                </nav>
            </div>
        </div>


        <!-- Pagination -->
        <!-- <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php 
                        // Hitung jumlah halaman
                        $total_pages = ceil($total_rows / $records_per_page);
                        for ($i = 1; $i <= $total_pages; $i++) {
                            // Tambahkan kelas 'active' pada halaman aktif
                            $active_class = ($i == $hal) ? 'active' : '';
                            echo "<li class='page-item $active_class'><a class='page-link' href='?page=home&&hal=$i&search=$search_query'>$i</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div> -->

        <div class="row mt-3">
            <div class="col-12">
                <h2>Total Iuran</h2>
                <p>Total Lunas: <?php echo $total_lunas; ?> tagihan, Rp <?php echo $total_nominal_lunas; ?></p>
                <p>Total Belum Dibayar: <?php echo $total_belum_dibayar; ?> tagihan, Rp <?php echo $total_nominal_belum_dibayar; ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>