<?php
/* Template Name: Apply Job Template */
get_header('second');
if(isset($_GET['jobid'])){
	$jobid=$_GET['jobid'];
}
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var joblistingurl = "<?php echo site_url(); ?>/job-listing";
</script>
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li>Career Oportunities</li>
                    </ul> 
                    <h1>Career Opportunities</h1>   
                    <?php
                    $targetfolder = site_url()."/assets/images/candidate_attachment/";
					$targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
					echo $targetfolder;                    
                    ?>
                    <div class="row">
                        <div class="training_video_main">
                            <div class="col-sm-8">
								<?php
								global $wpdb;
								$results=$wpdb->get_results("select * from {$wpdb->prefix}jobs where job_id=$jobid"); 
								if(count($results)>0){
								foreach($results as $result){
								?>
							
                                <div class="job_details">
                                    <h3><?php echo $result->job_title;?></h3>
                                    <span><?php echo $result->job_location;?></span>
                                    <p><?php echo $result->job_description;?></p>
                                    
                                    <h5>The role and responsibilities</h5>
                                    <ul>
                                        <li>Manage expectations and day to day interactions with executive clients and sponsors</li>
                                        <li>Develop and maintain contact with top decision makers at key clients</li>
                                        <li>Develop, maintain, and communicate accurate schedules with all project stakeholders</li>
                                        <li>Collaborate with partners across the business to deliver on-time and on-target results</li>
                                    </ul>
                                    
                                    <h5>Requirements</h5>
                                    <ul>
                                        <li>Bachelor Degree and 2+ years of medical device or industry sales experience preferred</li>
                                        <li>SLP or clinical experience with speech generating devices or assistive technology preferred</li>
                                        <li>Strong interpersonal, collaboration and teaming skills</li>
                                        <li>Listening, verbal and written communication skills</li>
                                    </ul>
                                </div>
                                <?php } }?>
                            </div>
                            <div class="col-sm-4">
                                <div class="webinars_register">
                                    <h1>Interested? Apply now!</h1>
                                    <form name="frm_apply_job" id="frm_apply_job" action="" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="jobid" id="jobid" value="<?php echo $jobid;?>">
                                        <div class="form-group">
                                            <label>Name</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="name_label"></label>
                                            <input class="form-control" type="name" name="candidate_name" id="candidate_name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                                            <input class="form-control" type="Email" name="candidate_email" id="candidate_email">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input class="form-control" type="contact" name="candidate_contact_no" id="candidate_contact_no">
                                        </div>
                                        <div class="attechment_button">
                                             <div class="fileUpload btn">
                                               <span><i class="fa fa-paperclip"></i>Attach Files</span>                                               
                                               <input  type="file" placeholder="Write a reply...." name="candidate_attachment" id="candidate_attachment">
                                               
                                              </div><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="att_label"></label>
                                         </div>
                                        <button type="submit" name="btn_apply_job" id="btn_apply_job">Apply Now</button>
                                    </form>
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
		 function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		};
			jQuery(document).ready(function(){
							jQuery("#btn_apply_job").click(function(){
								
									var candidate_name=jQuery("#candidate_name").val();									
									var candidate_email = jQuery("#candidate_email" ).val();
									var candidate_contact_no=jQuery("#candidate_contact_no").val();
									var candidate_attachment=jQuery("#candidate_attachment").val();
									
									
									if(candidate_name=='')
									{
										jQuery("#candidate_name").css("border-color","red");
										jQuery("#name_label").text("Please enter name");
										jQuery("#name_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#candidate_name").css("border-color","#8d8d8d");
									    jQuery("#name_label").empty();
									}
									if(candidate_email=='')
									{
									  jQuery("#candidate_email").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#candidate_email").val())) {
										jQuery("#candidate_email").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#candidate_email").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}									
									if(candidate_attachment=='')
									{	jQuery("#candidate_attachment").css("border-color","red");
										jQuery("#att_label").text("Please choose file");
										jQuery("#att_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#candidate_attachment").css("border-color","#8d8d8d");
									    jQuery("#att_label").empty();
									}
									
									//form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_apply_job").serialize()+"&action=apply_job",
										success: function(result) {
											console.log(result);											 						
											if(result["success"] == true){												
												var url = joblistingurl;
												setTimeout(function () {													
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

