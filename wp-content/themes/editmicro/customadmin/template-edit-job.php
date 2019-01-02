<?php
/* Template Name: Edit Job Template */

?>

<?php


if( current_user_can( 'employment' ) ){
	get_header('customadmin');
	
	if(isset($_GET['jobid'])){
		$jobid=$_GET['jobid'];
	}
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var joblistingurl = "<?php echo site_url(); ?>/job-listing";
</script>
<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>quotes request</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li>Quotes Requests</li>
                        </ul>
                    </div>
                    <label id="msg"></label>
                    <div class="dashboard_body_contain">
						<?php
									global $wpdb;
									$job_results=$wpdb->get_results("select * from {$wpdb->prefix}jobs where job_id=$jobid"); 
									foreach($job_results as $job_result){
										$locations=$job_result->job_location;
										$location=explode(",",$locations);
										//print_r($location);
										
						?>
                        <form class="login-form" name="frm_edit_job" id="frm_edit_job" action="" method="POST">
							<input type="hidden" name="jobid" id="jobid" value="<?php echo $job_result->job_id;?>">
							<div class="row">
                                <div class="col-sm-5 col-xs-12">
                                    <div class="form-group">
                                        <label>Job title</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="job_label"></label>
                                        <input type="text" id="job_title" name="job_title" class="form-control" placeholder="Job Title" value="<?php echo $job_result->job_title;?>">								                                        
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-12">
                                    <div class="form-group">
                                        <label>Job Location</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp; <label id="loc_label"></label>
                                        <div class="select_box">
                                            <select name="job_location[]" id="job_location"  multiple size="2">				
                                                <?php 
												global $wpdb;
												$results=$wpdb->get_results("select * from {$wpdb->prefix}states where country_id=202"); 
												foreach($results as $result){
													if(in_array("Glenn", $people))
													//echo "<option value='".$result->name."'>".$result->name."</option>";
												?>
													<option value="<?php echo $result->name;?>" <?php if(in_array($result->name,$location)) {echo 'selected';}?>><?php echo $result->name;?></option>
												<?php
												}
												?>
                                            </select>                         
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label>Job Description</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="des_label"></label>
										<?php 
										// default settings
										$content = $job_result->job_description;
										$editor_id = 'jobdescription';
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
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">                                    
                                    <button class="post_new_btn" type="submit" name="btn_edit_job" id="btn_edit_job">Edit Info</button>  
                                </div>
                            </div>
						</form>
						<?php }?>
                    </div>
                </div>
               <?php get_footer('customadmin');?>
            </div>
        </div>

<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery("#btn_edit_job").click(function(){
									tinyMCE.triggerSave();
									var job_title=jQuery("#job_title").val();
									var job_location = jQuery("#job_location" ).val();
									var job_description=jQuery("#job_description").val();
									
									
									if(job_title=='')
									{
										jQuery("#job_title").css("border-color","red");
										jQuery("#job_label").text("Please enter job title");
										jQuery("#job_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#job_title").css("border-color","#8d8d8d");
									    jQuery("#job_label").empty();
									}
									if(job_location=='')
									{
									  jQuery("#job_location").css("border-color","red");
									  jQuery("#loc_label").text("Please select location");
									  jQuery("#loc_label").css("color","red");                                        
									  return false;
									}else{									
										jQuery("#job_location").css("border-color","#8d8d8d");
										jQuery("#loc_label").empty();
									}									
									if(job_description=='')
									{	jQuery("#job_description").css("border-color","red");
										jQuery("#des_label").text("Please enter description");
										jQuery("#des_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#job_description").css("border-color","#8d8d8d");
									    jQuery("#des_label").empty();
									}
									
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_edit_job").serialize()+"&action=edit_job",
										success: function(result) {
											console.log(result);											 						
											if(result["success"] == true){	
												jQuery('#msg').text("Job has been updated successfully.");												
												jQuery('#msg').css("color","green");											
												var url = joblistingurl;
												setTimeout(function () {	
													jQuery('#msg').hide();													
													window.location.href = url;
												}, 2500);
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
					});

</script>

</body>
</html>    

<?php
}
?>

