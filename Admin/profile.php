<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
    <!--sidebar end-->
<?php 
  if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = mysqli_query($connection,"SELECT * FROM users WHERE id=$user_id");
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $role = $row['role'];
    }
    //cap nhat data USER
    if(isset($_POST['update_data'])) {
        $f_name = $_POST['f-name'];
        $l_name = $_POST['l-name'];
        $u_email  = $_POST['email'];

        // fix lỗi password  ??????????????????????????????????????????????????

        $pwd = md5($_POST['pwd']);
        $user_name = $f_name . "" . $l_name;
        $sql = mysqli_query($connection,"UPDATE users SET username='$user_name',firstname='$f_name',lastname='$l_name',
          email='$u_email',password = '$pwd' where id ='$id'");
        $_SESSION['admin_user'] = $user_name;
        header("Location: profile.php?user_id=$id");
    }
    //Upload avatar
    if(isset($_POST['upload']) && isset($_FILES['profile_pic'])){
      $dir ="../assets/images/profile_pics/default/";
      $target = $dir . basename($_FILES['profile_pic']['name']);
      $type = $_FILES['profile_pic']['type'];
      $size = $_FILES['profile_pic']['size'];
      if($size > 2000000){
        header("Location: profile.php?user_id=$id&message=file_is_large");
      }else{
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
        mysqli_query($connection,"UPDATE users SET profile_pic='$target' where id = $id");
        header("Location: profile.php?user_id=$id&message=file_upload");
      }
    }


  }
?>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_documents_alt"></i>Pages</li>
              <li><i class="fa fa-user-md"></i>Profile</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <!-- profile-widget -->
          <div class="col-lg-12">
            <div class="profile-widget profile-widget-info">
              <div class="panel-body">
                <div class="col-lg-2 col-sm-2">
                  <h4><?php echo $username; ?></h4>
                  <div class="follow-ava">
                    <img src="<?php echo $user_obj->getProfilePic(); ?>" alt="">
                    

                  </div>
                  <form method="POST" action="" enctype="multipart/form-data">
                      <input type="file" name="profile_pic">
                      <input type="submit" name="upload" class="btn btn-primary" value="UPLOAD">
                    </form>
                  <h6><?php echo $user_obj->getRole(); ?></h6>
                </div>
   
              </div>
            </div>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#recent-activity"><i class="icon-home"></i>
                     PROFILE </a>
                  </li>
             
                </ul>
              </header>
             
                  <!-- profile -->
                  <div id="profile" class="tab-pane">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1>Information</h1>
                        <div class="row">
                          <div class="bio-row">
                            <p><span>Username </span>: <?php echo $username; ?> </p>
                            <p><span>Firstname </span>: <?php echo $firstname; ?> </p>
                            <p><span>Lastname </span>: <?php echo $lastname; ?> </p>
                            <p><span>Email </span>: <?php echo $email; ?> </p>
                            <p><span>Role </span>: <?php echo $role; ?> </p>
                          </div>
                 
                        </div>
                      </div>
                    </section>
                    <section>
                      <div class="row">
                      </div>
                    </section>
                  </div>
                  <!-- edit-profile -->
                  <div id="edit-profile" class="tab-pane">
                    <?php 
                        $username =$user_obj->getUserName();
                        if($user === $username):

                    ?>
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form" method="POST" action="profile.php?user_id='<?php echo $id; ?>'">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="f-name" name="f-name" placeholder=" " value="<?php echo $firstname; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="l-name" name="l-name" placeholder=" " value="<?php echo $lastname; ?>">
                            </div>
                          </div>
                  
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="email" name="email" placeholder=" " value="<?php echo $email; ?>">
                            </div>
                          </div>
                           <div class="form-group">
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-6">
                              <input type="Password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <input type="submit" name="update_data" value="Save" class="btn btn-primary">
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>
                    <?php endif;

                    ?>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>

        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery knob -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>

  <script>
    //knob
    $(".knob").knob();
  </script>


</body>

</html>
