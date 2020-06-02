<?php 

// Create an empty array to put the errors in if there are any.
$error_bucket = [];

// When you post the form, check to be sure that it was filled in properly.
if($_SERVER['REQUEST_METHOD']=="POST"){

    // First ensure that all required fields are filled in
    if (empty($_POST['username'])) {
        array_push($error_bucket,"<p>A username is required.</p>");
    } else {
        $username = $db->real_escape_string(strip_tags($_POST['username']));
    }

    if (empty($_POST['first_name'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        $first_name = $db->real_escape_string(strip_tags($_POST['first_name']));
    }

    if (empty($_POST['last_name'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        $last_name = $db->real_escape_string(strip_tags($_POST['last_name']));
    }

    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }

    if (empty($_POST['address'])) {
        array_push($error_bucket,"<p>An address is required.</p>");
    } else {
        $address = $db->real_escape_string(strip_tags($_POST['address']));
    }

    if (empty($_POST['city'])) {
        array_push($error_bucket,"<p>A city is required.</p>");
    } else {
        $city = $db->real_escape_string(strip_tags($_POST['city']));
    }

    if (empty($_POST['state'])) {
        array_push($error_bucket,"<p>A state is required.</p>");
    } else {
        $state = $db->real_escape_string(strip_tags($_POST['state']));
    }

    if (empty($_POST['zip'])) {
        array_push($error_bucket,"<p>A zip code is required.</p>");
    } else {
        $zip = $db->real_escape_string(strip_tags($_POST['zip']));
    }

    if (empty($_POST['password'])) {
        array_push($error_bucket,"<p>A password is required.</p>");
    } else {
        if (isset($password) && isset($password2) && $password === $password2) {
            $password = $db->real_escape_string(strip_tags($_POST['password']));
        } else {
            array_push($error_bucket,"<p>Please make sure your passwords match.</p>")
            unset($password);
            unset($password2);
        }
    }

    if (empty($_POST['password2'])) {
        array_push($error_bucket,"<p>Please confirm your password.</p>");
        unset($password);
        unset($password2);
    } else {
        $password2 = $db->real_escape_string(strip_tags($_POST['password2']));
    }

    
    

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Build SQL string to insert information into DB
        $sql = "INSERT INTO user (first_name,last_name,username,email,address,city,state,zip,password) ";
        $sql .= "VALUES ('$first_name','$last_name','$username','$email','$address', '$city', '$state', '$zip', '$password')";

        // comment in for debug of SQL
        // echo $sql;

        // Query the results and notify user of status
        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
        //   Clear the fields after posting successfully so the user can proceed to add another entry.
            unset($first_name);
            unset($last_name);
            unset($email);
            
        }
    } else {
        // Tell the user what they did wrong.
        display_error_bucket($error_bucket);
    }
}

?>