<?php
/* Template Name: Thankyou Template */
get_header('second');
?>

   <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <?php while ( have_posts() ) : the_post();?>
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="#">Quotes</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <h1><?php the_title();?></h1>   
                    <div class="thank_you_text">
                        <?php the_post_thumbnail();?>
                        <?php the_content();?>
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