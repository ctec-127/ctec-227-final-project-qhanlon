<?php 
require_once 'inc/shared/db_connect.inc.php';

$cart_id = $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $item = $_POST['item'];
    $addedQuantity = $_POST['quantity'];

    $sql1 = "SELECT * FROM content WHERE cart_id='$cart_id' AND item_id='$item'";

    // echo $sql1;

    $result1 = $db->query($sql1);
    
    if ($result1->num_rows == 1) {
        $row = $result1->fetch_assoc();

        if (isset($_POST['update']) && $_POST['update'] == TRUE) {
            $quantity = $addedQuantity;
        } else {
            $quantity = $row['quantity'];
            $quantity += $addedQuantity;
        }
        
        $sql_input = "UPDATE content SET quantity = '$quantity' WHERE item_id = '$item' AND cart_id='$cart_id' LIMIT 1";
        $result2 = $db->query($sql_input);
        if (!$result2) {
            echo '<div class="alert alert-danger" role="alert">
            Something went wrong while trying to add the item to your cart. ' . "\n".  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            Your cart has been successfully updated.
          </div>';
        //     echo '<div class="alert alert-success" role="alert">
        //     You now have ' .  $addedQuantity . ' of item ' . $item . ' to your cart.
        //   </div>';
        }
    } else if ($result1->num_rows == 0) {
        $sql_input = "INSERT INTO content (cart_id, item_id, quantity) VALUES ('$cart_id', '$item', '$addedQuantity')";
        $result2 = $db->query($sql_input);
        if (!$result2) {
            echo '<div class="alert alert-danger" role="alert">
            Something went wrong while trying to add the item to your cart. ' . "\n".  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            Your cart has been successfully updated.
            </div>';
        //     echo '<div class="alert alert-success" role="alert">
        //     You\'ve added ' .  $addedQuantity . ' of item ' . $item . ' to your cart.
        //   </div>';
        }
    }
}




    echo '<div class="table-responsive">';
    echo "<table class=\"table table-dark\">";
    echo '<thead><tr><th><a href="?sorting=name">Product</a></th>';
    echo '<th>Description</th>';
    echo '<th class="w110"><a href="?sorting=cost">Cost</a></th>';
    echo '<th class="w210">Options</th></tr></thead>';

    // $sql = "SELECT * FROM content WHERE cart_id = '$cart_id'";
    // $result = $db->query($sql);

    $sql = " SELECT cost, description, name, quantity, product_id, stock
    FROM content, product
    WHERE content.item_id = product.product_id
    AND content.cart_id = $cart_id";

    $joined = $db->query($sql);
    
    $total = 0;
    

    while ($row = $joined->fetch_assoc()){

        $productNum = $row['product_id'];

        // $cost = number_format(($row['quantity'] * $row['cost']), 2, ".", "");
        $cost1 = number_format($row['cost'], 2, ".", "");


        $addToCart = '<form action="cart.php" method="POST">
        <p class="d-inline">Quantity</p>
        <input type="number" name="quantity" value="' . $row['quantity'] . '">
        <input type="hidden" name="item" value="' . $productNum . '">
        <input type="hidden" name="update" value="TRUE">
        <input type="submit" value="Update Quantity">
        </form>
        <form action="delete-stuff.php" method="POST">
        <input type="hidden" name="cart" value="' . $cart_id . '">
        <input type="hidden" name="item" value="' . $productNum . '">
        <input type="submit" value="Remove from Cart">
        </form>';

        # display rows and columns of data
        echo '<tr>';
        echo "<td><strong>" . $row['name'] . "</strong></td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . $cost1 . "</td>";
        echo "<td>" . $addToCart . "</td>";
        echo '</tr>';
        $total += ($row['cost'] * $row['quantity']);

        // echo "<h1>" . $row['quantity'] . " " . $row['stock'] . "</h1>";
        
        if ($row['quantity'] > $row['stock']) {
            $stock = TRUE;
        }
        $test = TRUE;
    }
    echo '</table>';
    echo '</div>';
    
    echo    '<div id="finalize" class="d-inline-block p-3 mb-4">';
    // if (empty($joined))
    if (!isset($test)) {
        echo '<p class="mb-0">Your cart is empty.</p>';
    } else {
        if (isset($stock)) {
            echo '<p class="alert alert-warning w300">One or more items in your cart currently don\'t have enough stock and your order may be delayed until they are available.</p>';
        }
        echo    '<p>Your order total is $' . number_format($total, 2, ".", "") . '</p>
                <form action="orders.php" method="POST" class="text-center">
                <input type="hidden" name="finalize" value="' . $cart_id . '">
                <input type="submit" value="Finalize Order" class="btn btn-light">
                </form>';
                
    }
    echo '</div>';
    


    // echo "<h1>$total</h1>"



?>