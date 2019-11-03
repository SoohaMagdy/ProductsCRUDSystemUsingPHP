<?php 
include('inc/session.php');
include('classes/Db.php');
include('classes/Product.php');

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
else{
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $user_id =$_SESSION['user_id'];
        $pro = new Product();
        $is_deleted = $pro->deleteProduct($product_id , $user_id);
        if ($is_deleted == FALSE ) {
            # code...
        }else{
            header('location:yourProducts.php');
        }
    }
}
?>