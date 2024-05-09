<?php
include 'conf/db_connection.php';
session_start();

// Pastikan pengguna sudah login sebelum menampilkan halaman
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Warga</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page=home">Home</a>
                </li>
                <li class="nav-item <?php echo (!isset($_GET['page']) || $_GET['page'] == 'dokumen') ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page=dokumen">Dokumen</a>
                </li>
                <li class="nav-item mt-4">
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </li>
                <!-- <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'about') ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page=about">About</a>
                </li>
                <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'services') ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page=services">Services</a>
                </li>
                <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'contact') ? 'active' : ''; ?>">
                    <a class="nav-link" href="?page=contact">Contact</a>
                </li> -->
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // Memuat konten sesuai dengan parameter ?page=
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                // case 'about':
                //     include 'about.php';
                //     break;
                case 'home':
                    include 'user.php';
                    break;
                case 'dokumen':
                    include 'doc.php';
                    break;
                // case 'services':
                //     include 'services.php';
                //     break;
                // case 'contact':
                //     include 'contact.php';
                //     break;
                default:
                    include 'user.php';
                    break;
            }
        } else {
            // Tampilkan halaman home secara default
            include 'user.php';
        }
        ?>
    </div>




    <footer class="footer mt-auto py-3">
    <div class="container text-center">
        <span class="text-muted">Developed by Warga &copy; <?php echo date("Y"); ?></span>
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
