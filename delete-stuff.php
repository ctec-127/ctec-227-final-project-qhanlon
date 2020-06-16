<?php
session_start();
$page_title = "delet";

require_once 'inc/shared/db_connect.inc.php';


// check to see if id is in the query string
if(isset($_POST['cart']) && isset($_POST['item'])){

    $sql = "DELETE FROM content WHERE cart_id={$_POST['cart']} AND item_id={$_POST['item']} LIMIT 1";

    $result = $db->query($sql); 

    if($db->affected_rows == 1){
        header('location: cart.php?deleted=true.');
    } else {
        header('location: cart.php?deleted=false.');
    }
}
?>