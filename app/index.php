<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../user_dashboard.php");
    exit();
}

// Inisialisasi halaman default jika parameter page tidak diberikan
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Daftar menu sidebar beserta linknya
$sidebar_menu = array(
    'home' => 'Home',
    'tagihan' => 'Tagihan',
    'user' => 'User',
    'add' => 'Add',
    'logout' => 'Logout'
);

// Daftar halaman yang sesuai dengan menu
$pages = array(
    'home' => 'dashboard.php',
    'tagihan' => 'tagihan.php',
    'user' => 'admin.php',
    'edit' => 'edit_payment.php',
    'edituser' => 'edit_booking.php',
    'add' => 'add.php',
    'logout' => '../logout.php'
);

// Cek apakah halaman yang diminta ada dalam daftar halaman
if (!array_key_exists($page, $pages)) {
    // Halaman tidak valid, arahkan ke halaman default (home)
    $page = 'home';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* CSS untuk styling sidebar */
        .sidebar {
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            color: white;
        }

        .sidebar a {
            padding: 10px;
            display: block;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #444;
        }

        /* CSS untuk styling konten */
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <!-- Tampilkan daftar menu sidebar -->
    <?php
    foreach ($sidebar_menu as $key => $value) {
        echo "<a href='?page=$key'>$value</a>";
    }
    ?>
</div>

<div class="content">
    <!-- Tampilkan konten halaman sesuai dengan parameter page -->
    <?php include $pages[$page]; ?>
</div>

</body>
</html>
