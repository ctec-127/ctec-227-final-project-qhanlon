<?php
// Create a new connection to the database
$db = new mysqli('localhost', 'root', '', 'shopping');

// If there was an error connecting to the database, display it.
if ($db->connect_error) {
    $error = $db->connect_error;
    echo "<h1>" . $error . "</h1>";
}

// Set the character encoding of the database connection to UTF-8 for maximum compatibility
$db->set_charset('utf8');

?>