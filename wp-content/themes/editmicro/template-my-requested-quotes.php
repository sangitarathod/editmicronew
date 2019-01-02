<?php
/* Template Name: My Requested Quotes Template */

if (is_user_logged_in()) {
	get_header('second');

?>
        <!-- section end Here -->

 <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <h1><?php the_title(); ?></h1>
                    
                    <?php 
					$customer = wp_get_current_user();
					
					//Get all customer orders
					$customer_quotes = get_posts( array(
						'numberposts' => -1,
						'meta_key'    => '_customer_user',
						'meta_value'  => get_current_user_id(),
						'post_type'   => wc_get_order_types(),
						'post_status' => array_keys( wc_get_order_statuses() ),  //'post_status' => array('wc-completed', 'wc-processing'),					
					) );
					
					
					//echo count($customer_quotes);
					
					//print_r($customer_quotes);
					
					?>
												
                    <div class="request_quote_page">
                        <div class="request_quote_main">
                            <div class="request_quote_table">
                                  <ul class="request_quote_heading">
                                    <li class="col-xs-1">Sr No</li>
                                    <li class="col-xs-5">Products</li>
                                    <li class="col-xs-2">Date Requested</li>
                                    <li class="col-xs-2">Status</li>
                                    <li class="col-xs-2">&nbsp;</li>
                                  </ul>
                                  <?php
								   if(count($customer_quotes)>0){
									$sr_no=0;
                                   foreach($customer_quotes as $customer_quote){ 
									   $sr_no++;
									   $status=explode("-",$customer_quote->post_status);
									   $view_quote=site_url()."/view-quote/?qid=$customer_quote->ID";
									?>
										<ul class="request_quote_data inprocess_quote">
											<li class="col-xs-1"><?php  echo $sr_no;?></li>
											<li class="col-xs-5 request_quote_product_list">
												<ul>
														<?php
														$quote = new WC_Order( $customer_quote->ID );
														$items = $quote->get_items();
														$more_items = $quote->get_items();
														/*echo "<pre>";
														print_r($items); 									
														echo "</pre>";*/
														$c=0;
														foreach ( $items as $item ) {
															$c++;
															$pid=$item['product_id']."<br>";														
																
														?>														
															<li><?php echo $item['name']." x ".$item['quantity'];?></li>															
															
														<?php if($c==1) break;
														}?>
														<div id="<?php echo $customer_quote->ID;?>" name="<?php echo $customer_quote->ID;?>" style="display:none;">
															<?php 
															$cc=0;														
															foreach ( $more_items as $more_item ) {
															$cc++;
															if($cc==1){
																continue;
															}
															?>
															
															<li><?php echo $more_item['name']." x ".$more_item['quantity'];?></li>															
														<?php }?>
														</div>
													</ul> 												
													<a id="<?php echo $customer_quote->ID;?>" class="moreitem" href=""><?php if((count($items)-1)>0){ ?>(View <?php echo count($items)-1; ?> more items)<?php }?></a>												
													<input type="hidden" name="order" id="order" value="<?php echo $customer_quote->ID; ?>">
											</li>
											<li class="col-xs-2"><?php echo date('d M Y', strtotime($customer_quote->post_date));?></li>
											<li class="col-xs-2"><?php if($status[1]=='gplsquote' && $status[2]=='req'){echo "Quote Request";}else if($status[1]=='completed'){echo "Quote Received";}else{echo ucfirst($status[1]);}?></li>
											<li class="col-xs-2 view_quote_link"><?php if($status[1]=='completed'){ echo "<a href='".$view_quote."'>View Quote</a>";} ?></li>
										</ul>
                                 <?php }
									}else{?>
									<ul class="request_quote_data inprocess_quote">
										<li class="col-xs-12">No order has been made yet</li>
									</ul>	
								<?php
									}
                                 ?>
                                 
                                
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
		jQuery(document).ready(function(){			
			
			jQuery('.moreitem').click(function(){
				var order=jQuery(this).attr('id');
				//alert(order);
				jQuery('#'+order).css('display','block');
				jQuery(this).css('display','none');
				return false;
			});
			
		});
	</script>

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
