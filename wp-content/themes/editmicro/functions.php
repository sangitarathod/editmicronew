<?php
//remove_action('shutdown', 'wp_ob_end_flush_all', 1);
//For home slider
include('inc/achievement_post.php');
include('inc/success_stories_post.php');
include('inc/gallery_post.php');
include('inc/news_post.php');
include('inc/events_post.php');
include('inc/projects_post.php');


add_action( 'init', 'create_post_type' );

function create_post_type() {	
	register_post_type( 'homeslider',
		array(
		'labels' => array(
		'name' => __( 'HomeSlider' ),
		'singular_name' => __( 'HomeSlider' )
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail'),
		)
	);
}

// Main menu
class Primary_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( array_search( 'menu-item-has-children', $item->classes ) ) {
            $output .= sprintf( "\n<li class='dropdown %s'><a href='%s' class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\">%s <span class='caret'></span></a>\n", ( array_search( 'current-menu-item', $item->classes ) || array_search( 'current-page-parent', $item->classes ) ) ? 'active' : '', $item->url, $item->title );
        } else {
            $output .= sprintf( "\n<li %s><a href='%s'>%s</a>\n", ( array_search( 'current-menu-item', $item->classes) ) ? ' class="active"' : '', $item->url, $item->title );
        }
    }
    function start_lvl( &$output, $depth=0, $args = array()) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
}

// Register menu for Sign in

function register_my_menus() {
  register_nav_menus(
    array(
      'signin' => __( 'Signin Menu','editmicro' ),           
      'signout' => __( 'Signout Menu','editmicro' ),           
      'manageprofile' => __( 'ManageProfie Menu','editmicro' ),           
     )
   );
 }
 add_action( 'init', 'register_my_menus' );
 
 
 // for ajax
 function my_enqueue() {

//wp_enqueue_script( 'theme_jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js",array(),NULL,true);

    $custom_javascript_file = get_stylesheet_directory_uri().'/js/script.js';
	wp_enqueue_script( 'my-js', $custom_javascript_file,array('theme_jquery_js'),NULL,true);

}

add_action( 'wp_enqueue_scripts', 'my_enqueue' );

function admin_enqueue_script_include_function(){

	$custom_javascript_file = get_stylesheet_directory_uri().'/js/script.js';
	wp_enqueue_script( 'my-js', $custom_javascript_file,array(),NULL,true);

}


add_action( 'admin_enqueue_scripts', 'admin_enqueue_script_include_function' );


add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

/*
 * Function Name: register_user_frontend
 * Description: Register user form submit using Ajax 
 * Returns: json
 */

// The function that handles the AJAX request
function register_user_frontend() {
 global $wpdb; 
 
 $useremail = sanitize_email($_POST['usremail']);
 $full_name = sanitize_text_field($_POST['full_name']);
 $userpwd=$_POST['usrpassword']; 
 $userdata = array(
 'user_login' => $useremail,
 'user_pass' => sanitize_text_field($_POST['usrpassword']), 
 'user_email' => $useremail,
 'role' => $_POST['user_role']
 );

 $user_id = wp_insert_user($userdata); 
 if (strpos(sanitize_text_field($_POST['full_name']), " ")) {
        $nameArr = explode(" ", sanitize_text_field($_POST['full_name']));
        $firstname = $nameArr[0];
        array_shift($nameArr);
        $lastname = implode(" ", $nameArr);
        $meta['first_name'] = $firstname;
        $meta['last_name'] = $lastname;
    } else {
        $meta['first_name'] = sanitize_text_field($_POST['full_name']);
    }
	 foreach ($meta as $key => $val) {
        update_user_meta($user_id, $key, $val);
    }
	add_user_meta($user_id, 'registered_role', $_POST['user_role'], true);

	$admin_email = get_option('admin_email');
 
 /* Email to Admin */
				$to=$admin_email;
				$subject="EditMicroSystem Registration";
				$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear Admin,</b> <br /> <b></b> New User has been registered.</td>
						</tr>
						   <tr>
							  <td width="1%" ></td>
							  <td width="33%"><strong>
								<label for="name">User Name </label>
								</strong></td>
							   <td width="50%" >'.$full_name.'</td>
							</tr> 
							<tr>
							  <td width="1%" ></td>
							  <td width="33%"><strong>
								<label for="name">User Email:</label>
								</strong></td>
							   <td width="50%" >'.$useremail.'</td>
							</tr> 
							<tr>
							  <td width="1%" ></td>
							  <td width="33%"><strong>
								<label for="name">User Password:</label>
								</strong></td>
							   <td width="50%" >'.$userpwd.'</td>
							</tr>
						   <tr>
							  <td colspan="3">&nbsp;</td>
							</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
			$from=$useremail;	
			$headers[] = "MIME-Version: 1.0" . "\r\n";
			$headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
			$headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";	
			wp_mail($to, $subject, $message,$headers);
			
			/* Email to User */
			
				$message1='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear '.$full_name.',</b> <br />Thank you for register with us. 
						  </td>
						</tr>
						
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	
				$from1=$admin_email;	
	
    
				$headers1[] = "MIME-Version: 1.0" . "\r\n";
				$headers1[] = "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers1[] = 'From: EditMicrosystem <' . $from1 . '>' . "\r\n";    
	
				wp_mail($useremail,$subject,$message1,$headers1); 
				
				 $result['success'] = true;
				 $result['message'] = "Thank you for register with us.";
				 $result['user_role'] = $_POST['user_role'];
				 $result['user_id']=$user_id;
				 //$result['error'] = "Your entered code is incorrect. Please try again.";
				 echo json_encode($result);
				 exit;
}

add_action('wp_ajax_register_member', 'register_user_frontend');
add_action('wp_ajax_nopriv_register_member', 'register_user_frontend');



/*
 * Function Name: register_webinar_user_frontend
 * Description: Register for webinar user form submit using Ajax 
                This form is on Webinar details page.
 * Returns: json
 */

