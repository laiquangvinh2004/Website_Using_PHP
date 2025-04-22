<section>
        <div class="bg_in">
            <div class="col-md-7 col-xs-12 col-sm-12" style="padding: 0;margin-top:10px;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="<?php echo BASE_URL ?>public/image/carosel2.jpg" data-slide-to="0" class="active"></li>
                        <li data-target="<?php echo BASE_URL ?>public/image/carosel3.jpg" data-slide-to="1"></li>
                        <li data-target="<?php echo BASE_URL ?>public/image/carosel1.jpg" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?php echo BASE_URL ?>public/image/carosel1.jpg" alt="Siêu khuyến mãi">
                        </div>

                        <div class="item">
                            <img src="<?php echo BASE_URL ?>public/image/carosel2.jpg" alt="Siêu khuyến mãi">
                        </div>

                        <div class="item">
                            <img src="<?php echo BASE_URL ?>public/image/carosel3.jpg" alt="Siêu khuyến mãi">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="<?php echo BASE_URL ?>public/image/carosel2.jpg" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="<?php echo BASE_URL ?>public/image/carosel3.jpg" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-12" style="padding: 0;margin-left:30px;margin-top:5px;">
                <div class="row">
                    <div class="panel  panel-warning panel-styling">
                        <div class="panel-heading">Tin tức cập nhật</div>
                        <div class="panel-body scrollable-panel">
                            <?php
                            foreach($post_index as $key => $post){
                            ?>
                            <div class="row">
                                <div class="col-md-4 col-xs-4 col-sm-4">
                                    <img src="<?php echo BASE_URL ?>public/upload/post/<?php echo $post['image_post']?>">
                                </div>
                                <div class="col-md-8 col-xs-8 col-sm-8">
                                    <h4><?php echo $post['title_post']?></h4>
                                    <p><?php echo substr($post['content_post'], 0, 100)?>...</p>
                                </div>
                            </div>
                            <hr>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </section>