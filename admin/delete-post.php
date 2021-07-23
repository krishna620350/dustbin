<?php
    include "config.php";

    $user_id = $_GET['id'];

    $sql_img = "select * from post_blog where pid = {$user_id}";

    $result_img = mysqli_query($conn,$sql_img) or die(mysqli_error($conn)."delete image failed");

    $row_img = mysqli_fetch_assoc($result_img);
    
    unlink("upload/".$row_img['image']);

    $sql_del = "delete from post_blog where pid = {$user_id}";

    if(mysqli_query($conn,$sql_del)){
        header("Location: {$localhost}/admin/post.php");
    }else{
        echo "redord not found";
    }
?>