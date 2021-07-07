<?php
$mysqli = new mysqli("localhost","hoangvu","123456","news") or die(mysqli_error($mysqli));
$error = [];
if(isset($_POST['register'])){
	 $firstname = clear($_POST['firstname']);
	 $lastname = clear($_POST['lastname']);
	 $email = clear($_POST['email']);
	 $pwd = $_POST['pwd'];

	 if(empty($firstname) && empty($lastname)){
	 	array_push($error,"FirstName và LastName không được rỗng");
	 	header("Location: ../../nw-admin.php?message=firstname_and_lastname_are_required");
	 }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
	 	array_push($error,"Email Không đúng định dạng");
	 	header("Location: ../../nw-admin.php?message=email_is_validation");
	 }elseif (empty($email)){
	 	array_push($error,"Email Không được Rỗng");
	 	header("Location: ../../nw-admin.php?message=email_is_required");
	 }else{
	 	if(empty($pwd)){
	 		array_push($error,"Password Không được Rỗng");
	 		header("Location: ../../nw-admin.php?message=pwd_is_required");
	 	}else{
	 		if(strlen($pwd)<=5){
	 			array_push($error,"Password Trên 5 ký tự");
	 			header("Location: ../../nw-admin.php?message=pwd_is_short");
	 		}
	 	}
	 }
	 if(empty($error)) {
	 	$username = $firstname." ".$lastname;
	 	$hashePwd = md5($pwd);
	 	$rand = rand(1,3);
	 	switch ($rand) {
	 		case '1':
	 			$profile_pic = "assets/images/profile_pics/default/head_1.png";
	 			break;
	 		case '2':
	 			$profile_pic = "assets/images/profile_pics/default/head_2.png";
	 			break;
	 		
	 		case 3:
	 			$profile_pic = "assets/images/profile_pics/default/head_3.png";
	 			break;
	 	}
	 	$role="User";
	 	$a=0;
	 	$query = mysqli_query($mysqli,"INSERT INTO users(username,firstname,lastname,email,password,profile_pic,role,num_posts)
	 	 VALUES('$username','$firstname','$lastname','$email','$hashePwd','$profile_pic','$role','$a');");
	 	if($query){
	 		header("Location: ../../nw-admin.php?message=Login_now");
	 	}
	 }

}

function clear($data){
	global $mysqli;
	$data = htmlspecialchars($data);
	$data = strip_tags($data);
	$data = trim($data);
	$data = mysqli_real_escape_string($mysqli,$data);
	return $data;
}