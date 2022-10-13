<?php 

    include "../config/constant.php";

    if (isset($_GET['id']) && isset($_GET['image_name']))

    {

        // Get id and Image name 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        // Remove the image if available

        if($image_name !="")
        {
            $path = '../images/food/'.$image_name;

            $remove  = unlink($path);

            if($remove == false)
            {
                $_SESSION['upload']= "<div class='erorr'>Failed to delete image file</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');
                die();
            }
        }
        // delete image form dattbase
        $sql = "DELETE FROM tbl_food WHERE id =$id";
        
        $res = mysqli_query($conn,$sql) or die(mysqli_error($sql));
        
        // Redirect Page 
        if($res == TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Deleted Food Successfully</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }
        
        else
        {
            $_SESSION['delete'] = "<div class='erorr'>failed to Delete Food .!</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }    
        
    }
    else
    {
        $_SESSION['delete'] = "<div class='erorr'>failed to Delete Food .!</div>";
        header('location:'.SITEURL.'Admin/manage-food.php');
    }


?>