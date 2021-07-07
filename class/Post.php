<?php

		class Post{
			private $conn;
			private $user_obj;

			public function __construct($conn,$user){
				$this->conn = $conn;
				$this->user_obj= new User($conn, $user);
			}

			public function addNews($title,$content,$category,$status,$type,$tags,$image){
				if(!empty($title) && !empty($content)){
					$title = strtoupper($title);
					$title = mysqli_real_escape_string($this->conn,$title);
					$content = nl2br($content);
					$content = mysqli_real_escape_string($this->conn,$content);
					$added_by = $this->user_obj->getUserName();
					$sql = mysqli_query($this->conn,"SELECT id FROM category WHERE cat_title='$category'");
					$row = mysqli_fetch_array($sql);
					$cat_id = $row['id'];

					$query = mysqli_query($this->conn,"INSERT INTO news Values ('','$title','$content','$added_by','$category','$cat_id','$image','$tags','$status','$type');");

				}
			}

			public function updatePost($id,$title,$content,$category,$status,$image){
				$query = mysqli_query($this->conn,"UPDATE news SET title='$title',content='$content',post_category='$category',
													status='$status',post_image = '$image' WHERE id=$id");
				if($query){
					return true;
				}else{
					return false;
				}
			}

			public function getAdminPost(){
				$query = mysqli_query($this->conn,"SELECT * FROM news ORDER BY id ASC");
				$str ="";
				$role =$this->user_obj->getRole();

				while ($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$title = $row['title'];

					if ($role === 'Admin') {
							$str .= "<tr>" .
								"<td>{$id}</td>".
								"<td>{$title}</td>".
								"<td><a href='edit_post.php?post_id=$id' class='btn btn-primary'>EDIT</a></td>".
								"<td><a href='post.php?post_id=$id' class='btn btn-danger'>DELETE</a></td>".
								"</tr>";
						}else{
							$str .= "<tr>" .
								"<td>{$id}</td>".
								"<td>{$title}</td>".
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

			public function deletePost($id){
				$query = mysqli_query($this->conn,"DELETE FROM news WHERE id=$id");
				if($query){
					return true;
				}else{
					return false;
				}	
			}	

			public function getBreakingNews(){
				$query = mysqli_query($this->conn,"SELECT * FROM news WHERE type='Breaking News'ORDER BY id DESC LIMIT 6 ");
				$str = "";
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
	                                    <a href='showposts.php?p_id=$id'><img src='Admin/$image' alt=''></a>
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

			public function getCasual(){
				$query = mysqli_query($this->conn,"SELECT * FROM news WHERE type='Casual News' ORDER BY id DESC LIMIT 3 ");
				$str = "";
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
		

					$str = "<div class='single-blog-post style-2'>
                       			 <div class='post-thumb'>
                           			 <a href='showposts.php?p_id=$id'><img src='Admin/$image' alt=''></a>
                        		</div>
	                        	<div class='post-data'>
		                            <a href='showposts.php?p_id=$id' class='post-title'>
		                                <h6>$title</h6>
		                            </a>
		                            <div class='post-meta'>
		                                <div class='post-date'><a href='showposts.php?p_id=$id'>$content</a></div>
		                            </div>
			                    </div>
		                    </div>";
                     echo $str;
				}
				
			}

			public function getPostBySearch($keyword){
				$query = mysqli_query($this->conn,"SELECT * FROM news WHERE post_category like '%$keyword%'
																		or title like '%$keyword%'
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
	                                    <a href='showposts.php?p_id=$id'><img src='Admin/$image' alt=''></a>
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

			public function getPostShow($id){
				$query = mysqli_query($this->conn,"SELECT * FROM news WHERE id = $id");
				$str = "";
					while ($row = mysqli_fetch_array($query)) {
						$id = $row['id'];
						$title = $row['title'];
						$content = $row['content'];
						$cat_title = $row['post_category'];
						$cat_id = $row['post_cat_id'];
						$image = $row['post_image'];
				
						$str = "<div class='post-thumb'>
										<h2>$title</h2>
	                                    <a href='#'><img src='Admin/$image' style='width: 400px;height: 250px;margin-left: 200px;' alt=''></a>
	                                </div>
	                                <br> <br>
	                                <div class='post-data'>
	                                   
	                                        
	                                  
	                                    <div class='post-meta'>
	                                        <div class='post-date'><a href='#'>$content</a></div>
	                                    </div>
                        		</div>";
                     	echo $str;
					}
			}

			public function getPostSuggest(){
				$query = mysqli_query($this->conn,"SELECT * FROM news ORDER BY id DESC limit 3");
				$str = "";
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
						

						$str = "<div class='single-blog-post style-2'>
                       			 <div class='post-thumb'>
                           			 <a href='showposts.php?p_id=$id'><img src='Admin/$image' alt=''></a>
                        		</div>
	                        	<div class='post-data'>
		                            <a href='showposts.php?p_id=$id' class='post-title'>
		                                <h6>$title</h6>
		                            </a>
		                            <div class='post-meta'>
		                                <div class='post-date'><a href='showposts.php?p_id=$id'>$content</a></div>
		                            </div>
			                    </div>
		                    </div>";
                     	echo $str;
					}
			}



}