<?php 
/*
 * Template Name: Signout Template
 */
 
 ?>
<?php
if (is_user_logged_in()) {
	$user = wp_get_current_user();
    $role = ( array ) $user->roles;
    if($role[0]=='customadmin'){
		wp_logout();
		$location = site_url()."/wp-login.php?loggedout=true";
		wp_redirect( $location);
		exit;                     
	}else{
		wp_logout();
		$location = site_url();
		wp_redirect( $location);
		exit; 
	}                    
}
?>
	


