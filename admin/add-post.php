<?php
include "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location: {$localhost}/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/logout.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="contant">
            <div class="header">
                <h1>Admin Dashboard</h1>
                <h3>Add-Post</h3>
            </div>
        </div>
        <?php
            if(isset($_POST['submit'])){
                if (isset($_FILES['image'])) {
                    $arrayerror = array();

                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_temp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];
                    $file_ext = end(explode('.',$file_name));
                    $extension = array("jpeg", "jpg", "png");


                    if (in_array($file_ext, $extension) === false) {
                        $error[] = "this extension file is not allowed , plese choose jpg or png image";
                    }
                    if ($file_size > 5242880) {
                        $error[] = "file size must be less than 2MB";
                    }

                    $new_name = time() . "-" . basename($file_name);
                    $target = "upload/" . $new_name;
                    $image_name = $new_name;
                    if (empty($error) == true) {
                        move_uploaded_file($file_temp, $target);
                    } else {
                        print_r($error);
                        die();
                    }
                }   
                $author=$_SESSION['username'];
                $category=mysqli_real_escape_string($conn,$_POST['category']);
                $description=mysqli_real_escape_string($conn,$_POST['description']);
        
                $date = date("Y-m-d");
                $time = date("H:i:s");

                if($category != 2){
                    $sql_post = "insert into post_blog(author,title,description,image,Date,Time) values ('{$author}',{$category},'{$description}','{$image_name}','{$date}','{$time}')";
                    
                    $result_post = mysqli_query($conn, $sql_post) or die    (mysqli_error($conn) . "post insertion faield");
                    
                    if ($result_post) {
                        header("location: {$localhost}/admin/post.php");
                    } else {
                        echo "< class='usererror'><h2>not insert properly</h2></ div>";
                    }
                }else{
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $sql_post = "insert into post_blog(author,title_add,description,image,Date,Time) values ('{$author}','{$title}','{$description}','{$image_name}','{$date}','{$time}')";
                    

                    if (mysqli_query($conn, $sql_post)) {
                            header("location: {$localhost}/admin/post.php");
                    } else {
                        echo "<div class='usererror'><h2>not insert properly</h2></div>";
                    }
                }
            }
        ?>
        <form class="form-cont" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-category">
                <div class="form-input">
                    <label>Author :-</label><br>
                    <input type="text" name="author" value="<?php echo $_SESSION['username'];?>" required>
                </div>
                <div class="form-input">
                    <label>Category :-</label><br>
                    <?php
                    $sql_category = "select * from category ";

                    $result_category = mysqli_query($conn, $sql_category) or die(mysqli_error($conn) . "category queary failed");

                    if (mysqli_num_rows($result_category) > 0) {
                    ?>
                        <select class="form-control" name="category" required>
                            <?php
                            while ($row_category = mysqli_fetch_assoc($result_category)) {
                            ?>
                                <option value="<?php echo $row_category['cid']; ?>"><?php echo $row_category['cname']; ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <h4>Or</h4>
                    <input type="text" name="title" placeholder="Enter your own title or choose from dropdown">
                </div>
                <div class="form-input">
                    <label>Description :-</label><br>
                    <textarea type="text" name="description" placeholder="Enter description....." required></textarea>
                </div>
                <div class="form-input">
                    <label>Image :-</label><br>
                    <input type="file" name="image" required>
                </div>
                <div class="form-input">
                    <div class="butn">
                        <button name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>