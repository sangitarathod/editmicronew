<?php
get_header('second'); ?>

 <!-- section end Here -->
     <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><a href="<?php echo site_url();?>/news">News</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
					<?php
                    while ( have_posts() ) : the_post();
                    $date=get_the_date('j F Y',$post->id);
					$m=date('F',strtotime($date));
					$d=date('d',strtotime($date));	
					$y=date('Y',strtotime($date));
					$category = get_the_terms( $post->ID, 'news-category' );     
					foreach ( $category as $cat){
					   $cat=$cat->name;
					}
					$thumb_url =  wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
                    ?>
                    <h1><?php the_title();?></h1> 
                    <div class="row">
                        <div class="news_detail_page">
                            <div class="col-sm-9">
                                <div class="news_short_info">
                                    <img src="<?php echo $thumb_url;?>" alt="">
                                    <div class="news_text_info">
                                        <div class="col-sm-1 col-xs-2 news_date">
                                            <h4><?php echo $d; ?></php></h4>
                                            <span><?php echo $m; ?> <br> <?php echo $y; ?></span>
                                        </div>
                                        <div class="col-sm-11 col-xs-10">
                                            <div class="news_text_data">
                                                <span>Categories: <?php echo $cat;?></span>
                                                <h2><?php the_title(); ?></h2>
                                                <?php the_content();?>
                                                <div class="share_news">
													 <?php echo do_shortcode('[apss_share]');
													 //echo do_shortcode('[csbwfs_buttons buttons="fb"]');
													 ?>
													 
													 <?php //echo do_shortcode("[social_share_button]"); ?>
                                                 <!--   <ul>
                                                        <li>Share</li>
                                                       <!-- <li><a href="">
                                                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                                        </a></li>
                                                        <li><a href="">
                                                            <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                                        </a></li>
                                                        <li><a href="">
                                                            <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                                        </a></li>
                                                        <li><a href="">
                                                            <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                                        </a></li>
                                                       
                                                    </ul>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="news_subscribe">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_subscribe_icon.png" alt="">
                                    <p>Get latest news and updates by subscribing to our newsletter!</p>
                                    <form class="subscribe_from">
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            <input class="form-control" type="email">
                                        </div>
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;?>
                    </div>
                </div>
            </div>
    </section>
    
<?php get_footer();?>
    
    
	<!--popup 1 -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			  </div>
			  <div class="modal-body">
				<p>Some text in the modal.</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
		</div>
	  </div>
	</div>
	<!--popup 1 -->

</body>
</html>
