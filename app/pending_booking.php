<?php
include '../conf/db_connection.php';

$id = $_GET['id'];

$sql = "UPDATE bookings SET status = 'Menunggu Persetujuan' WHERE id = $id";
mysqli_query($conn, $sql);

// header("Location: ../send_mail.php?id=" . $id);
header("Location: index.php?page=admin");
// header("Location: ../send_mail.php?id=" . $id);
?>
