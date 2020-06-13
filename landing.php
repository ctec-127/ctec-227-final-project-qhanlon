<?php  
session_start();
$page_title = "Home";

require 'inc/shared/header.inc.php';
require 'inc/shared/nav.inc.php';

echo "<div><h1 class=\"text-center\">Welcome to the site, " . (isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'friend') . "!</h1></div>";

echo "<h1>Your cart is cart #" . $_SESSION['cart'] . "</h1>";

require 'inc/shared/footer.inc.php';

?>