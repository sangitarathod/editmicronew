<?php 
/*
 * Template Name: Register Template
 */
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Microsystems</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags -->

    <!-- CSS links -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- CSS links -->

    <!-- font awesome links -->
    <link href="https://use.fontawesome.com/6f4d530519.css" media="all" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet"> 
    <!-- scroller Stylesheets -->    
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style_scroller.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery.mCustomScrollbar.css">
    
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.theme.default.min.css"/> 
<?php wp_head(); ?>
</head>
<body>


<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.jfontsize-1.0.js"></script>





<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var homeurl = "<?php echo get_site_url();?>";
var complete_profile="<?php echo site_url();?>/complete-profile";
</script>

    
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="login-wrapper">
                <div class="login-bg">
                    <div class="login_footer_link">
                          <?php
							if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
								<?php dynamic_sidebar( 'sidebar-2' ); ?>								
						  <?php }?>
                    </div>
                </div>
                <?php echo $result['error'];?>
                <div class="login-content">
                    <div class="login-content-main">
                        <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" class="img-responsive"></a>
                        <div class="login-screen">
                            <h1>Create Account</h1>
                            <p class="register-message" style="display:none"></p>
                            <form class="login-form" method="POST" id="frm_register" name="frm_register" enctype="multipart/form-data">
								<input type="hidden" id="user_role" name="user_role" value="subscriber" />		
                                <div class="form-group">
                                    <label>Full Name</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="fn_label"></label>
                                    <input class="form-control" type="text" name="full_name" id="full_name">                                    
                                </div>
                                <div class="form-group">
                                    <label>Email</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                                    <input class="form-control" type="email" name="usremail" id="usremail">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="pwd_label"></label>
                                    <input class="form-control" type="password" name="usrpassword" id="usrpassword">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="cpwd_label"></label>
                                    <input class="form-control" type="password" name="usrconfirmpassword" id="usrconfirmpassword">
                                    
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" id="optinosCheckbox2" name="optinosCheckbox2" value="">                                    
                                    <label for="optinosCheckbox2">I accept the <a href="terms_conditions.html">
                                        Terms &amp; Conditions</a></label><span style="color:red;"> * </span>
                                     <p id="term_label" style="color:red;display:none;">Please accept terms and condition</p>
                                </div>
                                <button type="submit" class="login-btn" id="btn_register" name="btn_register">Create account</button>
                                <p class="text_info1 text-center">Already have an account ?
                                    <a href="<?php echo site_url(); ?>/sign-in">Sign In</a></p>
                            </form>
                        </div>
                        <span class="back_home"><a href="<?php echo site_url(); ?>">Back To Home</a></span>
                        <div class="login_footer_link">
                              <?php
								if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
								<?php dynamic_sidebar( 'sidebar-2' ); ?>								
							  <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php include('inc/footer_all_script.php');?>
    
<!--font size script-->
        <script type="text/javascript" language="javascript">
			 function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
           	/* form validation and submission code start */

								
							jQuery("#btn_register").click(function(){
									
								
									var full_name=jQuery("#full_name").val();
									var usremail = jQuery("#usremail" ).val();
									var usrpassword=jQuery("#usrpassword").val();
									var usrconfirmpassword=jQuery("#usrconfirmpassword").val();
									var dataString = 'full_name='+full_name+'&usremail='+usremail+'&usrpassword='+usrpassword+'&usrconfirmpassword='+usrconfirmpassword ; 							
									
									if(full_name=='')
									{
										jQuery("#full_name").css("border-color","red");
										jQuery("#fn_label").text("Please Enter Full Name");
										jQuery("#fn_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#full_name").css("border-color","#8d8d8d");
									    jQuery("#fn_label").empty();
									}
									if(usremail=='')
									{
									  jQuery("#usremail").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#usremail").val())) {
										jQuery("#usremail").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#usremail").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}
									
									if(usrpassword=='')
									{	jQuery("#usrpassword").css("border-color","red");
										jQuery("#pwd_label").text("Please enter password");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}else if(usrpassword.length < 6)
									{	jQuery("#usrpassword").css("border-color","red");
										jQuery("#pwd_label").text("Please enter minimum six characters");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#usrpassword").css("border-color","#8d8d8d");
									    jQuery("#pwd_label").empty();
									}
									if(usrpassword != usrconfirmpassword)
									{
										jQuery("#usrconfirmpassword").css("border-color","red");
										jQuery("#cpwd_label").text("Passwords do not match");
										jQuery("#cpwd_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#usrconfirmpassword").css("border-color","#8d8d8d");
									    jQuery("#cpwd_label").empty();
									}
									if(!(jQuery("#optinosCheckbox2").is(":checked")))
									{										
										jQuery("#term_label").css('display','block');										
										return false;									
									}
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_register").serialize()+"&action=register_member",
										success: function(result) {
											console.log(result);											 						
											if(result["success"] == true){
												var userid=result['user_id'];
												//alert(result['user_role']);	
												//alert(result['user_id']);											
												//alert(result['success']);
												var url = complete_profile+"?userid="+userid;
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

							/* form validation and submission code end */
							
							
							/*check existing user usremail */
							jQuery("#usremail").on("blur", function(){
								var useremail = jQuery("#usremail").val();
								
									if(useremail!=""){
										jQuery.ajax({
											url: ajaxurl,
											type: 'post',
											dataType: 'json',
											data: "useremail="+useremail+"&action=check_existing_user_email",
											success: function(result) { 						
												if(result['success'] == true){
													//alert(result['success']);
													//jQuery("input[name='usrconfirmemail']").focus();
												} else {
													//alert(result['error']);
													//generateNotification(result['error'], "error");
													jQuery("#email_label").text("Email already exists");													
													jQuery("#email_label").css("color","red");                                        
													jQuery("input[name='usremail']").focus();
												}
											}
										});
									}
    });
        </script> 

</body>
</html>
