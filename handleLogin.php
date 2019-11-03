<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/User.php');
include('classes/Validator.php');

if (isset($_POST['submit'])) {

    //get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $validator = new Validator();
    $email = $validator->email($email);
    $password = $validator->password($password,$password);

    $errors = $validator->errors;

    if($errors !== []){
        $_SESSION['errors']= $errors;

        header('location:login.php');
    }
    else{
        //using user class
        $user = new User();
        $is_login = $user->login($email, $password);

        //check logging
        if ($is_login !== FALSE){

            //set session data
            $_SESSION['user_id'] = $is_login["user_id"];
            $_SESSION['user_name'] = $is_login[ "user_name"];

            //redirect if logged
            header('location:index.php');
        }
        else {
            
            //redirect if failed
            $_SESSION['errors'] = ['Failed to Log in'];
            header('location:login.php');
        }
        $conn->close();
    }  
}else{ 
    header('location:index.php');
}
