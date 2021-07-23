<?php
    include "config.php";
    
    $user_id = $_GET['id'];

    $sql_del = "delete from users_blog where uid = {$user_id}";

    if(mysqli_query($conn,$sql_del)){
        header("Location: {$localhost}/admin/users.php");
    }else{
        echo "record not found";
    }
?>