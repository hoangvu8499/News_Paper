<?php
include 'config/config.php';
$query = mysqli_query($connection,"SELECT * FROM users");
if(mysqli_num_rows($query) === 0){
		include 'register.php';
	}else{
		include 'login.php';
	}
?> 