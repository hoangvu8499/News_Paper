<div class="editors-pick-post-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Editors Pick -->
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="section-heading">
                        <h6>POST SEARCH</h6>
                    </div>

                    <div class="row">
                        <?php 
                            if(isset($_GET['s']) && $_GET['s'] !==""){
                                $post_obj->getPostBySearch($_GET['s']);
                            }else{
                                header("Location: index.php");
                            }

                         ?>

                    </div>

                </div>

                <!-- World News -->
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="section-heading">
                        <h6>Casual News</h6>
                    </div>
                    
                     <?php $post_obj->getCasual(); ?>

                </div>
            </div>
        </div>
    </div>