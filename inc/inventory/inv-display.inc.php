<?php

require_once 'inc/shared/db_connect.inc.php';

require 'inc/shared/functions.inc.php';

require 'inc/shared/filters.inc.php';

echo '<ul class="sorting mb-4 mt-4">
    <li><a href="inv-display.php">View All</a></li>
    <li><a href="inv-display.php?category=0">General Goods</a></li>
    <li><a href="inv-display.php?category=1">Electronics</a></li>
    <li><a href="inv-display.php?category=2">Camping Gear</a></li>
    <li><a href="inv-display.php?category=3">Board Games</a></li>
    <li><a href="inv-display.php?category=4">Sports</a></li>
    <li><a href="inv-display.php?category=5">Books</a></li>
</ul>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sqlD = "DELETE FROM product WHERE product_id={$_POST['delete']} LIMIT 1";
    echo "<h1>" . $sqlD . "</h1>";
    $resolve = $db->query($sqlD);

    if($db->affected_rows == 1){
        echo '<div class="alert alert-success" role="alert"><p>The item was successfully removed from the database.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert"><p>The item was not successfully removed from the database. Please try again or contact an administrator.</div>';
    }
}


// Query DB based on parameters specified
$sql = "SELECT * FROM product" . $filter . " ORDER BY " . $order;

// echo "<h1>" . $sql . "</h1>";

$result = $db->query($sql);

show_products($result, 1);



?>