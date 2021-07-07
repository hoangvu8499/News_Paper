<?php

class Category {
	private $conn;
	private $user_obj;

	public function __construct($conn, $user){
		$this->conn = $conn;
		$this->user_obj = new User($conn, $user);
	}

	public function addCategory($category){
		if(!empty($category)){
			$query = mysqli_query($this->conn,"INSERT INTO category values ('','$category');");
			($query) ? true : false;
		}else {
			return false;
		}
	}

	public function getAdminCategory(){
		$query = mysqli_query($this->conn,"SELECT * FROM category ORDER BY cat_title ASC");
		$str ="";
		$role =$this->user_obj->getRole();

		while ($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
			$cat_title = $row['cat_title'];

			if ($role === 'Admin') {

					$str .= "<tr>" .
						"<td>{$id}</td>".
						"<td>{$cat_title}</td>".
						"<td><a href='edit_category.php?cat_id=$id' class='btn btn-primary'>EDIT</a></td>".
						"<td><a href='category.php?d_cat_id=$id' class='btn btn-danger'>DELETE</a></td>".
						"</tr>";
				}else{
					$str .= "<tr>" .
						"<td>{$id}</td>".
						"<td>{$cat_title}</td>".
						"</tr>";

				}
			}
			echo $str;
		}


	public function updateCategory($id,$category){
		$query = mysqli_query($this->conn,"UPDATE category SET cat_title='$category' WHERE id=$id");
		if($query){
			return true;
		}else{
			return false;
		}
	}	

	public function deleteCategory($id){
		$query = mysqli_query($this->conn,"DELETE FROM category WHERE id=$id");
		if($query){
			return true;
		}else{
			return false;
		}
	}	

	public function getAllCategory(){
		$query = mysqli_query($this->conn,"SELECT * FROM category ORDER BY cat_title ASC");
		$str="";
		while ($row = mysqli_fetch_array($query)) {
			$cat_title = $row['cat_title'];
			$cat_id = $row['id'];
			$str .= "<li><a href='category.php?c_id=$cat_id'>$cat_title</a></li>";
		}
		echo $str;
	}

	public function getPostByCat($id){
				$query = mysqli_query($this->conn,"SELECT * FROM news WHERE post_cat_id = $id
									  ORDER BY id DESC LIMIT 6 ");
				$str = "";
				if (mysqli_num_rows($query) === 0){
					$str = "<h2 class='text-center'> No Results Found! </h2>";
					echo $str;
				}else{
					while ($row = mysqli_fetch_array($query)) {
						$id = $row['id'];
						$title = $row['title'];
						$content = $row['content'];
						if(strlen($content)>50){
							$content = substr($content,0,50);
						}
						$cat_title = $row['post_category'];
						$cat_id = $row['post_cat_id'];
						$image = $row['post_image'];
					

						$str = "<div class='col-12 col-lg-4'>
	                            <div class='single-blog-post'>
	                                <div class='post-thumb'>
	                                    <a href='showposts.php?p_id=$id'><img src='Admin/$image'  alt=''></a>
	                                </div>
	                                <div class='post-data'>
	                                    <a href='showposts.php?p_id=$id' class='post-title'>
	                                        <h6>$title</h6>
	                                    </a>
	                                    <div class='post-meta'>
	                                        <div class='post-date'><a href='showposts.php?p_id=$id'>$content</a></div>
	                                    </div>
	                                </div>
	                            </div>
                        	</div>";
                     	echo $str;
					}
				}
				
			}



}