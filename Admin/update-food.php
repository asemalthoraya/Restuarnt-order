<?php include"partials/menu.php";?>

<?php 

    if(isset($_GET['id']))
    {

        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn,$sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        header('location:'.SITEURL.'Admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <H1>Update Food</H1>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Descripation:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" value="<?php echo $price;?>" name="price"></td>
                </tr>
                <tr>
                    <td>Current iamge:</td>
                    <td>
                        <?php 
                            if($current_image =="")
                            {
                                echo "<div class='erorr'>Image Not available</div>";
                            }
                            else
                            {
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px">
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                            
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                            <option <?php if($current_category == $category_id)echo 'selected';?>
                                value='<?php echo $category_id?>'>
                                <?php echo $category_title?>
                            </option>";
                            <?php
                            }
                            }
                            else
                            {
                            echo "<option value='1'>No Category Found !</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") {echo "checked";}?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if($featured == "No") {echo "checked";}?> type="radio" name="featured"
                            value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No") {echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update food" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name != "")
            {
                
                $ext = explode('.',$image_name);
                $file_ext = end($ext);
                $image_name = 'food-name-'.rand(00,99).'.'.$file_ext;

                $src_path = $_FILES['image']['tmp_name'];

                $destination = '../images/food/'.$image_name;

                $upload = move_uploaded_file($src_path,$destination);

                if($upload == false)
                {
                    $_SESSION['uplaod'] = "<div class='erorr'>Failed to upload image</div>";
                    header('location:'.SITEURL."Admin/add-food.php");
                    die();
                }

                // Remove current image 

                if($current_image !="")
                {
                    $remove_path  = '../images/food/'.$current_image;

                    $remove = unlink($remove_path) or die(mysqli_error($conn));

                    if($remove == false)
                    {
                        $_SESSION['remove-failed'] = "<div class='erorr' >Failed to remove current image.</div>";
                        header('location:'.SITEURL.'Admin/manage-food.php');                        
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

        $sql3 = "UPDATE tbl_food Set
                title ='$title',
                description = '$description',
                price =$price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id =$id
                ";
        
        $res3 = mysqli_query($conn,$sql3);
        if($res3 ==true)
        {
            $_SESSION['update'] = "<div class='success'>Updated Food Successfully</div>";
            // header('location:'.SITEURL.'Admin/manage-food.php');
            echo "<script>window.location.href='manage-food.php';</script>";
        }
        else
        {
            $_SESSION['update'] = "<div class='erorr'>Failed to Update Food ..!</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');                        
        }
    }
?>
<?php include"partials/footer.php";?>