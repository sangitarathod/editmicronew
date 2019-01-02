<?php
/* Template Name: Ticket Status Template */

if (is_user_logged_in()) {
get_header('second');
$uid=get_current_user_id();

if(isset($_GET['tid'])){
	$tid=$_GET['tid'];
}
?>
        <!-- section end Here -->
       <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><a href="<?php echo site_url();?>/tickets">Ticket</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <h1><?php the_title();?></h1>
                    <div class="ticket_status_page">
                        <div class="ticket_info">
                            <div class="section_heading">
                                <span>Ticket No.: <?php echo $tid;?></span>
                            </div>
                            <div class="ticket_section_cont">
                                <div class="request_quote_main">
                                    <div class="request_quote_table">
                                          <ul class="request_quote_heading">
                                            <li class="col-xs-5">Products</li>
                                            <li class="col-xs-3">Date Created</li>
                                            <li class="col-xs-2">Type of issue</li>
                                            <li class="col-xs-2">Status</li>
                                          </ul>
                                          <?php
											global $wpdb;
											$sql = "SELECT * FROM `{$wpdb->prefix}log_a_fault`  WHERE log_id=".$tid;
											$results = $wpdb->get_results($sql);
											if(count($results)>0){
												foreach($results as $result){
                                           ?>
													  <ul class="request_quote_data">
														<li class="col-xs-5 request_quote_product_list">
															<?php echo $result->log_product_name;?>
														</li>
														<li class="col-xs-3"><?php echo date('d M Y', strtotime($result->log_created_at));?></li>
														<li class="col-xs-2"><?php echo $result->log_type_of_issue; ?></li>
														<li class="col-xs-2"><?php if($result->log_status==1){echo 'Open';} else { echo 'Resolved'; }?></li>
													  </ul>
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
                        <?php
                        $msg_sql = "SELECT * FROM `{$wpdb->prefix}logfault_messages`  WHERE log_id=".$tid;
						$msg_results = $wpdb->get_results($msg_sql);
						if(count($msg_results)>0){
							foreach($msg_results as $msg_result){
								$id=$msg_result->logmsg_by_userid;
								$msgid=$msg_result->logmsg_id;
								$u_data=get_userdata($id);
								$u_name=$u_data->display_name;
								$role=get_user_role($id);
								
								
								$current = strtotime(date("Y-m-d"));
								$date = date('Y-m-d',strtotime($msg_result->logmsg_created_at));
								$date1=strtotime($date);
								$datediff = $date1 - $current;
								$difference = floor($datediff/(60*60*24));	
								
                        ?>
                        <div class="ticket_info">
                            <div class="section_heading <?php if($role=='subscriber') {echo 'user_message';}elseif($role=='customadmin'){echo 'admin_message';}?>">
                                <span>Name: <?php echo $u_name;?> <?php if($role=='customadmin'){echo ' (Admin)';}?></span>
                                <span class="message_date_time">Date: <?php echo date('h:i a',strtotime($msg_result->logmsg_created_at)).' - '.date('d F, Y',strtotime($msg_result->logmsg_created_at)); ?></span>
                                
                            </div>
                            <div class="ticket_message">
                                <p><?php echo $msg_result->logmsg_message;?></p>
                            </div>
                            <div class="ticket_attach">								
								<?php 
										$results_attach= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}logfault_attachment WHERE log_id=$tid AND user_id=$id AND logmsg_id=$msgid");										
										foreach($results_attach as $result_attach){											
										?>
										<a class="f_dl_link<?php echo $msgid; ?>" href="<?php echo get_stylesheet_directory_uri();?>/assets/logfault_attachment/<?php echo $result_attach->log_attachment;?>" download></a>
										<?php
											
										}
									?>
										
                                    <p style="text-align:right;"><span><?php echo count($results_attach);?> Attachments</span><img data-msgid="<?php echo $msgid;?>" class="down_attach" src="<?php echo get_stylesheet_directory_uri(); ?>/customadmin/images/attechment_icon.png" alt=""></p>
                            </div>
                        </div>
                       
                        <?php 
							}
						}
                        ?>
                        <div class="enter_messages">
							<label id="msg"></label>
                            <form class="login-form" name="frm_logmsgby_user" id="frm_logmsgby_user"  method="POST" action="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="logmsgby_user">
								<input type="hidden" name="userid" id="userid" value="<?php echo $uid; ?>">
								<input type="hidden" name="logid" id="logid" value="<?php echo $tid;?>">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="font_style1">Enter New Message</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="msg_label"></label>
                                        <textarea rows="3" cols="50" name="message" id="message"></textarea> 
                                    </div>
                                </div> 
                                <div class="col-sm-12 col-xs-12">
                                   <div class="form-group">
                                      <label>Attachment (optional)</label>
                                      <div class="input-group">
                                        <div class="input-group-btn">
                                            <span class="fileUpload btn btn-success">
                                              <span class="upl" id="upload">Choose file</span>
                                              <input type="file" class="upload up" name="logmsg_user_attachment" id="logmsg_user_attachment">
                                            </span><!-- btn-orange -->
                                         </div><!-- btn -->
                                         <input type="text" class="form-control" readonly>
                                     </div><!-- group -->
                                   </div><!-- form-group -->
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                     <button type="submit" class="login-btn" name="btn_logmsgby_user" id="btn_logmsgby_user">Submit</button>
                                </div>
                            </form>
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
						/* form validation and submission code start */
						jQuery(document).ready(function(){
							jQuery("#frm_logmsgby_user").submit(function(e){
									e.preventDefault();									
									var message=jQuery("#message").val();										
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(message=='')
									{										
										jQuery("#message").css("border-color","red");
										jQuery("#msg_label").text("Please Enter Message");
										jQuery("#msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#message").css("border-color","#8d8d8d");
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
												
												jQuery('#msg').text("Email has been sent successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function() {
												jQuery('#msg').hide();
												jQuery("#frm_logmsgby_user")[0].reset();
												location.reload();
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
									//return false;
							});
			
							/* form validation and submission code end */
							
							
							jQuery(".down_attach").click(function() {
									//jQuery(".dl_link").attr("download", true);
									var msgid=jQuery(this).data("msgid");
									alert(msgid);
									jQuery('.f_dl_link'+msgid).each(function() {											
										jQuery(this)[0].click();										
									});

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
