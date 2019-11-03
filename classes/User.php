<?php
class User 
{
    public function register($username , $email , $password){
        global $conn;

        //preparing value befpre the query
        $password = sha1($password);
        $username = mysqli_real_escape_string($conn , $username);
        $email = mysqli_real_escape_string($conn , $email);

        //query of insert
        $sql = "INSERT INTO `users` (`user_name` , `user_email` , `user_password` , `created_at`)
        VALUES
        ('$username','$email','$password', CURRENT_DATE())";
    
        //check if the insert is successfull
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            return $last_id;
        } else {
            return false;
        }
    }
    public function login($email , $password){
        global $conn;

        //preparing value befpre the query
        $password = sha1($password);
        $email = mysqli_real_escape_string($conn , $email);

        //query of search
        $sql = "SELECT user_id , user_name
        FROM `users` 
        WHERE `user_email` = '$email' 
        AND `user_password` = '$password'";

        //getting result of query
        $result = $conn->query($sql);

        //check if search 
        if ($result->num_rows == 1) {

            // output data row
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
            
        }
    }
}
