<?php
include "../admin/config.php";
session_start();
if (empty($_FILES['new-image']['name'])) {
    $target = $_POST['old-image'];
}else{
    if (isset($_POST['submit'])) {
        if (isset($_FILES['new-image'])) {
            $arrayerror = array();

            $file_name = $_FILES['new-image']['name'];
            $file_size = $_FILES['new-image']['size'];
            $file_temp = $_FILES['new-image']['tmp_name'];
            $file_type = $_FILES['new-image']['type'];
            $file_ext = end(explode('.', $file_name));
            $extension = array("jpeg", "jpg", "png");


            if (in_array($file_ext, $extension) === false) {
                $error[] = "this extension file is not allowed , plese choose jpg or png image";
            }
            if ($file_size > 5242880) {
                $error[] = "file size must be less than 2MB";
            }

            $new_name = time() . "-" . basename($file_name);
            $target = "../admin/upload/" . $new_name;
            $image_name = $new_name;
            if (empty($error) == true) {
                move_uploaded_file($file_temp, $target);
            } else {
                print_r($error);
                die();
            }
        }
        $author = $_SESSION['username'];
        
        $sql_img = "select * from post_blog where author = '{$author}'";

        $result_img = mysqli_query($conn, $sql_img) or die();

        $row_img = mysqli_fetch_array($result_img);
        unlink("../admin/upload/".$row_img['image']);

        // die("image deleted");
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        if ($category != "none") {
            $sql = "select * from category";
            $result = mysqli_query($conn, $sql) or die();
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    if($row['cname'] == $category){
                        $sql_post = "update post_blog set author = '{$author}', description = '{$description}',title = {$row['cid']},image = '{$image_name}' where author = '{$author}'";

                        $result_post = mysqli_query($conn, $sql_post) or die(mysqli_error($conn) . "post insertion faield");

                        if ($result_post) {
                            header("location: {$localhost}/php/post.php");
                        } else {
                            echo "< class='usererror'><h2>not insert properly</h2></ div>";
                        }
                    }
                }
            }
        } else {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $sql_post = "update post_blog set author = '{$author}', description = '{$description}',title_add = '{$title}',title = 2,image = '{$image_name}' where author = '{$author}'";

            if (mysqli_query($conn, $sql_post)) {

                header("location: {$localhost}/php/post.php");
            } else {
                echo "<div class='usererror'><h2>not insert properly</h2></div>";
            }
        }
    }
}
?>