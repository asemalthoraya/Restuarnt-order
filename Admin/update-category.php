<?php include"partials/menu.php"?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if(isset($_GET['id']))
        {
            // echo "GETTING THE DATA";
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category where id = $id";

            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }
            else{
                $_SESSION['no-category-found'] = "<div class='erorr'>CATEGORY NOT FOUND</div> ";
                header("location:".SITEURL."Admin/manage-category.php");
            }
        }
        else
        {
            header("location:".SITEURL."Admin/manage-category.php");
        }

        
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?> ">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                ?>
                        <!-- Display the current image -->
                        <img src="<?php echo SITEURL ;?>images/category/<?php echo $current_image;?>" height="100"
                            width="100px">
                        <?php
                            }
                            else{
                                echo "<div class='erorr'>Image not added</div>";
                            }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes"){ echo "Checked";}?> type="radio" name="featured"
                            value="Yes">Yes

                        <input <?php if($featured == "No"){ echo "Checked";}?> type="radio" name="featured"
                            value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes"){ echo "Checked";}?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active == "No"){ echo "Checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="update" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // Check whether the image selected or not
    if(isset($_FILES['image']['name']))
    {
        // Get image details 
        $image_name = $_FILES['image']['name'];

        // check whether image avalible or not
        if($image_name != "")
        {
            $ext = explode('.',$image_name);

            // Rename Image
            $image_name = "food_category".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destantion_path = '../images/category/'.$image_name;

            // Finally upload the image
            $upload = move_uploaded_file($source_path,$destantion_path)or die(mysqli_error($image_name));

            // check whether the image is upload or not
            // and if the image not uploaded display an error message and redirct the page

            if($upload == FALSE)
            {
                $_SESSION['upload'] = "<div class='erorr'>Failed to upload the image</div>";
                header('location:'.SITEURL.'Admin/manage-category.php');
                // Stop the process
                die();
            }

            // Remove the Current image if avalbile
            if($current_image != "")
            {
                $remove_path = '../images/category/'.$current_image;
                $remove =unlink($remove_path);
                // check whether the image is remove or not 
    
                if ($remove ==FALSE)
                {
                    $_SESSION['failed-remove'] ="<div class='erorr'>Failed to remove the image</div>";
                    header('location:'.SITEURL.'Admin/manage-category.php');
                    die();
                }
            }
            
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }
    $sql2 = "UPDATE tbl_category set
            title ='$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id =$id";
    $res2 = mysqli_query($conn,$sql2);

    if($res2 ==TRUE)
    {
        $_SESSION['update'] = "<div class='success'>Updated Category Successfully</div>";

        header('location:'.SITEURL.'Admin/manage-category.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='erorr'>Failed to Udated Category</div>";

        header('location:'.SITEURL.'Admin/udate-category.php');
    }
    

}

?>
<?php include"partials/footer.php"?>