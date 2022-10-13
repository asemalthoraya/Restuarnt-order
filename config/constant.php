<?php 

session_start();
// Create a Constants to store non repeating Values 
define('SITEURL','http://localhost/MyProject/');
define('LOCALHOST','localhost');
define('DB_USERNAEM','root');
define('DB_PASSWORD','');
define('DB_NAME','restaurant-order');

$conn = mysqli_connect(LOCALHOST,DB_USERNAEM,DB_PASSWORD) or die(mysqli_error());//database Coneection

$db_select = mysqli_select_db($conn, DB_NAME)or die(mysqli_error());//select database 

?>