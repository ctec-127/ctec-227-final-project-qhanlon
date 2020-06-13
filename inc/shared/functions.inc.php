<?php

// Allow option to pass in Inventory variable to know if it's from a managing page or just browsing.
function show_products($result, $inventory){
    
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-dark\">";
    echo '<thead><tr><th class="table-cat"><a href="?sorting=category_id">Category</a></th>';
    echo '<th><a href="?sorting=name">Product</a></th>';
    echo '<th>Description</th>';
    echo '<th><a href="?sorting=cost">Cost</a></th>';
    echo !empty($inventory) ? '<th><a href="?sorting=stock">Stock</a></th>' : '';
    echo '<th>Options</th></tr></thead>';
    
    // $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()){
        
        // Only show inventory if in the inventory view.
        if (!empty($inventory)) {
            $stock = "<td>" . $row['stock'] . "</td>";
        } else {
            $stock = '';
        }

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
        echo "<td>" . number_format($row['cost'], 2, ".", "") . "</td>";
        echo $stock;
        // echo "<td><a href=\"update-record.php?id=" . $row['id'] . "\" onclick=\"return confirm('Do you want to edit this entry?');\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}

?>