<?php
/* Template Name: Career Template */
get_header('second');
?>
        <div class="body_content">
            <div class="container">
                <?php while ( have_posts() ) : the_post();?>
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <h1><?php the_title();?></h1>   
                    <div class="career_text1">
                        <span>
							<?php $imageurl = wp_get_attachment_url(get_post_thumbnail_id($trans_proID));?>
                            <img src="<?php echo $imageurl; ?>" alt=""><?php //the_post_thumbnail();?>
                        </span>
                        <div class="career_righttext">
                            <?php the_content();?>
                        </div>
                    </div>
                    <h1>Open Positions</h1> 
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="career-wrapper">                    
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<?php
									global $wpdb;
									$results=$wpdb->get_results("select * from {$wpdb->prefix}jobs"); 
									if(count($results)>0){
									foreach($results as $result){
									?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading<?php echo $result->job_id;?>">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $result->job_id;?>" aria-expanded="true" aria-controls="collapse<?php echo $result->job_id;?>">
                                                    <span class="faq-ques"><?php echo $result->job_title;?> – <?php echo $result->job_location;?><span>
                                                    <span class="icon"><i class="more-less glyphicon glyphicon-plus"></i></span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo $result->job_id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $result->job_id;?>">
                                            <div class="panel-body">
                                                <p><?php $description=explode('<!--more-->',$result->job_description); echo $description[0]; ?></p>
                                                <a href="<?php echo site_url();?>/apply-job?jobid=<?php echo $result->job_id;?>">More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}else{echo "No Data Found.";}?>
                                </div><!-- panel-group -->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="apply_today_section">
                                <h4>Apply Today</h4>
                                <p>We are always on the lookout for individuals who could contribute meaningfully to our company.  Regardless of whether we are currently adverting a vacancy that appeals to you, if you would like to join our team, please contact us.</p>
                                <p><span>Email your CV and covering letter to</span></p>
                                <a href="mailto:info@editmicro.co.za">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>info@editmicro.co.za
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
   <?php get_footer();?>
     
		
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




