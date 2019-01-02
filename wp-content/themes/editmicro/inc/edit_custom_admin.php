<?php

//echo "OK";
?>
<script type="text/javascript" language="javascript">
		 function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		};
					jQuery(".myEditButton").click(function(){														
									
									var e_admin_name=jQuery("#e_admin_name").val();
									var e_admin_email = jQuery("#e_admin_email" ).val();
									var e_admin_pwd=jQuery("#e_admin_pwd").val();
									
									
									
									if(e_admin_name=='')
									{
										jQuery("#e_admin_name").css("border-color","red");
										jQuery("#e_name_label").text("Please Enter Full Name");
										jQuery("#e_name_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#e_admin_name").css("border-color","#8d8d8d");
									    jQuery("#e_name_label").empty();
									}
									if(e_admin_email=='')
									{
									  jQuery("#e_admin_email").css("border-color","red");
									  jQuery("#e_email_label").text("Please enter email");
									  jQuery("#e_email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#e_admin_email").val())) {
										jQuery("#e_admin_email").css("border-color","red");
										jQuery("#e_email_label").text("Please enter valid email");
										jQuery("#e_email_label").css("color","red");  
										                                
										return false;
									}
									else{									
										jQuery("#e_admin_email").css("border-color","#8d8d8d");
										jQuery("#e_email_label").empty();
									}
									
									if(e_admin_pwd=='')
									{	jQuery("#e_admin_pwd").css("border-color","red");
										jQuery("#e_pwd_label").text("Please enter password");
										jQuery("#e_pwd_label").css("color","red");                                        
										return false;									
									}else if(e_admin_pwd.length < 6)
									{	jQuery("#e_admin_pwd").css("border-color","red");
										jQuery("#e_pwd_label").text("Please enter minimum six characters");
										jQuery("#e_pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#e_admin_pwd").css("border-color","#8d8d8d");
									    jQuery("#e_pwd_label").empty();
									}
									if(jQuery('input[name="e_capability[]"]:checked').length < 1){
											jQuery("#e_access_label").text("Please select at least one capability");
											jQuery("#e_access_label").css("color","red");  
												return false;
									}else{
										 jQuery("#e_access_label").empty();
									}
									
									// form submit									
								jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_edit_admin").serialize()+"&action=edit_custom_admin",
										success: function(result) {
											console.log(result);	
													
											if(result["success"] == true){
												var userid=result['user_id'];																						
												//alert(result['success']);
												var url = customadminlist;
												jQuery('#e_msg').text("Admin is updated successfully.");
												jQuery('#e_msg').css("color","green");
												setTimeout(function() {jQuery('#myEditModal').modal('hide');
													window.location.href = url;
												}, 4000);
																								
											} else {			
												jQuery("#e_msg").text("Error.");
												jQuery("#e_msg").css("color","red");				
												//alert("error");
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
									return false;
									
									
							});
							
							/*check existing user usremail */
							jQuery("#e_admin_email").on("blur", function(){
								var e_admin_email = jQuery("#e_admin_email").val();
								
									if(e_admin_email!=""){
										jQuery.ajax({
											url: ajaxurl,
											type: 'post',
											dataType: 'json',
											data: "useremail="+e_admin_email+"&action=check_existing_user_email",
											success: function(result) { 						
												if(result['success'] == true){
													//alert(result['success']);
													//jQuery("input[name='usrconfirmemail']").focus();
												} else {
													//alert(result['error']);
													//generateNotification(result['error'], "error");
													jQuery("#e_email_label").text("Email already exists");													
													jQuery("#e_email_label").css("color","red");                                        
													jQuery("input[name='e_admin_email']").focus();
												}
											}
										});
									}
								});
		
			jQuery('#myEditModal').on('show.bs.modal', function (event) {
				  var button = jQuery(event.relatedTarget) // Button that triggered the modal
				  var recipient = button.data('whatever') // Extract info from data-* attributes
				  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				  var modal = jQuery(this)
				  //modal.find('.modal-title').text('New message to ' + recipient)
				  modal.find('.modal-body input[name="u_id"]').val(recipient)
				});
				
	</script>
