<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "classroom";

    $conn = mysqli_connect($serverName,$userName,$password,$dbName);

    if(!$conn){
        die("connection Faild :".mysqli_connect_error());
    }
    else{
       
    }


 ?>