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
            if(isset($_POST['add_cat'])){
                $cat_obj->addCategory($_POST['cat_title']);
                header("Location: category.php?message=category_added");
            }
        ?>
        <div class="container row">
            <form method="POST" action="" role="form" class="col-lg-6" autocomplete="off">
                <h3>ADD CATEGORY</h3>
                <div class="form-group">
                  <input type="text" name="cat_title" placeholder="Category" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="add_cat" value="Add Category" class="btn btn-primary">
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
