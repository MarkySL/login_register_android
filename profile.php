<?php
require 'connection.php';

if (!empty($_POST['username']) && (!empty($_POST['apiKey']))) {
    $uname = $_POST['username'];
    $apiKey = $_POST['apiKey'];
    $result = array();

    if ($con) {
        $sql = "select * from users where username = '".$uname."' and apiKey = '".$apiKey."'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $result = array("status" => "success", "message" => "Data Fetched Successfully", "username" => $row['username'], "email" => $row['email'], "apiKey" => $row['apiKey']);
        }else {
            $result = array("status" => "failed", "message" => "Unauthorized Access");
        }
    }else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
}else {
    $result = array("status" => "failed", "message" => "All Fields are required");
}

?>