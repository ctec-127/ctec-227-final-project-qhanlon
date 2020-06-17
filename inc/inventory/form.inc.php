<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="m-3 p-3">
    <label for="product">Product</label>
    <input type="text" id="product" name="product" value="<?php echo (isset($product) ? $product: '');?>">
    <br>
    <label for="description">Description</label>
    <textarea id="description" name="description" maxlength="512" rows="7" cols="40"><?php echo (isset($description) ? $description: '');?></textarea>
    <br>
    <label for="cost">Cost (in dollars)</label>
    <input type="number" id="cost" name="cost" value="<?php echo (isset($cost) ? $cost: '');?>" step="0.01" min="0" max="99999999999">
    <br>
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" value="<?php echo (isset($stock) ? $stock: '');?>">
    <br>
    <label for="category">Product Category</label>
    <?php 
        if (isset($category_id)) { 
            $cat = $category_id;
        } else {
            $cat = NULL;
        } 
    ?>
    <select name="category" id="category">
        <option value="-" <?php if (empty($cat)) {echo "selected";}?>>--Please select a Category--</option>
        <option value="0" <?php if ($cat == "0") {echo "selected";}?>>General Goods</option>
        <option value="1" <?php if ($cat == "1") {echo "selected";}?>>Electronics</option>
        <option value="2" <?php if ($cat == "2") {echo "selected";}?>>Camping Gear</option>
        <option value="3" <?php if ($cat == "3") {echo "selected";}?>>Board Games</option>
        <option value="4" <?php if ($cat == "4") {echo "selected";}?>>Sports</option>
        <option value="5" <?php if ($cat == "5") {echo "selected";}?>>Books</option>
    </select>
    <br>
    <input type="hidden" name="editing" value="<?php echo (isset($_POST['edit']) || !empty($editing)) ? $editing : '' ?>">
    <input type="submit" value="<?php echo (isset($_POST['edit']) || !empty($editing)) ? "Update Listing" : "List Item" ?>">
</form>