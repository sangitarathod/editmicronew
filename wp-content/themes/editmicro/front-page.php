<?php 
/*
 * Template Name: Home Template
 */
get_header();
// wp_head();
?>
        <!-- section end Here -->
        <div class="body_content">
        <div class="banner_section">
            <div class="container">
                <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                    <div class="banner_slider">
                        <div class="owl-carousel owl-theme">
                            
                                <?php 
									$args = array( 'post_type' => 'homeslider', 'post_status'=>'publish' );
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();									
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
									$thumb_url = $thumb_url_array[0];
									
									$imageurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
									 if ($imageurl) {
										$res_imageurl = site_url() . "/wp-content/themes/editmicro/resize_homeslider_image.php?image=".$imageurl;
									 }
								?>
								<div class="item">
									<img alt="" class="img-responsive" src="<?php echo $res_imageurl;?>" >
									
								</div>
								
								<?php
									endwhile;
								?>
								
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
  
    </section>

<?php get_footer();

