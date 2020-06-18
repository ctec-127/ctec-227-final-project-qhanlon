<?php 

require_once 'inc/shared/db_connect.inc.php';

$userID = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cart = $_POST['finalize'];
    $sql = "UPDATE cart SET status = 1 WHERE cart_id ='$cart' LIMIT 1";
    $ordered = $db->query($sql);
    if (!$ordered) {
        echo '<div class="alert alert-danger" role="alert">
        Something went wrong while trying to process your order. ' . "\n".  
        $db->error . '.</div>';
    } else {
        echo '<div class="alert alert-success" role="alert">
        Your order has been successfully processed!
        </div>';

        // Build SQL to find make a new cart
        $sql = "INSERT INTO cart (user_id, status) VALUES ('$userID', '0')";
        $result = $db->query($sql);

        // SQL again so it won't barf
        $sql = "SELECT * FROM cart WHERE status = 0 AND user_id = '$userID'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['cart'] = $row['cart_id'];
    }

    
}

$sqlC = "SELECT * FROM cart WHERE status = 1 AND user_id = '$userID'";

$order = $db->query($sqlC);

while ($entry = $order->fetch_assoc()) {
    $cart_id = $entry['cart_id'];

    echo '<div class="table-responsive">';
    echo "<table class=\"table table-dark\">";
    echo '<thead><tr><th><a href="?sorting=name">Product</a></th>';
    echo '<th>Description</th>';
    echo '<th><a href="?sorting=cost">Cost</a></th>';
    echo '<th class="test">Options</th></tr></thead>';

    $sql = " SELECT cost, description, name, quantity, product_id
    FROM content, product
    WHERE content.item_id = product.product_id
    AND content.cart_id = $cart_id";

    $joined = $db->query($sql);
    
    $total = 0;
    

    while ($row = $joined->fetch_assoc()){

        $productNum = $row['product_id'];

        // $addToCart = '<form action="cart.php" method="POST">
        // <p class="d-inline">Quantity</p>
        // <input type="number" name="quantity" value="' . $row['quantity'] . '">
        // <input type="hidden" name="item" value="' . $productNum . '">
        // <input type="hidden" name="update" value="TRUE">
        // <input type="submit" value="Update Quantity">
        // </form>
        // <form action="delete-stuff.php" method="POST">
        // <input type="hidden" name="cart" value="' . $cart_id . '">
        // <input type="hidden" name="item" value="' . $productNum . '">
        // <input type="submit" value="Remove from Cart">
        // </form>';

        # display rows and columns of data
        echo '<tr>';
        echo "<td><strong>" . $row['name'] . "</strong></td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . number_format($row['cost'], 2, ".", "") . "</td>";
        echo "<td>Quantity: " . $row['quantity'] . "</td>";
        echo '</tr>';
        $total += ($row['cost'] * $row['quantity']);
    }
    echo '</table>';
    echo    '<div id="finalize" class="d-inline-block p-3 mb-4">
            <p class="mb-0">This order\'s total cost was $' . number_format($total, 2, ".", "") . '</p>
            </div>';
    echo '</div>';

}


    


?>