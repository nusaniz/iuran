<?php 
include '../conf/db_connection.php';
// session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

// Tentukan jumlah data yang akan ditampilkan per halaman
$limit = 5;

// Hitung total jumlah data tagihan
$count_query = "SELECT COUNT(*) as total FROM tb_payments";
$query = "SELECT tb_payments.payment_id, tb_payments.user_id, tb_users.username, tb_users.nama_lengkap, tb_payments.amount, tb_payments.status, tb_payments.invoice_date, tb_payments.payment_date , tb_payments.kode_transaksi 
          FROM tb_payments
          INNER JOIN tb_users ON tb_payments.user_id = tb_users.user_id";

$search = isset($_GET['search']) ? $_GET['search'] : '';
// Tambahkan kondisi WHERE jika ada pencarian
if (!empty($search)) {
    $count_query .= " INNER JOIN tb_users ON tb_payments.user_id = tb_users.user_id WHERE tb_payments.payment_id LIKE '%$search%' OR tb_payments.kode_transaksi LIKE '%$search%' OR tb_users.username LIKE '%$search%' OR tb_users.nama_lengkap LIKE '%$search%' OR tb_payments.amount LIKE '%$search%' OR tb_payments.status LIKE '%$search%' OR tb_payments.invoice_date LIKE '%$search%' OR tb_payments.payment_date LIKE '%$search%'";
    $query .= " WHERE tb_payments.payment_id LIKE '%$search%' OR tb_payments.kode_transaksi LIKE '%$search%' OR tb_users.username LIKE '%$search%' OR tb_users.nama_lengkap LIKE '%$search%' OR tb_payments.amount LIKE '%$search%' OR tb_payments.status LIKE '%$search%' OR tb_payments.invoice_date LIKE '%$search%' OR tb_payments.payment_date LIKE '%$search%'";
}

$result_count = mysqli_query($conn, $count_query);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// Hitung total jumlah halaman
$total_pages = ceil($total_records / $limit);

// Tentukan halaman saat ini
$current_page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
// $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;


// Hitung offset
// $offset = ($current_page - 1) * $limit;
$offset = max(0, ($current_page - 1) * $limit);


// Query untuk menampilkan data tagihan sesuai dengan halaman saat ini dan kata kunci pencarian
$query .= " LIMIT $offset, $limit";

// Eksekusi query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Tagihan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       /* Tambahkan warna hijau pada sel tabel dengan status "lunas" */
        td[data-status="lunas"] {
            background-color: #c8e6c9; /* Warna hijau */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Form Tagihan</h2>
                <form action="proses_tagihan.php" method="post">
                    <label for="username">Username:</label>
                    <select name="username" id="username" class="form-control">
                        <?php            
                        // Query untuk mendapatkan daftar username dari tabel tb_users
                        $query_user = "SELECT username,nama_lengkap FROM tb_users";
                        $result_user = mysqli_query($conn, $query_user);
                        
                        // Tampilkan opsi username
                        while ($row_user = mysqli_fetch_array($result_user)) {
                            echo "<option value='" . $row_user['username'] . "'>" . $row_user['username'] . " (" . $row_user['nama_lengkap'] . ")</option>";
                        }
                        ?>
                    </select>
                    
                    <label for="amount">Amount Tagihan:</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                    
                    <input type="submit" value="Buat Tagihan" class="btn btn-primary">
                </form>

                <!-- Form untuk membuat tagihan kepada seluruh user -->
                <form action="proses_tagihan_all.php" method="post">
                    <label for="amount_all">Nominal Tagihan untuk Seluruh User:</label>
                    <input type="number" name="amount_all" id="amount_all" class="form-control" required>
                    
                    <input type="submit" value="Buat Tagihan untuk Seluruh User" class="btn btn-primary">
                </form>

                <!-- Form untuk pencarian data tagihan -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <label for="search">Cari Tagihan:</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan kata kunci">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>

                <h2>Data Tagihan</h2>
                <!-- Tampilkan total data tagihan -->
                <p>Total Data Tagihan: <?php echo $total_records; ?></p>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Tagihan</th>
                            <th scope="col">Tanggal Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = $offset + 1;
                        // Periksa apakah ada data yang ditemukan
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['payment_id'] . "</td>";
                            echo "<td>" . $row['kode_transaksi'] . "</td>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['nama_lengkap'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            // echo "<td>" . $row['status'] . "</td>";
                            echo "<td data-status='" . $row['status'] . "'>" . $row['status'] . "</td>";
                            echo "<td>" . $row['invoice_date'] . "</td>";
                            echo "<td>" . $row['payment_date'] . "</td>";
                            // Tambahkan tombol edit dan hapus dengan link ke halaman terpisah
                            echo "<td>
                                    <a href='index.php?page=edit&&payment_id=" . $row['payment_id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='hapus_tagihan.php?payment_id=" . $row['payment_id'] . "' class='btn btn-sm btn-danger'>Hapus</a>
                                  </td>";
                            // echo "<td>
                            //         <a href='edit_tagihan.php?payment_id=" . $row['payment_id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                            //         <a href='hapus_tagihan.php?payment_id=" . $row['payment_id'] . "' class='btn btn-sm btn-danger'>Hapus</a>
                            //       </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?hal=<?php echo ($current_page - 1); ?>&search=<?php echo $search; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo; Sebelumnya</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for($i = max(1, $current_page - 1); $i <= min($current_page + 1, $total_pages); $i++): ?>
                            <li class="page-item <?php if($current_page == $i) echo 'active'; ?>"><a class="page-link" href="?hal=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?hal=<?php echo ($current_page + 1); ?>&search=<?php echo $search; ?>" aria-label="Next">
                                    <span aria-hidden="true">Selanjutnya &raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap's JavaScript features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($conn);
?>
