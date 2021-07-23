<?php include "header.php";
    if (isset($_POST['submit'])) {
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        $sql_update1 = "update users_blog set name = '{$name}',username = '{$username}',email = '{$email}',password = '{$password}',role = {$role} where uid = {$uid}";

        if (mysqli_query($conn,$sql_update1)) {
            header("Location: {$localhost}/admin/users.php");
        }
    }
?>
<div class="edit-cont">
    <h2>Edit-User</h2>

    <form class="form-cont" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php

        if ($_GET['id']) {
            $sql = "select * from users_blog";

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($_GET['id'] == md5($row['uid'])) {
        ?>
                    <div class="form-category">
                    <input type="text" name="uid" value="<?php echo $row['uid']; ?>" hidden>
                        <div class="form-input">
                            <label>Name :-</label><br>
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="form-input">
                            <label>Username :-</label><br>
                            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
                        </div>
                        <div class="form-input">
                            <label>Email Id :-</label><br>
                            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                        </div>
                        <div class="form-input">
                            <label>Password :-</label><br>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-input">
                            <label>Role :-</label><br>
                            <?php
                            $sql_role = "select * from role_blog ";

                            $result_role = mysqli_query($conn, $sql_role) or dir(mysqli_error($conn) . "title queary");

                            if (mysqli_num_rows($result_role) > 0) {
                            ?>
                                <select class="form-control" name="role" required>
                                    <?php
                                    while ($row_category = mysqli_fetch_assoc($result_role)) {
                                        if($row['role'] == $row_category['rid']){
                                            echo "<option value =". $row_category["rid"]." selected>".$row_category['role']. "</option>";
                                        }else{
                                            echo "<option value =" . $row_category["rid"] . ">" . $row_category['role'] . "</option>";
                                        }
                                    }
                                    ?>
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
                    <?php
                                }
                            }
                        }
                    ?>
    </form>
</div>