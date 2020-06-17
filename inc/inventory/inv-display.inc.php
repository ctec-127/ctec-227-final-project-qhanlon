<?php

require_once 'inc/shared/db_connect.inc.php';

require 'inc/shared/functions.inc.php';

require 'inc/shared/filters.inc.php';

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