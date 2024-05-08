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


// Tentukan parameter pagination
$rows_per_page = 5; // Misalnya, 10 item per halaman
$current_page_month = isset($_GET['page_month']) ? $_GET['page_month'] : 1;
$current_page_totals = isset($_GET['page_totals']) ? $_GET['page_totals'] : 1;

// Hitung offset untuk query
$offset_month = ($current_page_month - 1) * $rows_per_page;
$offset_totals = ($current_page_totals - 1) * $rows_per_page;

// Ubah query untuk memperhitungkan offset dan limit
$query_month .= " LIMIT $offset_month, $rows_per_page";
$query_totals .= " LIMIT $offset_totals, $rows_per_page";

// Function untuk rendering pagination
function renderPagination($total_pages, $current_page, $url_param) {
    $pagination = '<nav aria-label="Page navigation"><ul class="pagination">';
    $prev_class = ($current_page == 1) ? 'disabled' : '';
    $pagination .= '<li class="page-item ' . $prev_class . '"><a class="page-link" href="?'.$url_param.'=' . ($current_page - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($current_page == $i) ? 'active' : '';
        $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="?'.$url_param.'=' . $i . '">' . $i . '</a></li>';
    }
    $next_class = ($current_page == $total_pages || $total_pages == 0) ? 'disabled' : '';
    $pagination .= '<li class="page-item ' . $next_class . '"><a class="page-link" href="?'.$url_param.'=' . ($current_page + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
    $pagination .= '</ul></nav>';
    return $pagination;
}



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

        <!-- Pagination untuk data pembayaran lunas tiap bulan -->
        <?php echo renderPagination(ceil(count($data_month) / $rows_per_page), $current_page_month, 'page_month'); ?>

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
                <?php foreach ($data_totals as $row_totals): ?>
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

        <!-- Pagination untuk data pembayaran tiap tanggal -->
        <?php echo renderPagination(ceil(count($data_totals) / $rows_per_page), $current_page_totals, 'page_totals'); ?>
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
