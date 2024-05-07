<?php
include '../conf/db_connection.php';

$id = $_GET['id'];

// $sql = "UPDATE halo SET status = 'Tolak' WHERE id = $id";
$sql = "DELETE FROM `users` WHERE user_id = $id";
mysqli_query($conn, $sql);

// header("Location: ../send_mail.php?id=" . $id);
header("Location: index.php?page=user");
// header("Location: ../send_mail.php?id=" . $id);
?>