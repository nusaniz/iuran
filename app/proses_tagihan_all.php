<?php
// Sertakan file koneksi ke database
include '..\conf\db_connection.php';

// Atur zona waktu ke GMT+7
date_default_timezone_set('Asia/Jakarta');

// Periksa apakah form telah disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai nominal tagihan dari form
    $amount_all = $_POST['amount_all'];

    // Query untuk mendapatkan daftar semua user
    $query_users = "SELECT user_id FROM tb_users";
    $result_users = mysqli_query($conn, $query_users);

    // Periksa apakah ada user yang ditemukan
    if (mysqli_num_rows($result_users) > 0) {
        // Loop melalui setiap user dan buat tagihan untuk masing-masing
        while ($row_users = mysqli_fetch_assoc($result_users)) {
            $user_id = $row_users['user_id'];

            // Buat kode transaksi unik
            $kode_transaksi = generateUniqueCode();

            // Query untuk menyimpan tagihan ke database
            $insert_query = "INSERT INTO tb_payments (user_id, amount, status, invoice_date, kode_transaksi)
                             VALUES ('$user_id', '$amount_all', 'belum dibayar', NOW(), '$kode_transaksi')";

            // Eksekusi query untuk menyimpan tagihan
            if (!mysqli_query($conn, $insert_query)) {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
        echo "Tagihan berhasil dibuat untuk seluruh user.";
        header("Location: dashboard.php");

    } else {
        echo "Tidak ada user yang ditemukan.";
    }
} else {
    echo "Metode request tidak valid.";
}

// Fungsi untuk menghasilkan kode transaksi unik
function generateUniqueCode() {
    // Format kode transaksi: tanggal-bulan-tahun-random(6 digit)
    $date = date('dmY');
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    // $random = mt_rand(100000, 999999); // 6 digit random number
    // return $date . $random;
    return "TRX" . $date . substr(str_shuffle($chars), 0, 8 );
}
mysqli_close($conn);
?>
