<?php 

require_once 'inc/shared/db_connect.inc.php';

require 'inc/shared/functions.inc.php';

// Determine the filters or sorting.
if (isset($_GET['filter']) && is_numeric($_GET['filter'])) {
    $filter = " WHERE category=" . $_GET['filter'];
} else {
    $filter = '';
}

if (isset($_GET['sorting'])) {
    if ($_GET['sorting'] == 'cost' || $_GET['sorting'] == 'stock') {
        $order =  $_GET['sorting'] . " DESC";
    } else {
        $order = $_GET['sorting'] . " ASC";
    }
} else {
    $order = 'category_id ASC';
}

if (isset($_GET['clearfilter'])){
    $filter = '';
}

// Query DB based on parameters specified
$sql = "SELECT * FROM product" . $filter . " ORDER BY " . $order;

echo "<h1>" . $sql . "</h1>";

$result = $db->query($sql);

show_products($result, '');


?>