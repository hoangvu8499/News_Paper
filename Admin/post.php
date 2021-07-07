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
            <h3 class="page-header"><i class="fa fa-laptop"></i> POSTS</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>POSTS</li>
            </ol>
          </div>
        </div>

        <div class="container row">
            <div class="table-responsive">
              <button style="background-color: #007aff;">
                    <?php 
                      $role = $user_obj->getRole();
                      if($role === 'Admin'){
                        echo "<a href='add_post.php' style='color: white;''>ADD NEWS POST</a>";
                      }
                    ?>
              </button>
              <table class="table table-hover table-striped table-bordered table-success">
                <thead>
                  <tr>
                    <th>POST ID</th>
                    <th>POST Title</th>
                    <?php 
                      $role = $user_obj->getRole();
                      if($role === 'Admin'){
                        echo "<th colspan='2' class='text-center'>Action</th>";
                      }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $post_obj->getAdminPost();
                    if(isset($_GET['post_id'])){
                      $post_obj->deletePost($_GET['post_id']);
                      header("Location: post.php?message=delete_success");
                      echo "<script>alert('Delete Success');</script>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
