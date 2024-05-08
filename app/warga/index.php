<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Warga</h2>
    <form method="GET">
        <input type="text" name="page" value="warga" hidden>
        <input type="text" name="searchInput" class="form-control mb-3" placeholder="Cari berdasarkan Nama Lengkap" value="<?php echo isset($_GET['searchInput']) ? $_GET['searchInput'] : '' ?>">
        <button type="submit" class="btn btn-primary mb-3">Cari</button>
    </form>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Created At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataTable">
            <?php
            // Koneksi ke database
            $host = "localhost";
            $db_username = "root";
            $db_password = "";
            $database = "db_warga";
            $koneksi = mysqli_connect($host, $db_username, $db_password, $database);

            // Cek koneksi
            if (mysqli_connect_errno()) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }

            // Pagination
            $limit = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $mulai = ($halaman - 1) * $limit;
            
            // Query awal untuk menghitung total data
            $query_jumlah_total = "SELECT COUNT(*) AS jumlah FROM tb_warga";
            
            // Query pencarian
            if(isset($_GET['searchInput']) && !empty($_GET['searchInput'])) {
                $searchInput = $_GET['searchInput'];
                $query = "SELECT * FROM tb_warga WHERE nama_lengkap LIKE '%$searchInput%' LIMIT $mulai, $limit";
                $query_jumlah = "SELECT COUNT(*) AS jumlah FROM tb_warga WHERE nama_lengkap LIKE '%$searchInput%'";
            } else {
                $query = "SELECT * FROM tb_warga LIMIT $mulai, $limit";
                $query_jumlah = $query_jumlah_total;
            }
            
            $result = mysqli_query($koneksi, $query);

            // Tampilkan data warga dalam tabel
            $nomor_urut = $mulai + 1; // Inisialisasi nomor urut
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $nomor_urut++ . "</td>"; // Kolom No. increment
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nik'] . "</td>";
                echo "<td>" . $row['nama_lengkap'] . "</td>";
                echo "<td>" . $row['no_hp'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' href='?page=editwarga&&id=" . $row['id'] . "'>Edit</a> ";
                echo "<a class='btn btn-danger' href='?hapus_id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }

            // http://localhost/iuran/app/?page=editwarga&&id=6
            // http://localhost/iuran/app/index.php?page=warga&&halaman=2

            // Menghitung total halaman
            $result_jumlah = mysqli_query($koneksi, $query_jumlah);
            $data_jumlah = mysqli_fetch_assoc($result_jumlah);
            $total_halaman = ceil($data_jumlah['jumlah'] / $limit);

            // Tombol navigasi halaman
            echo "<tr><td colspan='8'>";
            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $total_halaman; $i++) {
                $class_active = ($i == $halaman) ? "active" : "";
                if(isset($_GET['searchInput']) && !empty($_GET['searchInput'])) {
                    echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i&searchInput=$searchInput'>$i</a></li>";
                } else {
                    echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i'>$i</a></li>";
                }
            }
            echo "</ul>";
            echo "</td></tr>";

            // Menampilkan total data yang sesuai dengan hasil pencarian
            if(isset($_GET['searchInput']) && !empty($_GET['searchInput'])) {
                echo "<tr><td colspan='8'>Total data: " . $data_jumlah['jumlah'] . "</td></tr>";
            } else {
                // Menampilkan total data dari seluruh tabel jika tidak ada pencarian
                $result_jumlah_total = mysqli_query($koneksi, $query_jumlah_total);
                $data_jumlah_total = mysqli_fetch_assoc($result_jumlah_total);
                echo "<tr><td colspan='8'>Total data: " . $data_jumlah_total['jumlah'] . "</td></tr>";
            }

            // Proses penghapusan data jika ada permintaan hapus
            if(isset($_GET['hapus_id'])) {
                $hapus_id = $_GET['hapus_id'];
                $query_hapus = "DELETE FROM tb_warga WHERE id = $hapus_id";
                if(mysqli_query($koneksi, $query_hapus)) {
                    echo "<script>alert('Data berhasil dihapus');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                }
            }

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
