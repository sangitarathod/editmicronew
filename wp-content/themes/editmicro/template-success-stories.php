<?php
/* Template Name: Success Stories Template */
get_header('second');
?>
      <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <h1><?php the_title(); ?></h1>
                    <div class="row">
                        <div class="listing_wrapper">
							<?php 
								$args = array( 'post_type' => 'success_stories', 'post_status'=>'publish' );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();									
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
									$thumb_url = $thumb_url_array[0];									
										
							?>
                            <div class="col-sm-4">
                                <div class="events_details">
                                    <span>
                                        <img src="<?php echo $thumb_url;?>" alt="">
                                    </span>
                                    <div class="success_story_info">
                                        <h4><?php the_title(); ?></h4>
                                        <p><?php the_excerpt();?></p>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
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
