<?php include"partials/menu.php"?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br><br>

        <?php 
            $id = $_GET['id'];
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>

                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    // check whether the subimt button is clicked or Not
    if(isset($_POST['submit']))
    {
        // Get the date from form
        $id = $_POST['id'];
        $current_password =md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        // check whether a password exists in DB 
        $sql = "SELECT * FROM tbl_admin WHERE id =$id AND password = '$current_password'";

        // EXE THE QUERY
        $res = mysqli_query($conn,$sql);

        if($res ==TRUE)
        {
            // check whether the date are avalibe or not
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // User exists and password can be change 
                // echo "USer exists";

                if($new_password == $confirm_password)
                {
                        // update the passwod 
                        $sql2 = "UPDATE tbl_admin SET
                                password='$new_password' WHERE id =$id";

                        $res2 = mysqli_query($conn,$sql2);

                        if($res2==TRUE)
                        {
                            $_SESSION['change-pwd'] ="<div class='success'>Change passowrd Successfully </div>";
                            // Redircted page
                            header('location:'.SITEURL.'Admin/manage-admin.php');
                        }
                        else{
                            $_SESSION['change-pwd'] ="<div class='erorr'>falid to Change passowrd</div>";
                            // Redircted page
                            header('location:'.SITEURL.'Admin/manage-admin.php');
                        }
                }
                else{
                    $_SESSION['pwd-not-match'] ="<div class='erorr'>password did not match ~~!</div>";
                    // Redircted page
                    header('location:'.SITEURL.'Admin/manage-admin.php');    
                }
            }
            else{
                $_SESSION['user-not-found'] ="<div class='erorr'>The Current Password Was Wrong ~~!</div>";
                // Redircted page
                header('location:'.SITEURL.'Admin/manage-admin.php');
            }
        }
        // check whether the new password match the confrim password


    }

?>


<?php include"partials/footer.php"?>