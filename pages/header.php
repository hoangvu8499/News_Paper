<?php 

include_once 'config/config.php'; 
$user = (isset($_SESSION['admin_user'])) ? $_SESSION['admin_user'] : "user";
include 'class/User.php';  
include 'class/Category.php';      
include 'class/Post.php';  
    $cat_obj = new Category($connection, $user);       
    $post_obj = new Post($connection, $user);      
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>News Of Life - News &amp; Lifestyle Magazine Template</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
	<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area" style="background-color: #02031c">
            <div class="container" >
                <div class="row">
                    <div class="col-12">
                        <div class="top-header-content d-flex align-items-center justify-content-between" style="background-color: #02031c">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php"><img style="width: 350px;height: 100px;" src="img/core-img/logo3.png" alt=""></a>
                            </div>

                            <!-- Login Search Area -->
                            <div class="login-search-area d-flex align-items-center" style="background-color: #02031c">
                                <!-- Login -->
                                <div class="login d-flex" >
                                    <a href="login.php">Login</a>
                                    <a href="register.php">Register</a>
                                </div>
                                <!-- Search Form -->
                                <div class="search-form" >
                                    <form action="search.php" method="GET">
                                        <input type="search" name="s" class="form-control" placeholder="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>