<?php 

require_once 'inc/shared/db_connect.inc.php';

// Create an empty array to put the errors in if there are any.
$error_bucket = [];

// When you post the form, check to be sure that it was filled in properly.
if($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['edit'])) {
        $sql = "SELECT * FROM product WHERE product_id = {$_POST['edit']}";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $product = $row['name'];
        $description = $row['description'];
        $cost = $row['cost'];
        $stock = $row['stock'];
        $category_id = $row['category_id'];
        $editing = $_POST['edit'];
    } else {

        isset($_POST['editing']) ? $editing = $_POST['editing'] : $editing = '' ;

        // First ensure that all required fields are filled in
        if (empty($_POST['product'])) {
            array_push($error_bucket,"<p>A product name is required.</p>");
        } else {
            $product = $db->real_escape_string(strip_tags($_POST['product']));
        }

        if (empty($_POST['description'])) {
            array_push($error_bucket,"<p>An item description is required.</p>");
        } else {
            $description = $db->real_escape_string(strip_tags($_POST['description']));
        }

        if (empty($_POST['cost'])) {
            array_push($error_bucket,"<p>A cost is required.</p>");
        } else {
            $cost = $db->real_escape_string(strip_tags($_POST['cost']));
        }

        if (empty($_POST['stock'])) {
            array_push($error_bucket,"<p>A stock is required.</p>");
        } else {
            if ($_POST['stock'] >= 0) {
                $stock = $db->real_escape_string(strip_tags($_POST['stock']));
            } else {
                array_push($error_bucket,"<p>Please select a valid stock amount.</p>");
            }
        }    

        if ($_POST['category'] == "-") {
            array_push($error_bucket,"<p>Please select a category.</p>");
        } else {
            $category_id = $db->real_escape_string(strip_tags($_POST['category']));
        }
        
        

        // If we have no errors than we can try and insert the data
        if (count($error_bucket) == 0) {
            // Build SQL string to insert information into DB
            if (!empty($editing)) {
                $sql = "UPDATE product 
                SET cost = '$cost', stock = '$stock', description = '$description', name = '$product', category_id = '$category_id'
                WHERE product_id = '$editing' LIMIT 1";
            } else {
                $sql = "INSERT INTO product (cost,stock,description,name,category_id) ";
                $sql .= "VALUES ('$cost','$stock','$description','$product','$category_id')";
            }

            

            // comment in for debug of SQL
            // echo $sql;

            // Query the results and notify user of status
            $result = $db->query($sql);
            if (!$result) {
                echo '<div class="alert alert-danger" role="alert">
                Something went wrong while trying to list your item. ' . "\n".  
                $db->error . '.</div>';
            } else {
                if (!empty($editing)) {
                    echo '<div class="alert alert-success" role="alert">
                    You\'ve successfully updated your product listing!.
                    </div>';
                } else {
                    echo '<div class="alert alert-success" role="alert">
                    You\'ve successfully listed your product!.
                    </div>';
                }
            //   Clear the fields after posting successfully so the user can proceed to add another entry.
                unset($cost);
                unset($stock);
                unset($description);
                unset($product);
                unset($category_id);
                
            }
        } else {
            // Tell the user what they did wrong.
            echo '<div class="alert alert-warning" role="alert">';
            foreach ($error_bucket as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
    }
}

require 'inc/inventory/form.inc.php'; 





?>