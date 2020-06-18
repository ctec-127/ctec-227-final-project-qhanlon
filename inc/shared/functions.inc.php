<?php

// Allow option to pass in Inventory variable to know if it's from a managing page or just browsing.
function show_products($result, $inventory){

    // if (!empty($inventory)) {
    //     $sortLink = '';
    // } else {
    //     $sortLink = '';
    // }
    
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-dark\">";
    echo '<thead><tr><th class="table-cat"><a href="?sorting=category_id">Category</a></th>';
    echo '<th class="product"><a href="?sorting=name">Product</a></th>';
    echo '<th>Description</th>';
    echo '<th><a href="?sorting=cost">Cost</a></th>';
    echo !empty($inventory) ? '<th><a href="?sorting=stock">Stock</a></th>' : '';
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['clearance'] > 0 && !empty($inventory)) {
            if ($_SESSION['clearance'] == 2) {
                echo '<th class="w170">Options</th></tr></thead>';
            } else {
                echo '<th class="w80">Options</th></tr></thead>';
            }
        } else {
            echo '<th class="w130">Options</th></tr></thead>';
        }
    }
    
    // $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()){
        
        // Only show inventory if in the inventory view.
        if (!empty($inventory)) {
            $stock = "<td>" . $row['stock'] . "</td>";
        } else {
            $stock = '';
        }

        $productNum = $row['product_id'];

        // Just make the code for adding an item to cart
        $addToCart = '<form action="cart.php" method="POST">
        <p class="d-inline">Quantity</p>
        <select name="quantity" class="d-inline mb-2">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        </select>
        <input type="hidden" name="item" value="' . $productNum . '">
        <input type="submit" value="Add to Cart">
        </form>';

        if (isset($row['category_id'])) {
            switch ($row['category_id']) {
                case 0:
                    $category = 'General Goods';
                    break;
                case 1:
                    $category = 'Electronics';
                    break;
                case 2:
                    $category = 'Camping Gear';
                    break;
                case 3:
                    $category = 'Board Games';
                    break;
                case 4:
                    $category = 'Sports';
                    break;
                case 5:
                    $category = 'Books';
                    break;
                default:
                    $category = 'General Goods';
                    break;
            }
        } else {
            $category = "General Goods";
        }

        # display rows and columns of data
        echo '<tr>';
        echo "<td><strong>" . $category . "</strong></td>";
        echo "<td><strong>" . $row['name'] . "</strong></td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . number_format($row['cost'], 2, ".", "") . "</td>";
        echo $stock;
        if (isset($_SESSION['loggedin'])) {
            if (!empty($inventory)) {
                if ($_SESSION['clearance'] > 0 && !empty($inventory)) {
                    echo '<td><form action="inventory.php" method="POST" class="p-2 d-inline-block">
                    <input type="hidden" name="edit" value="' . $productNum . '">
                    <input type="submit" value="Edit" class="btn btn-info d-inline-block">
                    </form>';
                    if ($_SESSION['clearance'] == 2){
                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" class="d-inline-block">
                        <input type="hidden" name="delete" value="' . $productNum . '">
                        <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                        ';
                    }

                    echo "</td>";
                } 
            } else {
                echo "<td>" . $addToCart . "</td>";
            }
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}

?>