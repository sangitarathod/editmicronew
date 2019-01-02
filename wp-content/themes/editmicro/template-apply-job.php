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
                    $target_dir = dirname(__FILE__)."/assets/candidate_attachment/";
                   //echo $target_dir;
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
                                    <?php $description=explode('<!--more-->',$result->job_description);?>
                                    <p><?php echo $description[0];?></p>
                                    <?php echo $description[1];?>
                                    
                                </div>
                                <?php } }?>
                            </div>
                            <div class="col-sm-4">
                                <div class="webinars_register">
									<label id="msg"></label>
                                    <h1>Interested? Apply now!</h1>
                                    <form name="frm_apply_job" id="frm_apply_job" action="" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="action" value="webinars_register_member">
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
                                               <input  class="upload" type="file" placeholder="Write a reply...." name="candidate_attachment" id="candidate_attachment">
                                               
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
							jQuery("#frm_apply_job").submit(function(e){
									e.preventDefault();
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
									var formData = new FormData(this);

									//form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:formData,																				
										success: function(result) {
											//console.log(result);	
												
											if(result["success"] == true){																								
												jQuery('#msg').text("Data has been sent successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function () {													
												 jQuery('#msg').text("");
												 jQuery('#frm_apply_job')[0].reset(); 
												}, 2500);
											} else {							
												alert("error");
											}
										},
										cache: false,
										contentType: false,
										processData: false,
									});
									return false;
							});
					});
				

	</script>
</body>
</html>

