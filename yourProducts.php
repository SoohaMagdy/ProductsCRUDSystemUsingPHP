<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/User.php');
include('classes/Product.php');

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

$user_id = $_SESSION['user_id'];
$pro = new Product();
$products = $pro->showUserProducts($user_id);
?>
<html>
    <!--HTML Head-->
    <?php include('inc/head.php'); ?>

    <body>

        <!--Navbar-->
        <?php include('inc/navbar.php'); ?>

        <!--Display Data if exists-->
        <?php if ($products !== FALSE) { ?>
            <div class="container py-5">
                <div class="row">
                    <?php foreach ($products as $product) { ?>
                        <!--Product Card-->
                        <div class="col-md-4">
                            <div class="card m-3" style="width: 18rem;">
                                <img src="images/<?php echo $product['img_name']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $product['product_name']; ?>
                                    </h5>
                                    <p>
                                        <small>
                                            <strong>By : </strong>
                                            <?php echo $product['user_name']; ?>
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        <?php echo substr($product['product_desc'], 0, 100) . " ..."; ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-start ">
                                        <div>
                                            <a href="showProduct.php?product_id=<?php echo $product['product_id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="editProduct.php?product_id=<?php echo $product['product_id'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="handleDeleteProduct.php?product_id=<?php echo $product['product_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure that you want to delete this product?');"><i class="fa fa-trash"></i></a>

                                        </div>
                                        <p class="text-danger font-weight-bold">
                                            <?php echo number_format($product['product_price']); ?> $
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!--Display if no data exists-->
        <?php } else { ?>
            <div class="text-center py-5">
                <h3 class="text-danger font-weight-bolder py-5">No Products Have Been Added Yet</h3>
            </div>
        <?php } ?>

        <!--Footer-->
        <?php include('inc/footer.php'); ?>

        <!--Scripts-->
        <?php include('inc/scripts.php'); ?>

    </body>

</html>