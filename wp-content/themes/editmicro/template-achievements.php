<?php
/* Template Name: Achievements Template */
get_header('second');
?>
        <!-- section end Here -->
      <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li>Achievements</li>
                    </ul> 
                    <h1>Achievements of Edit Microsystems</h1>  
                    <div class="achievements_page">
                        <div class="achievements_section1">
							<?php 
										$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
										$topfour_args = array( 
										'post_type' => 'achievements',
										'post_status'=>'publish',
										'posts_per_page' => 4,
										'paged' => $paged, 
										'tax_query'   => array(
											array(
												'taxonomy' => 'category',
												'field'    => 'slug',
												'terms'    => 'top-four'
												)
											)
										);
										$topfour_loop = new WP_Query( $topfour_args );
										while ( $topfour_loop->have_posts() ) : $topfour_loop->the_post();									
										$topfour_thumb_id = get_post_thumbnail_id();
										$topfour_thumb_url_array = wp_get_attachment_image_src($topfour_thumb_id, 'thumbnail-size', true);
										$topfour_thumb_url = $topfour_thumb_url_array[0];								
										
							?>
                                <div class="achievements_textinfo">
                                    <span class="col-sm-3"><img src="<?php echo $topfour_thumb_url;?>" alt=""></span>
                                    <div class="col-sm-9 achievements_text1">
                                        <h6><?php the_title();?></h6>
                                        <p><?php the_content(); ?></p>
                                    </div>
                                </div>
                             <?php endwhile; ?>
                             <div class="pagination_main">
                              <?php
									$total_pages = $topfour_loop->max_num_pages;
									$previmg=get_stylesheet_directory_uri()."/assets/images/pagination_left_arrow.png";
									$nextimg=get_stylesheet_directory_uri()."/assets/images/pagination_right_arrow.png";
										if ($total_pages > 1){
											$current_page = max(1, get_query_var('paged'));
											echo paginate_links(array(
												'base' => get_pagenum_link(1) . '%_%',
												'format' => '/page/%#%',
												'current' => $current_page,
												'total' => $total_pages,
												'prev_text'    => __('<img src="'.$previmg.'">'),
												'next_text'    => __('<img src="'.$nextimg.'"'),
											));
										}    
									
									wp_reset_postdata();
								?>
							</div>
                          </div>
                        <div class="achievements_section2">
                            <h3>Some of the other Achievements of Edit Microsystems are listed below:</h3>
                            <div class="row">
								<?php 
										$args =array( 
										'post_type' => 'achievements',
										'post_status'=>'publish',
										'tax_query'   => array(
											array(
												'taxonomy' => 'category',
												'field'    => 'slug',
												'terms'    => 'uncategorized'
												)
											)
										);
										$loop = new WP_Query( $args );
										while ( $loop->have_posts() ) : $loop->the_post();	
										$thumb_id = get_post_thumbnail_id();
										$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
										$thumb_url = $thumb_url_array[0];
									?>
                                <div class="col-sm-3 col-xs-6 achievements_award">
                                    <img src="<?php echo $thumb_url;?>" alt="">
                                    <p><?php echo the_title();?></p>
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



