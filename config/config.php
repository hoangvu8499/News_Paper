<?php 
ob_start();
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$connection = new mysqli("localhost","hoangvu","123456","news") or die(mysqli_connect_error($connection));
