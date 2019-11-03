<?php
class Product
{
    public function showAllProducts()
    {
        global $conn;
        $sql = "SELECT users.user_name , products.* , product_imgs.img_name
        FROM users JOIN products JOIN product_imgs
        ON users.user_id = products.user_id 
        AND products.product_id = product_imgs.product_id
        ORDER By products.product_id DESC";

        $result = $conn->query($sql);
        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($products, $row);
            }
            return $products;
        } else {
            return false;
        }
    }

    public function showProduct($product_id)
    {
        global $conn;
        $sql = "SELECT users.user_name , products.* , product_imgs.img_name
        FROM users JOIN products JOIN product_imgs
        ON users.user_id = products.user_id 
        AND products.product_id = product_imgs.product_id
        WHERE products.product_id = '$product_id'";

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $product = $result->fetch_assoc();
            return $product;
        } else { 
            return false;
        }
    }

    public function showUserProducts($user_id)
    {
        global $conn;
        $sql = "SELECT users.user_id , users.user_name , products.* , product_imgs.img_name
        FROM users JOIN products JOIN product_imgs
        ON users.user_id = products.user_id 
        AND products.product_id = product_imgs.product_id
        WHERE users.user_id = '$user_id'
        ORDER By products.product_id DESC";

        $result = $conn->query($sql);
        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($products, $row);
            }
            return $products;
        } else {
            return false;
        }
    }

    public function addProduct($user_id, $product_name, $product_desc, $product_price, $product_piecesNo, $img_name)
    {
        global $conn;
        //prepare data before query
        $product_name = mysqli_real_escape_string($conn, $product_name);
        $product_desc = mysqli_real_escape_string($conn, $product_desc);

        //query of insert
        $sql = "INSERT INTO `products` (`user_id` , `product_name`, `product_desc`, `product_price`, `product_piecesNo` , `created_at`)
        VALUES
        ('$user_id','$product_name','$product_desc', '$product_price', '$product_piecesNo', CURRENT_DATE())";

        //check if the insert is successfull
        if ($conn->query($sql) === TRUE) {

            $last_id = $conn->insert_id;

            //query of the second insert 
            $sql = "INSERT INTO `product_imgs` (`product_id` , `img_name`)
            VALUES
            ('$last_id','$img_name')";

            //check if the insert is successfull
            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateProduct($product_id, $product_name, $product_desc, $product_price, $product_piecesNo)
    {
        global $conn;
        //prepare data before query
        $product_name = mysqli_real_escape_string($conn, $product_name);
        $product_desc = mysqli_real_escape_string($conn, $product_desc);

        //query of insert
        $sql = "UPDATE `products` 
                SET `product_name`='$product_name', 
                    `product_desc`='$product_desc', 
                    `product_price`='$product_price', 
                    `product_piecesNo`='$product_piecesNo' 
                WHERE `product_id`='$product_id'";

        //check if the insert is successfull
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($product_id, $user_id)
    {
        global $conn;

        //query of delete
        $sql = "DELETE FROM `products`
        WHERE `product_id`='$product_id'
        AND `user_id`='$user_id'";

        //check if the insert is successfull
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>