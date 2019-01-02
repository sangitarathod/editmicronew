<?php
/* Template Name: Job Details Template */

?>

<?php


if( current_user_can( 'employment' ) ){
	get_header('customadmin');
if(isset($_GET['jobid'])){
	$jobid=$_GET['jobid'];
}
?>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>quotes request</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/job-listing">Employment</a></li>
                          <li>Job id: <?php echo "#".$jobid;?></li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
						 <div class="job_details_main">
                            <div class="job_details_top">
								<?php
									global $wpdb;
									$job_results=$wpdb->get_results("select * from {$wpdb->prefix}jobs where job_id=$jobid"); 
									foreach($job_results as $job_result){
								?>
                                <div class="col-sm-6">
                                    <h3><?php echo $job_result->job_title;?></h3>
                                    <p><?php echo $job_result->job_location;?></p>
                                </div>
                                <div class="col-sm-6 job_details_btn">
                                    <a class="job_edit_btn" href="<?php echo site_url();?>/edit-job?jobid=<?php echo $job_result->job_id;?>">Edit Info</a>
                                    <form name="frm_change_status" id="frm_change_status" method="POST" action="">
									<input type="hidden" name="jobid" id="jobid" value="<?php echo $jobid; ?>">
									<input type="hidden" name="jobstatus" id="jobstatus" value="<?php echo $job_result->job_status; ?>">
									<input  type="submit" class="deactivate_btn"  value="<?php if($job_result->job_status==1){echo "Deactivate";}else if($job_result->job_status==0){echo "Activate";}?>" name="chang_job_status" id="chang_job_status">
									</form>
                                   
                                    
                                </div>
                                <?php $description=explode('<!--more-->',$job_result->job_description);
                               /* echo "<pre>";
                                print_r($description);
                                echo "</pre>";*/
                                ?>
                                <p><?php echo $description[0];?></p>
                                <a name="morelink" id="morelink" href="">Read More <img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/down_arrow2.png" alt=""></a>
                                <div id="more" style="display:none;">
									<?php echo $description[1];?>
                                </div>
                                <?php }?>
                            </div>
                            <h2>Candidates</h2>
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SR.NO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Resume</th>
                                        <th>Date Received</th>
                                    </tr>
                                </thead>
                                <tbody>
										<?php
										global $wpdb;
										$results=$wpdb->get_results("select * from {$wpdb->prefix}jobcandidates where job_id=$jobid"); 
										if(count($results)>0){
										foreach($results as $result){
										$attachments=$result->candidate_attachment;
										$attachment=explode('/',$attachments);
										//print_r($attachment);				
										?>
                                    <tr>
                                        <td><?php echo $result->candidate_id;?></td>
                                        <td><?php echo $result->candidate_name; ?> </td>
                                        <td><?php echo $result->candidate_email; ?> </td>
                                        <td><?php echo $result->candidate_contact_no; ?> </td>
                                        <td><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/download_icon.png" alt=""><a href="<?php echo get_stylesheet_directory_uri();?>/assets/candidate_attachment/<?php echo $attachment['11'];?>" download>Download</a></td>
                                        <td><?php echo date('d M Y',strtotime($result->candidate_created_at));?></td>
                                    </tr>
                                     <?php
										} 
									}else{ echo "<td colspan='6'>No Data Found.</td>";}
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
               <?php get_footer('customadmin');?>
            </div>
        </div>
           <script type="text/javascript" language="javascript">
			  jQuery(document).ready(function(){
				  
					jQuery("#chang_job_status").click(function(){
						
												
						var jobstatus=jQuery('#jobstatus').val();
						
							jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_change_status").serialize()+"&action=change_job_status",
										success: function(result) {
											console.log(result);						 						
											if(result["success"] == true){
												location.reload();
												
											} else {							
												alert("error");
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
									return false;
								});
								
								jQuery('#morelink').click(function(){
									jQuery('#more').toggle();
									return false;							
								
								});
						});
			</script>
</body>
</html>    

<?php
}
?>

