<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/Product.php');
include('classes/Validator.php');

if (isset($_POST['submit'])) {

    //getting data 
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $product_piecesNo = $_POST['product_piecesNo'];
    $file = $_FILES['img_name'];

    //get uploaded file data
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp_name = $file['tmp_name'];
    $file_erorr = $file['error'];
    $file_size = $file['size'];

    $file_path_info = pathinfo($file_name);
    $ext = $file_path_info['extension'];

    //validation
    $validator =  new Validator();
    $product_name = $validator->product_name($product_name);
    if ($product_desc !== null) {
        $product_desc = $validator->product_desc($product_desc);
    }
    $product_price = $validator->product_price($product_price);
    $product_piecesNo = $validator->product_piecesNo($product_piecesNo);
    $img_name = $validator->product_img($file_name, $file_erorr, $ext);

    $errors = $validator->errors;
    if ($errors !== []) {
        $_SESSION['errors'] = $errors;
        header('location:addProduct.php');
    } else {
        $img_name = uniqid() . "." . $ext;
        $destination = "images/" . $img_name;
        move_uploaded_file($file_tmp_name, $destination);

        //adding new product 
        $pro = new Product();
        $$is_added = $pro->addProduct($_SESSION['user_id'], $product_name, $product_desc, $product_price, $product_piecesNo, $img_name);

        //redirect after adding
        header('location:yourProducts.php');
    }
} else {
    header('location:index.php');
}
?>