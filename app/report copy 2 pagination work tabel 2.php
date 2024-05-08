<?php
// Include database connection file
include '../conf/db_connection.php';

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query to get total nominal 'lunas', total nominal 'belum dibayar', total data status 'lunas', and total data status 'belum dibayar' for each date
$query_totals = "SELECT 
                    DATE(payment_date) AS tanggal,
                    SUM(CASE WHEN status = 'lunas' THEN amount ELSE 0 END) AS total_nominal_lunas,
                    SUM(CASE WHEN status = 'belum dibayar' THEN amount ELSE 0 END) AS total_nominal_belum_dibayar,
                    COUNT(CASE WHEN status = 'lunas' THEN 1 END) AS total_data_lunas,
                    COUNT(CASE WHEN status = 'belum dibayar' THEN 1 END) AS total_data_belum_dibayar
                FROM tb_payments
                GROUP BY tanggal
                ORDER BY tanggal DESC";

$result_totals = mysqli_query($conn, $query_totals);

// Check for query execution error
if (!$result_totals) {
    die("Query gagal: " . mysqli_error($conn));
}

// Convert query results into an array
$data_totals = array();
while ($row_totals = mysqli_fetch_assoc($result_totals)) {
    $data_totals[] = $row_totals;
}

// Query to get total nominal per month where the status is 'lunas'
$query_month = "SELECT YEAR(payment_date) AS tahun, MONTH(payment_date) AS bulan, SUM(amount) AS total_nominal 
                FROM tb_payments 
                WHERE status = 'lunas' 
                GROUP BY tahun, bulan 
                ORDER BY tahun DESC, bulan DESC";

$result_month = mysqli_query($conn, $query_month);

// Check for query execution error
if (!$result_month) {
    die("Query gagal: " . mysqli_error($conn));
}

// Convert query results into an array
$data_month = array();
while ($row_month = mysqli_fetch_assoc($result_month)) {
    $data_month[] = $row_month;
}


// Pagination tabel tanggal
    // Mengatur jumlah baris per halaman
    $rowsPerPage = 5;

    // Menghitung jumlah total baris
    $totalRows = count($data_totals);

    // Menghitung jumlah halaman
    $totalPages = ceil($totalRows / $rowsPerPage);

    // Mendapatkan halaman saat ini
    if (isset($_GET['hal']) && is_numeric($_GET['hal'])) {
        $currentPage = (int)$_GET['hal'];
    } else {
        $currentPage = 1;
    }

    // Memastikan halaman saat ini berada dalam rentang yang valid
    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    } elseif ($currentPage < 1) {
        $currentPage = 1;
    }

    // Menghitung offset untuk query
    $offset = ($currentPage - 1) * $rowsPerPage;

    // Mengambil data untuk halaman saat ini
    $dataPerPage = array_slice($data_totals, $offset, $rowsPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Nominal Pembayaran Lunas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Data pembayaran lunas tiap bulan -->
        <h1>Total Nominal Pembayaran Lunas per Bulan</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Total Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_month as $row_month): ?>
                <tr>
                    <td><?php echo $row_month["bulan"]; ?></td>
                    <td><?php echo $row_month["tahun"]; ?></td>
                    <td><?php echo $row_month["total_nominal"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Data pembayaran tiap tanggal -->
        <h1>Total Nominal dan Data Pembayaran per Tanggal</h1>

        <canvas id="paymentChart" width="800" height="400"></canvas>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Total Nominal Lunas</th>
                    <th>Total Nominal Belum Dibayar</th>
                    <th>Total Data Lunas</th>
                    <th>Total Data Belum Dibayar</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($dataPerPage as $row_totals): ?>
            <tr>
                <td><?php echo $row_totals["tanggal"]; ?></td>
                <td><?php echo $row_totals["total_nominal_lunas"]; ?></td>
                <td><?php echo $row_totals["total_nominal_belum_dibayar"]; ?></td>
                <td><?php echo $row_totals["total_data_lunas"]; ?></td>
                <td><?php echo $row_totals["total_data_belum_dibayar"]; ?></td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <div class="row">
    <div class="col">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=report&&hal=<?php echo ($currentPage - 1); ?>">Previous</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=report&&hal=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=report&&hal=<?php echo ($currentPage + 1); ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Ambil data dari PHP dan simpan ke dalam variabel JavaScript
    var tanggal = <?php echo json_encode(array_reverse(array_column($data_totals, 'tanggal'))); ?>;
    var totalNominalLunas = <?php echo json_encode(array_reverse(array_column($data_totals, 'total_nominal_lunas'))); ?>;
    var totalNominalBelumDibayar = <?php echo json_encode(array_reverse(array_column($data_totals, 'total_nominal_belum_dibayar'))); ?>;
    var totalDataLunas = <?php echo json_encode(array_reverse(array_column($data_totals, 'total_data_lunas'))); ?>;
    var totalDataBelumDibayar = <?php echo json_encode(array_reverse(array_column($data_totals, 'total_data_belum_dibayar'))); ?>;

    // Ambil elemen canvas
    var ctx = document.getElementById('paymentChart').getContext('2d');

    // Buat grafik
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tanggal,
            datasets: [{
                label: 'Total Nominal Lunas',
                data: totalNominalLunas,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Biru
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Total Nominal Belum Dibayar',
                data: totalNominalBelumDibayar,
                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Merah
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Total Data Lunas',
                data: totalDataLunas,
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Hijau
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Total Data Belum Dibayar',
                data: totalDataBelumDibayar,
                backgroundColor: 'rgba(255, 206, 86, 0.5)', // Kuning
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
