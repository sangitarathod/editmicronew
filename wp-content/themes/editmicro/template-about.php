<?php
/* Template Name: About Template */
get_header('second');
?>

 <div class="body_content">
            <div class="container">
            	 <?php while ( have_posts() ) : the_post();?>
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <h1><?php the_title();?></h1>   
                    <div class="row">
                        <div class="about_contain">
                        <div class="col-sm-4">
                            <div class="about_Text_left">
                                <div class="about_blue_area">
                                	<?php the_content();?>
                                </div>
                                <div class="about_img">
                                    <?php the_post_thumbnail();?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="aboutcompany_info">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                        	<?php if( get_field('about_solutions_title') ): ?>
                                           		<h3> <?php the_field('about_solutions_title'); ?> </h3>
                                        	<?php endif; ?>
                                        	<?php if( get_field('about_solutions_content') ): ?>
                                            <p><?php the_field('about_solutions_content'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                        	<?php if( get_field('interactivity_title') ): ?>
                                            	<h3><?php the_field('interactivity_title'); ?></h3>
                                            <?php endif; ?>
                                            <?php if( get_field('interactivity_content') ): ?>
                                            <p><?php the_field('interactivity_content'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                        	<?php if( get_field('cost_effective_title') ): ?>
                                            	<h3><?php the_field('cost_effective_title'); ?></h3>
                                            <?php endif; ?>
                                            <?php if( get_field('cost_effective_content') ): ?>
                                            <p><?php the_field('cost_effective_content'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                           	<?php if( get_field('ongoing_support_title') ): ?>
                                            	<h3><?php the_field('ongoing_support_title'); ?></h3>
                                            <?php endif; ?>
                                            <?php if( get_field('ongoing_support_content') ): ?>
                                            <p><?php the_field('ongoing_support_content'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                            <?php if( get_field('special_needs_title') ): ?>
                                            	<h3><?php the_field('special_needs_title'); ?></h3>
                                            <?php endif; ?>
                                            <?php if( get_field('special_needs_content') ): ?>
                                            	<?php the_field('special_needs_content'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="about_info1">
                                           <?php if( get_field('business_practices_title') ): ?>
                                            	<h3><?php the_field('business_practices_title'); ?></h3>
                                            <?php endif; ?>
                                            <?php if( get_field('business_practices_content') ): ?>
                                            	<?php the_field('business_practices_content'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php endwhile; ?>
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
