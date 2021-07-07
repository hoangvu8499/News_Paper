<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> POST</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>POST</li>
            </ol>
          </div>
        </div>
     
        <div class="container row">
          <?php 
              if(isset($_POST['add_news']) && $_FILES['post_image'] !== "" && $_FILES['post_image'] !==" "){
                $fileName = $_FILES['post_image']['name'];
                $fileTmpName = $_FILES['post_image']['tmp_name'];
                $imageSize = $_FILES['post_image']['size'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png','gif');
                if(!in_array($fileActualExt,$allowed)){
                  header("Location: add_post.php?message=file_type_not_allowed");
                }else{
                  if($imageSize > 10000000){
                    header("Location: add_post.php?message=file_is_large");
                  }else{
                    $fileNewName = uniqid('',true) . ".".$fileActualExt;
                    $dir = "news_images/";
                    $target_file = $dir.basename($fileNewName);
                    move_uploaded_file($fileTmpName,$target_file);
                    $post_obj->addNews($_POST['title'],$_POST['content'],$_POST['category'],$_POST['status'],$_POST['type_news'],
                                        $_POST['tags'],$target_file);
                    echo "<script>alert('Update Success');</script>";
                  }
                }
              }
          ?>
          <form method="POST" action="" role="form" class="col-lg-8" autocomplete="off" runat="server" enctype="multipart/form-data">
                <h3>ADD NEWS</h3>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="title" name="title" placeholder="News Title" class="form-control">
                    <span class="input-group-addon" id="left">60</span>
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="content" placeholder="News Content" class="form-control"></textarea> 
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="category">
                    <?php 
                      $query = mysqli_query($connection,"SELECT DISTINCT * FROM category ORDER BY cat_title ASC");
                      while ($row = mysqli_fetch_array($query)) {
                        $cat_title = $row['cat_title'];
                        echo "<option value='{$cat_title}'>$cat_title</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
                  </select>
                </div>  
                <div class="form-group">
                  <label>Type of News</label>
                  <select class="form-control" name="type_news">
                    <option value="Breaking News">Breaking News</option>
                    <option value="Casual News">Casual News</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tags</label>
                  <input type="text" name="tags" placeholder="News Tags (separate by a comma)" class="form-control">
                </div>
                 <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="post_image" onchange="readURL(this)">
                  <br>
                  <img src="#" class="img-rounded" alt="Image to Display" id="img" style="width: 120px;height: 80px;">

                </div>
                 <div class="form-group">
                  <input type="submit" name="add_news" value="Add News" class="btn btn-primary">
                </div>
            </form>
        </div>
      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- javascripts -->
  <script>
      var title = document.querySelector('#title');
      var max = 60;
      title.addEventListener('keyup',function(){
        var left = document.getElementById('left');
        if(title.value.length > max){
          title.value = title.value.substring(0,max);
          title.style.border = "2px solid red";
        }else{
          left.textContent = max - title.value.length;
          title.style.border = "1px solid green";
        }
      });

      function readURL(input){
        if(input.files && input.files[0]){
          let reader = new FileReader();
          reader.onload = function(e){
            $("#img").attr("src",e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
  </script>

  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
