<?php
include '..\conf\db_connection.php';

// Periksa apakah parameter payment_id ada dalam URL
if(isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];

    // Query untuk menghapus data tagihan berdasarkan payment_id
    $delete_query = "DELETE FROM tb_payments WHERE payment_id = $payment_id";

    // Eksekusi query hapus
    if(mysqli_query($conn, $delete_query)) {
        echo "Data tagihan berhasil dihapus.";
        header("Location: dashboard.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Parameter payment_id tidak diberikan.";
    exit();
}
// Tutup koneksi
mysqli_close($conn);
?>
