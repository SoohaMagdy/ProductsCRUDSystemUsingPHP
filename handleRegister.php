<?php
include('inc/session.php');
include('classes/Db.php');
include('classes/User.php');
include('classes/Validator.php');

if (isset($_POST['submit'])) {
    //get user inputs
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    //validation
    $validator =  new Validator();
    $username = $validator->username($username);
    $email = $validator->email($email);
    $password = $validator->password($password,$rePassword);
    $errors = $validator->errors;
    
    if($errors !== []){
        $_SESSION['errors']= $errors;
        header('location:register.php');
    }
    else{

        //using user class
        $user = new User();
        $is_registered = $user->register($username, $email, $password);

        //check register
        if ($is_registered !== FALSE) {

            //set session data
            $_SESSION['user_id'] = $is_registered;
            $_SESSION['user_name'] = $user_name;
            
            //redirect if registered
            header('location:index.php');
        }
        else {

            //redirect if failed
            $_SESSION['errors'] = ['Failed to Register !'];
            header('location:register.php');
        }
        $conn->close();
    }  
}
else{ 
    header('location:index.php');
}
?>