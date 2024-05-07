<?php

function renderPagination($total_pages, $current_page) {
    echo "<nav aria-label='Page navigation'>";
    echo "<ul class='pagination justify-content-center'>";

    // Tombol "Previous"
    if ($current_page > 1) {
        echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=" . ($current_page - 1) . "'>&laquo;</a></li>";
    } else {
        echo "<li class='page-item disabled'><span class='page-link'>&laquo;</span></li>";
    }

    // Tombol untuk setiap halaman
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<li class='page-item active'><a class='page-link' href='dashboard.php?page=$i'>$i</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=$i'>$i</a></li>";
        }
    }

    // Tombol "Next"
    if ($current_page < $total_pages) {
        echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=" . ($current_page + 1) . "'>&raquo;</a></li>";
    } else {
        echo "<li class='page-item disabled'><span class='page-link'>&raquo;</span></li>";
    }

    echo "</ul>";
    echo "</nav>";
}

?>
