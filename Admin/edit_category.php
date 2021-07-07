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
        <?php
            $role = $user_obj->getRole();
            if(isset($_GET['cat_id']) && $_GET['cat_id']!=="" && $role === 'Admin'){
               $cat_id = $_GET['cat_id'];
               $sql = mysqli_query($connection,"SELECT * FROM category WHERE id=$cat_id");
               $row = mysqli_fetch_array($sql);
               $cat_title = $row['cat_title'];
            }else{
              header("Location: category.php");
            }

            if(isset($_POST['u_add_cat'])){
              $cat_obj->updateCategory($cat_id, $_POST['u_cat_title']);
              header("Location: category.php?message=updated");
            }
        ?>
        <div class="container row">
            <form method="POST" action="" role="form" class="col-lg-6" autocomplete="off">
                <h3>UPDATE CATEGORY</h3>
                <div class="form-group">
                  <input type="text" value="<?php echo $cat_title;?>" name="u_cat_title" placeholder="Category" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="u_add_cat" value="UPDATE Category" class="btn btn-primary">
                </div>

            </form>
        </div>
      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
