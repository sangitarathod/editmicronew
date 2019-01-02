<?php
/* Template Name: Training Template */
get_header('second');
?>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <?php while ( have_posts() ) : the_post();?>
                    <?php the_content();?>
                    <?php endwhile; ?>
                    <div class="training_contain">
                        <div class="col-sm-3 col-xs-6">
                            <div class="training_section">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/video_icon.png" alt="">
                                <h2>
									<?php if( get_field('title1') ): ?>
                                        <?php the_field('title1'); ?>
                                    <?php endif; ?>
                                </h2>
                                <p>
									<?php if( get_field('description1') ): ?>
                                       <?php the_field('description1'); ?>
                                    <?php endif; ?>
                                </p>
                                <a href="<?php if( get_field('link1') ): ?>
                                        <?php the_field('link1'); ?>
                                    <?php endif; ?>">See Videos</a>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="training_section">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/webinars_icon.png" alt="">
                                <h2>
									<?php if( get_field('title2') ): ?>
                                       <?php the_field('title2'); ?>
                                    <?php endif; ?>
                                </h2>
                                <p>
									<?php if( get_field('description2') ): ?>
                                       <?php the_field('description2'); ?>
                                    <?php endif; ?>
                                </p>
                                <a href="<?php if( get_field('link2') ): ?>
                                        <?php the_field('link2'); ?>
                                    <?php endif; ?>">Learn More</a>
                            </div>            
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="training_section">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training_icon.png" alt="">
                                <h2>
									<?php if( get_field('title3') ): ?>
                                        <?php the_field('title3'); ?>
                                    <?php endif; ?>
                                </h2>
                                <p>
									<?php if( get_field('description3') ): ?>
                                       <?php the_field('description3'); ?>
                                    <?php endif; ?>
                                </p>
                                <a href="<?php if( get_field('link3') ): ?>
                                        <?php the_field('link3'); ?>
                                    <?php endif; ?>">Learn More</a>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="training_section">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/glossary_icon.png" alt="">
                                <h2>
									<?php if( get_field('title4') ): ?>
                                        <?php the_field('title4'); ?>
                                    <?php endif; ?>
                                </h2>
                                <p>
									<?php if( get_field('description4') ): ?>
                                       <?php the_field('description4'); ?>
                                    <?php endif; ?>
                                </p>
                                <a href="<?php if( get_field('link4') ): ?>
                                        <?php the_field('link4'); ?>
                                    <?php endif; ?>">Learn More</a>
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




