<?php
include "../admin/config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("location: {$localhost}/php/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/post_style.css">
    <title><?php echo $_GET['search'] ?></title>
</head>

<body>
    <div class="container">
        <div class="contant">
            <h1>DustBin-Post</h1>
            <div class="add-post">
                <a href="add-post.php">Add-post</a>
            </div>
        </div>
        <form class="search" method="GET" action="search.php">
            <input type="text" name="search" placeholder="search contant...">
        </form>
        <?php
        $limit = 10;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        if ($_GET['search']) {
            $search = $_GET['search'];

            $sql_post = "select * from post_blog left join category on post_blog.title = category.cid where post_blog.author like '%{$search}%' or post_blog.title_add like '%{$search}%' or post_blog.description like '%{$search}%' or category.cname like '%{$search}%' order by pid desc limit {$offset},{$limit}";

            $result_post = mysqli_query($conn, $sql_post) or die(mysqli_error($conn) . "post not found");

            if (mysqli_num_rows($result_post) > 0) {
                while ($row_post = mysqli_fetch_array($result_post)) {
        ?>
                    <div class="post-category">
                        <section class="post">
                            <img src="../admin/upload/<?php echo $row_post['image']; ?>" alt="">
                            <div class="post-cat">
                                <h3><b><?php echo $row_post['cname'] ?></b></h3>
                                <h6><?php echo $row_post['author']; ?></h6>
                                <span class="date"><?php echo $row_post['Date'] . " / "; ?></span>
                                <span class="time"><?php echo $row_post['Time']; ?></span>
                                <p><?php echo $row_post['description']; ?></p>
                                <div><a href="edit-post.php">Edit</a></div>
                            </div>
                        </section>
                    </div>
        <?php
                }
            }
        }
        $sql_page = "select * from post_blog";

        $result_page = mysqli_query($conn, $sql_page) or die(mysqli_error($conn) . "page fault");

        if (mysqli_num_rows($result_page) > 0) {
            $total_record = mysqli_num_rows($result_page);
            $total_page = ceil($total_record / $limit);

            echo "<ul class = 'list'>";
            if ($page > 1) {
                echo "<li><a href='post.php?page=" . ($page - 1) . "'>Prev</a></li>";
            }

            for ($i = 1; $i < $total_page; $i++) {

                echo "<li><a href='post.php?page=" . $i . "'>" . $i . "</a></li>";
            }

            if ($total_page > $page) {
                echo "<li><a href='post.php?page=" . ($page + 1) . "'>Next</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
    <footer>
        <div class="cont">
            <p>All the rights are reserver by <a href="">Krishna</a></p>
        </div>
    </footer>
</body>

</html>