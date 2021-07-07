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
            <h3 class="page-header"><i class="fa fa-laptop"></i> USER</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>User</li>
            </ol>
          </div>
        </div>

        <div class="container row">
            <div class="table-responsive">
              <button style="background-color: #007aff;">
              </button>
              <table class="table table-hover table-striped table-bordered table-success">
                <thead>
                  <tr>
                    <th>USER ID</th>
                    <th>UserName</th>
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
                    $user_obj->getAllUser();
                    if(isset($_GET['d_u_id'])){
                        if($role!=='Admin'){
                          $user_obj->deleteUser($_GET['d_u_id']);
                          header("Location: user.php?message=delete_success");
                      }else{
                         echo "<script>alert(' You Cannot Delete Your Account');</script>";
                      }
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
