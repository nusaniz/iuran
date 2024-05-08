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
    <h1>Data Warga</h1>
    <form method="GET">
        <input type="text" name="page" value="warga" hidden>
        <input type="text" name="searchInput" class="form-control mb-3" placeholder="Cari berdasarkan Nama Lengkap" value="<?php echo isset(
            $_GET["searchInput"]
        )
            ? $_GET["searchInput"]
            : ""; ?>">
        <button type="submit" class="btn btn-primary mb-3">Cari</button>
    </form>

    <a href="index.php?page=addwarga" class="btn btn-primary btn-sm mb-4">Tambah Data Warga</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataTable">
            <?php
            include '../conf/db_connection.php';
            // conn ke database
            // $host = "localhost";
            // $db_username = "root";
            // $db_password = "";
            // $database = "db_iuran";
            // $conn = mysqli_connect(
            //     $host,
            //     $db_username,
            //     $db_password,
            //     $database
            // );

            // Cek conn
            if (mysqli_connect_errno()) {
                die("conn database gagal: " . mysqli_connect_error());
            }

            // Pagination
            $limit = 5;
            $halaman = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
            $mulai = ($halaman - 1) * $limit;

            // Query awal untuk menghitung total data
            $query_jumlah_total = "SELECT COUNT(*) AS jumlah FROM tb_users";

            // Query pencarian
            if (isset($_GET["searchInput"]) && !empty($_GET["searchInput"])) {
                $searchInput = $_GET["searchInput"];
                $query = "SELECT * FROM tb_users WHERE nama_lengkap LIKE '%$searchInput%' LIMIT $mulai, $limit";
                $query_jumlah = "SELECT COUNT(*) AS jumlah FROM tb_users WHERE nama_lengkap LIKE '%$searchInput%'";
            } else {
                $query = "SELECT * FROM tb_users LIMIT $mulai, $limit";
                $query_jumlah = $query_jumlah_total;
            }

            $result = mysqli_query($conn, $query);

            // Tampilkan data warga dalam tabel
            $nomor_urut = $mulai + 1; // Inisialisasi nomor urut
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $nomor_urut++ . "</td>"; // Kolom No. increment
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["nik"] . "</td>";
                echo "<td>" . $row["nama_lengkap"] . "</td>";
                echo "<td>" . $row["no_hp"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' href='?page=editwarga&&id=" .
                    $row["user_id"] .
                    "'>Edit</a> ";
                echo "<a class='btn btn-danger' href='?page=warga&&hapus_id=" .
                    $row["user_id"] .
                    "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }

            // http://localhost/iuran/app/?page=editwarga&&id=6
            // http://localhost/iuran/app/index.php?page=warga&&halaman=2

            // Menghitung total halaman
            $result_jumlah = mysqli_query($conn, $query_jumlah);
            $data_jumlah = mysqli_fetch_assoc($result_jumlah);
            $total_halaman = ceil($data_jumlah["jumlah"] / $limit);


        //    Tombol navigasi halaman
            echo "<tr>
                <td colspan='11'>
                    <ul class='pagination justify-content-center'>";
                        // Tentukan halaman yang akan ditampilkan
                        $startPage = $halaman - 1;
                        $endPage = $halaman + 1;
            
                        // Jika halaman saat ini adalah halaman pertama
                        if ($halaman <= 1) {
                            $startPage = 1;
                            $endPage = min(3, $total_halaman); // Tampilkan maksimal 3 halaman
                        }
            
                        // Jika halaman saat ini adalah halaman terakhir
                        if ($halaman >= $total_halaman) {
                            $startPage = max(1, $total_halaman - 2); // Tampilkan maksimal 3 halaman
                            $endPage = $total_halaman;
                        }
            
                        // Tampilkan tautan "Sebelumnya" jika halaman bukan halaman pertama
                        if ($halaman > 1) {
                            $prevPage = $halaman - 1;
                            echo "<li class='page-item'><a class='page-link' href='?page=warga&&halaman=$prevPage" . (isset($_GET["searchInput"]) ? "&searchInput=" . $_GET["searchInput"] : "") . "'>Sebelumnya</a></li>";
                        }
            
                        // Tampilkan tautan untuk halaman yang ditentukan
                        for ($i = $startPage; $i <= $endPage; $i++) {
                            $class_active = $i == $halaman ? 'active' : '';
                            if (isset($_GET["searchInput"]) && !empty($_GET["searchInput"])) {
                                echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i&searchInput=$searchInput'>$i</a></li>";
                            } else {
                                echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i'>$i</a></li>";
                            }
                        }
            
                        // Tampilkan tautan "Selanjutnya" jika halaman bukan halaman terakhir
                        if ($halaman < $total_halaman) {
                            $nextPage = $halaman + 1;
                            echo "<li class='page-item'><a class='page-link' href='?page=warga&&halaman=$nextPage" . (isset($_GET["searchInput"]) ? "&searchInput=" . $_GET["searchInput"] : "") . "'>Selanjutnya</a></li>";
                        }
                        echo"
                    </ul>
                </td>
            </tr>";
            


            // Tombol navigasi halaman
            // echo "<tr>
            //     <td colspan='11'>
            //         <ul class='pagination justify-content-center'>";
            //             // Tentukan halaman yang akan ditampilkan
            //             $startPage = $halaman - 1;
            //             $endPage = $halaman + 1;

            //             // Jika halaman saat ini adalah halaman pertama
            //             if ($halaman <= 1) {
            //                 $startPage = 1;
            //                 $endPage = min(3, $total_halaman); // Tampilkan maksimal 3 halaman
            //             }

            //             // Jika halaman saat ini adalah halaman terakhir
            //             if ($halaman >= $total_halaman) {
            //                 $startPage = max(1, $total_halaman - 2); // Tampilkan maksimal 3 halaman
            //                 $endPage = $total_halaman;
            //             }

            //             // Tampilkan tautan untuk halaman yang ditentukan
            //             for ($i = $startPage; $i <= $endPage; $i++) {
            //                 $class_active = $i == $halaman ? 'active' : '';
            //                 if (isset($_GET["searchInput"]) && !empty($_GET["searchInput"])) {
            //                     echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i&searchInput=$searchInput'>$i</a></li>";
            //                 } else {
            //                     echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i'>$i</a></li>";
            //                 }
            //             }
            //         echo "</ul>
            //     </td>
            // </tr>";



            // Tombol navigasi halaman
            // echo "<tr><td colspan='11'>";
            // echo "<ul class='pagination justify-content-center'>";
            // for ($i = 1; $i <= $total_halaman; $i++) {
            //     $class_active = $i == $halaman ? "active" : "";
            //     if (
            //         isset($_GET["searchInput"]) &&
            //         !empty($_GET["searchInput"])
            //     ) {
            //         echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i&searchInput=$searchInput'>$i</a></li>";
            //     } else {
            //         echo "<li class='page-item $class_active'><a class='page-link' href='?page=warga&&halaman=$i'>$i</a></li>";
            //     }
            // }
            // echo "</ul>";
            // echo "</td></tr>";

            // Menampilkan total data yang sesuai dengan hasil pencarian
            if (isset($_GET["searchInput"]) && !empty($_GET["searchInput"])) {
                echo "<tr><td colspan='11'>Total data: " .
                    $data_jumlah["jumlah"] .
                    "</td></tr>";
            } else {
                // Menampilkan total data dari seluruh tabel jika tidak ada pencarian
                $result_jumlah_total = mysqli_query(
                    $conn,
                    $query_jumlah_total
                );
                $data_jumlah_total = mysqli_fetch_assoc($result_jumlah_total);
                echo "<tr><td colspan='11'>Total data: " .
                    $data_jumlah_total["jumlah"] .
                    "</td></tr>";
            }

            // Proses penghapusan data jika ada permintaan hapus
            if (isset($_GET["hapus_id"])) {
                $hapus_id = $_GET["hapus_id"];
                $query_hapus = "DELETE FROM tb_users WHERE user_id = $hapus_id";
                if (mysqli_query($conn, $query_hapus)) {
                    echo "<script>alert('Data berhasil dihapus');</script>";
                    // echo "<script>window.location.href='index.php';</script>";
                    echo "<script>window.location.href='index.php?page=warga';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                }
            }

            // Tutup conn
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
