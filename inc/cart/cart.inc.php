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
            You now have ' .  $addedQuantity . ' of item ' . $item . ' to your cart.
          </div>';
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
            You\'ve added ' .  $addedQuantity . ' of item ' . $item . ' to your cart.
          </div>';
        }
    }
}




    echo '<div class="table-responsive">';
    echo "<table class=\"table table-dark\">";
    echo '<thead><tr><th><a href="?sorting=name">Product</a></th>';
    echo '<th>Description</th>';
    echo '<th><a href="?sorting=cost">Cost</a></th>';
    echo '<th class="test">Options</th></tr></thead>';

    // $sql = "SELECT * FROM content WHERE cart_id = '$cart_id'";
    // $result = $db->query($sql);

    $sql = " SELECT cost, description, name, quantity, product_id
    FROM content, product
    WHERE  content.item_id = product.product_id
    AND content.cart_id = $cart_id";

    $joined = $db->query($sql);

    

    while ($row = $joined->fetch_assoc()){

        $productNum = $row['product_id'];

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
        echo "<td>$" . number_format($row['cost'], 2, ".", "") . "</td>";
        echo "<td>" . $addToCart . "</td>";
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';



?>