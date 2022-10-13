<?php 

    // Authoriration - Access Control
    // check the user logged in or not
    if(!isset($_SESSION['user'])){
        // if the user not logged in
        // Redirct to login page with masssage
        $_SESSION['no-login-meesage'] = "<div class='erorr'>Please login to access admin panel </div>";
        header('location:'.SITEURL.'Admin/login.php');
    }
?>