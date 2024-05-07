<?php
$prev = $hal - 1;
$next = $hal + 1;

echo "<li class='page-item " . ($prev <= 0 ? 'disabled' : '') . "'><a class='page-link' href='index.php?page=admin&&hal=$prev&show=$show'>Previous</a></li>";

for ($i = 1; $i <= $total_pages; $i++) {
    $active = $i == $hal ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='index.php?page=admin&&hal=$i&show=$show'>$i</a></li>";
}

echo "<li class='page-item " . ($next > $total_pages ? 'disabled' : '') . "'><a class='page-link' href='index.php?page=admin&&hal=$next&show=$show'>Next</a></li>";
?>