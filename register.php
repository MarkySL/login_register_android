<?php
require 'connection.php';

if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // THIS WILL ENCRYPT THE PASSWORD
    if ($con) {
        $sql = "insert into users (username,email,password) values ('".$uname."','".$email."','".$password."')";
        if (mysqli_query($con, $sql)) {
            echo "Registration Success";
        } else {
            echo "Registration Failed";
        }
    } 
} else {
    echo "All Fields are required";
}


?>