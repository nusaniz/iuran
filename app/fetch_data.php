<?php

require "../conf/db_connection.php";

// Koneksi ke database
// $servername = "localhost";
// $username = "root"; // Ganti dengan username MySQL Anda
// $password = ""; // Ganti dengan password MySQL Anda
// $database = "db_booking"; // Ganti dengan name database Anda

// Membuat koneksi
// $conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menentukan jumlah data per halaman
$show = isset($_POST['show']) ? $_POST['show'] : 10;

// Calculate pagination
$total_query = "SELECT COUNT(*) AS total FROM users";
$total_result = $conn->query($total_query);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $show);

$hal = isset($_GET['hal']) && $_GET['hal'] <= $total_pages ? $_GET['hal'] : 1;
$offset = ($hal - 1) * $show;

// Menghitung total data
$total_data_query = "SELECT COUNT(*) AS total FROM users";
$result_total = $conn->query($total_data_query);
$total_rows = $result_total->fetch_assoc()['total'];

// Menghitung total data hasil pencarian
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT COUNT(*) AS total FROM users WHERE username LIKE '%$search%'";
    $result_search = $conn->query($search_query);
    $total_search_rows = $result_search->fetch_assoc()['total'];
}

// Menghitung jumlah data pada setiap status
$status_query = "SELECT role, COUNT(*) AS total FROM users GROUP BY role";
$result_status = $conn->query($status_query);
$status_counts = array();
while ($row_status = $result_status->fetch_assoc()) {
    $status_counts[$row_status['role']] = $row_status['total'];
}

// Query untuk mengambil data dari tabel dengan pagination
$sql = "SELECT * FROM users LIMIT $offset, $show";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM users WHERE username LIKE '%$search%' OR role LIKE '%$search%' LIMIT $offset, $show";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data dalam format tabel HTML
    $no = ($hal - 1) * $show + 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='text-center'>" . $no++ . ".</td>";
        // echo "<td>" . $row["kode_booking"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        // echo "<td>" . $row["alamat"] . "</td>";
        // echo "<td>" . $row["tanggal_penjemputan"] . "</td>";
        // echo "<td>" . $row["email"] . "</td>";
        // echo "<td>" . $row["status"] . "</td>";
        echo "<td> <a href='approve_booking.php?id=" . $row["user_id"] . "' class='btn btn-success btn-sm'>Setuju</a> | <a href='reject_booking.php?id=" . $row["user_id"] . "' class='btn btn-danger btn-sm'>Tolak</a> | <a href='pending_booking.php?id=" . $row["user_id"] . "' class='btn btn-warning btn-sm'>Pending</a> | <a href='delete_booking.php?id=" . $row["user_id"] . "' class='btn btn-danger btn-sm'>Hapus</a> | <a href='index.php?page=edit_booking&&id=" . $row["user_id"] . "' class='btn btn-primary btn-sm'> Edit</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
}

// Menampilkan jumlah data secara keseluruhan
echo "<p>Jumlah data keseluruhan: <span class='btn-primary btn-sm'>$total_rows</span></p>";

// Menampilkan jumlah data hasil pencarian
if (isset($total_search_rows)) {
    echo "<p>Jumlah data hasil pencarian: $total_search_rows</p>";
}

// Menampilkan jumlah data pada setiap status
// echo "<p>Jumlah data status:</p>";
echo "<div class='d-flex mb-4'>";
foreach ($status_counts as $status => $count) {
    echo "<p style='margin: 0 10px 0 0'>$status <span class='btn-primary btn-sm'>$count</span></p>";
}
echo "</div>";

// Menutup koneksi database
$conn->close();
?>
