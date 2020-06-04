<?php

require_once 'inc/shared/db_connect.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
        $loginfo = 'email';
    }
    else {
        $loginfo = 'username';
    }

    $login = $db->real_escape_string($_POST['login']);
    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    if ($loginfo == 'email') {
        $sql = "SELECT * FROM user WHERE email='$login' AND password='$password'";
    } else {
        $sql = "SELECT * FROM user WHERE username='$login' AND password='$password'";
    }

    // For debug:
    echo $sql;

    $result = $db->query($sql);
    if ($result->num_rows == 1) {

        $_SESSION['loggedin'] = 1;
        $_SESSION['email'] = $email;

        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];

        header ('location: landing.php');
    } else {
        echo '<div class="alert alert-warning"><p>Something went wrong. Please try again.</p></div>';
    }
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="m-3 p-3">
    <label for="login">Username / Email</label>
    <br>
    <input type="login" name="login" id="login" value="<?php echo (isset($login) ? $login : '');?>" required>
    <br><br>
    <label for="password">Password</label>
    <span id="showPassword" onclick="showPassword();"><strong>Show Password</strong></span>
    <br>
    <input type="password" name="password" id="password" required>
    <br><br>
    <input type="submit" value="Login">
</form>

<script src="js/script.js"></script>