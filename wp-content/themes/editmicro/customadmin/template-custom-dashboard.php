<?php
/* Template Name: Custom Dashboard Template */
get_header('customadmin');
?>
                <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="count_info">
                            <div class="col-sm-4 col-xs-12">
                                <div class="all_count">
                                    <span class="orange"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/messages_icon.png" alt=""></span>
                                    <div class="text_info1">
                                        <h3>05</h3>
                                        <p>New Messages</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-4 col-xs-12">
                                <div class="all_count">
                                    <span class="red"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/fault_logs_icon.png" alt=""></span>
                                    <div class="text_info1">
                                        <h3>08</h3>
                                        <p>Open Fault Logs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="all_count">
                                    <span class="green"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/training_icon.png" alt=""></span>
                                    <div class="text_info1">
                                        <h3>03</h3>
                                        <p>Training Request</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $quotes = get_posts( array(
							'numberposts' => -1,											
							'post_type'   => wc_get_order_types(),
							'post_status' => array_keys( wc_get_order_statuses() ),  //'post_status' => array('wc-completed', 'wc-processing'),					
						) );
									
                    ?>
                    <div class="dashboard_body_contain">
                    <h2>New Quote Requests (<?php echo count($quotes);?>)</h2>
                    
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>									
                                    <tr>
                                        <th>Quote No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th># of Products</th>
                                        <th>Date Received</th>
                                        <th>Status</th>
                                        <th class="hide_text">Action</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
									<?php
									
									if(count($quotes)>0){
										foreach($quotes as $quote){
											$status=explode("-",$quote->post_status);
											$order = new WC_Order( $quote->ID );	
											$user = $order->get_user();
											$user_id = $order->get_user_id();
											$user_info = get_userdata($user_id);
											$first_nm=get_post_meta($order->ID,'_billing_first_name',true);										
											$last_nm=get_post_meta($order->ID,'_billing_last_name',true);										
											$items = $order->get_items();
											
											
									?>
                                    <tr>
                                        <td><?php echo $quote->ID;?></td>
                                        <td><?php echo ucfirst($first_nm)." ".ucfirst($last_nm);?> </td>
                                        <td><?php echo $user_info->user_email;?></td>
                                        <td><?php echo $order->get_item_count();?></td>
                                        <td><?php echo date('d M Y', strtotime($quote->post_date));?></td>
                                        <td class=<?php if($status[1]=='gplsquote' && $status[2]=='req'){echo "open_status";}else if($status[1]=='completed'){echo "send_status";}?>><?php if($status[1]=='gplsquote' && $status[2]=='req'){echo "Open";}else if($status[1]=='completed'){echo "Sent";}else{echo ucfirst($status[1]);}?></td>
                                        <td><a href="">View</a></td>
                                    </tr>
                                    <?php
										} 
									}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               <?php get_footer('customadmin');?>
            </div>
            
            
        </div>
    
    
    
    

</body>
</html>    
