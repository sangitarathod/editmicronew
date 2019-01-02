<?php
/* Template Name: Job Listing Template */
?>
<?php


if( current_user_can( 'employment' ) ){
	get_header('customadmin');
?>
                <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Employment</h1>
                        <ul class="breadcrumb">
                         <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li>Employment</li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
                        <a class="post_new_btn" href="<?php echo site_url();?>/create-job">
                            <i class="fa fa-plus" aria-hidden="true"></i>Post a new Job
                        </a>
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Title</th>
                                        <th>Posted On</th>
                                        <th>Application Recived</th>
                                        <th>Status</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                   
                                   <?php
									global $wpdb;
									$results=$wpdb->get_results("select * from {$wpdb->prefix}jobs"); 
									foreach($results as $result){
									?>
									<tr class="read_text">
										<td><?php echo $result->job_id;?></td>
										<td><?php echo $result->job_title;?></td>
										<td><?php echo date('d M Y',strtotime($result->job_created_at));?></td>
										<td><?php $total_app=application_received($result->job_id); echo $total_app;?></td>
										<td class=<?php if($result->job_status==0){ echo "open_status";}else{echo "send_status";}?>><?php if($result->job_status==0){echo "Inactive";}else{echo "Active";}?></td>
										<td><a href="<?php echo site_url();?>/job-detail?jobid=<?php echo $result->job_id;?>">View</a></td>
									</tr>
								   <?php }?>
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
function application_received($id){
	global $wpdb;
	$application_results=$wpdb->get_results("select * from {$wpdb->prefix}jobcandidates where job_id=$id"); 
	return count($application_results);
}
?>
