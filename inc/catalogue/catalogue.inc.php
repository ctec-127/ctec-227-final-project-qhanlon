<?php 

require_once 'inc/shared/db_connect.inc.php';

require 'inc/shared/functions.inc.php';

require 'inc/shared/filters.inc.php';

// Query DB based on parameters specified
$sql = "SELECT * FROM product" . $filter . " ORDER BY " . $order;

// echo "<h1>" . $sql . "</h1>";

$result = $db->query($sql);

show_products($result, '');


?>