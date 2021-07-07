<div class="editors-pick-post-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Editors Pick -->
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="section-heading">
                        <h6>BY CATEGORY</h6>
                    </div>

                    <div class="row">
                        <?php 
                            if(isset($_GET['c_id']) && $_GET['c_id'] !==""){
                                $cat_obj->getPostByCat($_GET['c_id']);
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