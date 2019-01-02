<?php
/* Template Name: Webinars Template */
get_header('second');
?>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li>Online Webinars</li>
                    </ul> 
                    <?php while ( have_posts() ) : the_post();?>
                    <?php the_content();?>
                    <?php endwhile; ?>
                    <div class="row">
                        <div class="training_video_main">
                            <div class="col-sm-9">
                                <div class="webinar_list">
                                    <?php 
										$args = array( 'post_type' => 'webinars', 'post_status'=>'publish' );
										$loop = new WP_Query( $args );
										while ( $loop->have_posts() ) : $loop->the_post();									
										$date=get_post_meta(get_the_ID(),'webinar_date',true);										
										$m=date('M',strtotime($date));
										$d=date('d',strtotime($date));										
										
									?>
										<div class="webinar_cont1">
											<div class="col-sm-1 webinar_date">												
												<p><span class="date_text"><?php echo $d; ?></span><span class="month_text"><?php echo $m; ?></span></p>
											</div>
											<div class="col-sm-11 webinar_smalltext">
												<h3><?php the_title(); ?></h3>
												<p><?php the_excerpt(); ?></p>
												<a href="<?php the_permalink(); ?>">Learn More</a>
											</div>
										</div>
									<?php
										endwhile;
									?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="register_course_info facebook_like">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/face_like_icon.png" alt="">
                                    <p>Like us on Facebook for updates of our upcoming webinars.</p>
                                </div>
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
