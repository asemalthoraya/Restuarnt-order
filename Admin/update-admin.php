<?php include'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            // get the id of selected admin
            $id=$_GET['id'];

            // create sql query to get details 
            $sql = "SELECT * FROM tbl_admin WHERE id = $id ";

            $res = mysqli_query($conn,$sql);

            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count ==1)
                {
                    //Get the details 
                    $rows = mysqli_fetch_assoc($res);

                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                }
                else
                {
                    //Redirect to admin manage
                    header('location:'.SITEURL.'Admin/manage-admin.php');
                }
            }
        
        ?>
        <form action="" method="post">

            <table class='tbl-30'>
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>userName</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name='submit' value="Update Admin" class="btn-secondary">
                    </td>

                </tr>
            </table>
        </form>
    </div>
</div>
<?php 

    if(isset($_POST['submit']))
    {
        //Get all the vakue from form to update

        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        
        // Create sql query to update

        $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id='$id'";
        // execute the Query 
        $res = mysqli_query($conn,$sql);

        if($res ==true)
        {
            $_SESSION['update'] = "<div class='success'>Admin Update Successfully</div> ";
            
            // Redirect page
            header("location:".SITEURL."Admin/manage-admin.php");
        }
        else
        {
            $_SESSION['update'] = "Faild to update admin";
            header("location:".SITEURL."Admin/update-admin.php");
        }
        
    }
?>
<?php include'partials/footer.php'?>