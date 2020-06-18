<?php 

// Determine the filters or sorting.
if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $filter = " WHERE category_id = " . $_GET['category'];
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


?>