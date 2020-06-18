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
    // echo $sql;

    $result = $db->query($sql);
    if ($result->num_rows == 1) {

        $_SESSION['loggedin'] = 1;
        

        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['clearance'] = $row['clearance'];
        $id = $_SESSION['id'];
        $cart = "SELECT * FROM cart WHERE user_id='$id' AND status='0'";

        $whoseCart = $db->query($cart);
        if ($whoseCart->num_rows == 1) {
            // Get the row so it's an associative array with integer intervals
            $row = mysqli_fetch_row($whoseCart);
            // Debug that it's getting the right data
            // echo "<h2>" . $row[0] . "</h2>";

            // Assign it to session variable
            $_SESSION['cart'] = $row[0];
        } else if ($whoseCart->num_rows == 0) {
            // Build SQL to find user's current cart
            $sql = "INSERT INTO cart (user_id, status) VALUES ('$id', '0')";
            $result2 = $db->query($sql);
            // Make it into an associative array to receive the Key Value
            $row = mysqli_fetch_row($result2);
            $_SESSION['cart'] = $row[0];
        }

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