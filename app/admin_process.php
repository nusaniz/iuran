<?php
include '../conf/db_connection.php';

$sql = "SELECT * FROM tb_users";
$result = mysqli_query($conn, $sql);
?>
