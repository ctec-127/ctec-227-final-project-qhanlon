<?php  
session_start();
$page_title = "Home";

require 'inc/shared/header.inc.php';
require 'inc/shared/nav.inc.php';

echo "<div><h1>Welcome to the site, " . (isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'friend') . "!</h1></div>";

require 'inc/shared/footer.inc.php';

?>