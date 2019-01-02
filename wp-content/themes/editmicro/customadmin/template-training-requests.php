<?php
/* Template Name: Training Requests Template */

?>

<?php

if( current_user_can( 'training_requests' ) ){
	get_header('customadmin');
?>

                <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Training Requests</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><?php the_title();?></li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
                        <h2>Webinar Requests</h2>
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Webinar Name</th>
                                        <th>Date Received</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									global $wpdb;
									$res_webinars_user_list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}webinar_users ORDER BY webinar_user_id DESC");
									if(count($res_webinars_user_list)>0){ 	
										foreach($res_webinars_user_list as $res_webinars_user_list_item){ 
									?>
                                    <tr class="">
                                        <td><?php echo $res_webinars_user_list_item->webinar_user_id;?></td>
                                        <td><?php echo $res_webinars_user_list_item->webinar_user_name; ?></td>
                                        <td><?php echo get_the_title( $res_webinars_user_list_item->webinar_id); ?></td>
                                        <td><?php echo date('d M Y',strtotime($res_webinars_user_list_item->webinar_created_at));?></td>
                                        <td><a name="count_link" href="<?php echo site_url();?>/training-requests-webinar?webusrid=<?php echo $res_webinars_user_list_item->webinar_user_id;?>">View</a></td>
                                    </tr>
                                    <?php	
										}
									}
                                    ?>                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="dashboard_body_contain">
                        <h2>Face to Face Training Requests</h2>
                        <div class="table-responsive dashborad_table">
                            <table id="example2" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Course Topic or Area of Interest</th>
                                        <th>Date Received</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									global $wpdb;
									$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}facetoface_training ORDER BY ftf_id DESC");
									if(count($results)>0){ 	
										foreach($results as $result){ 
									?>
                                    <tr>
                                        <td><?php echo $result->ftf_id;?></td>
                                        <td><?php echo $result->ftf_user_name;?></td>
                                        <td><?php echo $result->ftf_course_topic_interest;?></td>
                                        <td><?php echo date('d M Y',strtotime($result->ftf_created_at));?></td>
                                        <td><a href="<?php echo site_url();?>/training-requests-facetoface?ftfusrid=<?php echo $result->ftf_id;?>">View</a></td>
                                    </tr>
                                    <?php	
										}
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
