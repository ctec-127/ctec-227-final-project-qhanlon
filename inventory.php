<?php  
session_start();
$page_title = "Inventory Management";

require 'inc/shared/header.inc.php';
require 'inc/shared/nav.inc.php';

require 'inc/inventory/inventory.inc.php';
require 'inc/shared/footer.inc.php';

?>