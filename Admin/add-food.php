<?php include"partials/menu.php"?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="title"></td>
                </tr>
                <tr>
                    <td>Descripation:</td>
                    <td><textarea name="description" placeholder="Descripation of food." cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" placeholder="0.0" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><select name="category">
                            <?php 
                            
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                            <option value="<?php echo $id?>"><?php echo $title;?></option>
                            <?php
                                }
                            }
                            else
                            {
                            ?>
                            <option value="1">No Category Found !</option>

                            <?php

                            }
                            
                            ?>

                        </select></td>
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
                    <td colspan="2"><input type="submit" name="submit" value="Add food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
            
        }
        else
        {
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

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
            }
        }
        else
        {
            $image_name = "";
        }
        $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";
        $res2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        
        if($res2 == TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Add Food Successfully</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
            die();
        }
        else
        {
            $_SESSION['add'] = "<div class='erorr'>fail to Add Food !</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }

        
    }
?>
<?php include"partials/footer.php"?>