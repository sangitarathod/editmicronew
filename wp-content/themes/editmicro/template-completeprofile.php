<?php 
/*
 * Template Name: Completeprofile Template
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
 <?php 
 if(isset($_GET['userid'])){
	 $userid=$_GET['userid'];
 }
 ?>
</head>

<body>
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
	var signinurl="<?php echo site_url();?>/sign-in";
	var countryurl="<?php echo get_stylesheet_directory_uri(); ?>/json/countries.json";
	</script>

    <!-- Header Starts Here -->
    <header>
        <div class="container completeprofile_header">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="logo_img"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header end Here -->
    <section class="complete_profile_page">
        <div class="container complete_profile_from">
                <div class="col-sm-12 col-xs-12">
                    <div class="profile_from">
                        <h1>Complete your account</h1>
                        <div class="row">
                            <form class="login-form" method="POST" name="frm_complete_profile" id="frm_complete_profile">
								<input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Organisation Name</label>
                                        <input class="form-control" type="text" name="org_name" id="org_name">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input class="form-control" type="text" name="street_add" id="street_add">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Contact Number</label><span style="color:red;"> * </span> <label id="cn_label"></label>
                                        <input class="form-control" type="text" name="contact_no" id="contact_no">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input class="form-control" type="text" name="city" id="city">
                                            </div>
                                            </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Zip/Postal Code</label>
                                                <input class="form-control" type="text" name="zip_code" id="zip_code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Condition or Needs <span>(Optional)</span></label>
                                       <input class="form-control" type="text" name="conditions_needs" id="conditions_needs">
                                   </div>
                                </div>
                                
                                <div class="col-sm-6 col-xs-12">
                                   <div class="form-group">
                                        <label>Country</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;<label id="country_label"></label>
                                        <div class="select_box">
                                            <select name="country" id="country">
												<option value="">Select Country</option>
                                                <?php
                                                global $wpdb;
                                                $results=$wpdb->get_results("select * from wp_countries");                                                
                                                foreach($results as $result){													
												?>
													<option value="<?php echo $result->id;?>"><?php echo $result->name;?></option>
												<?php
												}                                                
                                                ?>
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Age Group of product user <span>(Optional)</span></label>
                                        <div class="select_box">
                                            <select name="age_grp" id="age_grp">
                                                 <option value="">Select Age</option>
                                                 <option value="0-9">0-9</option>
                                                <option value="10-19">10-19</option>
                                                <option value="20-29">20-29</option>
                                                <option value="30-39">30-39</option>
                                                <option value="40-49">40-49</option>
                                                <option value="50-59">50-59</option>
                                                <option value="60-69">60-69</option>
                                                <option value="70-79">70-79</option>
                                                <option value="80-89">80-89</option>
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
									 <div class="form-group">
                                        <label>State/Province</label>
                                        <div class="select_box">
                                            <select name="state" id="state">                                               
												<option value="">Select country first</option>									
                                            </select>
                                        </div>
                                   </div>                                    
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>I am a <span>(Optional)</span></label>
                                        <div class="select_box">
                                            <select name="i_am_a" id="i_am_a">
                                                <option value="">Select option</option>
												  <option value="department-of-education">Department of Education</option>
												  <option value="educational-institution">Educational Institution</option>
												  <option value="educator">Educator</option>
												  <option value="special-needs-and-inclusion">Special Needs and Inclusion</option>
												  <option value="corporate">Corporate</option>
												  <option value="csi-manager">CSI Manager</option>
												  <option value="it-manager">IT Manager</option>
												  <option value="learner-or-parent">Learner or Parent</option>
												  <option value="government">Government</option>
												  <option value="ngo">NGO</option>
												  <option value="other">Other</option>	
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <input id="optinosCheckbox2" name="optinosCheckbox2" value="" type="checkbox">
                                        <label for="optinosCheckbox2">Subscribe to our mailing List.</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 complite_profile_btn">
                                     <button type="submit" class="login-btn" name="btn_complete_profile" id="btn_complete_profile">Create account</button>
                                     <span class="back_home"><a href="<?php echo site_url(); ?>">Back To Home</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    
<?php
get_footer();
?>
   

<?php include('inc/footer_all_script.php');?>
<script type="text/javascript" language="javascript">
	jQuery("#btn_complete_profile").click(function(){
									var contact_no=jQuery("#contact_no").val();
									var country=jQuery("#country").val();
																		
									if(contact_no=='')
									{
										jQuery("#contact_no").css("border-color","red");
										jQuery("#cn_label").text("Please enter contact no");
										jQuery("#cn_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#contact_no").css("border-color","#8d8d8d");
									    jQuery("#cn_label").empty();
									}
									if(country=='')
									{
										jQuery("#country").css("border-color","red");
										jQuery("#country_label").text("Please select country.");
										jQuery("#country_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#country").css("border-color","#8d8d8d");
									    jQuery("#country_label").empty();
									}
									
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_complete_profile").serialize()+"&action=user_complete_profile",
										success: function(result) { 
											console.log(result);						
											if(result["success"] == true){
												var userid=result['user_id'];
												//alert("success");												
												var url = signinurl;
												setTimeout(function () {
													window.location.href = url;
												}, 3500);
											} else {							
												
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
