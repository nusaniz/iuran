<?php
// Koneksi ke database
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "db_booking";
$koneksi = mysqli_connect($host, $db_username, $db_password, $database);

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Fungsi untuk mengambil jumlah data
function countRecords($koneksi, $search = "") {
    $query = "SELECT COUNT(*) AS total FROM bookings";
    if (!empty($search)) {
        $query .= " WHERE nama LIKE '%$search%'";
    }
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

// Fungsi untuk menampilkan data dengan pagination
function fetchData($koneksi, $start, $per_page, $search = "") {
    $query = "SELECT * FROM bookings";
    if (!empty($search)) {
        $query .= " WHERE nama LIKE '%$search%'";
    }
    $query .= " LIMIT $start, $per_page";
    $result = mysqli_query($koneksi, $query);
    $output = "";
    $no = $start + 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>";
        $output .= "<td>" . $no++ . "</td>";
        $output .= "<td>" . $row['nama'] . "</td>";
        $output .= "<td>" . $row['kode_booking'] . "</td>";
        $output .= "</tr>";
    }
    return $output;
}

// Tentukan jumlah data per halaman
$per_page = 10;

// Hitung jumlah total data
$total_records = countRecords($koneksi, $_GET['search']);

// Hitung jumlah halaman
$total_pages = ceil($total_records / $per_page);

// Tentukan halaman saat ini
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung data awal yang akan ditampilkan pada halaman saat ini
$start = ($current_page - 1) * $per_page;

// Ambil data sesuai dengan pencarian dan halaman saat ini
$table_data = fetchData($koneksi, $start, $per_page, $_GET['search']);

// Buat pagination
$pagination_data = '';
if ($total_pages > 1) {
    $pagination_data .= '<li class="page-item '.($current_page == 1 ? 'disabled' : '').'"><a class="page-link" href="?page='.($current_page - 1).'&search='.$_GET['search'].'">Sebelumnya</a></li>';
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination_data .= '<li class="page-item '.($current_page == $i ? 'active' : '').'"><a class="page-link" href="?page='.$i.'&search='.$_GET['search'].'">'.$i.'</a></li>';
    }
    $pagination_data .= '<li class="page-item '.($current_page == $total_pages ? 'disabled' : '').'"><a class="page-link" href="?page='.($current_page + 1).'&search='.$_GET['search'].'">Selanjutnya</a></li>';
}

echo json_encode([
    'table_data' => $table_data,
    'pagination_data' => $pagination_data,
    'total_records' => $total_records
]);

// Tutup koneksi database
mysqli_close($koneksi);
?>
