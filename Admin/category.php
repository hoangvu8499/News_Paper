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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Category</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Category</li>
            </ol>
          </div>
        </div>

        <div class="container row">
            <div class="table-responsive">
              <button style="background-color: #007aff;">
                    <?php 
                      $role = $user_obj->getRole();
                      if($role === 'Admin'){
                        echo "<a href='add_category.php' style='color: white;''>ADD CATEGORY</a>";
                      }
                    ?>
              </button>
              <table class="table table-hover table-striped table-bordered table-success">
                <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Title</th>
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
                    $cat_obj->getAdminCategory();
                    if(isset($_GET['d_cat_id'])){
                      $cat_obj->deleteCategory($_GET['d_cat_id']);
                      header("Location: category.php?message=delete_success");
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
