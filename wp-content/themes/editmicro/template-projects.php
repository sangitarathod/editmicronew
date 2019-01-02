<?php
/* Template Name: Projects Template */
get_header('second');
global $post;
?>
        <!-- section end Here -->
          <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="index.html">Home</a></li>
                      <li>Projects</li>
                    </ul> 
                    <h1>Life-changing Projects in South Africa</h1>
                    <div class="project_top_contain">
                        <div class="col-sm-8">
                            <div class="project_text_info">
								<?php while ( have_posts() ) : the_post();?>
									<?php the_content();?>
								<?php endwhile; ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
							<?php while ( have_posts() ) : the_post();
										$thumb_id = get_post_thumbnail_id();
										$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
										$thumb_url = $thumb_url_array[0];
							?>
										<img src="<?php echo $thumb_url;?>" alt="">
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
					$f_args =array( 
						'post_type' => 'projects',
						'post_status'=>'publish',
						'tax_query'   => array(
							array(
								'taxonomy' => 'projects-category',
								'field'    => 'slug',
								'terms'    => 'feature-projects'
								)
						)
					);
					$f_loop = new WP_Query( $f_args );
					while ( $f_loop->have_posts() ) : $f_loop->the_post();	
					$f_thumb_id = get_post_thumbnail_id();
					$f_thumb_url_array = wp_get_attachment_image_src($f_thumb_id, 'thumbnail-size', true);
					$f_thumb_url = $f_thumb_url_array[0];
			?>
            <div class="featured_project">
                <div class="container">
                    <div class="col-sm-6 featured_project_img">
                        <img src="<?php echo $f_thumb_url;?>" alt="">
                    </div>
                    <div class="col-sm-6">
						
                        <div class="featured_project_text">
                            <h4>Featured Project</h4>
                            <p><strong><?php the_title(); ?></strong> <?php $f_c=get_the_content();$f_content=strip_tags($f_c, '<p>'); echo $f_content;?></p>
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
           <?php endwhile; ?>
            <div class="container">
                <div class="few_project_list">
                    <h4>A Few of our Projects:</h4>
                    <?php 
					$args =array( 
						'post_type' => 'projects',
						'post_status'=>'publish',
						'tax_query'   => array(
							array(
								'taxonomy' => 'projects-category',
								'field'    => 'slug',
								'terms'    => 'projects'
								)
						)
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();	
					
					?>
                    <div class="col-sm-6">
                        <p><strong><?php the_title(); ?> :</strong> <?php $c=get_the_content();$content=strip_tags($c, '<p>'); echo $content;?></p>
                    </div>
                   <?php endwhile;?>
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
