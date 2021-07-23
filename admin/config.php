<?php
    $host= "localhost";
    $username= "root";
    $password= "";
    $database= "blogsite";
    $conn=mysqli_connect($host,$username,$password,$database) or die(mysqli_connect_error()."connection failed");

    $localhost= "http://$host/blog";
?>