<?php
/* Template Name: Admin Logfault2 Template */

?>

<?php


if( current_user_can( 'fault_logs' ) ){
	get_header('customadmin');
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}
	
	$aid=get_current_user_id();
?>
			<script type="text/javascript">
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			</script>
			<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>fault logs</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-admin;">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/admin-logfault1;">fault logs</a></li>
                          <li>#<?php echo $id; ?></li>
                        </ul>
                    </div>
                     <label id="msg"></label>
                    <div class="dashboard_contain_subpage">
						<?php
							global $wpdb;
							$results= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}log_a_fault WHERE log_id=$id");
							if(count($results)>0){ 	
										foreach($results as $result){ 
											 $current = strtotime(date("Y-m-d"));
											 $date    = date('Y-m-d',strtotime($result->log_created_at));
											 $date1=strtotime($date);
											 $datediff = $date1 - $current;
											 $difference = floor($datediff/(60*60*24));											 
											
											 $log_uid=$result->log_user_id;
						?>
                        <div class="message_container">
                            <div class="ticket_heading">
                                <h6>Ticket #<?php echo $id;?></h6>
                                <p>Status : <span><?php if($result->log_status==1){echo 'Open';} else { echo 'Closed'; }?></span></p>
                            </div>
                            <div class="message_info_top">
                                <div class="col-sm-8 col-xs-12 user_details">
                                    <h4><?php echo $result->log_user_name;?></h4>
                                    <p><?php if($difference==0){ echo 'Today';} else { echo date('l', strtotime($result->log_crated_at)).", ".date('d M Y',strtotime($result->log_created_at)); } ?> at <?php echo date('h:i a',strtotime($result->log_created_at));?></p>
                                </div>
                                <div class="col-sm-4 col-xs-12 user_contact_info">
                                    <ul>
                                        <li><a href="">
                                            <i class="fa fa-envelope" aria-hidden="true"></i><?php echo $result->log_user_email;?>
                                        </a></li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i>+ <?php echo $result->log_user_contactno;?> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_name">
                                <p><strong>Product: <?php echo $result->log_product_name;?></strong></p>
                            </div>
                            <div class="message_text_info remove_bottom_space">
                                <div class="fault_log_massage">
                                    <div class="ticket_info">
                                    <p><span>Sr no: </span> <?php echo $result->log_serial_no;?></p>
                                    <p><span>Invoice no: </span> <?php echo $result->log_invoice_no;?></p>
                                    </div>
                                    <?php 
                                    $results_msg= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}logfault_messages WHERE log_id=$id AND logmsg_by_userid=$log_uid");
										if(count($results_msg)>0){ 												
											foreach($results_msg as $result_msg){ 
                                    ?>
                                    <p>
										<?php echo $result_msg->logmsg_message;?>
                                    </p>
                                    <?php 	
											}
										}
                                    ?>
                                </div>
                                
                                <div class="attechment_main">
									<?php 
										$results_attach= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}logfault_attachment WHERE log_id=$id AND user_id=$log_uid");										
										foreach($results_attach as $result_attach){											
										?>
										<a class="dl_link" href="<?php echo get_stylesheet_directory_uri();?>/assets/logfault_attachment/<?php echo $result_attach->log_attachment;?>" download></a>
										<?php
											
										}
									?>
										
                                    <p><span><?php echo count($results_attach);?> Attachments</span><img id="download_attach" src="<?php echo get_stylesheet_directory_uri(); ?>/customadmin/images/attechment_icon.png" alt=""></p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="message_container">
                            <div class="message_reply_box">
                                <h5>Reply</h5>
                                <form name="frm_admin_logfault" id="frm_admin_logfault" method="POST" action="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="admin_logfault_reply">
								<input type="hidden" name="msg_user_name" id="msg_user_name" value="<?php  echo $result->log_user_name;?>">
								<input type="hidden" name="msg_user_email" id="msg_user_email" value="<?php echo $result->log_user_email; ?>"> 
								<input type="hidden" name="logid" id="logid" value="<?php echo $result->log_id;?>">
								<input type="hidden" name="aid" id="aid" value="<?php echo $aid;?>">
                                <?php 
										// default settings
										$content = $_POST['adminlogfaultreply'];
										$editor_id = 'adminlogfaultreply';
										$settings =   array(
											'wpautop' => true, // use wpautop?
											'media_buttons' => true, // show insert/upload button(s)
											'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
											'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
											'tabindex' => '',
											'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
											'editor_class' => '', // add extra class(es) to the editor textarea
											'teeny' => false, // output the minimal editor config used in Press This
											'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
											'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
											'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
										);
										wp_editor( $content, $editor_id, $settings );
										?>
										<label id="msg_label"></label>
										<br><br>
								<input type="submit" name="btn_admin_logfault" id="btn_admin_logfault" value="Send Message"> 	
								
								<br><br>
								<input class="upload" type="file" name="admin_logfault_attachment" id="admin_logfault_attachment">
								
								</form>
                            </div>
                        </div>
                        <div class="page_btn">
                            <a id="mars_as_resolved" name="mars_as_resolved">Mark as Resolved</a>
                        </div>
                    </div>
                    <?php 
						}
					}						
                    ?>
                </div>
                <?php get_footer('customadmin');?>
            </div>
        </div>
         
        <script type="text/javascript" language="javascript">
						/* form validation and submission code start */
						jQuery(document).ready(function(){
							jQuery("#frm_admin_logfault").submit(function(e){
									e.preventDefault();
									tinyMCE.triggerSave();																		
									var adminlogfaultreply=jQuery("#adminlogfaultreply").val();	
									var msg_user_email=jQuery("#msg_user_email").val();
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(adminlogfaultreply=='')
									{										
										jQuery("#adminlogfaultreply").css("border-color","red");
										jQuery("#msg_label").text("Please Enter Message");
										jQuery("#msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#adminlogfaultreply").css("border-color","#8d8d8d");
									    jQuery("#msg_label").empty();
									}
									var formData = new FormData(this);
									/*form submit*/
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:formData,
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){
												
												var userid=result['user_id'];																						
												//alert(result['success']);
												jQuery('#msg').text("Email has been sent successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function() {
												jQuery('#msg').hide();
												jQuery("#frm_admin_logfault")[0].reset();
												}, 2000);
																								
											} else {			
												jQuery("#msg").text("Error.");
												jQuery("#msg").css("color","red");				
												//alert("error");
											}
										},
										cache: false,
										contentType: false,
										processData: false,										
									});
									return false;
							});
							
							
			
							/* form validation and submission code end */
							
							jQuery("#mars_as_resolved").click(function(){
								
								var logid=jQuery('#logid').val();							
								var dataString = 'logid='+ logid;
								
									jQuery.ajax({
												url: ajaxurl,
												type: 'post',
												dataType: 'json',
												data:dataString+"&action=logfault_resolved",
												success: function(result) {
													console.log(result);						 						
													if(result["success"] == true){
														jQuery('#msg').text("Logfault has been marked as resolved successfully.");
														jQuery('#msg').css("color","green");
														setTimeout(function() {
																jQuery('#msg').hide();
																location.reload();
															}, 2000);														
														
													} else {							
														alert("error");
													}
												},
												error: function(){
													//alert("Error!  Please try again.");
													
												}
											});
											return false;
								});
								
								
								jQuery("#download_attach").click(function() {
									//jQuery(".dl_link").attr("download", true);
									jQuery('.dl_link').each(function() {										
										jQuery(this)[0].click();										
									});

								});

						});	
		</script>
</body>
</html>    

<?php
}
?>

