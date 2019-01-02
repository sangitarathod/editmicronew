<?php 
/*
 * Template Name: Login Template
 */
 include('inc/number_to_words.php');
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
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri();?>/assets/js/validations/jquery.validationEngine.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri();?>/assets/js/validations/jquery.validationEngine-en.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.noty.packaged.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/validations/validationEngine.jquery.css">

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var homeurl = "<?php echo get_site_url();?>";
var customadminurl = "<?php echo get_site_url();?>/custom-dashboard";
var complete_profile="<?php echo site_url();?>/complete-profile";
</script>

<div id="test">
<
</div>
<?php

if(isset($_POST['btn_login']) && !empty($_POST['btn_login'])){
	login_user_frontend($_POST);
	
}

?>

 

    
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
                <div class="login-content">
                    <div class="login-content-main">
                        <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" class="img-responsive"></a>
                        <div class="login-screen">
							<?php
							if($_GET['err']=='logerr'){
								echo "<p style='color:red;'>Username or password is incorrect.</p>";
							}elseif($_GET['err']==1){
								echo "<p style='color:red;'>Please first signin to manage profile.</p>";
							}
							
							?>
							<label id="msg"></label>
                            <h1>Sign In</h1>
                            <form class="login-form" name="frm_login" id="frm_login" method="POST">
								<input type="hidden" name="s_ans" id="s_ans" value="<?php echo $s_ans;?>">
                                <div class="form-group">
                                    <label>Email Address</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                                    <input class="form-control validate[required,custom[email]]" type="email" name="lgnusername" id="lgnusername">
                                </div>
                                <div class="form-group">
                                    <label>Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="pwd_label"></label>
                                    <input class="form-control validate[required]" type="password" name="lgnpassword" id="lgnpassword">
                                </div>
                                <div class="form-group">
								<div style="display: inline-block;">
									<div id="captchadiv" >
										<?php

										session_start();

										$digit1 = mt_rand(1,20);
										$digit2 = mt_rand(1,20);
										$d1=convert_number_to_words($digit1);
										//echo $digit1;
										if($digit2 > $digit1) {
												$math = "$d1 + $digit2";
												$_SESSION['answer'] = $digit1 + $digit2;
										} else {
												$math = "$d1 - $digit2";
												$_SESSION['answer'] = $digit1 - $digit2;
										}
										$s_ans= $_SESSION['answer'];
										//echo $math."<br>";
										//echo $s_ans;
										?>
										<label>Complete the Math Equation Below *</label><br>
										<label id="ans_label"></label><br>
										<?php echo $math; ?> = <input name="answer" id="answer" type="text" style="width:25%;"/><span style="color:red;"> * </span> 
										
									</div>
									<div style="float:right;margin-top: -15px;">
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/reload.png" height="40px" width="45px" id="reload" > 
									</div>
									</div>
									
								</div>
                                <button type="submit" class="login-btn" name="btn_login" id="btn_login" value='btn_login'>Sign In</button>
                                <p class="forgot text-center"><a href="<?php echo site_url();?>/forgot-password">Forgot Password?</a></p>
                            </form>
                        </div>
                        <p class="register text-center"><span>New User ?</span></p>
                        <a href="<?php echo site_url(); ?>/sign-up" class="create_account_btn">Create your account</a>
                        <span class="back_home"><a href="<?php echo site_url(); ?>">Back To Home</a></span>
                        <div class="login_footer_link">
                           <?php
							if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
									<?php //dynamic_sidebar( 'sidebar-2' ); ?>								
							<?php }?>							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php include('inc/footer_all_script.php');?>
<script type="text/javascript" language="javascript">
			function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		};
           	/* form validation and submission code start */

								
							jQuery("#btn_login").click(function(){
									//alert("ok");								
									var lgnusername = jQuery("#lgnusername" ).val();
									var lgnpassword=jQuery("#lgnpassword").val();								
									var answer=jQuery("#answer").val();
									
									if(lgnusername=='')
									{
									  jQuery("#lgnusername").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#lgnusername").val())) {
										jQuery("#lgnusername").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#lgnusername").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}
									
									if(lgnpassword=='')
									{	jQuery("#lgnpassword").css("border-color","red");
										jQuery("#pwd_label").text("Please enter password");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#lgnpassword").css("border-color","#8d8d8d");
									    jQuery("#pwd_label").empty();
									}
									if(answer==''){
										jQuery("#answer").css("border-color","red");
										jQuery("#ans_label").text("Please fill the captcha");
										jQuery("#ans_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#answer").css("border-color","#8d8d8d");
									    jQuery("#ans_label").empty();
									}
									
									/* form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_login").serialize()+"&action=login_user",
										success: function(result) {
											console.log(result);
											// alert(result['user_role']);
											 
											if(result["success"] == true && result['user_role']=='subscriber')
											{							
												generateNotification("You are logged in successfully.","success");                           
												var redirecturl = homeurl;
												setTimeout(function () {
													window.location.href = redirecturl;
												}, 2500);
											}											
											else if(result['status']==0)
											{							
												generateNotification(result['error'],"error");                            
												var userid=result['userid'];
												var redirecturl = complete_profile+"?userid="+userid;                            
												setTimeout(function () {
												window.location.href = redirecturl;
												}, 2500);
											}else{
												generateNotification(result['error'],"error");							
											}     
										},
										error: function(){						
											generateNotification("Error in login. Please try again.","error");
										}
									});
									return false;*/
							});

							/* form validation and submission code end */
							
							jQuery('#reload').click(function(){		
								//alert("OK");													
								jQuery("#test").load(location.href + " #test");
								jQuery("#captchadiv").load(location.href + " #captchadiv");
								var sessiondata = "<?php echo $s_ans; ?>" ;
								
							});
</script>
</body>
</html>
