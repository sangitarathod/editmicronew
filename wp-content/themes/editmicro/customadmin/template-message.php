<?php
/* Template Name: Messages Template */

?>

<?php

if( current_user_can( 'messages' ) ){
get_header('customadmin');
	

?>
 <div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>Messages</h1>
                        <ul class="breadcrumb">
                          <li><a href="<?php echo site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li>Messages</li>
                        </ul>
                    </div>
                    <div class="dashboard_body_contain">
                        <div class="table-responsive dashborad_table">
                            <table id="example" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th class="hide_text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									global $wpdb;
									$results=$wpdb->get_results("select * from {$wpdb->prefix}contact_data"); 
									if(count($results)>0){
									foreach($results as $result){										
										$current = strtotime(date("Y-m-d"));
									    $date    = date('Y-m-d',strtotime($result->date));
										$date1=strtotime($date);
										$datediff = $date1 - $current;
										$difference = floor($datediff/(60*60*24));
										
										$data=unserialize($result->data);
									
									?>
                                    <tr>
                                        <td><?php echo $result->id;?></td>
                                        <td><?php echo $data['name'];?></td>
                                        <td><?php echo $data['message'];?></td>
                                        <td><?php if($difference==0){ echo date('h:i a',strtotime($result->date));} else { echo date('l', strtotime($result->date)).", ".date('d M Y',strtotime($result->date)); } ?></td>
                                        <td><a href="<?php echo site_url();?>/message-reply?mid=<?php echo $result->id;?>">Reply</a></td>
                                    </tr>
                                  <?php } }else{?>
                                    <tr>
										<td>No Data Found.</td>
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
<?php }?>
