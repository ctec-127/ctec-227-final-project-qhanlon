<?php  

$page_title = "Placeholder";

require 'inc/shared/header.php';

require_once 'inc/shared/db_connect.inc.php';
?>

<form action="inc/registration/register.php" method="POST">
<?php require 'inc/registration/form.php'; ?>
</form>

<?php

require 'inc/shared/footer.php';

?>