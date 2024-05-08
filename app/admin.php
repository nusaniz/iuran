
<?php include 'admin_process.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <!-- <a href="../login/logout.php">Logout</a> -->
    <!-- <a href="../send_mail.php">Kirim</a> -->
    <!-- <h2>Daftar Booking</h2> -->
    
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Table with Real-time Update, Pagination, and Search</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../bootstrap/css/all.min.css">
            <!-- Custom CSS -->
            <style>
                .status-valid {
                    background-color: #28a745;
                    color: white;
                }
                </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Data User</h1>
        <!-- <h3>Data Tabel</h3> -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="Search by Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select class="form-control" id="show" onchange="changeShow()">
                        <option value="10">Show 10</option>
                        <option value="25">Show 25</option>
                        <option value="50">Show 50</option>
                        <option value="100">Show 100</option>
                    </select>
                </div>
            </div>
        </div>

        <a href="index.php?page=add" class="btn btn-primary btn-sm">Tambah Data User</a>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <!-- <th>Kode Booking</th> -->
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <!-- <th>Alamat</th> -->
                        <!-- <th>Tanggal Penjemputan</th> -->
                        <!-- <th>Email</th> -->
                        <!-- <th>Status</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-data">
                    <tr>
                        <?php include 'fetch_data.php'; ?>
                    </tr>
                </tbody>
            </table>
            
            <!-- Pagination -->

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul id="pagination" class="pagination justify-content-center">
                    <?php include 'pagination.php'; ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script>
    function changeShow() {
        var show = document.getElementById('show').value;
        updateTable(1, show);
    }

    function updateTable(page, show) {
        var searchText = $('#search').val();
        $.ajax({
            url: 'fetch_data.php',
            method: 'post',
            data: {page: page, show: show, search: searchText},
            success: function(response){
                $('#table-data').html(response);
            }
        });
    }

    $(document).ready(function(){
        // Handle search
        $('#search').keyup(function(){
            updateTable(1, $('#show').val());
        });

        // Polling for real-time update every 1 second
        // setInterval(function(){
        //     var page = $('.pagination .active').text();
        //     updateTable(page, $('#show').val());
        // }, 1000);
    });
    </script>
</body>
</html>


</body>
</html>
