<?php
/* Template Name: Training Requests Webinars Template */

?>

<?php

if( current_user_can( 'training_requests' ) ){
get_header('customadmin');
if(isset($_GET['webusrid'])){
	$webusrid=$_GET['webusrid'];
	
}
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
                <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Webinar Request</h1>                       
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/training-requests">Training Request</a></li>
                          <li>#<?php echo $webusrid; ?></li>
                        </ul>
                    </div>
                    <div class="dashboard_contain_subpage">
						<?php
							global $wpdb;
							$results= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}webinar_users WHERE webinar_user_id=$webusrid");
							if(count($results)>0){ 	
										foreach($results as $result){ 
											 $current = strtotime(date("Y-m-d"));
											 $date    = date('Y-m-d',strtotime($result->webinar_created_at));
											 $date1=strtotime($date);
											 $datediff = $date1 - $current;
											 $difference = floor($datediff/(60*60*24));
						?>
                        <div class="training_webinar_main">
                            <div class="webinar_name">
                                <h4>Webinar Name</h4>
                                <p><?php echo get_the_title( $result->webinar_id); ?></p>
                            </div>
                            <div class="applicaton_info">
                                <h4>Applicant Information</h4>
                                <p>Received on:  <?php if($difference==0){ echo 'Today';} else { echo date('l', strtotime($result->webinar_created_at)).", ".date('d M Y',strtotime($result->webinar_created_at)); } ?>at <?php echo date('h:i a',strtotime($result->webinar_created_at));?></p>
                                <ul>
                                    <li><span><?php echo $result->webinar_user_name; ?></span></li>
                                    <li><a href="">
                                        <i class="fa fa-envelope" aria-hidden="true"></i><?php echo $result->webinar_user_email; ?>
                                    </a></li>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i>+ <?php echo $result->webinar_user_contact_num; ?> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="message_container">
                            <div class="message_reply_box">
								<label id="msg"></label>
                                <h5>Reply</h5>
                                <form name="frm_webinar" id="frm_webinar" method="POST" action="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="webinars_register_member">
								<input type="hidden" name="web_user_name" id="web_user_name" value="<?php  echo $result->webinar_user_name;?>">
								<input type="hidden" name="web_user_email" id="web_user_email" value="<?php echo $result->webinar_user_email;?>"> 
                                <?php 
										// default settings
										$content = $_POST['webinarmessage'];
										$editor_id = 'webinarmessage';
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
										<label id="web_user_msg_label"></label>
										<br><br>
								<input type="submit" name="btn_webinar" id="btn_webinar" value="Send Message"> 	
								
								<br><br>
								<input class="upload" type="file" name="webinar_attachment" id="webinar_attachment">
								
								</form>
                            </div>
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
							jQuery("#frm_webinar").submit(function(e){
									e.preventDefault();
									tinyMCE.triggerSave();																		
									var webinarmessage=jQuery("#webinarmessage").val();	
									var web_user_email=jQuery("#web_user_email").val();
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(webinarmessage=='')
									{										
										jQuery("#webinarmessage").css("border-color","red");
										jQuery("#web_user_msg_label").text("Please Enter Message");
										jQuery("#web_user_msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#webinarmessage").css("border-color","#8d8d8d");
									    jQuery("#web_user_msg_label").empty();
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
												jQuery("#frm_webinar")[0].reset();
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
						});	
		</script>
</body>
</html>
<?php }?>
