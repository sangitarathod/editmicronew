<?php
/* Template Name: Events Template */
get_header('second');
global $posts;
?>

<!-- section end Here -->
<div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <h1><?php the_title(); ?></h1>
                    
                    <div class="row">
                        <div class="listing_wrapper">
						<?php 
							$args = array( 'post_type' => 'events', 'post_status'=>'publish' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
															
								$date=get_the_date('Y-m-d', $posts->ID);														
								$m=date('M',strtotime($date));
								$d=date('d',strtotime($date));										
								$y=date('y',strtotime($date));		
								$thumb_url =  wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );								
						?>
                            <div class="col-sm-4">
                                <div class="events_details">
                                    <span>
                                        <img src="<?php echo $thumb_url;?>" alt="">
                                        <span class="event_date"><?php echo $d;?>th <?php echo $m." ".$y;?></span>
                                    </span>
                                    <div class="events_short_info">
                                        <h4><?php the_title();?></h4>
                                        <p><?php the_excerpt();?></p>
                                        <a href="">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <?php
								endwhile;
							?>                          
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

</body>
</html>
