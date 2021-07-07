<?php
session_start();
$mysqli = new mysqli("localhost","hoangvu","123456","news") or die(mysqli_error($mysqli));

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$email'");
	$row = mysqli_fetch_array($sql);
	$db_email = $row['email'];
	$db_password = $row['password'];
	$db_username = $row['username'];
	$rehashedPwd = md5($pwd);
	if($db_email === $email && $db_password=== $rehashedPwd){
		$_SESSION['admin_user'] = $db_username;
		header("Location: ../../Admin");
	}else{
		$_SESSION['email'] = $email;
		header("Location: ../../nw-admin.php?message=wrong_entries");
	}

}