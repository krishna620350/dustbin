<?php include "../admin/config.php";
// include "../admin/config.php";
session_start();

if (isset($_SESSION['username'])) {
    header("location: {$localhost}/php/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login-style.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="login-contant">
            <div class="login">
                <h2>login</h2>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="logni-info">
                        <label for="username">Username </label><br>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="logni-info">
                        <label for="password">Password </label><br>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="logni-info">
                        <button name="submit">submit</button>
                    </div>
                    <div class="logni-info">
                        <a href="forget.php">forget password</a>
                    </div>
                    <div class="logni-info">
                        <a href="registration.php">sing-up</a>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

                    $sql_login = "select * from users_blog where username = '{$username}' and password = '{$password}'";
                    // echo $sql_login;
                    // die();
                    $result_login = mysqli_query($conn, $sql_login) or die(mysqli_error($conn) . "login failed");
                    if (mysqli_num_rows($result_login) > 0) {
                        while ($row_login = mysqli_fetch_assoc($result_login)) {

                            $_SESSION['username'] = $row_login['username'];
                            $_SESSION['uid'] = $row_login['uid'];
                            $_SESSION['role'] = $row_login['role'];

                            header("Location: {$localhost}/php/index.php");
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>