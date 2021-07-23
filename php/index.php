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
    <link rel="stylesheet" href="../css/index.css">
    <title>Dustbin</title>
</head>

<body>
    <div class="container">
        <div class="contant">
            <header>
                <h1>DustBin</h1>
            </header>
            <div class="header-btn">
                <a href="logout.php"><?php echo "hello" . $_SESSION['username']; ?></a>
            </div>
        </div>
        <div class="post-cont">
            <div class="reflex">
                <h2>Post</h2>
                <div class="post-btn">
                    <a href="post.php">post</a>
                </div>
            </div>
        </div>
        <div class="about-contant">
            <h2>About</h2>
            <div class="about-cont">
                <div class="about-para">
                    <p>If you don’t, then you’ve come to the right place. In 1994, when blogs began, a blog was more of a personal diary that people shared online. In this online journal, you could talk about your daily life or share about things that you were doing. Then, people saw an opportunity to communicate information in a new way online. Thus began the beautiful world of blogging</p>
                </div>
                <div class="about-img">
                    <img src="../image/aboutImg.jpg" alt="">
                </div>
            </div>
        </div>
        <section class="blog-cont">
            <h2>Blog</h2>
            <div class="blog">
                <?php
                include "../admin/config.php";
                $limit = 3;
                $count = 0;
                $sql_blog = "select * from post_blog order by pid desc";

                $result_blog = mysqli_query($conn, $sql_blog) or die(mysqli_error($conn));

                if (mysqli_num_rows($result_blog) > 0) {
                    while (($row_blog = mysqli_fetch_assoc($result_blog)) && $count < $limit) {
                ?>
                        <div class="blog-post">
                            <div class="image">
                                <img src="../admin/upload/<?php echo $row_blog['image']; ?>" alt="">
                            </div>
                            <h3><?php echo $row_blog['author'] ?></h3>
                            <div class="discription">
                                <?php echo $row_blog['description'] ?>
                            </div>

                        </div>
                <?php
                        $count += 1;
                    }
                }
                ?>
            </div>
        </section>
        <footer>
            <div class="footer">
                <div class="imp-link">
                    <div class="link">
                        <ul>
                            <li><a href="php/post.php">post</a></li>
                            <li><a href="php/login.php">login</a></li>
                            <li><a href="php/registration.php">sing-up</a></li>
                        </ul>
                    </div>
                </div>
                <div class="contact">
                    <h2>contact</h2>
                    <p>Name :-krishna<br>Email :- krishna966120@gmai.com</p>
                </div>
            </div>
            <p>All rights are reserved by <a>krishna</a></p>
        </footer>
    </div>
</body>

</html>