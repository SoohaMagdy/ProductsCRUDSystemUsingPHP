<?php
class Validator
{
    var $errors = [];
    public function username($username)
    {
        if ($username == '') {
            $error = 'Username can not be Null';
        } else if (!is_string($username)) {
            $error = 'Username must be string';
        } else if (strlen($username) < 5) {
            $error = 'Username must be greater than 5 characters';
        } else if (strlen($username) > 100) {
            $error = 'Username must be less than 100 characters';
        } else {
            return $username;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function email($email)
    {
        if ($email == '') {
            $error = 'Email can not be Null';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email is not valid';
        } else if (strlen($email) > 100) {
            $error = 'Email must be less than 100 characters';
        } else {
            return $email;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function password($password, $rePassword)
    {
        if ($password == '') {
            $error = 'Password can not be Null';
        } else if (strlen($password) < 5) {
            $error = 'Password must be greater than 5 characters';
        } else if (strlen($password) > 100) {
            $error = 'Password must be less than 100 characters';
        } else if ($password !== $rePassword) {
            $error = 'Password is not matched';
        } else {
            return $password;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function product_name($product_name)
    {
        if ($product_name == '') {
            $error = 'Product name can not be Null';
        } else if (!is_string($product_name)) {
            $error = 'Product name must be string';
        } else if (strlen($product_name) < 5) {
            $error = 'Product name must be greater than 5 characters';
        } else if (strlen($product_name) > 100) {
            $error = 'Product name must be less than 100 characters';
        } else {
            return $product_name;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function product_desc($product_desc)
    {

        if ($product_desc == '') {
            $error = 'Product description can not be Null';
        } else if (!is_string($product_desc)) {
            $error = 'Product description must be string';
        } else if (strlen($product_desc) > 3000) {
            $error = 'Product description must be less than 100 characters';
        } else {
            return $product_desc;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function product_price($product_price)
    {
        if ($product_price == '') {
            $error = 'Product price can not be Null';
        } else if (!is_double((float) $product_price)) {
            $error = 'Product price must be number';
        } else {
            return $product_price;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function product_piecesNo($product_piecesNo)
    {
        if ($product_piecesNo == '') {
            $error = 'Product pieces number can not be Null';
        } else if (!is_integer((int) $product_piecesNo)) {
            $error = 'Product pieces number must be number';
        } else {
            return $product_piecesNo;
        }
        array_push($this->errors, $error);
        return false;
    }

    public function product_img($file_name, $file_error, $ext)
    {
        $types = ['jpg', 'jpeg', 'png', 'gif'];

        if ($file_name == '' || $file_error !== 0) {
            $error = 'Image is required';
        } else if ($file_error !== 0) {
            $error = 'Error while uploading file';
        } else if (!in_array($ext, $types)) {
            $error = 'File type is not an image';
        } else {
            return true;
        }
        array_push($this->errors, $error);
        return false;
    }
}
?>