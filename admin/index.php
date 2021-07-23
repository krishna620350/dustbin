<?php
include "config.php";
session_start();
if (isset($_SESSION["username"])) {
    header("location: {$localhost}/admin/post.php");
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
            </div>
        </div>
        <div class="login">
            <div class="login-page">
                <h2>Login</h2>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="uid" hidden>
                    <input type="text" name="role" hidden>
                    <div class="form-contant">
                        <label>Username</label><br>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-contant">
                        <label>password</label><br>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="submit">
                    </div>
                    <a href="">Forget Password</a>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                    $sql = "select * from users_blog where username ='{$username}'and password = '{$password}'";
                    // echo $sql;
                    // die();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "queary faield");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            session_start();

                            $_SESSION["username"] = $row['username'];
                            $_SESSION["uid"] = $row['uid'];
                            $_SESSION["role"] = $row['role'];

                            header("location: {$localhost}/admin/post.php");
                        }
                    } else {
                        echo "<div class='usererror'><h2>user not found</h2></div>";
                    }
                }
                ?>
            </div>
        </div>

        <?php include "footer.php"; ?>
    </div>
</body>

</html>