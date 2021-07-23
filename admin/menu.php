<?php
include "config.php";

if (!isset($_SESSION["username"])) {
    header("location: {$localhost}/admin/");
}
?>
<div class="menu">
    <div class="menu-cont">
        <a href="post.php">Post</a>
        <?php
            if($_SESSION["role"] == 1){
        ?>
        <a href="users.php">Users</a>
        <a href="category.php">Category</a>
        <?php } ?>
    </div>
</div>