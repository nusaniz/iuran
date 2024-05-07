<?php
include '../conf/db_connection.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>
