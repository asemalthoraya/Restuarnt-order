<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            
            ?>
        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input class="input" type="text" name="name" id="name" placeholder="Input your full name ..">
                    </td>
                </tr>
                <tr>
                    <td>userName:</td>
                    <td><input class="input" type="text" name="userName" id="userName"
                            placeholder="Input your user name .."></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input class="input" type="password" name="password" id="password"
                            placeholder="Input your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td colspan>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php
// process the value form from and save it in Database 
// Check whether the submit is clicked Or not
if(isset($_POST['submit'])){
    
    //1. Get the data from form
    $full_name = $_POST['name']."<br>";
    $user_name = $_POST['userName'];
    $password = md5($_POST['password']);// Password Encryption with MD5

    //2. SQL Query to save the data into database

    $sql = "INSERT INTO tbl_admin SET
            full_name ='$full_name',
            username ='$user_name',
            password = '$password'
    ";
    
    //3. Execute Query and save data into database. 
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    // check if the (Query is Execute) data inert or not
    if($res == TRUE)
    {
        // Data inerted
        //Create a session varible to display message

        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

        //redirect page manage admin
        header("location:".SITEURL.'Admin/manage-admin.php');
    }
    else{
        //Create a session varible to display message

        $_SESSION['add'] = "<div class='erorr'>failed to add Admin !!</div>";

        //redirect page add admin
        header("location:".SITEURL.'Admin/add-admin.php');
 
    }
}


?>