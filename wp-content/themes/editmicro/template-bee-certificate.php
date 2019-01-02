<?php
/* Template Name: Bee Certificate Template */
get_header('second');
?>

    <!-- section end Here -->
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
                        <div class="certificate_page">
                            <div class="col-sm-6">
                                <?php the_content();?>
                            </div>
                            <div class="col-sm-6">
                                <div class="certificate_img">
                                    <?php the_post_thumbnail();?>
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


