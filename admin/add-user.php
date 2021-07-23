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
                <h3>Add-User</h3>
            </div>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $role = mysqli_real_escape_string($conn, $_POST['role']);

            $check_sql = "select * from users_blog where username = '{$username}'";

            $check_username = mysqli_query($conn, $check_sql) or die(mysqli_error($conn) . "sql fault");

            if (mysqli_num_rows($check_username) > 0) {
                echo "<div class='usererror'><h2>choose another username<br>username already present !</h2></div>";
            } else {

                $sql = "insert into users_blog(name,username,email,role,password) values ('{$name}','{$username}','{$email}',{$role},'{$password}')";

                // echo $sql;
                // die();
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "insert queary faield");
                if ($result) {
                    header("location: {$localhost}/admin/users.php");
                } else {
                    echo "<div class='usererror'><h2>not insert properly</h2></div>";
                }
            }
        }
        ?>
        <form class="form-cont" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-category">
                <div class="form-input">
                    <label>Name :-</label><br>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-input">
                    <label>Username :-</label><br>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-input">
                    <label>Email Id :-</label><br>
                    <input type="email" name="email" placeholder="Enter your email id" required>
                </div>
                <div class="form-input">
                    <label>Password :-</label><br>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-input">
                    <label>Role :-</label><br>
                    <?php
                    $sql_role = "select * from role_blog";

                    $result_role = mysqli_query($conn, $sql_role) or dir(mysqli_error($conn) . "title queary");

                    if (mysqli_num_rows($result_role) > 0) {
                    ?>
                        <select class="form-control" name="role" required>
                            <?php
                            while ($row = mysqli_fetch_assoc($result_role)) {
                            ?>
                                <option value="<?php echo $row['rid']; ?>"><?php echo $row['role'] ?></option>
                            <?php } ?>
                            <!-- <option value="2"></option> -->
                        </select>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-input">
                    <div class="butn">
                        <button name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>