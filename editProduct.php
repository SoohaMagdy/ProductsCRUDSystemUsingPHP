<!--Session Authentication-->
<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/Product.php');

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}
?>

<html>

    <!--HTML Head-->
    <?php include('inc/head.php'); ?>

    <!--Product Authentication-->
    <?php
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $pro = new Product();
        $product = $pro->showProduct($product_id);
        $_SESSION['product_id'] = $product_id;
    }
    ?>

    <body>
        <!--Navbar-->
        <?php include('inc/navbar.php'); ?>

        <!--Display if Error in data -->
        <?php if (isset($_SESSION['errors']) && $_SESSION['errors'] != []) { ?>
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-6 offset-md-3">
                        <?php foreach ($_SESSION['errors'] as $error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php $_SESSION['errors'] = []; ?>

        <!--Display Data if exists-->
        <section>
            <?php if (isset($_GET['product_id']) && $product !== FALSE && $product['user_id'] == $_SESSION['user_id']) { ?>
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-8 m-auto justify-content-center">
                            <div class="form-group border p-4">
                                <h2 class="text-center">Edit Product</h2>
                                <form action="handleEditProduct.php" method="post">
                                    <div class="form-group">
                                        <label>Product Name : </label>
                                        <input type="text" name="product_name" id="product_name" value="<?php echo $product['product_name']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Description : </label>
                                        <textarea name="product_desc" id="product_desc" rows="7" class="form-control"><?php echo $product['product_desc']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Price: </label>
                                        <input type="number" name="product_price" id="product_price" value="<?php echo $product['product_price']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Pieces Number : </label>
                                        <input type="number" name="product_piecesNo" id="product_piecesNo" value="<?php echo $product['product_piecesNo']; ?>" class="form-control">
                                    </div>
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary"> Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Display if no data exists-->
            <?php } else { ?>
                <div class="text-center py-5">
                    <h3 class="text-danger font-weight-bolder py-5">Product Not Found</h3>
                </div>
            <?php } ?>
        </section>

        <!--Footer-->
        <?php include('inc/footer.php'); ?>

        <!--Scripts-->
        <?php include('inc/scripts.php'); ?>

    </body>

</html>