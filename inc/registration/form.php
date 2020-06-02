<form>
    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo (isset($username) ? $username: '');?>">
    <br>
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo (isset($first_name) ? $first_name: '');?>">
    <br>
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo (isset($last_name) ? $last_name: '');?>">
    <br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?php echo (isset($email) ? $email: '');?>">
    <br>
    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="<?php echo (isset($address) ? $address: '');?>">
    <br>
    <label for="city">City</label>
    <input type="text" id="city" name="city" value="<?php echo (isset($city) ? $city: '');?>">
    <br>
    <label for="state">State</label>
    <input type="text" id="state" name="state" value="<?php echo (isset($state) ? $state: '');?>">
    <br>
    <label for="zip">Zip Code</label>
    <input type="text" id="zip" name="zip" value="<?php echo (isset($zip) ? $zip: '');?>">
    <br>
    <label for="password">Password</label>
    <input type="text" id="password" name="password" value="<?php echo (isset($password) ? $password: '');?>">
    <br>
    <label for="password2">Confirm Password</label>
    <input type="text" id="password2" name="password2" value="<?php echo (isset($password2) ? $password2: '');?>">
    <br>
    <input type="submit" value="Register">
</form>