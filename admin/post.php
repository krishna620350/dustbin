<?php
include "config.php";
include "header.php";
if ($_SESSION['role'] == 2) {
    header("location: {$localhost}/php/index.php");
}
if (!isset($_SESSION['username'])) {
    header("location: {$localhost}/php/login.php");
}
?>
<div class="user">
    <h2>Post</h2>
</div>
<?php
include "menu.php";
?>
<div class="add-data">
    <a href="add-post.php">Add-post</a>
</div>
<?php
$limit = 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "select * from post_blog order by pid desc limit {$offset},{$limit}";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "queary faield");

if (mysqli_num_rows($result) > 0) {
?>
    <div class="table-cost">
        <div class="table">
            <table>
                <tbody>
                    <thead>
                        <th>S.no</th>
                        <th>Author</th>
                        <th>Title</th>
                        <!-- <th>Added-Title</th> -->
                        <th>Description</th>
                        <th>Image</th>
                        <th>Date/Time</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    $serial = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $serial; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php
                                if ($row['title'] >= 2) {
                                    $sql_title = "select * from category";

                                    $result_title = mysqli_query($conn, $sql_title) or die(mysqli_error($conn) . "title not found");

                                    while ($row_title = mysqli_fetch_assoc($result_title)) {
                                        if ($row['title'] == $row_title['cid']) {
                                            echo $row_title['cname'];
                                        }
                                    }
                                } else {
                                    echo $row['title_add'];
                                }
                                ?></td>
                            <!-- <td><?php //echo $row['title_add']; 
                                        ?></td> -->
                            <td><?php echo substr($row['description'], 0, 20) . "...."; ?></td>
                            <td><img src="upload/<?php echo $row['image']; ?>" alt=""></td>
                            <td><?php echo $row['Date'] . "/" . $row['Time']; ?></td>
                            <td><a href="edit-post.php">Edit</b></a></td>
                            <td><a href="delete-post.php?id=<?php echo $row['pid']; ?>"><b>Delete</b></a></td>
                        </tr>
                    <?php
                        $serial += 1;
                    }
                    ?>
                </tbody>
            </table>
        <?php
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
    </div>
    <?php include "footer.php" ?>