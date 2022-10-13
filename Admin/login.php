<?php include '../config/constant.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="../css/style-login.css">
    <title>Login</title>
</head>

<body>

    <div class="content">
        <div class="text"> Login Form</div>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-meesage'])){
                echo $_SESSION['no-login-meesage'];
                unset($_SESSION['no-login-meesage']);
            }
        ?>
        <br>
        <!-- Form login Begin -->
        <form action="" method="post">

            <div class="field">
                <input type="text" name="username" required><span class="fas fa-user"></span>
                <label>User Name</label>
            </div>

            <div class="field">
                <input type="password" name="password" required><span class="fas fa-lock"></span>
                <label>Password</label>
            </div>
            <br><br>
            <input type="submit" name='login' value="Login" style="margin:0 2rem;" class="btn-primary log ">
        </form>
        <p style="padding-top:3rem;" class="text-center">Created by <a href="#"
                style="text-decoration:none;color:#0b63cd;"><b>Asem
                    Althoraya</b></a></p>
    </div>


</body>

</html>

<?php 
    if(isset($_POST['login']))
    {
        // gET data from form
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password'])) ;

        // SQL to check whether the user with username and password exits or not
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password='$password'";

        // EXECUTE THE QUERY

        $res = mysqli_query($conn,$sql);

        // count the rows to check the user exite or not

        $count = mysqli_num_rows($res);

        if($count ==1)
        {
            // user avalible 
            $_SESSION['login'] = "<div class='success'>You have Logged in Successfully</div>";
            $_SESSION['user'] = $username;//To check whether the user log in or not and logged out will unset it

            header('location:'.SITEURL.'Admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='erorr'>Welcome Sir to our Restaurant.</div>";
            header('location:'.SITEURL);
        }
    }
?>