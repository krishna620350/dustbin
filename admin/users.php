<?php
include "header.php";
include "config.php";

if($_SESSION['role'] == 2 ){
    header("location: {$localhost}/php/index.php");
}
?>
<div class="user">
    <h2><b>User Data</b></h2>
</div>
<?php
include "menu.php";
?>

<div class="add-data">
    <a href="add-user.php">Add-user</a>
</div>
<div class="table-cost">
    <div class="table">
        <?php
        $limit = 10;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

        $sql_user = "select * from users_blog join role_blog where users_blog.role =role_blog.rid  order by uid desc limit {$offset},{$limit}";
        // echo $sql;
        // die();
        $result = mysqli_query($conn, $sql_user) or die(mysqli_error($conn) . "queary failed");
        // print_r ($result);
        // die();
        if (mysqli_num_rows($result) > 0) {
        ?>
            <table>
                <tbody>
                    <thead>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    $serial = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $serial ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><a href="edit-user.php   ?id=<?php echo md5($row['uid']); ?>"><b>Edit</b></a></td>
                            <td><a href="delete-user.php  ?id=<?php echo $row['uid']; ?>"><b>Delete</b></a></td>
                        </tr>
                    <?php
                        $serial += 1;
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }

        $sql_page = "select * from users_blog";

        $result_page = mysqli_query($conn, $sql_page) or die(mysqli_error($conn) . "page fault");

        if (mysqli_num_rows($result_page) > 0) {
            $total_record = mysqli_num_rows($result_page);
            $total_page = ceil($total_record / $limit);

            echo "<ul class = 'list'>";
            if ($page > 1) {
                echo "<li><a href='users.php?page=" . ($page - 1) . "'>Prev</a></li>";
            }

            for ($i = 1; $i < $total_page; $i++) {

                echo "<li><a href='users.php?page=" . $i . "'>" . $i . "</a></li>";
            }

            if ($total_page > $page) {
                echo "<li><a href='users.php?page=" . ($page + 1) . "'>Next</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
</div>
<?php include "footer.php" ?>