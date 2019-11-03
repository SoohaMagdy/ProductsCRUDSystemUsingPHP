<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/Product.php');
include('classes/Validator.php');

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {
        //getting data 
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $product_piecesNo = $_POST['product_piecesNo'];

        //validation
        $validator =  new Validator();
        $product_name = $validator->product_name($product_name);
        if ($product_desc !== null) {
            $product_desc = $validator->product_desc($product_desc);
        }
        $product_price = $validator->product_price($product_price);
        $product_piecesNo = $validator->product_piecesNo($product_piecesNo);

        $errors = $validator->errors;
        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header('location:editProduct.php?product_id=' . $_SESSION['product_id']);
        } else {

            //updating products
            $pro = new Product();
            $$is_added = $pro->updateProduct($_SESSION['product_id'], $product_name, $product_desc, $product_price, $product_piecesNo);

            if ($is_added = true) {
                //redirect if updating success
                header('location:showProduct.php?product_id=' . $_SESSION['product_id']);
            } else {
                //redirect if updating failed
                header('location:editProduct.php?product_id=' . $_SESSION['product_id']);
            }
        }
    } else {
        header('location:index.php');
    }
}
?>