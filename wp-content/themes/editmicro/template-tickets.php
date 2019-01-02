<?php
/* Template Name: Tickets Template */

if (is_user_logged_in()) {
get_header('second');
$uid=get_current_user_id();

?>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li>My <?php the_title(); ?></li>
                    </ul> 
                    <h1>My <?php the_title(); ?></h1>
                        <div class="request_quote_main">
                            <div class="request_quote_table">
                                  <ul class="request_quote_heading">
                                    <li class="col-xs-1">Ticket #</li>
                                    <li class="col-xs-5">Products</li>
                                    <li class="col-xs-2">Type of issue</li>
                                    <li class="col-xs-2">Date Created</li>
                                    <li class="col-xs-1">Status</li>
                                    <li class="col-xs-1">&nbsp;</li>
                                  </ul>
                                  <?php
									global $wpdb;
									$sql = "SELECT * FROM `{$wpdb->prefix}log_a_fault`  WHERE log_user_id=".$uid;
									$results = $wpdb->get_results($sql);
									if(count($results)>0){
										foreach($results as $result){
                                  ?>
                                  <a href="<?php echo site_url();?>/ticket-status?tid=<?php echo $result->log_id; ?>">
											  <ul class="request_quote_data <?php if($result->log_status==1){echo 'ticket_status_open';} else{ echo 'ticket_status_resolved';  }?>">
												<li class="col-xs-1"><?php echo $result->log_id;?></li>
												<li class="col-xs-5 request_quote_product_list">
													<?php echo $result->log_product_name;?>
												</li>
												<li class="col-xs-2"><?php echo $result->log_type_of_issue; ?></li>
												<li class="col-xs-2"><?php echo date('d M Y', strtotime($result->log_created_at));?></li>
												<li class="col-xs-1"><?php if($result->log_status==1){echo 'Open';} else { echo 'Resolved'; }?></li>
												<li class="col-xs-1"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/next_arrow.png" alt=""></li>
											  </ul>
											  
									</a>		  
                                  <?php	
											}
										}else{
								 ?>
								 <ul class="request_quote_data">
									 No Tickets Found.
								 </ul>
								 <?php }?>
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
<?php
}else{
	$u1=site_url();
	$u2="/sign-in/";
    wp_redirect(site_url()."/sign-in/", 307);
    exit;
}
?>
