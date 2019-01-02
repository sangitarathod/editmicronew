<?php
/* Template Name: Get Direction Template */
get_header('second');
?>
       <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <?php while ( have_posts() ) : the_post();?>
                <div class="subpages_cont">
                    <h1><?php the_title();?></h1> 
                    <div class="direction_text1">
                        <span class="col-sm-7"><?php the_post_thumbnail();?></span>
                        <div class="col-sm-5 direction_contain">
                            <div class="direction_info">
                                <?php if( get_field('address_icon') ): ?>
                                <span class="col-sm-2"><img src="<?php the_field('address_icon'); ?>" alt=""></span>
                                <?php endif; ?>
                                <?php if( get_field('address_detail') ): ?>
                                <div class="col-sm-10 text_info1">
                                    <?php the_field('address_detail'); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="direction_info">
                                <?php if( get_field('contact_icon') ): ?>
                                <span class="col-sm-2"><img src="<?php the_field('contact_icon'); ?>" alt=""></span>
                                <?php endif; ?>
                                <?php if( get_field('contact_detail') ): ?>
                                <div class="col-sm-10 text_info1">
                                    <?php the_field('contact_detail'); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="direction_info">
                                <?php if( get_field('direction_icon') ): ?>
                                <span class="col-sm-2"><img src="<?php the_field('direction_icon'); ?>" alt=""></span>
                                <?php endif; ?>
                                <?php if( get_field('direction_detail') ): ?>
                                <div class="col-sm-10 text_info1">
                                    <?php the_field('direction_detail'); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="direction_info2">
                        <?php if( get_field('find_parking') ): ?>
                            <?php the_field('find_parking'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="direction_info2">
                        <?php if( get_field('office_detail_title') ): ?>
                            <h1><?php the_field('office_detail_title'); ?></h1>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-sm-8">
                                <?php if( get_field('office_detail') ): ?>
                                    <?php the_field('office_detail'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <div class="direction_info3">
                                    <div class="text_info2">
                                        
                                        <span>
                                            <?php if( get_field('office_contact_icon') ): ?>
                                                <img src="<?php the_field('office_contact_icon'); ?>" alt="">
                                            <?php endif; ?>
                                        </span>
                                        <?php if( get_field('office_contact_detail') ): ?>
                                           <p> <?php the_field('office_contact_detail'); ?> </p>
                                        <?php endif; ?>
                                        
                                    </div>
                                    <div class="text_info2">
                                        <span>
                                            <?php if( get_field('office_disabled_icon') ): ?>
                                                <img src="<?php the_field('office_disabled_icon'); ?>" alt="">
                                            <?php endif; ?>
                                        </span>
                                        <?php if( get_field('office_disabled_content') ): ?>
                                           <p> <?php the_field('office_disabled_content'); ?> </p>
                                        <?php endif; ?>
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
    <div class="download_catalogue">
        <p><a href="">Download Our Catalogue</a></p>
    </div> 
		
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
