<?php
get_header('second'); ?>

 <!-- section end Here -->
       <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li><a href="<?php echo site_url();?>/webinars">Webinars</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <?php
                    while ( have_posts() ) : the_post();
                    ?>
                    <h1><?php the_title();?></h1> 
                    <div class="row">
                        <div class="training_video_main">
                            <div class="col-sm-8">
                                <div class="webinars_details">
                                    <h4>Description</h4>
                                    <?php the_content();?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="webinars_register">
								 <label id="msg" style="margin-left:20px;"></label>
                                    <h1>Register for Webinar</h1>
									   <form  method="POST" id="webinar_register_form" name="webinar_register_form">
										   <input type="hidden" name="webinar_id" id="webinar_id" value="<?php the_ID();?>">
                                        <div class="form-group">
                                            <label>Name</label>&nbsp;&nbsp;&nbsp;<label id="web_reg_name_error"></label>
                                            <input class="form-control" type="text" id="web_reg_name" name="web_reg_name">
                                        </div>
										<div class="form-group">
                                            <label>Institute</label>&nbsp;&nbsp;&nbsp;<label id="web_reg_institute_error"></label>
                                            <input class="form-control" type="text" id="web_reg_institute" name="web_reg_institute">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>&nbsp;&nbsp;&nbsp;<label id="web_reg_email_error"></label>
                                            <input class="form-control" type="email" id="web_reg_email" name="web_reg_email">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Num.&nbsp;</label><label id="web_reg_contact_error"></label>
                                            <input class="form-control" type="text" id="web_reg_contact" name="web_reg_contact">
                                        </div>
                                        <div class="form-group">
											<input id="optinosCheckbox" name="optinosCheckbox" value="" type="checkbox">
											<label for="optinosCheckbox">Subscribe to our mailing List.</label>
											<p id="subscribe_label" style="color:red;display:none;">Please accept terms and condition</p>
										</div>
                                        <p>By clicking this button you submit your information to the training organizer, who will use it to communicate with you regarding this event and their other services.</p>
                                        <button type="submit" id="webinar_register_btn">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile; // End of the loop.
						?>
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


		function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		}
						
		jQuery("#webinar_register_btn").click(function(){

				var web_reg_name =jQuery("#web_reg_name").val();
				var web_reg_email = jQuery("#web_reg_email" ).val();
				var web_reg_contact =jQuery("#web_reg_contact").val();
		
				
				if(web_reg_name=='')
				{
					jQuery("#web_reg_name").css("border-color","red");
					jQuery("#web_reg_name_error").text("Please Enter Full Name");
					jQuery("#web_reg_name_error").css("color","red");                                        
					return false;									
				}else{									
					jQuery("#web_reg_name").css("border-color","#8d8d8d");
					jQuery("#web_reg_name_error").empty();
				}

				if(web_reg_email=='')
				{
				  jQuery("#web_reg_email").css("border-color","red");
				  jQuery("#web_reg_email_error").text("Please enter email");
				  jQuery("#web_reg_email_error").css("color","red");                                        
				  return false;
				}else if (!ValidateEmail(jQuery("#web_reg_email").val())) {
					jQuery("#web_reg_email").css("border-color","red");
					jQuery("#web_reg_email_error").text("Please enter valid email");
					jQuery("#web_reg_email_error").css("color","red");                                        
					return false;
				}
				else{									
					jQuery("#web_reg_email").css("border-color","#8d8d8d");
					jQuery("#web_reg_email_error").empty();
				}
				
				if(web_reg_contact=='')
				{
					jQuery("#web_reg_contact").css("border-color","red");
					jQuery("#web_reg_contact_error").text("Please Enter Contact Number");
					jQuery("#web_reg_contact_error").css("color","red");                                        
					return false;									
				}else{									
					jQuery("#web_reg_contact").css("border-color","#8d8d8d");
					jQuery("#web_reg_contact_error").empty();
				}
				
				if(!(jQuery("#optinosCheckbox").is(":checked")))
				{										
					jQuery("#subscribe_label").css('display','block');										
					return false;									
				}
				
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

				// form submit
				jQuery.ajax({
					url: ajaxurl,
					type: 'post',
					dataType: 'json',
					data:jQuery("#webinar_register_form").serialize()+"&action=register_webinar_member",
					success: function(result) {
						
						//alert(result);

						var result1 = Object.keys(result).map(function(key) {
						return [Number(key), result[key]];
						});

						if(result["success"] == true){
							jQuery("#msg").text("Successfully Registered.");
							jQuery("#msg").css("color","green");
							//var userid=result['user_id'];
							//alert(result['user_role']);	
							//alert(result['user_id']);											
							//alert(result['success']);
							//var url = complete_profile+"?userid="+userid;
							//setTimeout(function () {
							//	window.location.href = url;
							//}, 2500);
							setTimeout(function(){ 
								jQuery("#msg").hide();
								jQuery("#webinar_register_form")[0].reset();
							}, 2000);

						} else {							
							
							jQuery("#msg").text("Error in Registration.");
							jQuery("#msg").css("color","red");
						}
					},
					error: function(){
						//alert("Error!  Please try again.");
						
					}
				});
				return false;
		});

		/* form validation and submission code end */

    </script>

</body>
</html>
