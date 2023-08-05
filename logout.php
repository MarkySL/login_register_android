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
            $sqlUpdate = "update users set apiKey = '".$apiKey."' where username = '".$uname."'";
            if (mysqli_query($con, $sqlUpdate)) {
                echo "Success";
            } else {
                echo "Logout Failed";
            }
        }else {
            echo "Unauthorized to Access";
        }
    }else {
        echo "Database Connection Failed";
    }
}else {
    echo "All Fields are required";
}

?>