// The function that handles the AJAX request
function register_webinar_user_frontend() {
	global $wpdb; 

	//echo json_encode($_POST);
	//exit;

	$web_reg_email = sanitize_email($_POST['web_reg_email']);
	$web_reg_name = sanitize_text_field($_POST['web_reg_name']);
	$web_reg_institute = sanitize_text_field($_POST['web_reg_institute']);
	$web_reg_contact = sanitize_text_field($_POST['web_reg_contact']);
    $web_reg_subscribe = (isset($_POST['optinosCheckbox'])) ? 1 : 0; 
   // $web_created_at=time();
    $webinar_id=sanitize_text_field($_POST['webinar_id']);
	$result=array();

	/*$sql = "INSERT INTO {$wpdb_prefix}webinar_users (webinar_id, webinar_user_name, webinar_user_institute, webinar_user_email, webinar_user_contact_num,webinar_user_subscribe,webinar_created_at) VALUES ($webinar_id, '$web_reg_name', '$web_reg_institute', '$web_reg_email','$web_reg_contact',$web_reg_subscribe,$web_created_at)";
	if($wpdb->query($sql)){
		$result['res']=true;
	}*/
	$result['res']=$wpdb->insert( 
	                          'wp_webinar_users', 
								array( 
									'webinar_id'=>$webinar_id,
									'webinar_user_name' => $web_reg_name, 
									'webinar_user_institute' => $web_reg_institute, 
									'webinar_user_email' => $web_reg_email, 
									'webinar_user_contact_num' => $web_reg_contact, 
									'webinar_user_subscribe'=>$web_reg_subscribe,																		
								), 
								array( 
									'%d',
									'%s', 
									'%s',
									'%s',
									'%s',
									'%d',																		
								) 
                             );

	

 /* Email to Admin */
    
	/*
	$to='rathodsangita1111@gmail.com';
	$subject="Registration";
	$message ="Name: " . $full_name . "<br/>";
	$message .="User Email= " . $useremail. "<br/>";
	$message .="User Password= " . $userpwd. "<br/>";
	$from=$useremail;	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
	wp_mail($to, $subject, $message,$headers);

    */

	/* Email to Admin */
	if($result['res']==true){
		$result['success'] = true;
		$result['sub']=$web_reg_subscribe;
	}else{
		$result['success'] = true;
	}

	$result['message'] = "Thank you for register with us.";
	//$result['user_role'] = $_POST['user_role'];
	$result['query']=$wpdb->last_query;
	//$result['error'] = "Your entered code is incorrect. Please try again.";
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_register_webinar_member', 'register_webinar_user_frontend');
add_action('wp_ajax_nopriv_register_webinar_member', 'register_webinar_user_frontend');

/*
 * Function Name: check_existing_user_email
 * Description: Check whether Registered user email is already exits
 * Author: Jiten
 * Returns: json
 */

// The function that handles the AJAX request
function check_existing_user_email() {
 $useremail = sanitize_email($_POST['useremail']);
 $user = get_user_by('email', $useremail);
 if ($user) {
 $result['error'] = "Email already Exists. Please try another email.";
 //$result['userdata'] = $user;
 $result['success'] = false;
 } else {
 $result['message'] = "User not exists.";
 $result['success'] = true;
 }
 echo json_encode($result);
 exit;
}

add_action('wp_ajax_check_existing_user_email', 'check_existing_user_email');
add_action('wp_ajax_nopriv_check_existing_user_email', 'check_existing_user_email');

/*
 * Function Name: check_existing_user_username
 * Description: Check whether Registered user Username is already exits
 * Author: Jiten
 * Returns: json
 */

// The function that handles the AJAX request
function check_existing_user_username() {
 $usrname = sanitize_text_field($_POST['usrname']);
 $user = get_user_by('login', $usrname); 
 if ($user) {
 $result['error'] = "Username already Exists. Please try another Username.";
 //$result['userdata'] = $user;
 $result['success'] = false;
 } else {
 $result['message'] = "User not exists.";
 $result['success'] = true;
 }
 echo json_encode($result);
 exit;
}

add_action('wp_ajax_check_existing_user_username', 'check_existing_user_username');
add_action('wp_ajax_nopriv_check_existing_user_username', 'check_existing_user_username');



/*
 * Function Name: login_user_frontend
 * Description: Login form submit using Ajax
 * Author: Jiten
 * Returns: json
 */

// The function that handles the AJAX request
function login_user_frontend($post_object) {
	
	session_start();
    $username = sanitize_text_field($post_object['lgnusername']);
    $answer= sanitize_text_field($post_object['answer']);
    if( is_numeric($answer) )
    $number = $answer + 0;
	else // let's the number be 0 if the string is not a number
    $number = 0;   
    
    
    if($post_object['s_ans']== $number){
		$f_ans=1;
	}else{
		$f_ans=0;
	}
	//echo "SESS=".$post_object['s_ans'];
	//echo "<br>Ourans=".$post_object['answer'];
	
    $user = get_user_by('email', $username);
    
    $user_role = $user->roles[0];

    $creds = array();
    $creds['user_login'] = $user->user_login;
    $creds['user_password'] = $post_object['lgnpassword'];

    $userObj = wp_signon($creds, false);   
	
	
    if (is_wp_error($userObj)) {
		//echo "YES";		
		if($user_role=='subscriber'){
		//wp_safe_redirect(site_url().'/sign-in/?err=logerr');
			echo "<script>generateNotification('Email or password is incorrect.','error'); setTimeout(\"window.location.href = '".site_url()."/sign-in';\",3500);</script>";       
		}else if($user_role=='customadmin'){
			echo "<script>generateNotification('Email or password is incorrect.','error'); setTimeout(\"window.location.href = '".site_url()."/staff-admin-signin';\",3500);</script>";       
		}
		
       
    }else{
		if( $f_ans==1){
				// Code For Restrict Inactive User Login
				$user_status = get_user_meta($userObj->ID, 'useractive');
				$usr_info=$user_info = get_userdata($userObj->ID);
				$usr_status=$usr_info->user_status;
				if($usr_status==1 && $user_role=='subscriber') {
					//wp_safe_redirect(site_url());
					echo "<script>generateNotification('You are logged in successfully.','success'); setTimeout(\"window.location.href = '".site_url()."';\",3500);</script>";
					
				}elseif($usr_status==1 && $user_role=='customadmin') {
					//wp_safe_redirect(site_url().'custom-dashboard');
					echo "<script>generateNotification('You are logged in successfully.','success'); setTimeout(\"window.location.href = '".site_url()."/custom-dashboard';\",3500);</script>";
					
				}else{
					wp_logout();            
					echo "<script>generateNotification('Your Account is still not activated. Please first activate It.','error'); setTimeout(\"window.location.href = '".site_url().'/complete-profile/?userid='.$userObj->ID."';\",3500);</script>";
					//wp_safe_redirect(site_url().'/complete-profile/?userid='.$userObj->ID);
					
				}
			}else{
				wp_logout();
				echo "<script>generateNotification('Please enter valid captcha.','error'); setTimeout(\"window.location.href = '".site_url()."/sign-in';\",3500);</script>";       
			}
}
   // echo json_encode($result);
   // exit;
}

/*
 * Function Name: complete_profile_frontend
 * Description: complete profile form submit using Ajax 
 * Returns: json
 */

/* The function that handles the AJAX request */
function complete_profile_frontend() {
    $org_name = sanitize_text_field($_POST['org_name']);
    $street_add=sanitize_text_field($_POST['street_add']);
    $contact_no=sanitize_text_field($_POST['contact_no']);
    $city=sanitize_text_field($_POST['city']);
    $zip_code=sanitize_text_field($_POST['zip_code']);
    $conditions_needs=$_POST['conditions_needs'];
    $state=$_POST['state'];
    $age_grp=$_POST['age_grp'];
    $country=$_POST['country'];
    $i_am_a=$_POST['i_am_a'];
    $userid=$_POST['userid'];   
    $subscribe = (isset($_POST['optinosCheckbox2'])) ? 1 : 0; 
		
		$usr_info=$user_info = get_userdata($userid);
		$usr_status=$usr_info->user_status;
		
		global $wpdb;
		$country_names=$wpdb->get_results("select name from wp_countries where id=$country"); 
		foreach($country_names as $country_name){
		 $country_nm=$country_name->name;
		}
		$state_names=$wpdb->get_results("select name from wp_states where id=$state"); 
		foreach($state_names as $state_name){
		 $state_nm=$state_name->name;
		}
		if($usr_status==0){
			update_user_meta($userid,'org_name',$org_name);
			update_user_meta($userid,'street_add',$street_add);
			update_user_meta($userid,'contact_no',$contact_no);
			update_user_meta($userid,'city',$city);
			update_user_meta($userid,'zip_code',$zip_code);
			update_user_meta($userid,'conditions_needs',$conditions_needs);
			update_user_meta($userid,'state',$state_nm);
			update_user_meta($userid,'age_grp',$age_grp);
			update_user_meta($userid,'country',$country_nm);
			update_user_meta($userid,'i_am_a',$i_am_a);		
			update_user_meta($userid,'subscribe',$subscribe);			
			$wpdb->query('UPDATE wp_users SET user_status = 1 WHERE ID = '.$userid);
			$result['success']=true;
			$result['message']="Your account has been activated.Please signin to Continue shopping...";
		}else{
			$result['success']=false;
			$result['message']="Your account is already active.";
		}
	
    
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_user_complete_profile', 'complete_profile_frontend');
add_action('wp_ajax_nopriv_user_complete_profile', 'complete_profile_frontend');

/*============Manage profile start============= */

/* For OTHER INFO */
function user_mamage_profile_other_info() {
    $mp_org_name = sanitize_text_field($_POST['mp_org_name']);
    $mp_conditions_needs=$_POST['mp_conditions_needs'];    
    $mp_age_grp=$_POST['mp_age_grp'];    
    $mp_i_am_a=$_POST['mp_i_am_a'];
    $userid=$_POST['mp_otherinfo_uid'];   
    
		
		$usr_info=$user_info = get_userdata($userid);
		$usr_status=$usr_info->user_status;		
		
		if($usr_status==1){
			update_user_meta($userid,'org_name',$mp_org_name);
			update_user_meta($userid,'conditions_needs',$mp_conditions_needs);			
			update_user_meta($userid,'age_grp',$mp_age_grp);			
			update_user_meta($userid,'i_am_a',$mp_i_am_a);				
			
			$result['success']=true;
			$result['message']="Other info has been updated successfully.";
		}else{
			$result['success']=false;
			$result['message']="Your account is not active.";
		}
	
    
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_user_mamage_profile_other_info', 'user_mamage_profile_other_info');
add_action('wp_ajax_nopriv_user_mamage_profile_other_info', 'user_mamage_profile_other_info');

/* FOR ADDRESS INFO */

function user_mamage_profile_address_info() {    
    $mp_street_add=sanitize_text_field($_POST['mp_street_add']);    
    $mp_city=sanitize_text_field($_POST['mp_city']);
    $mp_zip_code=sanitize_text_field($_POST['mp_zip_code']);   
    $state=$_POST['state'];    
    $country=$_POST['mp_country'];    
    $userid=$_POST['mp_addressinfo_uid'];   
    
		
		$usr_info=$user_info = get_userdata($userid);
		$usr_status=$usr_info->user_status;
		
		global $wpdb;
		$country_names=$wpdb->get_results("select name from wp_countries where id=$country"); 
		foreach($country_names as $country_name){
		 $country_nm=$country_name->name;
		}
		$state_names=$wpdb->get_results("select name from wp_states where id=$state"); 
		foreach($state_names as $state_name){
		 $state_nm=$state_name->name;
		}	
		
		if($usr_status==1){
			update_user_meta($userid,'street_add',$mp_street_add);
			update_user_meta($userid,'city',$mp_city);			
			update_user_meta($userid,'zip_code',$mp_zip_code);			
			update_user_meta($userid,'country',$country_nm);	
			update_user_meta($userid,'state',$state_nm);	
						
			$result['country']=$country_nm;
			$result['success']=true;
			$result['message']="Address information has been updated successfully.";
		}else{
			$result['success']=false;
			$result['message']="Your account is not active.";
		}
	
    
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_user_mamage_profile_address_info', 'user_mamage_profile_address_info');
add_action('wp_ajax_nopriv_user_mamage_profile_address_info', 'user_mamage_profile_address_info');

/* For PERSONAL INFO */
function user_mamage_profile_personal_info() {
	 $mp_email = sanitize_email($_POST['mp_email']);
	 $mp_full_name = sanitize_text_field($_POST['mp_full_name']);
	 $userpwd=$_POST['mp_password'];
	 $userid=$_POST['mp_personalinfo_uid']; 
	 $mp_contact_no=sanitize_text_field($_POST['mp_contact_no']);
	/* $userdata = array(
	 'ID'=>$id,
	 'user_login' => $mp_email,
	 'user_pass' => sanitize_text_field($_POST['mp_password']), 
	 'user_email' => $mp_email,	 
	 );*/

			$usr_info=$user_info = get_userdata($userid);
			$usr_status=$usr_info->user_status;
		
			if($usr_status==1){
				$userid = wp_update_user( array( 'ID' => $userid, 'user_email' => $mp_email,'user_pass' => sanitize_text_field($_POST['mp_password'])) );
				if ( is_wp_error( $userid ) ) {
				$result['success']=false;
				$result['message']="There is some error to update user.";
				} else {
						if (strpos(sanitize_text_field($_POST['mp_full_name']), " ")) {
						$nameArr = explode(" ", sanitize_text_field($_POST['mp_full_name']));
						$firstname = $nameArr[0];
						array_shift($nameArr);
						$lastname = implode(" ", $nameArr);
						$meta['first_name'] = $firstname;
						$meta['last_name'] = $lastname;
					} else {
						$meta['first_name'] = sanitize_text_field($_POST['mp_full_name']);
					}
					 foreach ($meta as $key => $val) {
						update_user_meta($userid, $key, $val);
					}
					
					update_user_meta($userid,'contact_no',$mp_contact_no);
				
					$result['success']=true;
					$result['message']="Personal information has been updated successfully.";
				}
			}else{
				$result['success']=false;
				$result['message']="Your account is not active.";
			}
		
	
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_user_mamage_profile_personal_info', 'user_mamage_profile_personal_info');
add_action('wp_ajax_nopriv_user_mamage_profile_personal_info', 'user_mamage_profile_personal_info');



/*=============Manage profile end===================*/



/*
 * Function Name: state_frontend
 * Description: complete profile form submit using Ajax 
 * Returns: json
 */

/* The function that handles the AJAX request */
function state_frontend() {
	if(isset($_POST["country_id"])){
		$country_id=$_POST['country_id'];
		global $wpdb;
		$results=$wpdb->get_results("select * from wp_states where country_id=$country_id"); 
		                                             
		echo '<option value="">Select state</option>';
		if(isset($_POST['stateid'])){
			$sid=$_POST['stateid'];
			foreach($results as $result){
				$state_id=$result->id;
				$state_name=$result->name;	
			?>			
				<option value="<?php echo $state_id;?>" <?php if($sid==$state_name){echo 'selected';}?>><?php echo $state_name; ?></option>";
			<?php
			}		
		}else{
			foreach($results as $result){
				$state_id=$result->id;
				$state_name=$result->name;
				echo "<option value='$state_id'>$state_name</option>";
			}
			
		}
		
	}
    
}

add_action('wp_ajax_state_frontend', 'state_frontend');
add_action('wp_ajax_nopriv_state_frontend', 'state_frontend');
///////////////////


/*
 * Function Name: forgot_pwd_frontend
 * Description: forgot pwd form submit using Ajax 
 * Returns: json
 */

/* The function that handles the AJAX request */
function forgot_pwd_frontend() {	
	$fpwd_email=sanitize_email($_POST['fpwd_email']);
	global $wpdb;
	$query = $wpdb->get_results("SELECT * FROM wp_users where user_email='$fpwd_email'");
	$count = $wpdb->num_rows;
	$usrs=get_user_by('email', $fpwd_email);
	$usr_nm=$usrs->user_login;
	$usr_id=$usrs->ID;
	if($count >0){	
		 // take a token as current stamp
			 $token = time();
			 //$wpdb->query("UPDATE $wpdb->users SET user_activation_key = '$key' WHERE user_email = '$fpwd_email'");
			 add_user_meta($usr_id,'forgot_pwd_token',$token);
			 $resetlink=site_url()."/reset-password/?token=$token&userid=$usr_id";
			 //email to user
			 $to="$fpwd_email";
   			 $subject="Forgot Password";
			 $message ="Hello".ucfirst($usr_nm).",<br/><br>";
			 $message .="Click the below link to reset password<br><br>";
			 $message .="$resetlink";
			 $message .="<br><br><Br>";
			 $message .="Thanks & regards<br>Admin";
			 $from='admin@editmicrosystem.php-dev.in';	
			 $headers[] = "MIME-Version: 1.0" . "\r\n";
			 $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
			 $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
			 if(wp_mail($to, $subject, $message,$headers)){	
    		$result['success']=true;
    		$result['token']=$token;    		
			$result['message']="Password reset request sent successfully.Please check the email.";
			}else{
				$result['success']=false;
				$result['message']="error";
			}
	}else{
			$result['success']=false;
			$result['message']="Email was not found";	
	}
	
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_forgot_pwd', 'forgot_pwd_frontend');
add_action('wp_ajax_nopriv_forgot_pwd', 'forgot_pwd_frontend');



/*
 * Function Name: reset_pwd_frontend
 * Description: Reset pwd form submit using Ajax 
 * Returns: json
 */

/* The function that handles the AJAX request */
function reset_pwd_frontend() {
	$token=$_POST['token'];
	$resetpwd=$_POST['resetpwd'];
	$user_id=$_POST['user_id'];
	
	// if condition checking timstsmp with timre + 7 
	$sevendays_stamp = strtotime("+7 day", $token);
	$eight=strtotime("+8 day",$token);
	$current_date=date('Y-m-d');
	if($current_date <= $sevendays_stamp){
			wp_set_password( $resetpwd, $user_id );	
    		$result['success']=true;
			$result['message']="Your password is changed successfully.";
	}else{
			$result['success']=false;
			$result['message']="Invalid Token";
	}
	
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_reset_pwd', 'reset_pwd_frontend');
add_action('wp_ajax_nopriv_reset_pwd', 'reset_pwd_frontend');






/////////////////


// hide adminbar to frontend
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


 /* Creating custom post type Webinars code start */
	
	$labels_webinars = array(
		'name'                => _x( 'Webinars', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Webinar', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Webinars', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Webinars', 'twentysixteen' ),
		'all_items'           => __( 'All Webinars', 'twentysixteen' ),
		'view_item'           => __( 'View webinar', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New webinar', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit webinar', 'twentysixteen' ),
		'update_item'         => __( 'Update Webinars', 'twentysixteen' ),
		'search_items'        => __( 'Search Webinars', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);



	$args_webinars= array(
		
		'label'               => __('Webinars', 'twentysixteen' ),
		'description'         => __('Webinars', 'twentysixteen' ),
		'labels'              => $labels_webinars,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor','thumbnail','excerpt'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 4,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		
	);

	register_post_type('webinars',$args_webinars);


	/* Creating custom post type Webinars code end */
	
	/**** Adding custom fields to custom post type  webinar code start */

function webinar_add_meta_box() {
	
	$screens = array( 'webinars' );



	foreach ( $screens as $screen ) {

		add_meta_box(
			'webinars_sectionid',
			__( 'Webinar Date', 'member_textdomain' ),
			'webinar_meta_box_callback',
			$screen
		);
	 }

}

add_action( 'add_meta_boxes', 'webinar_add_meta_box' );


function webinar_meta_box_callback( $post ) {

	wp_nonce_field( 'webinar_save_meta_box_data', 'webinar_meta_box_nonce' );

	/* Below code for Adding jquery Libraries */

    /*
	wp_enqueue_script('jquery-ui-datepicker');	
	//$jquery_ui_css_path = get_stylesheet_directory().'/css/jquery-ui.css';
	//wp_enqueue_style('jquery-ui-css', $jquery_ui_css_path);
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	
	$child_directory_path = get_template_directory_uri();
	wp_enqueue_style('jquery-ui-time-css','http://dancefm.cactiuk.com/dev/wp-content/themes/dancefm/css/jquery-ui-timepicker-addon.css');

	*/

	/* datetime picker library start */


	wp_enqueue_style('bootstrap-theme','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	wp_enqueue_style('datetime','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css'); 


   ?>

	<style>
	.inside td, th { padding: 2px !important;}
	.inside label{margin: 5px; font-weight: 500 !important;}
	</style>
	
   <script type="text/javascript">

        jQuery(document).ready(function(jQuery) {

			jQuery('#webinar_date').datetimepicker({
				format: 'YYYY-MM-DD HH:mm'
			});

			jQuery('#webinar_end_date').datetimepicker({
				format: 'YYYY-MM-DD HH:mm'
			});

		 });
  </script>
	  
  <?php
	
	wp_enqueue_script('moment','https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
	wp_enqueue_script('datetimepicker','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js');



	/* datetime picker libray end */
	
	/*
	if(array_key_exists( 'my_plugin_errors', $_SESSION ) ) {?>
	<div class="error">
		<p style="color:red;"><?php echo $_SESSION['my_plugin_errors']; ?></p>
	</div><?php
	unset( $_SESSION['my_plugin_errors'] );
	}
	*/
	/*
	$webinar_active = get_post_meta( $post->ID, 'webinar_active', true );
	if($webinar_active!=''){$chk_webinar_active ='checked'; }else{ $chk_webinar_active=''; }

	echo '<input type="checkbox" id="webinar_active" name="webinar_active" value="webinar_active" size="25" '.$chk_webinar_active.'/>';
	echo '<label for="member_new_field">';
	_e( 'webinar Active', 'member_textdomain' );
	echo '</label> ';

	echo "<br><br>";
	*/
	
	echo "<table>";
	
	/* webinar start date code start  */

	echo  "<tr>";
	echo "<td>";

	$webinar_date = get_post_meta( $post->ID, 'webinar_date', true );
	echo '<label for="member_new_field">';
	_e('webinar Date', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input class="custom_date_webinar" type="text" id="webinar_date" name="webinar_date" value="' . esc_attr( $webinar_date) . '" size="21" />';
	
	echo "</td>"; 
	echo "</tr>";
	
	/* webinar start date code ends */

	/* webinar end date code start  */

	/*
	echo  "<tr>";
	echo "<td>";

	$webinar_end_date = get_post_meta($post->ID, 'webinar_end_date', true);
	echo '<label for="member_new_field">';
	_e('webinar End Date', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input class="custom_date_webinar" type="text" id="webinar_end_date" name="webinar_end_date" value="' . esc_attr($webinar_end_date) . '" size="21" />';
	
	echo "</td>"; 
	echo "</tr>";
	*/

	/* webinar end date code ends  */


     /*
	echo  "<tr>";
	echo "<td>";

	$webinar_start_time = get_post_meta( $post->ID, 'webinar_start_time', true );
	echo '<label for="member_new_field">';
	_e('webinar Time', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input class="" type="text" id="webinar_start_time" name="webinar_start_time" value="' . esc_attr($webinar_start_time) . '" size="21" />';
	
	echo "</td>"; 
	echo "</tr>";

	*/


	?>

	<script type="text/javascript">

		/*
		jQuery(document).ready(function($) {
		jQuery('.custom_date_webinar').datepicker({
		dateFormat : 'yy-mm-dd'
		});
		*/

	});
	</script>	

	<?php
	/*
	echo  "<tr>";
	echo "<td>"; 
	//echo "webinar Category";

	echo '<label for="member_new_field">';
	_e('webinar Category', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>"; 

    $selected_webinar_category= get_post_meta( $post->ID, 'webinar_category', true );

    ?>

    <select name="webinar_category" style="width:200px;">
			<option value="">Select</option>
			<option value="Upcoming"   <?php if($selected_webinar_category=='Upcoming'){ echo "selected"; } ?> > Upcoming webinar</option>
			<option value="Dancemania" <?php if($selected_webinar_category=='Dancemania'){ echo "selected"; } ?> >Dancemania webinar</option>
    </select>
	
	<?php

	 echo "</td>"; 
	 echo "</tr>";
	 */
	 echo "</table>";

}


 function webinar_save_meta_box_data( $post_id ) {

		 if ( ! isset( $_POST['webinar_meta_box_nonce'] ) ) {
			return;
		 }

		 if ( ! wp_verify_nonce( $_POST['webinar_meta_box_nonce'], 'webinar_save_meta_box_data' ) ) {
			return;
		 }

		 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		 }


		 if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		 } else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		 }

		
		$webinar_active = sanitize_text_field( $_POST['webinar_active'] );
		update_post_meta($post_id, 'webinar_active', $webinar_active);


		$webinar_date = sanitize_text_field( $_POST['webinar_date'] );
		update_post_meta( $post_id, 'webinar_date', $webinar_date);


		$webinar_end_date = sanitize_text_field( $_POST['webinar_end_date'] );
		update_post_meta( $post_id, 'webinar_end_date', $webinar_end_date);


		$webinar_start_time = sanitize_text_field( $_POST['webinar_start_time'] );
		update_post_meta( $post_id, 'webinar_start_time', $webinar_start_time);
		
		//webinar_category

		$webinar_category = sanitize_text_field( $_POST['webinar_category'] );
		update_post_meta( $post_id, 'webinar_category', $webinar_category);

}
add_action( 'save_post', 'webinar_save_meta_box_data' );
/* webinar media code box end */ 


/* Creating custom post type Videos code start */
	
	$labels_Videos = array(
		'name'                => _x( 'Videos', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'video', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Training Videos', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Videos', 'twentysixteen' ),
		'all_items'           => __( 'All Videos', 'twentysixteen' ),
		'view_item'           => __( 'View video', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New video', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit video', 'twentysixteen' ),
		'update_item'         => __( 'Update Videos', 'twentysixteen' ),
		'search_items'        => __( 'Search Videos', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);



	$args_Videos= array(
		
		'label'               => __('Videos', 'twentysixteen' ),
		'description'         => __('Videos', 'twentysixteen' ),
		'labels'              => $labels_Videos,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title','thumbnail'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 4,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		
	);

	register_post_type('Videos',$args_Videos);


	/* Creating custom post type Videos code end */
	
	/**** Adding custom fields to custom post type  video code start */

function video_add_meta_box() {
	
	$screens = array( 'Videos' );



	foreach ( $screens as $screen ) {

		add_meta_box(
			'Videos_sectionid',
			__( 'Video Link', 'member_textdomain' ),
			'video_meta_box_callback',
			$screen
		);
	 }

}

add_action( 'add_meta_boxes', 'video_add_meta_box' );


function video_meta_box_callback( $post ) {

	wp_nonce_field( 'video_save_meta_box_data', 'video_meta_box_nonce' );

	/* Below code for Adding jquery Libraries */

    /*
	wp_enqueue_script('jquery-ui-datepicker');	
	//$jquery_ui_css_path = get_stylesheet_directory().'/css/jquery-ui.css';
	//wp_enqueue_style('jquery-ui-css', $jquery_ui_css_path);
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	
	$child_directory_path = get_template_directory_uri();
	wp_enqueue_style('jquery-ui-time-css','http://dancefm.cactiuk.com/dev/wp-content/themes/dancefm/css/jquery-ui-timepicker-addon.css');

	*/

	/* datetime picker library start */


	wp_enqueue_style('bootstrap-theme','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	wp_enqueue_style('datetime','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css'); 


   ?>

	<style>
	.inside td, th { padding: 2px !important;}
	.inside label{margin: 5px; font-weight: 500 !important;}
	</style>
	
   <script type="text/javascript">

        jQuery(document).ready(function(jQuery) {
			
                   var radioValue = jQuery("input[name='video_link']:checked").val();
                   if(radioValue=='youtube'){					   
                       jQuery('#row_youtube').show();
				   }
				    if(radioValue=='vimeo'){					   
                       jQuery('#row_vimeo').show();
				   }
                   jQuery('#r_youtube').click(function () {
                       jQuery('#row_vimeo').hide();
                       jQuery('#row_youtube').show();
				   });
				  jQuery('#r_vimeo').click(function () {
						  jQuery('#row_youtube').hide();
						  jQuery('#row_vimeo').show();
				  });
                
		 });
  </script>
	  
  <?php
	
	wp_enqueue_script('moment','https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
	wp_enqueue_script('datetimepicker','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js');



	/* datetime picker libray end */
	
	/*
	if(array_key_exists( 'my_plugin_errors', $_SESSION ) ) {?>
	<div class="error">
		<p style="color:red;"><?php echo $_SESSION['my_plugin_errors']; ?></p>
	</div><?php
	unset( $_SESSION['my_plugin_errors'] );
	}
	*/
	/*
	$video_active = get_post_meta( $post->ID, 'video_active', true );
	if($video_active!=''){$chk_video_active ='checked'; }else{ $chk_video_active=''; }

	echo '<input type="checkbox" id="video_active" name="video_active" value="video_active" size="25" '.$chk_video_active.'/>';
	echo '<label for="member_new_field">';
	_e( 'video Active', 'member_textdomain' );
	echo '</label> ';

	echo "<br><br>";
	*/
	
	echo "<table>";
	
	/* Radio button code start */
	echo  "<tr >";
	echo "<td>"; 
	//echo "video Link";

	echo '<label for="member_new_field">';
	_e('Select Video Link', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>"; 

    $selected_video_link= get_post_meta( $post->ID, 'video_link', true );

    ?>
	<input type="radio" id="r_youtube"  name="video_link" value="youtube" <?php checked( $selected_video_link, 'youtube' ); ?> /> Youtube
	<input type="radio" id="r_vimeo" name="video_link" value="vimeo" <?php checked( $selected_video_link, 'vimeo' ); ?> /> Vimeo
    
	
	<?php

	 echo "</td>"; 
	 echo "</tr>";
	 /* Radio button code end */
	/* video youtube link code start  */
	echo "<tr><td>&nbsp;</td></tr>";
	echo  "<tr id='row_youtube'  style='display: none;'>";
	echo "<td>";

	$Youtube_link = get_post_meta( $post->ID, 'Youtube_link', true );
	echo '<label for="member_new_field">';
	_e('Youtube Link', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input type="text" name="Youtube_link" id="Youtube_link" class="regular-text" value="' . esc_attr( $Youtube_link) . '">';
	
	echo "</td>"; 
	echo "</tr>";
	
	/* video youtube link code ends */

	/* video vimeo link code start  */

	
	echo  "<tr id='row_vimeo'  style='display: none;'>";
	echo "<td>";

	$vimeo_link = get_post_meta($post->ID, 'vimeo_link', true);
	echo '<label for="member_new_field">';
	_e('Vimeo Link', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input  class="regular-text" type="text" id="vimeo_link" name="vimeo_link" value="' . esc_attr($vimeo_link) . '" >';
	
	echo "</td>"; 
	echo "</tr>";
	

	/* video vimeo link code ends  */


     /*
	echo  "<tr>";
	echo "<td>";

	$video_start_time = get_post_meta( $post->ID, 'video_start_time', true );
	echo '<label for="member_new_field">';
	_e('video Time', 'member_textdomain' );
	echo '</label> ';

	echo "</td>";  
	echo "<td>";
	
	echo '<input class="" type="text" id="video_start_time" name="video_start_time" value="' . esc_attr($video_start_time) . '" size="21" />';
	
	echo "</td>"; 
	echo "</tr>";

	*/


	?>

	<script type="text/javascript">

		/*
		jQuery(document).ready(function($) {
		jQuery('.custom_date_video').datepicker({
		dateFormat : 'yy-mm-dd'
		});
		*/

	});
	</script>	

	<?php
	
	 echo "</table>";

}


 function video_save_meta_box_data( $post_id ) {

		 if ( ! isset( $_POST['video_meta_box_nonce'] ) ) {
			return;
		 }

		 if ( ! wp_verify_nonce( $_POST['video_meta_box_nonce'], 'video_save_meta_box_data' ) ) {
			return;
		 }

		 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		 }


		 if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		 } else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		 }

		
		$video_active = sanitize_text_field( $_POST['video_active'] );
		update_post_meta($post_id, 'video_active', $video_active);

					
		$Youtube_link = sanitize_text_field( $_POST['Youtube_link'] );
		update_post_meta( $post_id, 'Youtube_link', $Youtube_link);
				
		
		$vimeo_link = sanitize_text_field( $_POST['vimeo_link'] );
		update_post_meta( $post_id, 'vimeo_link', $vimeo_link);
		
		$video_start_time = sanitize_text_field( $_POST['video_start_time'] );
		update_post_meta( $post_id, 'video_start_time', $video_start_time);
		
		//video_link

		$video_link = sanitize_text_field( $_POST['video_link'] );
		update_post_meta( $post_id, 'video_link', $video_link);

}
add_action( 'save_post', 'video_save_meta_box_data' );
/* video media code box end */ 

/* Adding menu with page in wordpress admin area */

/**
 * Register a custom menu page.
 
function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Webinar Users',
        'manage_options',
        'webinar-users',
		'webinars_users_list',
        '',
	     6
		
    );
}

add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

function webinars_users_list(){
	include("webinar_users_listings.php");

}*/

/* Adding menu with page in wordpress admin area */

/* Send mail to weinars registered users start */
/*
 * Function Name: webinars_register_user_frontend
 * Description: Webniars Register user form submit using Ajax 
 * Returns: json
 */

// The function that handles the AJAX request
function webinars_register_user_frontend() {
 global $wpdb; 
 $web_user_name=$_POST['web_user_name'];
 $web_user_email = $_POST['web_user_email'];
 $web_user_msg=wpautop($_POST['webinarmessage']);
 $timestamp = time();
 $webinar_attachment=$timestamp."_".basename($_FILES["webinar_attachment"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/webinar_attachment/";
 $target_file = $target_dir . $webinar_attachment;
 move_uploaded_file($_FILES["webinar_attachment"]["tmp_name"], $target_file);
 /* Email to Admin */
	$to="$web_user_email";
	$subject="Webinars Requests Reply";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear '.$web_user_name.',</b> <br />'.$web_user_msg.' 
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from="rathodsangita1111@gmail.com";	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/webinar_attachment/$webinar_attachment");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
	 $result['success'] = true;
	 $result['message'] = "Thank you for register with us."; 
	 $result['email']=$web_user_email;
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_webinars_register_member', 'webinars_register_user_frontend');
add_action('wp_ajax_nopriv_webinars_register_member', 'webinars_register_user_frontend');


/* Send mail to weinars registered users  end */
/* add exceprt to page */
add_post_type_support( 'page', 'excerpt' );

/* Creating custom post type Meet Team code start */
	
	$labels_Videos = array(
		'name'                => _x( 'Meet Team', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'team', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Meet The Team', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Teams', 'twentysixteen' ),
		'all_items'           => __( 'All Teams', 'twentysixteen' ),
		'view_item'           => __( 'View team', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New team', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit team', 'twentysixteen' ),
		'update_item'         => __( 'Update Teams', 'twentysixteen' ),
		'search_items'        => __( 'Search Teams', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);



	$args_Videos= array(
		
		'label'               => __('Teams', 'twentysixteen' ),
		'description'         => __('Teams', 'twentysixteen' ),
		'labels'              => $labels_Videos,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title','editor','thumbnail'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 4,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		
	);

	register_post_type('Teams',$args_Videos);


	/* Creating custom post type Videos code end */


  /* Creating custom post type for glossary start */

	
	add_action( 'init', 'create_post_type_glossary' );

	function create_post_type_glossary() {	
		register_post_type( 'glossary',
			array(
			'labels' => array(
			'name' => __( 'Glossary' ),
			'singular_name' => __( 'Glossary' )
			),
			'public' => true,			
			)
		);
	}

	register_taxonomy( 'alpha-char', 'glossary',array('hierarchical'=>true));
	

/* Creating custom post type for glossary end */

/* glossary listing function start */
function display_glossary() {
	if(isset($_POST["id"])){
		$cat_id=$_POST["id"];
		$args = [
			'post_type' => 'glossary',
			'tax_query' => [
				[
					'taxonomy' => 'alpha-char',
					'terms' =>$cat_id,											
				],
			],									
		];	
		$posts = get_posts($args);	
		if(count($posts)>0){	
			foreach($posts as $post){
				$result.='<li><h4>'.$post->post_title.'</h4><p>'.$post->post_content.'</p></li>';
			}
		}else{
				$result='<h2>No Data Found.</h2>';
		}
		
	}
     echo $result;
	 exit;
}
add_action('wp_ajax_display_glossary', 'display_glossary');
add_action('wp_ajax_nopriv_display_glossary', 'display_glossary');

//Get gallery posts years
function get_posts_years_array($p_type) {
    global $wpdb;
    $result = array();
    $query="SELECT YEAR(post_date) FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type='".$p_type."' GROUP BY YEAR(post_date) DESC";
    $years = $wpdb->get_results($query,ARRAY_N);
    if ( is_array( $years ) && count( $years ) > 0 ) {
        foreach ( $years as $year ) {
            $result[] = $year[0];
        }
    }
    return $result;
}
/* gallary by year listing function start */
function display_gallary_by_year() {
	global $wpdb;
	if(isset($_POST["year"])){
		$year=$_POST["year"];
		
		$args = array(
			'post_type' => 'gallery',
			'post_status'=>'publish',
			'date_query' => array(
					'year' => $year),
		);

		$posts = get_posts($args);
		$count_posts=count($posts);	
		if(count($posts)>0){	
			foreach($posts as $post){
				$url=site_url()."/gallery-album?id=".$post->ID;								
				$category = get_the_terms( $post->ID, 'gallery-category' );     
				foreach ( $category as $cat){
				   $cat=$cat->name;
				}
				$thumb_url =  wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$id=$post->ID;
				$date=get_the_date('j F Y',$id);
				
				$result.='<a href="'.$url.'">';
				$result.='<img src="'.$thumb_url.'" alt="" />';
				$result.='<div class="album_details">';
				$result.='<p>'.$cat.'</p>';
				$result.='<h3>'.$post->post_title.'</h3>';
				$result.='<span>'.$date.'</span>';
				$result.='</div>';
				$reault.='</a>';
			}
		}else{
				$result='<h2>No Data Found.</h2>';
		}
		
	}
     echo $result;
     
	 exit;
}
add_action('wp_ajax_display_gallary_by_year', 'display_gallary_by_year');
add_action('wp_ajax_nopriv_display_gallary_by_year', 'display_gallary_by_year');
/* gallary by year listing function end */

/* News by year listing function start */
function display_news_by_year() {
	global $wpdb;
	if(isset($_POST["year"])){
		$year=$_POST["year"];
		
		$args = array(
			'post_type' => 'news',
			'post_status'=>'publish',
			'date_query' => array(
					'year' => $year),
		);

		$posts = get_posts($args);
		$count_posts=count($posts);	
		if(count($posts)>0){	
			foreach($posts as $post){
				$url=site_url()."/gallery-album?id=".$post->ID;								
				$category = get_the_terms( $post->ID, 'news-category' );     
				foreach ( $category as $cat){
				   $cat=$cat->name;
				}
				$thumb_url =  wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$id=$post->ID;
				$date=get_the_date('j F Y',$id);
				$m=date('F',strtotime($date));
				$d=date('d',strtotime($date));	
				$y=date('Y',strtotime($date));
				$excerpt=get_the_excerpt($id);
				$permalink=get_the_permalink($id);
				$result.='<img src="'.$thumb_url.'" alt="">';
				$result.='<div class="news_text_info">';
				$result.='<div class="col-sm-1 col-xs-2 news_date">';
				$result.='<h4>'.$d.'</h4>';
				$result.='<span>'.$m.'<br> '.$y.'</span>';
				$result.='</div>';
				$result.='<div class="col-sm-11 col-xs-10">';
				$result.='<div class="news_text_data">';
				$result.='<span>Categories: '.$cat.'</span>';
				$result.='<h2>'.$post->post_title.'</h2>';
				$result.='<p>'.$excerpt.'</p>';
				$result.='<a href="'.$permalink.'">Read More</a>';
				$result.='</div>';
				$result.='</div>';
				$result.='</div>';
				
			}
		}else{
				$result='<h2>No Data Found.</h2>';
		}
		
	}
     echo $result;
     
	 exit;
}
add_action('wp_ajax_display_news_by_year', 'display_news_by_year');
add_action('wp_ajax_nopriv_display_news_by_year', 'display_news_by_year');
/* News by year listing function end */

// woocommerce product  title
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 );
	function abChangeProductsTitle() {
	echo '<p>' . get_the_title() . '</p>';
}

// Remove image and title link in shop page.
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


// get addressbar url
function getAddress() {
    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

// get subcategories by cat id
function woocommerce_subcats_from_parentcat_by_ID($parent_cat_ID) {

   $args = array(

       'hierarchical' => 1,

       'show_option_none' => '',

       'hide_empty' => 0,

       'parent' => $parent_cat_ID,

     'taxonomy' => 'product_cat'

   );

$subcats = get_categories($args);
	if( !empty($subcats) ){
		foreach ($subcats as $sc) {

			   $link = get_term_link( $sc->slug, $sc->taxonomy );

				echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';

			 }
	}else{
		echo '<li><a href="">No subcategories found &nbsp;</a></li>';
	}
}

// display products of blind and low vision category products in  shop page 
add_action('pre_get_posts','shop_filter_cat');

     function shop_filter_cat($query) {
        if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
           $query->set('tax_query', array(
                        array ('taxonomy' => 'product_cat',
                                           'field' => 'slug',
                                            'terms' => 'blind-and-low-vision'
                                     )
                         )
           );   
        }
     }
     

// Add manage admin menu 
function register_manage_admins_menu_page() {
    add_menu_page('Manage Admins', 'Manage Admins','manage_options','manage_admins','manage_admin_menu_page', null, 6); 
}
add_action('admin_menu', 'register_manage_admins_menu_page');

function manage_admin_menu_page(){
   include("inc/manage_admins_page.php");
}

// create new role

/*add_role('custom-admin', __(
    'Custom Admin'),
     array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);
add_role(
    'basic_contributor',
    __( 'Basic Contributor' ),
    array(
        'read'         => false,  // true allows this capability
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    )
);*/
add_role("basic_contributor1", "User with no access");
add_role("customadmin", "customadmin");

/* Custom add new admin function start */

function add_new_admin() {
	
		
		$admin_name = sanitize_text_field($_POST['admin_name']);
		$admin_pwd = sanitize_text_field($_POST['admin_pwd']);
		$admin_email = sanitize_email($_POST['admin_email']);
		$admin_department=sanitize_text_field($_POST['admin_department']);
		$capability=$_POST['capability'];
			
				// Create user and set role to administrator
				$user_id = wp_create_user( $admin_name, $admin_pwd, $admin_email);
				if ( is_int($user_id) )
				{
					
					$wp_user_object = new WP_User($user_id);
					$wp_user_object->set_role('customadmin');
					
					$chk="";  
					foreach($capability as $capa)  
					   {  
						  $wp_user_object->add_cap("$capa");
						  
					   }  
										
					 
					update_user_meta($user_id,'department',$admin_department);
					$result['success'] = true;
					$result['message']="Admin has been created successfully.";
				}
				else {
					$result['false']=false;
					$result['message']="Error with wp_insert_user. No users were created.";
				}
			
		
	
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_add_new_admin', 'add_new_admin');
add_action('wp_ajax_nopriv_add_new_admin', 'add_new_admin');


/* Edit Custom admin function start */

function edit_custom_admin() {
	
		$userid=sanitize_text_field($_POST['u_id']);
		$e_admin_name = sanitize_text_field($_POST['e_admin_name']);
		$e_admin_pwd = sanitize_text_field($_POST['e_admin_pwd']);
		$e_admin_email = sanitize_email($_POST['e_admin_email']);
		$e_admin_department=sanitize_text_field($_POST['e_admin_department']);
		$e_capability=$_POST['e_capability'];
		//$capability=$_POST['capability'];
			
			
			wp_update_user( array(
				'ID' => $userid,
				'user_email' => $e_admin_email,
				'user_login'=>$e_admin_name,
				'user_nicename'=>$e_admin_name,
				'display_name'=>$e_admin_name,
				'user_pass'=>$e_admin_pwd
		   ) );
			$user_data = get_userdata( $userid );
			/*if(!empty( $user_data->roles )){
				$role=$user_data->roles[0];				
			}*/
			
			$wp_user_object = new WP_User($userid);			
			
			$old_caps=km_get_user_capabilities($userid);
			foreach($old_caps as $old_cap)  
					   { 						  
						  $wp_user_object->remove_cap("$old_cap");						  
					   }
			//$result['old_cap']=print_r($old_cap);
			$wp_user_object->set_role('customadmin');
			foreach($e_capability as $capa)  
					   { 						  
						  $wp_user_object->add_cap("$capa");						  
					   }
			
			//$result['old_cap']=$old_cap;
			$result['success']=true;
				/*Create user and set role to administrator
				$user_id = wp_create_user( $admin_name, $admin_pwd, $admin_email);
				if ( is_int($user_id) )
				{
					
					$wp_user_object = new WP_User($user_id);
					$wp_user_object->set_role('customadmin');
					
					$chk="";  
					foreach($capability as $capa)  
					   {  
						  $wp_user_object->add_cap("$capa");
						  
					   }  
										
					 
					update_user_meta($user_id,'department',$admin_department);
					$result['success'] = true;
					$result['message']="Admin has been created successfully.";
				}
				else {
					$result['false']=false;
					$result['message']="Error with wp_insert_user. No users were created.";
				}
			
				
	*/
	
		
		
	
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_edit_custom_admin', 'edit_custom_admin');
add_action('wp_ajax_nopriv_edit_custom_admin', 'edit_custom_admin');




/* Custom add new admin function end*/

// get capabilities of user
function km_get_user_capabilities( $user ) {
	$user = $user ? new WP_User( $user ) : wp_get_current_user();
	return array_keys( $user->allcaps );
}

// Remove add to cart message 
add_filter( 'wc_add_to_cart_message_html', '__return_null' );


//update cart when quanity changed

add_action( 'wp_footer', 'cart_refresh_update_qty' ); 
 
function cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript"> 
            jQuery('div.woocommerce').on('change', 'input.qty', function(){ 
                jQuery("[name='update_cart']").trigger("click"); 
            }); 
        </script> 
        <?php 
    } 
}
//remove cart updated message
add_filter('gettext', 'wpse_124400_woomessages', 10, 3);

function wpse_124400_woomessages($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        if ($text == 'Cart updated.') {
            $translation = '';
        }
    }

    return $translation;
}

// Remove category name from product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// hide coupon msg on checkout
function hide_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout' );

// Remove order notes label and change placeholder for additional comment on checkout page
add_filter( 'woocommerce_checkout_fields' , 'theme_override_checkout_notes_fields' );

// Our hooked in function - $fields is passed via the filter!
function theme_override_checkout_notes_fields( $fields ) {
     $fields['order']['order_comments']['placeholder'] = 'Enter Comment here';
     $fields['order']['order_comments']['label'] = '';
     return $fields;
}

// prefill billing form details on checkout
add_filter('woocommerce_checkout_get_value', function($input, $key ) {
    global $current_user;
    switch ($key) :
        case 'billing_first_name':
        case 'shipping_first_name':
            return $current_user->first_name;
        break;
        case 'billing_last_name':
        case 'shipping_last_name':
            return $current_user->last_name;
        break;
        case 'billing_email':
            return $current_user->user_email;
        break;
        case 'billing_phone':
            return $current_user->contact_no;
        break;
        case 'billing_postcode':
            return $current_user->zip_code;
        break;
        case 'billing_address_1':
            return $current_user->street_add;
        break;
        case 'billing_city':
            return $current_user->city;
        break;
        case 'billing_state':
            return $current_user->state;
        break;        
    endswitch;
}, 10, 2);

//
add_filter( 'default_checkout_country', 'change_default_checkout_country' );
add_filter( 'default_checkout_state', 'change_default_checkout_state' );

function change_default_checkout_country() {
  $country=get_sortname_by_country_name();
  return $country; // country code
}

function change_default_checkout_state() {
  return 'xx'; // state code
}

function get_sortname_by_country_name(){		
		global $current_user;
		$country=$current_user->country;
		global $wpdb;
		$country_codes=$wpdb->get_results("select sortname from wp_countries where name='$country'"); 
		foreach($country_codes as $country_code){
		 $country_c=$country_code->sortname;
		}
		return $country_c;
}
//
add_filter( 'woocommerce_billing_fields', 'woo_filter_state_billing', 10, 1 );
 
add_filter( 'woocommerce_shipping_fields', 'woo_filter_state_shipping', 10, 1 );
 
 
 
function woo_filter_state_billing( $address_fields ) {
 
                $address_fields['billing_state']['required'] = false;
 
                return $address_fields;
 
} 
 
 
function woo_filter_state_shipping( $address_fields ) {
 
                $address_fields['shipping_state']['required'] = false;
 
                return $address_fields;
 
}
// redirect after checkout
add_action( 'woocommerce_thankyou', 'redirectcustom');
 
function redirectcustom( $order_id ){
    $order = new WC_Order( $order_id );
	$site_url=site_url();
    $url =$site_url.'/quote-acknowledge/';
 
    if ( $order->status != 'failed' ) {
        wp_redirect($url);
        exit;
    }
}
// custom add to cart for product listing
function custom_addcart() {
	$qty=$_POST['qty'];
	$prod_id=$_POST['prod_id'];
	global $woocommerce;
	$woocommerce->cart->add_to_cart($prod_id,$qty);
	$result['success']=true;
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_custom_addcart', 'custom_addcart');
add_action('wp_ajax_nopriv_custom_addcart', 'custom_addcart');

// create job


function create_job() {
	$job_title=sanitize_text_field($_POST['job_title']);
	$job_location=implode(',', $_POST['job_location']);
	$jobdescription=$_POST['jobdescription'];
	$job_created_at=date('y-m-d');
	global $wpdb;
	$wpdb->insert('wp_jobs',array('job_title'=>$job_title,'job_location'=>$job_location,'job_description'=>$jobdescription,'job_created_at'=>$job_created_at,'job_status'=>1),array('%s','%s','%s','%s','%d'));
	$result['success']=true;
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_create_job', 'create_job');
add_action('wp_ajax_nopriv_create_job', 'create_job');

// apply job


function apply_job() {	
	
	$candidate_name=sanitize_text_field($_POST['candidate_name']);
	$candidate_email=sanitize_email($_POST['candidate_email']);
	$candidate_contact_no=sanitize_text_field($_POST['candidate_contact_no']);
	$candidate_created_at=date('y-m-d');
	$jobid=sanitize_text_field($_POST['jobid']);
	$timestamp = time();
	$candidate_attachment=$timestamp."_".basename($_FILES["candidate_attachment"]["name"]);
	$target_dir = dirname(__FILE__)."/assets/candidate_attachment/";
	$target_file = $target_dir . $candidate_attachment;
	
	//$result['success']=$candidate_name;
	 if (move_uploaded_file($_FILES["candidate_attachment"]["tmp_name"], $target_file)) 
	{
		global $wpdb;
		//$table="{$wpdb->prefix}jobcandidates";
		$wpdb->insert('wp_jobcandidates',array('job_id'=>$jobid,'candidate_name'=>$candidate_name,'candidate_email'=>$candidate_email,'candidate_contact_no'=>$candidate_contact_no,'candidate_created_at'=>$candidate_created_at,'candidate_attachment'=>$target_file),array('%d','%s','%s','%s','%s','%s'));
		$result['success']=true;
		//echo "The file ". basename( $_FILES['file']['name']). " is uploaded";

	}else {

		$result['error']=false;
	}
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_apply_job', 'apply_job');
add_action('wp_ajax_nopriv_apply_job', 'apply_job');

// redirect to customdashboard if user role is customadmin
function login_redirect_based_on_roles($user_login, $user) {

    if( in_array( 'customadmin',$user->roles ) ){
        exit( wp_redirect(site_url().'/custom-dashboard') );
    }   
}

add_action( 'wp_login', 'login_redirect_based_on_roles', 10, 2);

// chnage job status
function change_job_status() {
	$jobstatus=sanitize_text_field($_POST['jobstatus']);
	$jobid=sanitize_text_field($_POST['jobid']);
		global $wpdb;
		if($jobstatus==1){
			$s=0;
		}else if($jobstatus==0){
			$s=1;
		}
	
		 $chnage_status_result = $wpdb->update("{$wpdb->prefix}jobs", array('job_status' => $s), array('job_id' => $jobid), array('%d'),
		 array('%d'));
	$result['success']=true;
	$result['status']=$s;
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_change_job_status', 'change_job_status');
add_action('wp_ajax_nopriv_change_job_status', 'change_job_status');


// Edit Job
function edit_job() {
	global $wpdb;
	$job_title=sanitize_text_field($_POST['job_title']);
	$job_location=implode(',', $_POST['job_location']);
	$job_description=$_POST['jobdescription'];
	$job_updated_at=date('y-m-d');
	$jobid=sanitize_text_field($_POST['jobid']);
	$edit_job_result = $wpdb->update("{$wpdb->prefix}jobs", array('job_title' => $job_title,'job_location'=>$job_location,'job_description'=>$job_description,'job_updated_at'=>$job_updated_at), array('job_id' => $jobid), array('%s','%s','%s','%s'),
		 array('%d'));
	$result['success']=true;
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_edit_job', 'edit_job');
add_action('wp_ajax_nopriv_edit_job', 'edit_job');

// Delere user by id
function delete_custom_admin_byid() {
	$userid=$_POST['userid'];
	$a=wp_delete_user($userid);
	if($a==true){
		$result['success']=true;
	}else{
		$result['success']=false;
	}
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_delete_custom_admin_byid', 'delete_custom_admin_byid');
add_action('wp_ajax_nopriv_delete_custom_admin_byid', 'delete_custom_admin_byid');

/* FaceToFace Training Frontend function start */
function ftf_training_frontend() {
	global $wpdb; 

	//echo json_encode($_POST);
	//exit;

	$user_name = sanitize_text_field($_POST['user_name']);
	$course_topic_interest = sanitize_text_field($_POST['course_topic_interest']);
	$school_org = sanitize_text_field($_POST['school_org']);
	$training_duration = sanitize_text_field($_POST['training_duration']);
    $contact_no = sanitize_text_field($_POST['contact_no']);
    $level_of_literacy = sanitize_text_field($_POST['level_of_literacy']);
    $no_of_persons = sanitize_text_field($_POST['no_of_persons']);
    $suggested_date = sanitize_text_field($_POST['suggested_date']);
	$user_email=sanitize_email($_POST['user_email']);
	$additional_comment=sanitize_text_field($_POST['additional_comment']);
    
	$result=array();

	$result['res']=$wpdb->insert( 
	                          'wp_facetoface_training', 
								array( 
									'ftf_user_name'=>$user_name,
									'ftf_course_topic_interest' => $course_topic_interest, 
									'ftf_school_org' => $school_org, 
									'ftf_training_duration' => $training_duration, 
									'ftf_contact_no' => $contact_no, 
									'ftf_level_of_literacy'=>$level_of_literacy,																		
									'ftf_no_of_persons'=>$no_of_persons,
									'ftf_suggested_date'=>$suggested_date,
									'ftf_user_email'=>$user_email,
									'ftf_additional_comment'=>$additional_comment,
								), 
								array( 
									'%s',
									'%s', 
									'%s',
									'%s',
									'%s',
									'%s',	
									'%s',																	
									'%s',
									'%s',
									'%s',
								) 
                             );

	

 
	if($result['res']==true){
		$result['success'] = true;
		$result['sub']=$web_reg_subscribe;
	}else{
		$result['success'] = true;
	}

	$result['message'] = "Thank you for register with us.";
	//$result['user_role'] = $_POST['user_role'];
	$result['query']=$wpdb->last_query;
	//$result['error'] = "Your entered code is incorrect. Please try again.";
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_ftf_training_frontend', 'ftf_training_frontend');
add_action('wp_ajax_nopriv_ftf_training_frontend', 'ftf_training_frontend');

// Training request facetoface custom screen send email function 

function facetoface_user_message() {
 global $wpdb; 
 $ftf_user_name=$_POST['facetoface_user_name'];
 $ftf_user_eamil = $_POST['facetoface_user_email'];
 $ftf_user_msg=wpautop($_POST['facetofacemessage']);
 $timestamp = time();
 $ftf_attachment=$timestamp."_".basename($_FILES["facetoface_attachment"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/facetoface_attachment/";
 $target_file = $target_dir . $ftf_attachment;
 move_uploaded_file($_FILES["facetoface_attachment"]["tmp_name"], $target_file);
 /* Email to Admin */
	$to="$ftf_user_eamil";
	$subject="Facetoface Training Request Reply";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear '.$ftf_user_name.',</b> <br />'.$ftf_user_msg.' 
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from="rathodsangita1111@gmail.com";	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/facetoface_attachment/$ftf_attachment");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
	 $result['success'] = true;
	 $result['message'] = "Thank you for register with us."; 
	 $result['email']=$web_user_email;
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_facetoface_user_message', 'facetoface_user_message');
add_action('wp_ajax_nopriv_facetoface_user_message', 'facetoface_user_message');

//  store admin quote view data function

function store_admin_quote_view_data() {
 global $wpdb; 
 
 $quote_message=$_POST['quote_message'];
 $p_qty=$_POST['p_qty'];
 $p_price=$_POST['p_price'];
 $p_tot_price=$_POST['p_tot_price'];
 $p_sub_total=$_POST['p_sub_total'];
 $p_vat=$_POST['p_vat'];
 $p_total_with_vat=$_POST['p_total_with_vat'];
 $p_id=$_POST['p_id'];
 $qid=$_POST['qid'];
 
 $order = wc_get_order($qid);    
 $uid = $order->get_user_id();
 $u_info=get_userdata($uid);
 $u_email=$u_info->user_email;
 
 $e_pid=explode(",",$p_id);
 $e_qty=explode(",",$p_qty);
 $e_price=explode(",",$p_price);
 $e_tot_price=explode(",",$p_tot_price);
 
 for($i=0;$i<count($e_pid);$i++){
	$data[] =array(
			"prodid"=>$e_pid[$i],
			"qty"=>$e_qty[$i],
			"unit_price"=>$e_price[$i],
			"total_price"=>$e_tot_price[$i]
	);
	
 }
 /*$timestamp = time();
 $quotation_attachment=$timestamp."_".basename($_FILES["pdf"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/quotation_attachment/";
 $target_file = $target_dir . $quotation_attachment;
 move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file);*/
 
 global $wpdb;
 $wpdb->query( "UPDATE $wpdb->posts SET post_status = 'wc-sendquote' WHERE ID = $qid" );

 update_post_meta($qid,'_quote_message',$quote_message);
 update_post_meta($qid,'_quote_sub_total',$p_sub_total);
 update_post_meta($qid,'_quote_vat',$p_vat);
 update_post_meta($qid,'_quote_total_with_vat',$p_total_with_vat);
 update_post_meta($qid,'_quote_pid_uprice_totprice',$data);
 //Email to user 
	$to="$u_email";
	$subject="Quotation";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear ,</b> <br />Please find the attachment for the quatation.
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from="rathodsangita1111@gmail.com";	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/facetoface_attachment/1540366579_web.pdf");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
	 $result['success'] = true;
	 $result['message'] = "Thank you for register with us."; 	
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_store_admin_quote_view_data', 'store_admin_quote_view_data');
add_action('wp_ajax_nopriv_store_admin_quote_view_data', 'store_admin_quote_view_data');

// custom  woocommerce status
add_action( 'init', 'register_sendquote_status' );

function register_sendquote_status() {
    register_post_status( 'wc-sendquote', array(
        'label'                     => _x( 'Send Quote', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Send Quote<span class="count">(%s)</span>', 'Send Quote<span class="count">(%s)</span>', 'woocommerce' )
    ) );
}

add_filter( 'wc_order_statuses', 'approved_status' );

// Register in wc_order_statuses.
function approved_status( $order_statuses ) {
    $order_statuses['wc-sendquote'] = _x( 'Send Quote', 'Order status', 'woocommerce' );

    return $order_statuses;
}

// save contact data

add_action('wpcf7_before_send_mail', 'save_form' );
 
function save_form( $wpcf7 ) {
   global $wpdb;
 
   /*
    Note: since version 3.9 Contact Form 7 has removed $wpcf7->posted_data
    and now we use an API to get the posted data.
   */
 
   $submission = WPCF7_Submission::get_instance();
 
   if ( $submission ) {
 
       $submited = array();
       $submited['title'] = $wpcf7->title();
       $submited['posted_data'] = $submission->get_posted_data();
 
    }
 
     $data = array(
   		'name'  => $submited['posted_data']['Name'],
   		'email' => $submited['posted_data']['Email'],
   		'pnoneNumber' => $submited['posted_data']['PhoneNumber'],
   		'i_am_a' => $submited['posted_data']['menu-708'],
   		'message' => $submited['posted_data']['message'],
   		
   	     );
 
     $wpdb->insert( $wpdb->prefix . 'contact_data', 
		    array( 
               'form'  => $submited['title'], 
			   'data' => serialize( $data )			   
			)
		);
}

// Message reply to  user  (custom admin screen)

function message_reply() {
 global $wpdb; 
 $msg_user_name=$_POST['msg_user_name'];
 $msg_user_eamil = $_POST['msg_user_eamil'];
 $messagereply=wpautop($_POST['messagereply']);
 $timestamp = time();
 $msg_attachment=$timestamp."_".basename($_FILES["message_attachment"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/message_attachment/";
 $target_file = $target_dir . $msg_attachment;
 move_uploaded_file($_FILES["message_attachment"]["tmp_name"], $target_file);
 /* Email to Admin */
	$to="$msg_user_eamil";
	$subject="Message Reply";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear '.$msg_user_name.',</b> <br />'.$messagereply.' 
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from="rathodsangita1111@gmail.com";	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/facetoface_attachment/$msg_attachment");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
	 $result['success'] = true;	 
	 $result['email']=$msg_user_email;
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_message_reply', 'message_reply');
add_action('wp_ajax_nopriv_message_reply', 'message_reply');


// Log a fault  fronend function


function logfault_frontend() {
 global $wpdb; 
 $log_user_name = sanitize_text_field($_POST['log_user_name']);
 $log_user_email = sanitize_email($_POST['log_user_email']);
 $log_user_contactno = sanitize_text_field($_POST['log_user_contactno']);
 $log_product_name=sanitize_text_field($_POST['log_product_name']);
 $log_type_of_issue=$_POST['log_type_of_issue'];
 $log_invoice_no=sanitize_text_field($_POST['log_invoice_no']);
 $log_serial_no=sanitize_text_field($_POST['log_serial_no']);
 $log_desc_issue=$_POST['log_desc_issue'];
 $userid=sanitize_text_field($_POST['userid']);
 $result['desc']=$log_desc_issue;
// store to wp_log_a_fault table start
	$result['reslogafault']=$wpdb->insert( 
								  'wp_log_a_fault', 
									array( 
										'log_user_name'=>$log_user_name,	
										'log_user_email'=>$log_user_email,
										'log_user_contactno'=>$log_user_contactno,
										'log_product_name'=>$log_product_name,
										'log_type_of_issue'=>$log_type_of_issue,
										'log_invoice_no'=>$log_invoice_no,
										'log_serial_no'=>$log_serial_no,
										'log_status'=>1,
										'log_user_id'=>$userid,
									
									), 
									array( 
										'%s',
										'%s',
										'%s',										
										'%s',
										'%s',
										'%s',										
										'%s',
										'%d',
										'%d',
									) 										
								 );
								
// store to wp_log_a_fault table end


if($result['reslogafault']==true){

	$logfault_lastid = $wpdb->insert_id;
		/* wp_logfault_messages code start */
		
		$result['resmessage']=$wpdb->insert( 
									  'wp_logfault_messages', 
										array( 
											'log_id'=>$logfault_lastid,
											'logmsg_message'=>$log_desc_issue,
											'logmsg_by_userid'=>$userid,
											
										), 
										array( 
											'%d',
											'%s',
											'%d',										
										) 
									 );
		$msg_lastid = $wpdb->insert_id;
		/* wp_logfault_messages code end */
		
		
		/* for wp_logfault_attachment code start */
		
		if (isset($_FILES["attachment"]) && is_array($_FILES["attachment"]) && count($_FILES["attachment"]) > 0) {
		$target_dir = dirname(__FILE__)."/assets/logfault_attachment/";
		$attachments = array();
		for ($k = 0; $k < count($_FILES["attachment"]["name"]); $k++) {
			if (isset($_FILES["attachment"]["name"][$k]) && is_uploaded_file($_FILES["attachment"]["tmp_name"][$k])) {
				//$timestamp = time();
				$file_info = pathinfo($_FILES["attachment"]["name"][$k]);            
				$logfault_attachment = uniqid() . time() .basename($_FILES["attachment"]["name"][$k]); //"." . $file_info["extension"];
				//$logfault_att[]=$timestamp."_".basename($_FILES["attachment"]["name"][$k]);
				//$logfault_attachment=$timestamp."_".basename($_FILES["attachment"]["name"][$k]);
				$target_file = $target_dir.$logfault_attachment;
				$result['uploadimg'][]=$logfault_attachment;
				
				if(move_uploaded_file($_FILES["attachment"]["tmp_name"][$k], $target_file)){
					

					array_push($attachments, dirname(__FILE__)."/assets/logfault_attachment/$logfault_attachment" ); 
					
					$result['res']=$wpdb->insert( 
									  'wp_logfault_attachment', 
										array( 
											'log_id'=>$logfault_lastid,
											'log_attachment'=>$logfault_attachment,
											'logmsg_id'=>$msg_lastid,
											'user_id'=>$userid,
										), 
										array( 
											'%d',
											'%s',					
											'%d',					
											'%d',
										) 
									 );
					}else{
							$result['res']=false;
							$result['resmsg']="Failed to upload attachments";
					}
				
			}
		}
	 }
	 /* for wp_logfault_attachment code end */
}

	

 /* Email to Admin */
	$to='rathodsangita1111@gmail.com';
	$subject="Log a fault Request";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear </b> <br />
						  Type of issue : '.$log_type_of_issue.' <br />
						  product name :'.$log_product_name.'<br />
						  Invoice no :'.$log_invoice_no.'<br />
						  Description of issue : '.$log_desc_issue.'<br />
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from=$log_user_email;	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    //$attachments = array( dirname(__FILE__) . "/assets/facetoface_attachment/$ftf_attachment");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
	 $result['success'] = true;
	 $result['log_id']=$logfault_lastid;
	 
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_logfault_frontend', 'logfault_frontend');
add_action('wp_ajax_nopriv_logfault_frontend', 'logfault_frontend');


//
function getwooproducts_nm_action(){
	$args     = array( 'post_type' => 'product','posts_per_page' => -1 );
	$products = get_posts( $args ); 
	
	foreach($products as $product){
		$imageurl = wp_get_attachment_url(get_post_thumbnail_id($product->ID));
		$p_img='<img src="'.$imageurl.'">';
		$p_arr[]=$product->post_title;
	}
	
	echo json_encode($p_arr);
	exit;
}
add_action( 'wp_ajax_getwooproducts_nm_action', 'getwooproducts_nm_action' );
add_action( 'wp_ajax_nopriv_getwooproducts_nm_action', 'getwooproducts_nm_action' );

// Logfault reply to  user  (custom admin screen)

function admin_logfault_reply() {
 global $wpdb; 
 $msg_user_name=$_POST['msg_user_name'];
 $msg_user_email = $_POST['msg_user_email'];
 $adminlogfaultreply=wpautop($_POST['adminlogfaultreply']);
 $logid=sanitize_text_field($_POST['logid']);
 $aid=sanitize_text_field($_POST['aid']);
 
 $timestamp = time();
 $logfault_attachment=$timestamp."_".basename($_FILES["admin_logfault_attachment"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/logfault_attachment/";
 $target_file = $target_dir . $logfault_attachment;
 
	
		 
	 
 /* Email to Admin */
	$to="$msg_user_email";
	$subject="Logfault Reply";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear '.$msg_user_name.',</b> <br />'.$adminlogfaultreply.' 
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from="rathodsangita1111@gmail.com";	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/logfault_attachment/$logfault_attachment");
	if(wp_mail($to, $subject, $message,$headers,$attachments)){	
				$result['resmessage']=$wpdb->insert( 
									  'wp_logfault_messages', 
										array( 
											'log_id'=>$logid,
											'logmsg_message'=>$adminlogfaultreply,
											'logmsg_by_userid'=>$aid,
											
										), 
										array( 
											'%d',
											'%s',
											'%d',										
										) 
									 );
									 
					$msg_lastid = $wpdb->insert_id;	
								 
					if(move_uploaded_file($_FILES["admin_logfault_attachment"]["tmp_name"], $target_file)){
					$result['res']=$wpdb->insert( 
										  'wp_logfault_attachment', 
											array( 
												'log_id'=>$logid,
												'log_attachment'=>$logfault_attachment,
												'user_id'=>$aid,
												'logmsg_id'=>$msg_lastid,
											), 
											array( 
												'%d',
												'%s',
												'%d',	
												'%d',									
											) 
										 );
						}else{
								$result['res']=false;
								$result['resmsg']="Failed to upload attachments";
						}
		
	 $result['success'] = true;	 
	 $result['email']=$msg_user_email;
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_admin_logfault_reply', 'admin_logfault_reply');
add_action('wp_ajax_nopriv_admin_logfault_reply', 'admin_logfault_reply');


// logfault_resolved function (custom admin screen for change status of logfault)

function logfault_resolved() {
	global $wpdb;
	$logid=sanitize_text_field($_POST['logid']);		
	$s=0;
	$logfault_status_result = $wpdb->update("{$wpdb->prefix}log_a_fault", array('log_status' => $s), array('log_id' => $logid), array('%d'),
		 array('%d'));
	$result['success']=true;
	
	
	echo json_encode($result);
	exit;
}

add_action('wp_ajax_logfault_resolved', 'logfault_resolved');
add_action('wp_ajax_nopriv_logfault_resolved', 'logfault_resolved');

// get user role by user id

function get_user_role($userid) {
    
    $user = new WP_User($userid);
    $role = array_shift($user -> roles);
    return $role;
}


// Logfault reply by  user  to admin (frontend screen)

function logmsgby_user() {
 global $wpdb; 
 
 $message=sanitize_text_field($_POST['message']);
 $logid=sanitize_text_field($_POST['logid']);
 $uid=sanitize_text_field($_POST['userid']);
 $u_data=get_userdata($uid);
 $u_email=$u_data->user_email;
 $timestamp = time();
 $logfault_user_attachment=$timestamp."_".basename($_FILES["logmsg_user_attachment"]["name"]);
 $target_dir = dirname(__FILE__)."/assets/logfault_attachment/";
 $target_file = $target_dir . $logfault_user_attachment;
 	 
	 
 /* Email to Admin */
	$to="rathodsangita1111@gmail.com";
	$subject="Logfault Message";
	//$message="Hello,<br>";
	//$message.="<p>".$web_user_msg."</p><br/><br><br><br>";	
	//$message.="Thanks & Regars,<br>EditMicroSyatem";
	
	$message1='<table width="600px" cellspacing="0" align="center" cellpadding="0" border="0" style="border:1px solid #075199; background:#fff;" >
					<tr>
						<td style="background-color:#fff; text-align:center;">
							<a href="http://editmicrosystem.php-dev.in/" title=""><img src="http://editmicrosystem.php-dev.in/wp-content/uploads/2018/09/logo.png" title="" alt="" border="0" hspace="20" vspace="20"  align="center" /></a>
						</td>
					</tr>
					<tr>
						<td style="padding:25px 15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
					 <table width="100%" border="0" cellspacing="2" cellpadding="3" style="padding-left:10px; padding-right:10px;font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; font-weight: standard;"> 
						<tr>
						  <td height="39" colspan="3">
						  <b>Dear Admin,</b> <br />'.$message.' 
						  </td>
						</tr>
					  </table>
						</td>
					</tr>
					<tr>
						<td style="background-color:#FFF; border:1px solid #075199;  border-bottom:0px;border-left:0px; border-right:0px;">
							<table width="600">
							<tr>
								<td style="text-align: center; margin: 5px 30px; padding: 7px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; line-height: 3px; ">		
									Copyright © 2018 EditMicrosystem <br /><br />
									
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>';	
	$from=$u_email;	
	$headers[] = "MIME-Version: 1.0" . "\r\n";
    $headers[] = "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers[] = 'From: EditMicrosystem <' . $from . '>' . "\r\n";
    $attachments = array( dirname(__FILE__) . "/assets/logfault_attachment/$logfault_user_attachment");
	if(wp_mail($to, $subject, $message1,$headers,$attachments)){	
			$result['resmessage']=$wpdb->insert( 
									   "{$wpdb->prefix}logfault_messages", 
										array( 
											'log_id'=>$logid,
											'logmsg_message'=>$message,
											'logmsg_by_userid'=>$uid,
											
										), 
										array( 
											'%d',
											'%s',
											'%d',										
										) 
									 );
									 
			$msg_lastid = $wpdb->insert_id;						 
			if(move_uploaded_file($_FILES["logmsg_user_attachment"]["tmp_name"], $target_file)){
					$result['res']=$wpdb->insert( 
										  "{$wpdb->prefix}logfault_attachment", 
											array( 
												'log_id'=>$logid,
												'log_attachment'=>$logfault_user_attachment,
												'user_id'=>$uid,
												'logmsg_id'=>$msg_lastid,
											), 
											array( 
												'%d',
												'%s',
												'%d',					
												'%d',					
											) 
										 );
						}else{
								$result['res']=false;
								$result['resmsg']="Failed to upload attachments";
						}
		
	 $result['success'] = true;	 
	
	}else{
		$result['success']=false;
		$result['message'] = "Mail can't sent."; 
	}
	 echo json_encode($result);
	 exit;
}

add_action('wp_ajax_logmsgby_user', 'logmsgby_user');
add_action('wp_ajax_nopriv_logmsgby_user', 'logmsgby_user');


//

add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2 );
function wpse18703_posts_where( $where, &$wp_query )
{
    global $wpdb;
    if ( $wpse18703_title = $wp_query->get( 'wpse18703_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $wpse18703_title ) ) . '%\''.' AND post->staus=publish AND post_type=product';
    }
    return $where;
}
//

add_action( 'after_setup_theme', 'yourtheme_setup' );
 
function yourtheme_setup() {
	add_theme_support('woocommerce');
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
    
}

function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

//

//add_image_size("HOME_PAGE_IMAGE",769,398,false);


function wpse_setup_theme() {
   add_theme_support( 'post-thumbnails' );  
   add_image_size( 'HOME_PAGE_IMAGE',769,398, false);
}

add_action( 'after_setup_theme', 'wpse_setup_theme' );


/*if ( function_exists( 'fly_add_image_size' ) ) {
    fly_add_image_size( 'HOME_PAGE_IMAGE', 769, 398, true );
    fly_add_image_size( 'MEET_THE_TEAM_IMAGE', 330,169, false );
   
}*/

add_filter( 'wp_get_attachment_image_src','pn_change_product_image_link', 50, 4 );
function pn_change_product_image_link( $image, $attachment_id, $size, $icon ){
 if( ! is_product() ) return $image; // Only on single product pages
    //if( $size == 'shop_thumbnail' ) return $image; // Not for gallery thumbnails (optional)
	//$imageurl = wp_get_attachment_url(get_post_thumbnail_id($attachment_id));
	$imageurl = wp_get_attachment_url($attachment_id);
	if ($imageurl) {
		$res_imageurl = site_url() . "/wp-content/themes/editmicro/resize_prod_detail_image.php?image=".$imageurl;
	}
    // Your source image link
    $src ="$res_imageurl";// 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/WP_Suspension_logo.svg/2000px-WP_Suspension_logo.svg.png';
    $width  = ''; // <== (optional) define the width
    $height = ''; // <== (optional) define the height
    $image  = array( $src, $width, $height );

    return $image;   
}



?>
