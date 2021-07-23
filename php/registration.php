<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index-style.css">
    <title>sing-up</title>
</head>

<body>
    <div class="container">
        <div class="login-contant">
            <div class="login">
                <h2>Sing-Up</h2>
                <?php
                    include "../admin/config.php";
                    if(isset($_POST['submit'])){
                        $name = mysqli_real_escape_string($conn,$_POST['name']);
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

                        $sql_up = "select username from users_blog";
                        $result_up = mysqli_query($conn,$sql_up) or die(mysqli_error($conn)."up failed");
                        if(mysqli_num_rows($result_up)>0){
                            while($row_up = mysqli_fetch_assoc($result_up)){
                                if($row_up['username']!=$username){
                                    $sql_up_insert = "insert into users_blog(name,username,email,password,role) values ('{$name}','{$username}','{$email}','{$password}',2)";
                                    // echo $sql_up_insert;
                                    // die();
                                    if(mysqli_query($conn,$sql_up_insert)){
                                        header("Location: {$localhost}/php/login.php");
                                    }
                                    break;
                                }else{
                                    echo "user is present";
                                }
                            }
                        }
                    }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="logni-info">
                        <label for="username">Name </label><br>
                        <input type="text" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="logni-info">
                        <label for="username">Username </label><br>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="logni-info">
                        <label for="username">Email Id </label><br>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="logni-info">
                        <label for="password">Password </label><br>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="logni-info">
                        <button name="submit">submit</button>
                    </div>
                    <div class="logni-info">
                        <a href="login.php">login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>