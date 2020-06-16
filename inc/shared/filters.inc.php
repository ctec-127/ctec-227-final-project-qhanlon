<?php 

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

?>