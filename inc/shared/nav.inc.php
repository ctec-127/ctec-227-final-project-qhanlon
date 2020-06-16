<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="display-records.php">Shopping</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="landing.php">Home</a>
        </li>
      

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Catalogue
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="catalogue.php">Browse Catalogue</a>
            <a class="dropdown-item" href="cart.php">View Cart</a>
            <a class="dropdown-item" href="orders.php">View Orders</a>
        </div>

        </li>


        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inventory
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="inventory.php">List Items for Sale</a>
        </div>
        
        </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
            <?php 
            echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) ?  '<a class="nav-link" href="logout.php">Log Out</a>' : '<a class="nav-link" href="login.php">Log In</a>';
            ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
        </li>
    </ul>
  </div>
</nav>