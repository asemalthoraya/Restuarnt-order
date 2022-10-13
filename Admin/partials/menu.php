<?php 
    include('../config/constant.php');
    include('login-check.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food order website - Home page</title>
</head>

<body>
    <!-- Menu section start -->
    <div class="menu">
        <div class="wrapper text-center">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <!-- <li></li> -->
                <a href="logout.php" class="logout">Logout</a>
            </ul>
        </div>
    </div>
    <!-- Menu section ends -->