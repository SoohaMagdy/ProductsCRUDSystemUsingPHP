<nav class="navbar navbar-expand-sm navbar-dark bg-dark px-5">
    <a class="navbar-brand" href="#">Route Backend</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php if (!isset($_SESSION['user_name'])) { ?>
                <li class="nav-item">
                    <a class="nav-link " href="index.php">Products</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link " href="index.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="yourProducts.php">Your Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="addProduct.php">Add Product</a>
                </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['user_name'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true"><?php echo $_SESSION['user_name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="handleLogout.php" onclick="return confirm('Do you really want to log out?');">Log Out</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>