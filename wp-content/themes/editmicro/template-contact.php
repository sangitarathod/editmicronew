<?php
/* Template Name: Contact Template */
get_header('second');
?>
        <!-- section end Here -->
         <div class="contact_main">
            <div class="contact_banner">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/contact_banner.jpg" alt="">
            </div>
            <div class="container">
                    <div class="contact_details">
                        <h1><span><?php the_title();?></span></h1>
                        
                        <p>For all other questions, comments or requests regarding our solutions, please feel free to contact us directly. We'd love to hear from you.</p>
                        <div class="row">
                            <div class="address_details">
                                    <?php while ( have_posts() ) : the_post();?>
									<?php the_content();?>
									<?php the_excerpt();?>
									<?php endwhile; ?>
                                    
                                </div>
                            </div>
                            
                            <div class="get_in_touch">
                                <h1><span>Get in Touch</span></h1>
                                <div class="row">
                                    
                                    <div class="login-form">
                                        <?php echo do_shortcode('[contact-form-7 id="288" title="Contact form 1"]'); ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="regional_offices">
                                <h1><span>Regional Offices</span></h1>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="contact_info1">
                                            <?php if( get_field('contact_info_1') ): ?>
                                               <?php the_field('contact_info_1'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="contact_info2">
                                            <?php if( get_field('contact_info_2') ): ?>
                                                <?php the_field('contact_info_2'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="contact_info2">
                                            <?php if( get_field('contact_info_3') ): ?>
                                                <?php the_field('contact_info_3'); ?>
                                            <?php endif; ?>
                                        </div>
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
				<script type="text/javascript" language="javascript">
						jQuery('#reload').click(function(){															
								jQuery("#quizdiv").load(location.href + " #quizdiv");
								//var sessiondata = "<?php echo $s_ans; ?>" ;
								
							});
							
							
</script>


</body>
</html>
