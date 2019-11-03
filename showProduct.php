<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/User.php');
include('classes/Product.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $pro = new Product();
    $product = $pro->showProduct($product_id);
}
?>
<html>
    <!--HTML Head-->
    <?php include('inc/head.php'); ?>

    <body>

        <!--Navbar-->
        <?php include('inc/navbar.php'); ?>

        <!--Display Data if exists-->
        <?php if (isset($_GET['product_id']) && $product !== FALSE) { ?>
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-img p-3">
                            <h3 class="p-2"><?php echo $product['product_name']; ?></h3>
                            <img src="images/<?php echo $product['img_name']; ?>" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-desc py-5">
                            <h4 class="text-danger"><?php echo number_format($product['product_price']) . " $"; ?></h4>
                            <h5 class="text-muted"><?php echo $product['product_piecesNo'] . " Pieces"; ?></h5>
                            <p><strong>By: </strong><small><?php echo $product['user_name']; ?></small></p>
                            <p><strong>at: </strong><small><?php echo $product['created_at']; ?></small></p>
                            <p class="py-3 text-muted">
                                <?php echo $product['product_desc']; ?>
                            </p>
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

        <!--Footer-->
        <?php include('inc/footer.php'); ?>

        <!--Scripts-->
        <?php include('inc/scripts.php'); ?>

    </body>

</html>