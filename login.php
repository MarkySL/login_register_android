<?php
require 'connection.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $result = array();
    if ($con) {
        $sql = "select * from users where username = '".$uname."'";
        $res = mysqli_query($con,$sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            if ($uname == $row['username'] && password_verify($password, $row['password'])) {
                try {
                    $apiKey = bin2hex(random_bytes(length:23));
                } catch (Exception $e) {
                    $apiKey = bin2hex(uniqid($uname, true));
                }
                /* This Updates the api token whenever a user is created inside the database and also check if the username matches the database  */
                $sqlUpdate = "update users set apiKey = '".$apiKey."' where username = '".$uname."'";

                if (mysqli_query($con, $sqlUpdate)) {
                    $result = array("status" => "success", "message" => "Login Successfully", "username" => $row['username'], "email" => $row['email'], "apiKey" => $row['apiKey']);
                } else {
                    $result = array("status" => "failed", "message" => "Login Failed try again");
                }
            } else {
                $result = array("status" => "failed", "message" => "Retry with correct username or password");
            }
        } else {
            $result = array("status" => "failed", "message" => "Retry with correct username or password");
        }
    } else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
} else {
    $result = array("status" => "failed", "message" => "All Fields are required");
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>