<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
            }  
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            } 
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            } 
        ?>
        <br><br>
        <!-- btn Add Admin -->
        <a href="<?php echo SITEURL;?>Admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count >0)
                {
                    // we have data
                    $sn =1;
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active =$row['active'];

                        ?>
            <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $title?></td>
                <td>
                    <?php 
                    // Check whether image name is avalibe or not
                    if($image_name !="")
                    {
                    ?>
                    <!-- Display the Image -->
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px"
                        height="100px">
                    <?php
                    }
                    else{
                        echo "<div class='erorr'>Image not Added</div> ";
                    }
                    
                    ?>
                </td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
                    <a href="<?php echo SITEURL;?>Admin/update-category.php?id=<?php echo $id;?>"
                        class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL;?>Admin/delete-category.php?id=<?php echo $id?>"
                        class="btn-danger">Delete Category</a>
                </td>
            </tr>

            <?php
                    }
                }
                else
                {
                    // we dont have data
                    ?>

            <tr>
                <td colspan="6" class="erorr">No Category Added</td>
            </tr>

            <?php
                }
            ?>


        </table>
    </div>
</div>




<?php include("partials/footer.php")?>