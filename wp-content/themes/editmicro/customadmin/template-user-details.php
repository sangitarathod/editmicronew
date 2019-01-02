<?php
/* Template Name: User Details Template */

?>

<?php


if( current_user_can( 'users' ) ){
	get_header('customadmin');
if(isset($_GET['userid'])){
	$userid=$_GET['userid'];
	$user_info = get_userdata($userid);
}
?>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>User Details</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/manage-users">Manage Users</a></li>
                          <li>User Details</li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
						 <div class="user_deatils_main">
                            <h3>Personal Information</h3>
                            <div class="row">
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Name</h5>
                                    <p><?php echo ucfirst(get_user_meta($userid,'first_name',true))." ".ucfirst(get_user_meta($userid,'last_name',true));?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Email</h5>
                                    <p><?php echo $user_info->user_email;?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Contact Number</h5>
                                    <p><?php echo get_user_meta($userid,'contact_no',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>I am a</h5>
                                    <p><?php echo get_user_meta($userid,'i_am_a',true);?></p>
                                </div>
                                
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Organisation Name</h5>
                                    <p><?php echo get_user_meta($userid,'org_name',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Condition or Needs</h5>
                                    <p><?php echo get_user_meta($userid,'conditions_needs',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Age group of product user</h5>
                                    <p><?php echo get_user_meta($userid,'age_grp',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Condition or Needs</h5>
                                    <p><?php echo get_user_meta($userid,'conditions_needs',true);?></p>
                                </div>
                            </div>
                        </div>
                        <div class="user_deatils_main">
                            <h3>Address Information</h3>
                            <div class="row">
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Street Address</h5>
                                    <p><?php echo get_user_meta($userid,'streed_add',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>City</h5>
                                    <p><?php echo get_user_meta($userid,'city',true);?></p>
                                </div>
                                <div class="col-sm-6 col-xs-6 user_deatils_info">
                                    <h5>Zip/Postal Code</h5>
                                    <p><?php echo get_user_meta($userid,'zip_code',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>State/Province</h5>
                                    <p><?php echo get_user_meta($userid,'state',true);?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6 user_deatils_info">
                                    <h5>Country</h5>
                                    <p><?php echo get_user_meta($userid,'country',true);?></p>
                                </div>
                            </div>
                        </div>
                        <a class="block_btn" href="">Block User</a>
                    </div>
                </div>
               <?php get_footer('customadmin');?>
            </div>
        </div>
          
</body>
</html>    

<?php
}
?>

