<?php include "header.php" ?>
<div class="user">
    <h2>Category</h2>
</div>
<?php
    include "menu.php"; 
    include "config.php";

        $limit = 10;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

    $sql="select * from category  order by cid desc limit {$offset},{$limit}";

    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn)."queary faield");

    if(mysqli_num_rows($result)>0){
?>
<div class="add-data">
    <a href="add-post.php">Add-Category</a>
</div>
<div class="table-cost">
    <div class="table">
        <table>
            <tbody>
                <thead>
                    <th>S.no</th>
                    <th>Title-name</th>
                    <th>No-Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <?php
                    $serial = $offset+1;
                    while($row=mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $serial;?></td>
                    <td><?php echo $row['cname'];?></td>
                    <td><?php echo $row['cpost'];?></td>
                    <td><a href=""><b>Edit</b></a></td>
                    <td><a href=""><b>Delete</b></a></td>
                </tr>
                <?php
                        $serial+=1;
                    }
                ?>
            </tbody>
        </table>
        <?php 
            }
            $sql_page = "select * from category";

            $result_page = mysqli_query($conn, $sql_page) or die(mysqli_error($conn) . "page fault");

            if (mysqli_num_rows($result_page) > 0) {
                $total_record = mysqli_num_rows($result_page);
                $total_page = ceil($total_record / $limit);

                echo "<ul class = 'list'>";
                if ($page > 1) {
                    echo "<li><a href='category.php?page=" . ($page - 1) . "'>Prev</a></li>";
                }

                for ($i = 1; $i < $total_page; $i++) {

                    echo "<li><a href='category.php?page=" . $i . "'>" . $i . "</a></li>";
                }

                if ($total_page > $page) {
                    echo "<li><a href='category.php?page=" . ($page + 1) . "'>Next</a></li>";
                }
                echo "</ul>";
            }   
        ?>
    </div>
</div>
        <?php include "footer.php" ?>