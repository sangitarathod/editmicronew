<?php
/* Template Name: Admin Logfault1 Template */

?>

<?php


if( current_user_can( 'fault_logs' ) ){
	get_header('customadmin');
?>
				<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Fault Logs</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li>Fault Logs</li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Log.No</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Issue</th>
                                        <th>Date Received</th>
                                        <th>Status</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
									global $wpdb;
									$sql = "SELECT * FROM `{$wpdb->prefix}log_a_fault`  ORDER BY log_id DESC";
									$results = $wpdb->get_results($sql);
									if(count($results)>0){
										foreach($results as $result){
									?>
											<tr class="<?php if($result->log_status==0){echo 'read_text';}?>">
												<td><?php echo $result->log_id; ?></td>
												<td><?php echo $result->log_user_name;?></td>
												<td><?php echo $result->log_product_name;  ?></td>
												<td><?php echo $result->log_type_of_issue; ?></td>
												<td><?php echo date('d M Y', strtotime($result->log_created_at));?></td>
												<td class="<?php if($result->log_status==1){echo 'open_status';} else { echo 'send_status'; }?>"><?php if($result->log_status==1){echo 'Open';} else { echo 'Closed'; }?></td>
												<td><a href="<?php echo site_url();?>/admin-logfault2?id=<?php echo $result->log_id; ?>">View</a></td>
											</tr>
                                   <?php }
									}else{
                                   ?>
									<tr><td colspan="7">No Tickets Found.</td></tr>
                                   <?php
										}
									?>
                                </tbody>
                            </table>
                        </div>
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

