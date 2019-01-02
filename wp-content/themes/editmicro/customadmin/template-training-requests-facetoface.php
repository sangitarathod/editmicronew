<?php
/* Template Name: Training Requests FacetoFace Template */

?>

<?php

if( current_user_can( 'training_requests' ) ){
get_header('customadmin');
if(isset($_GET['ftfusrid'])){
	$ftfusrid=$_GET['ftfusrid'];
	
}
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
                 <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Face to Face Training</h1>
                        <ul class="breadcrumb">
                          <li><a href=<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href=<?php echo site_url();?>/training-requests">Training Request</a></li>
                          <li>#<?php echo $ftfusrid;?></li>
                        </ul>
                    </div>
                    <div class="dashboard_contain_subpage">
						<?php
							global $wpdb;
							$results= $wpdb->get_results("SELECT * FROM {$wpdb->prefix}facetoface_training WHERE ftf_id=$ftfusrid");
							if(count($results)>0){ 	
										foreach($results as $result){ 
											$current = strtotime(date("Y-m-d"));											
											 $date    = date('Y-m-d',strtotime($result->ftf_created_at));
											 $date1=strtotime($date);
											 $datediff = $date1 - $current;
											 $difference = floor($datediff/(60*60*24));
						?>
                        <div class="message_container">
                            <div class="message_info_top">
                                <div class="col-sm-8 col-xs-12 user_details">
                                    <h4><?php echo $result->ftf_user_name;?></h4>
                                    <p> <?php if($difference==0){ echo 'Today'; } else { echo date('l', strtotime($result->ftf_created_at)).", ".date('d M Y',strtotime($result->ftf_created_at)); } ?> at <?php echo date('h:i a',strtotime($result->ftf_created_at));?></p>
                                </div>
                                <div class="col-sm-4 col-xs-12 user_contact_info">
                                    <ul>
                                        <li><a href="">
                                            <i class="fa fa-envelope" aria-hidden="true"></i><?php echo $result->ftf_user_email;?>
                                        </a></li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i>+ <?php echo $result->ftf_contact_no;	?> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="training_details">
                                <div class="col-sm-6">
                                    <h6>School Organisation</h6>
                                    <p><?php echo $result->ftf_school_org;?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6>Required training duration</h6>
                                    <p><?php echo $result->ftf_training_duration;?></p>
                                </div>
                                
                                <div class="col-sm-6">
                                    <h6>Number of Person requiring training</h6>
                                    <p><?php echo $result->ftf_no_of_persons;?> People</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6>Level of computer literacy of the person to be trained</h6>
                                    <p><?php echo $result->ftf_level_of_literacy;?></p>
                                </div>
                                
                                <div class="col-sm-6">
                                    <h6>Course topic or area of interest</h6>
                                    <p><?php echo $result->ftf_course_topic_interest;?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6>Suggested Dates</h6>
                                    <p><?php echo $result->ftf_suggested_date;?></p>
                                </div>
                            </div>
                            <div class="message_text_info">
								<p><?php echo $result->ftf_additional_comment;?></p>
                            </div>
                        </div>
                        <div class="message_container">
                            <div class="message_reply_box">
                                <h5>Reply</h5><label id="msg"></label>
                                <form name="frm_facetoface" id="frm_facetoface" method="POST" action="" enctype="multipart/form-data">
								<input type="hidden" name="action" value="facetoface_user_message">
								<input type="hidden" name="facetoface_user_name" id="facetoface_user_name" value="<?php  echo $result->ftf_user_name;?>">
								<input type="hidden" name="facetoface_user_email" id="facetoface_user_email" value="<?php echo $result->ftf_user_email;?>"> 
                                <?php 
										// default settings
										$content = $_POST['facetofacemessage'];
										$editor_id = 'facetofacemessage';
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
								<input type="submit" name="btn_facetoface" id="btn_facetoface" value="Send Message"> 	
								
								<br><br>
								<input class="upload" type="file" name="facetoface_attachment" id="facetoface_attachment">
								
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
							jQuery("#frm_facetoface").submit(function(e){
									e.preventDefault();
									tinyMCE.triggerSave();																		
									var facetofacemessage=jQuery("#facetofacemessage").val();	
									var facetoface_user_email=jQuery("#facetoface_user_email").val();
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(facetofacemessage=='')
									{										
										jQuery("#facetofacemessage").css("border-color","red");
										jQuery("#msg_label").text("Please Enter Message");
										jQuery("#msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#facetofacemessage").css("border-color","#8d8d8d");
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
												jQuery("#frm_facetoface")[0].reset();
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
