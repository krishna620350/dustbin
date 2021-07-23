<?php
include "../admin/config.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("location: {$localhost}/php/login.php");
}
?>
<?php include "header.php" ?>
<div class="contant">
    <div class="header">
        <h1>DustBin</h1>
        <h3>Edit-Post</h3>
    </div>
</div>
<?php
$post_author = $_SESSION['username'];
$sqli_post_update = "select * from post_blog where author = '{$post_author}'";
$result_post_update = mysqli_query($conn, $sqli_post_update) or die(mysqli_error($conn) . "update fault");
if (mysqli_num_rows($result_post_update) > 0) {
    while ($row_post_update = mysqli_fetch_array($result_post_update)) {
?>
        <form class="form-cont" action="update-post.php" method="POST" enctype="multipart/form-data">
            <div class="form-category">
                <div class="form-input">
                    <label>Author :-</label><br>
                    <input type="text" name="author" value="<?php echo $post_author; ?>" required>
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
                                if ($row_post_update['title'] == $row_category['cid']) {
                                    echo "<option values =" . $row_category['cid'], " selected >" . $row_category['cname'] . "</option>";
                                } else {
                                    echo "<option values =" . $row_category['cid'], " selected >" . $row_category['cname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    <?php } ?>
                    <h4>Or</h4>
                    <input type="text" name="title" value="<?php echo $row_post_update['title_add']; ?>">
                </div>
                <div class="form-input">
                    <label>Description :-</label><br>
                    <textarea type="text" name="description" required><?php echo $row_post_update['description']; ?></textarea>
                </div>
                <div class="form-input">
                    <label>Image :-</label><br>
                    <input type="file" name="new-image">
                    <img src="../admin/upload/<?php echo $row_post_update['image'] ?>" alt="" style="width:50%;height:50%">old image
                    <input type="file" name="old-image" hidden>
                </div>
                <div class="form-input">
                    <div class="butn">
                        <button name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
<?php
    }
}
?>