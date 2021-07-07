<?php
	
	class User{
		private $conn;
		private $user;

		public function __construct($conn,$user){
			$this->conn = $conn;
			$sql = mysqli_query($conn,"SELECT * FROM users where username='$user'");
			return $this->user = mysqli_fetch_array($sql);
		}

		public function getAllUser(){
		$query = mysqli_query($this->conn,"SELECT * FROM users ORDER BY id desc");
		$str ="";
		$role = $this->user['role'];

		while ($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$username = $row['username'];

			if ($role === 'Admin') {

					$str .= "<tr>" .
						"<td>{$id}</td>".
						"<td>{$username}</td>".
						"<td><a href='user.php?d_u_id=$id' class='btn btn-danger'>DELETE</a></td>".
						"</tr>";
				}else{
					$str .= "<tr>" .
						"<td>{$id}</td>".
						"<td>{$username}</td>".
						"</tr>";

				}
			}
			echo $str;
	
		}
		public function deleteUser($id){
		$query = mysqli_query($this->conn,"DELETE FROM users WHERE id=$id");
		if($query){
			return true;
		}else{
			return false;
		}
	}	
		public function getUserName(){
			$username = $this->user['username'];
			return $username;
		}

		public function getProfilePic(){
			$username = $this->user['username'];
			$sql = mysqli_query($this->conn,"SELECT profile_pic FROM users where username= '$username'");
			$row = mysqli_fetch_array($sql);
			return $row['profile_pic'];
		}

		public function getRole(){
			$username = $this->user['username'];
			$sql = mysqli_query($this->conn,"SELECT role FROM users where username= '$username'");
			$row = mysqli_fetch_array($sql);
			return $row['role'];
		}
		public function getID(){
			$username = $this->user['username'];
			$sql = mysqli_query($this->conn,"SELECT id FROM users where username= '$username'");
			$row = mysqli_fetch_array($sql);
			return $row['id'];
		}



	}