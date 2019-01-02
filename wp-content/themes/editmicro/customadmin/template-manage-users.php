<?php
/* Template Name: Manage Users Template */

?>

<?php

if( current_user_can( 'users' ) ){

get_header('customadmin');

$args1 = array(
 'role' => 'subscriber',
 'orderby' => 'ID',
 'order' => 'DESC'
);
 $subscribers = get_users($args1);


?>
<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Manage Users</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li>Manage Users</li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>CUSTOMER ID</th>
                                        <th>NAME</th>
                                        <th>Email</th>
                                        <th>DATE JOINED</th>                                        
                                        <th>Status</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								foreach ($subscribers as $user) {
								?>	
								<tr class="read_text">
									<td><?php  echo $user->ID;?></td>
									<td><?php  echo $user->ID;?></td>
									<td><?php echo $user->user_email;?></td>
									<td><?php echo date('d M Y',strtotime($user->user_registered));?></td>
									<td><?php if($user->user_status==0){ echo "Inactive";}else if($user->user_status==1){echo "Active";}?></td>
									<td><a href="<?php echo site_url();?>/user-details?userid=<?php echo $user->ID;?>">View</a></td>
								</tr>	
								<?php }?>
                                </tbody>
                            </table>
                        </div>
                        <a class="export_btn" href="">Export Data</a>
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

