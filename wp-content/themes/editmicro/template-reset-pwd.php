<?php 
/*
 * Template Name: ResetPWD  Template
 */
 ?>
<?php 
if(isset($_GET['token'])){
	$token=$_GET['token'];
}
if(isset($_GET['userid'])){
	$user_id=$_GET['userid'];
}
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
                <div class="login-content">
                    <div class="login-content-main">
                        <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" class="img-responsive"></a>
                        <div class="login-screen">
							<?php $sevendays_stamp = strtotime("+7 day", $token);
							//echo $sevendays_stamp;
							?>
                            <h1>Reset Password</h1>
                            <p class="reset_password">Please enter a new password</p>
                            <form class="login-form" name="frm_reset_pwd" id="frm_reset_pwd" method="POST">
								<input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                                <div class="form-group">
                                    <label>Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="pwd_label"></label>
                                    <input class="form-control validate[required],minSize[6]" type="password" name="resetpwd" id="resetpwd">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="cpwd_label"></label>
                                    <input class="form-control validate[required, equals[resetpwd]]" type="password" name="resetconfirmpwd" id="resetconfirmpwd">
                                </div>
                                <button type="submit" class="login-btn" name="btn_restet_pwd" id="btn_restet_pwd">Reset Password</button>
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

  <script type="text/javascript" language="javascript">
			 function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
           	/* form validation and submission code start */

								
							jQuery("#btn_restet_pwd").click(function(){																	
									
									var resetpwd=jQuery("#resetpwd").val();
									var resetconfirmpwd=jQuery("#resetconfirmpwd").val();
									
									if(resetpwd=='')
									{	jQuery("#resetpwd").css("border-color","red");
										jQuery("#pwd_label").text("Please enter password");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}else if(resetpwd.length < 6)
									{	jQuery("#resetpwd").css("border-color","red");
										jQuery("#pwd_label").text("Please enter minimum six characters");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#resetpwd").css("border-color","#8d8d8d");
									    jQuery("#pwd_label").empty();
									}
									if(resetpwd != resetconfirmpwd)
									{
										jQuery("#resetconfirmpwd").css("border-color","red");
										jQuery("#cpwd_label").text("Passwords do not match");
										jQuery("#cpwd_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#resetconfirmpwd").css("border-color","#8d8d8d");
									    jQuery("#cpwd_label").empty();
									}
									
									// form submit
									jQuery.ajax({
											url: ajaxurl,
											type: 'post',
											dataType: 'json',
											data:jQuery("#frm_reset_pwd").serialize()+"&action=reset_pwd",
											success: function(result) { 
												console.log(result);						
												if(result["success"] == true){							
													generateNotification(result['message'],"success");
													var url = homeurl;
													setTimeout(function () {
														window.location.href = url;
													}, 3000);
												} else {							
													generateNotification(result["message"],'error');
												}
											},
											error: function(){
												//alert("Error!  Please try again.");
												generateNotification("Error!  Please try again.","error");
											}
										});
									return false;
							});

							/* form validation and submission code end */
							
							
							
        </script> 
