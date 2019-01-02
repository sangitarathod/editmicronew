<?php
/* Template Name: Manage profile Template */

if (is_user_logged_in()){
	get_header('second');

	global $current_user;
	$uid=$current_user->ID;
	$user_meta = get_userdata($uid);
	$user_roles = $user_meta->roles;

	if ( in_array( 'subscriber', $user_roles, true ) ) {
		$role='subscriber';
	}else if ( in_array( 'customadmin', $user_roles, true ) ) {
		$role='customadmin';		
	}
	if($role=='subscriber'){
		get_header('second');
	}else if($role=='customadmin'){
		get_header('customadmin');
	}
	//for other info
	$mp_org_name=get_user_meta($uid,'org_name',true);	
	$mp_age_grp=get_user_meta($uid,'age_grp',true);	
	$mp_i_am_a=get_user_meta($uid,'i_am_a',true);	
	$mp_conditions_needs=get_user_meta($uid,'conditions_needs',true);
	//for address info
	$mp_street_add=get_user_meta($uid,'street_add',true);
	$mp_city=get_user_meta($uid,'city',true);
	$mp_zip_code=get_user_meta($uid,'zip_code',true);
	$mp_country=get_user_meta($uid,'country',true);
	$mp_state=get_user_meta($uid,'state',true);	
	//for personal info
	$mp_full_name=get_user_meta($uid,'first_name',true)." ".get_user_meta($uid,'last_name',true);
	$mp_contact_no=get_user_meta($uid,'contact_no',true);
	global $wpdb;
	$personal_results=$wpdb->get_results("select * from {$wpdb->prefix}users WHERE ID=$uid");                                                
	foreach($personal_results as $personal_result){
		$mp_email=$personal_result->user_email;
		$mp_password=$personal_result->user_pass;
	}
	

?>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js"></script>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <h1><?php the_title();?></h1>   
                    <div class="manage_profile">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="manage_profile_from">
									<label id="personal_info_s_msg" style="display:none;color:green;">Personal information has been updated successfully</label>
                                    <h2>Personal Information</h2>
                                    <div class="row">
                                        <form class="login-form" name="frm_mp_personal_info" id="frm_mp_personal_info" method="POST" action="">											
											<input type="hidden" name="mp_personalinfo_uid" id="mp_personalinfo_uid" value="<?php echo $uid;?>">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Your Name</label>
                                                    <input class="form-control" placeholder="John Smith" type="text" name="mp_full_name"  id="mp_full_name" value="<?php echo $mp_full_name;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" placeholder="johnsmith@gmail.com" type="email" name="mp_email" id="mp_email" value="<?php echo $mp_email;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input class="form-control" placeholder="8956 5678 3552" type="text" name="mp_contact_no" id="mp_contact_no" value="<?php echo $mp_contact_no;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="col-sm-9 col-xs-9 form-group password_input">
                                                    <label>Password</label>
                                                    <input class="form-control" placeholder="***********" type="password" name="mp_password" id="mp_password">
                                                </div>
                                                <div class="col-sm-3 col-xs-3 edit_icon">
                                                    <a href=""><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/edit_icon.png" alt="">Edit</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 complite_profile_btn">
                                                <button type="submit" class="login-btn" name="btn_mp_personal_info" id="btn_mp_personal_info">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="manage_profile_from">
									<label id="address_info_s_msg" style="display:none;color:green;">Address information has been updated successfully</label>
                                    <h2>Address Information</h2>
                                    <div class="row">
                                        <form class="login-form" name="frm_mp_address_info" id="frm_mp_address_info" action="" method="POST">
											<input type="hidden" name="mp_addressinfo_uid" id="mp_addressinfo_uid" value="<?php echo $uid;?>">
											<input type="hidden" name="stateid" id="stateid" value="<?php echo $mp_state;?>">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Street Address</label>
                                                    <input class="form-control" placeholder="2 Lake Road" type="text" name="mp_street_add" id="mp_street_add" value="<?php echo $mp_street_add; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 city_info">
                                                <div class="col-sm-7 form-group">
                                                    <label>City</label>
                                                    <input class="form-control" placeholder="Longmeadow" type="text" name="mp_city" id="mp_city" value="<?php echo $mp_city; ?>">
                                                </div>
                                                <div class="col-sm-5 form-group">
                                                    <label>Postal Code</label>
                                                    <input class="form-control" placeholder="7560" type="text" name="mp_zip_code" id="mp_zip_code" value="<?php echo $mp_zip_code;?>">
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
													<label>Country</label>
													<div class="select_box">
														<select name="mp_country" id="mp_country" class="country">
															<option value="">Select Country</option>
															<?php
															global $wpdb;
															$results=$wpdb->get_results("select * from wp_countries");                                                
															foreach($results as $result){													
															?>
																<option value="<?php echo $result->id;?>" <?php if($mp_country==$result->name){echo "selected";}?>><?php echo $result->name;?></option>
															<?php
															}                                                
															?>
														</select>
													</div>
											   </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 complite_profile_btn">
                                                <button type="submit" class="login-btn" name="btn_mp_address_info" id="btn_mp_address_info">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                
                                <div class="manage_profile_from">
									<label id="other_info_s_msg" style="display:none;color:green;">Other information has been updated successfully</label>
                                    <h2>Other Information</h2>
                                    <div class="row">
                                        <form class="login-form" name="frm_mp_other_info" id="frm_mp_other_info" method="POST" action="">
											<input type="hidden" name="mp_otherinfo_uid" id="mp_otherinfo_uid" value="<?php echo $uid;?>">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Organisation Name</label>
                                                    <input class="form-control" placeholder="" type="text" name="mp_org_name" id="mp_org_name" value="<?php echo $mp_org_name;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>I am a...</label>
                                                    <div class="select_box">
                                                        <select name="mp_i_am_a" id="mp_i_am_a">
                                                            <option value="">Select option</option>
															  <option value="department-of-education" <?php if($mp_i_am_a=="department-of-education"){echo "selected";}?>>Department of Education</option>
															  <option value="educational-institution" <?php if($mp_i_am_a=="educational-institution"){echo "selected";}?>>Educational Institution</option>
															  <option value="educator" <?php if($mp_i_am_a=="educator"){echo "selected";}?>>Educator</option>
															  <option value="special-needs-and-inclusion" <?php if($mp_i_am_a=="special-needs-and-inclusion"){echo "selected";}?>>Special Needs and Inclusion</option>
															  <option value="corporate" <?php if($mp_i_am_a=="corporate"){echo "selected";}?>>Corporate</option>
															  <option value="csi-manager" <?php if($mp_i_am_a=="csi-manager"){echo "selected";}?>>CSI Manager</option>
															  <option value="it-manager" <?php if($mp_i_am_a=="it-manager"){echo "selected";}?>>IT Manager</option>
															  <option value="learner-or-parent" <?php if($mp_i_am_a=="learner-or-parent"){echo "selected";}?>>Learner or Parent</option>
															  <option value="government" <?php if($mp_i_am_a=="government"){echo "selected";}?>>Government</option>
															  <option value="ngo" <?php if($mp_i_am_a=="ngo"){echo "selected";}?>>NGO</option>
															  <option value="other" <?php if($mp_i_am_a=="other"){echo "selected";}?>>Other</option>	
                                                        </select>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Condition or Need</label>
                                                    <input class="form-control" type="text" name="mp_conditions_needs" id="mp_conditions_needs" value="<?php echo $mp_conditions_needs;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Age Group of product user </label>
                                                    <div class="select_box">
                                                        <select name="mp_age_grp" id="mp_age_grp">
                                                            <option value="">Select Age</option>
															<option value="0-9" <?php if($mp_age_grp=="0-9"){echo "selected";}?>>0-9</option>
															<option value="10-19" <?php if($mp_age_grp=="10-19"){echo "selected";}?>>10-19</option>
															<option value="20-29" <?php if($mp_age_grp=="20-29"){echo "selected";}?>>20-29</option>
															<option value="30-39" <?php if($mp_age_grp=="30-39"){echo "selected";}?>>30-39</option>
															<option value="40-49" <?php if($mp_age_grp=="40-49"){echo "selected";}?>>40-49</option>
															<option value="50-59" <?php if($mp_age_grp=="50-59"){echo "selected";}?>>50-59</option>
															<option value="60-69" <?php if($mp_age_grp=="60-69"){echo "selected";}?>>60-69</option>
															<option value="70-79" <?php if($mp_age_grp=="70-79"){echo "selected";}?>>70-79</option>
															<option value="80-89" <?php if($mp_age_grp=="80-89"){echo "selected";}?>>80-89</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 complite_profile_btn">
                                                <button type="submit" class="login-btn" name="btn_mp_other_info" id="btn_mp_other_info">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>    
     <?php 
    if($role=='subscriber'){
		get_footer();
	}else if($role=='customadmin'){
		get_footer('customadmin');
	}
    ?>
	
	
		
		
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
				
				jQuery(document).ready(function(){
						var countryID = jQuery(".country option:selected").val();
						var stateid=jQuery("#stateid").val();
						var dataString = 'country_id='+ countryID+'&stateid=' + stateid;  
						//var countryID = jQuery(this).val();
						///alert(countryID);
						if(countryID){
						 jQuery.ajax({ 
								 type:'POST', 
								 url:ajaxurl,
								 data:dataString+"&action=state_frontend",
								 success:function(html){ 
									 //alert(html);
									 jQuery('#state').html(html); 
									
								 }
								}); 
						 }else{ 
							 jQuery('#state').html('<option value="">Select country first</option>'); 			 
						} 
					
					
					
						jQuery("#btn_mp_other_info").click(function(){		
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_mp_other_info").serialize()+"&action=user_mamage_profile_other_info",
										success: function(result) { 
											console.log(result);
											if(result["success"] == true){												
												jQuery("#other_info_s_msg").css('display','block');
												setTimeout(function () {
													jQuery("#other_info_s_msg").css('display','none');
												}, 4000);
												
											} else {							
												
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
									return false;
							});
							
							// FOR ADDRESS INFO
							
							jQuery("#btn_mp_address_info").click(function(){	
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_mp_address_info").serialize()+"&action=user_mamage_profile_address_info",
										success: function(result) { 
											console.log(result);
											
											if(result["success"] == true){												
												jQuery("#address_info_s_msg").css('display','block');
												setTimeout(function () {
													jQuery("#address_info_s_msg").css('display','none');
												}, 4000);
												
											} else {							
												
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
									return false;
							});

							// FOR PERSONAL INFO
							jQuery("#btn_mp_personal_info").click(function(){	
									
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_mp_personal_info").serialize()+"&action=user_mamage_profile_personal_info",
										success: function(result) { 
											console.log(result);
											if(result["success"] == true){												
												jQuery("#personal_info_s_msg").css('display','block');
												setTimeout(function () {
													jQuery("#personal_info_s_msg").css('display','none');
												}, 4000);
												
											} else {							
												
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
}else{
	$url=site_url()."/sign-in/?err=1";
	wp_redirect($url);
	exit;
}
?>
