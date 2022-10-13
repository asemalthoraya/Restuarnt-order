<?php 
    
    // INCLUDE CONSTANTs.php file here
    include('../config/constant.php');
    
    // 1.Get the ID of admin to be deleted 
    
    echo $id = $_GET['id'];
    
    // 2.Create sql query to delete from DB

    $sql = "DELETE FROM tbl_admin WHERE id =$id";

    
    //EXECUTE THE QUERY
    $res = mysqli_query($conn,$sql);
    
    // check if the query execute successfully Or not
    if($res ==TRUE)
    {
        // QUERY SUCCESSFULLY EXECUTE IT AND ADMIN DELETED 
        // echo"admin Deleted";
        $_SESSION['delete'] = "<div class='success'> Admin deleted Successfully </div>";
        // Redirect to manage admin page
        header('location:'.SITEURL.'Admin/manage-admin.php');
    }
    else
    {
        //QUERY NOT EXECUTE IT CORRECTLY
        $_SESSION['delete'] = "<div class='success'>Failed to delete admin .try again </div>";
        header('location:'.SITEURL.'Admin/manage-admin.php');
    }
?>