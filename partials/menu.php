<?php include"config/constant.php"?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="header">
        <a href="<?php echo SITEURL;?>" class='logo'><img src="images/logo2.png" width="70px" alt="Restaurant Logo"></a>

        <nav class='navbar'>
            <a href="<?php echo SITEURL;?>">Home</a>
            <a href="<?php echo SITEURL;?>categories.php">Categories</a>
            <a href="<?php echo SITEURL;?>foods.php">Foods</a>
            <!-- <a href="<?php echo SITEURL;?>">Contact</a> -->
        </nav>

        <a href='<?php echo SITEURL;?>Admin/login.php' class='btn-sign'>Sign up</a>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>
    <!-- Header Section Ends -->
    <!-- Navbar Section Ends Here -->