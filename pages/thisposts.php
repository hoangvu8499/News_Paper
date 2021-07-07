<div class="editors-pick-post-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Editors Pick -->
                <div class="col-12 col-md-7 col-lg-9">
                 

                    <div class="row">
                        <?php 
                            if(isset($_GET['p_id']) && $_GET['p_id'] !==""){
                                $post_obj->getPostShow($_GET['p_id']);
                            }else{
                                header("Location: index.php");
                            }

                         ?>

                    </div>

                </div>

                <!-- World News -->
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="section-heading">
                        <h6>Suggest Post</h6>
                    </div>
                    
                     <?php $post_obj->getPostSuggest(); ?>

                </div>
            </div>
        </div>
    </div>