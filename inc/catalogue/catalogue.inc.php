<?php 

require_once 'inc/shared/db_connect.inc.php';

require 'inc/shared/functions.inc.php';

require 'inc/shared/filters.inc.php';

echo '<ul class="sorting mb-4 mt-4">
    <li><a href="catalogue.php">View All</a></li>
    <li><a href="catalogue.php?category=0">General Goods</a></li>
    <li><a href="catalogue.php?category=1">Electronics</a></li>
    <li><a href="catalogue.php?category=2">Camping Gear</a></li>
    <li><a href="catalogue.php?category=3">Board Games</a></li>
    <li><a href="catalogue.php?category=4">Sports</a></li>
    <li><a href="catalogue.php?category=5">Books</a></li>
</ul>';

// Query DB based on parameters specified
$sql = "SELECT * FROM product" . $filter . " ORDER BY " . $order;

// echo "<h1>" . $sql . "</h1>";

$result = $db->query($sql);

show_products($result, '');


?>