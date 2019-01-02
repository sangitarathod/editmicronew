<?php
/* Template Name: FacetoFace Training Template */
get_header('second');
?>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li>Face-to-Face Training</li>
                    </ul> 
                    <h1>Face-to-Face Training</h1>   
                    <div class="face_to_face_training">
                        <div class="row">
                            <div class="face_training_main">
                                <div class="col-sm-6">
                                    <div class="our_office">
                                        <span class="col-sm-3">
                                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/at_our_office_icon.png" alt="">
                                        </span>
                                        <div class="col-sm-9 our_office_text">
                                            <h3>At Our Office</h3>
                                            <p> 
												<?php if( get_field('at_our_office') ): ?>
													<?php the_field('at_our_office'); ?>
												<?php endif;?>
											</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="our_office">
                                        <span class="col-sm-3">
                                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/premises.png" alt="">
                                        </span>
                                        <div class="col-sm-9 our_office_text">
                                            <h3>At Your Premises</h3>
                                            <p>
												<?php if( get_field('at_your_premises') ): ?>
													<?php the_field('at_your_premises'); ?>
												<?php endif;?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="request_info">
                                <h1>Request Information</h1>
                                <p>
									<?php if( get_field('request_information') ): ?>
										<?php the_field('request_information'); ?>
									<?php endif;?>
                                </p>
                                <div class="request_info_from">
                                    <div class="col-sm-9">
                                        <form class="login-form" name="frm_ftf_training" id="frm_ftf_training" action="" method="POST">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Name</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="user_label"></label>
                                                    <input class="form-control" type="text" name="user_name" id="user_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Course topic or area of interest</label>
												<div class="select_box">
                                                        <select name="course_topic_interest" id="course_topic_interest">
                                                            <option></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>School/Organisation</label>
                                                    <input class="form-control" type="text" name="school_org" id="school_org">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Required training duration</label>
                                                    <input class="form-control" type="text" name="training_duration" id="training_duration">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input class="form-control" type="text" name="contact_no" id="contact_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Level of computer literacy of the persons to be trained</label>
                                                    <div class="select_box">
                                                        <select name="level_of_literacy" id="level_of_literacy">
                                                            <option></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Number of persons requiring training</label>
                                                    <div class="select_box">
                                                        <select name="no_of_persons" id="no_of_persons">
                                                            <option></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Suggested dates</label>
                                                    <div class="select_box">
                                                        <select name="suggested_date" id="suggested_date">
                                                            <option></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form-group">
                                                     <label>Email</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                                                      <input class="form-control" type="text" name="user_email" id="user_email">
                                                </div>
                                            </div> 
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                     <label>Additional Comments</label>
                                                     <textarea rows="3" cols="50" name="additional_comment" id="additional_comment"></textarea> 
                                                </div>
                                            </div> 
                                            <div class="col-sm-6 col-xs-12 complite_profile_btn">
                                                <button type="submit" class="login-btn" name="btn_ftf_training" id="btn_ftf_training">Request Information</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-3">
										<?php $imageurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));?>
                                        <img src="<?php echo $imageurl; ?>" alt="s">
                                    </div>
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
           	/* form validation and submission code start */

								
							jQuery("#btn_ftf_training").click(function(){
									
								
									var user_name=jQuery("#user_name").val();
									var user_email = jQuery("#user_email" ).val();
									
									
									if(user_name=='')
									{
										jQuery("#user_name").css("border-color","red");
										jQuery("#user_label").text("Please Enter  Name");
										jQuery("#user_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#user_name").css("border-color","#8d8d8d");
									    jQuery("#user_label").empty();
									}
									if(user_email=='')
									{
									  jQuery("#user_email").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#user_email").val())) {
										jQuery("#user_email").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#user_email").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}
									
									
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_ftf_training").serialize()+"&action=ftf_training_frontend",
										success: function(result) {
											console.log(result);											 						
											if(result["success"] == true){	
												jQuery("#msg").text("Successfully Registered.");
												jQuery("#msg").css("color","green");																																			
												setTimeout(function () {
													jQuery("#msg").hide();
													jQuery("#frm_ftf_training")[0].reset();
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
</script>

</body>
</html>
