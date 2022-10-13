<?php include"partials/menu.php"?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <!-- Add category form -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title category">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name='submit' value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 


    

    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];

        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            // Set the default value
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            // Set the default value
            $active = "No";
        }
        // Check whether the image file selected or not  
        // print_r($_FILES['image']);

        if(isset($_FILES['image']['name']))
        {
            // UPLOAD IMAGE
            // TO UPLOAD IMAGE WE NEED IMAGE NAME, SOURCE PATH AND DESTNATION PATH
            $image_name = $_FILES['image']['name'];
            

            // Upload the image only if selected

            if($image_name != "")
            {
                // Auto Rename image
                // Get the extention of our image(jpg,jpeg,png)
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
                    header('location:'.SITEURL.'Admin/add-category.php');
                    // Stop the process
                    die();
                }
            }
        }
        else
        {
            $image_name = "";
        }

        $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name = '$image_name',
                featured='$featured', 
                active='$active' 
                ";

        $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        if($res == TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Add Category Successfully.</div>";

            header('location:'.SITEURL.'Admin/manage-category.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='erorr'>faild to Add category.</div>";
            header('location:'.SITEURL.'Admin/add-category.php');
        }
    }
    
    
?>

<?php include"partials/footer.php"?>