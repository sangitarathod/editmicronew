<?php
/* Template Name: LogaFault2 Template */

if (is_user_logged_in()) {
get_header('second');
$uid=get_current_user_id();

if(isset($_GET['logid'])){
	$logid=$_GET['logid'];
}

?>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                     <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><?php echo the_title();?></li>
                    </ul> 
                    <h1><?php echo the_title(); ?></h1>
                    <div class="log_fault_page">
                        <div class="col-sm-9">
                            <?php while ( have_posts() ) : the_post();?>
							<?php the_content();?>
							<?php endwhile; ?>
                            <div class="log_fault_from">
                                <p>Thank you! your complaint has been regisrtered and your ticket number is #<?php echo $logid; ?> we will contact you soon. You can check the 
                                    <a href="<?php echo site_url();?>/tickets">status of your ticket here.</a></p>
                            </div>
                            
                        </div>  
                        <div class="col-sm-3 customer_support">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/cutomer_support_icon.png" alt="">
                            <p>If you’d like some advice, call us on </p>
                            <span>086 111 3973</span>
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
<?php
}else{
	$u1=site_url();
	$u2="/sign-in/";
    wp_redirect(site_url()."/sign-in/", 307);
    exit;
}
?>
