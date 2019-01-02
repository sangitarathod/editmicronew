<?php
/* Template Name: Message Reply Template */

?>

<?php

if( current_user_can( 'messages' ) ){
get_header('customadmin');
if(isset($_GET['mid'])){
	$mid=$_GET['mid'];
	
}
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
                 <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Messages</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/messages">Messages</a></li>
                          <li><?php echo $mid;?></li>
                        </ul>
                    </div>
                    <label id="msg"></label>
                    <div class="dashboard_contain_subpage">
						<?php
							global $wpdb;
							$results= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}contact_data WHERE id=$mid");
							if(count($results)>0){ 	
										foreach($results as $result){ 
											 $current = strtotime(date("Y-m-d"));
											 $date    = date('Y-m-d',strtotime($result->date));
											 $date1=strtotime($date);
											 $datediff = $date1 - $current;
											 $difference = floor($datediff/(60*60*24));
											 
											 $data=unserialize($result->data);
						?>
                        <div class="message_container">
                            <div class="message_info_top">
                                <div class="col-sm-8 col-xs-12 user_details">
                                    <h4><?php echo ucfirst($data['name']);?></h4>
                                    <p><?php if($difference==0){ echo 'Today';} else { echo date('l', strtotime($result->date)).", ".date('d M Y',strtotime($result->date)); } ?> at <?php echo date('h:i a',strtotime($result->date));?></p>
                                </div>
                                <div class="col-sm-4 col-xs-12 user_contact_info">
                                    <ul>
                                        <li><a href="">
                                            <i class="fa fa-envelope" aria-hidden="true"></i><?php echo $data['email'];?>
                                        </a></li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i>+<?php echo $data['pnoneNumber'];?> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="message_text_info">
                                <p><?php echo $data['message'];?></p>
                            </div>
                        </div>
                        <div class="message_container">
                            <div class="message_reply_box">
                                <h5>Reply</h5>
                                <form name="frm_message" id="frm_message" method="POST" action="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="message_reply">
								<input type="hidden" name="msg_user_name" id="msg_user_name" value="<?php  echo $data['name'];?>">
								<input type="hidden" name="msg_user_email" id="msg_user_email" value="<?php echo $data['email'];?>"> 
                                <?php 
										// default settings
										$content = $_POST['messagereply'];
										$editor_id = 'messagereply';
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
										<label id="user_msg_label"></label>
										<br><br>
								<input type="submit" name="btn_message" id="btn_message" value="Send Message"> 	
								
								<br><br>
								<input class="upload" type="file" name="message_attachment" id="message_attachment">
								
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
							jQuery("#frm_message").submit(function(e){
									e.preventDefault();
									tinyMCE.triggerSave();																		
									var messagereply=jQuery("#messagereply").val();	
									var msg_user_email=jQuery("#msg_user_email").val();
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(webinarmessage=='')
									{										
										jQuery("#messagereply").css("border-color","red");
										jQuery("#user_msg_label").text("Please Enter Message");
										jQuery("#user_msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#messagereply").css("border-color","#8d8d8d");
									    jQuery("#user_msg_label").empty();
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
												jQuery("#frm_message")[0].reset();
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
