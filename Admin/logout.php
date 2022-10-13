<?php 
    // iclude constant page
    include "../config/constant.php";
    // DESTORY THE SESSION

    session_destroy();
    // REDIRCT TO LOGIN PAGE
    header('location:'.SITEURL.'Admin/login.php');
?>