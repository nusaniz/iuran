<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tabel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Data Tabel</h2>

    <!-- Form untuk pencarian -->
    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." name="search" id="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
    </form>

    <!-- Tabel data -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kode Booking</th>
            </tr>
        </thead>
        <tbody id="table_data">
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination_data">
        </ul>
    </nav>

    <p id="total_records"></p>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    fetch_data();
    function fetch_data(page = 1) {
        var searchValue = $('#search').val();
        $.ajax({
            url: 'fetch_data.php',
            method: 'GET',
            data: {page: page, search: searchValue},
            dataType: 'json',
            success: function(response) {
                $('#table_data').html(response.table_data);
                $('#pagination_data').html(response.pagination_data);
                $('#total_records').text('Jumlah data: ' + response.total_records);
            }
        });
    }

    $(document).on('click', '.pagination li a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    $('#search').on('input', function() {
        fetch_data();
    });
});
</script>

</body>
</html>
