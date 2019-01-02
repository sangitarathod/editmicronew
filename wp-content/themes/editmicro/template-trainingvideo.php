<?php
/* Template Name: TrainingVideos Template */
get_header('second');
?>
 <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <?php while ( have_posts() ) : the_post();?>
                    <?php the_content();?>
                    <?php endwhile; ?>
                    <div class="row">
                        <div class="training_video_main">
                            <div class="col-sm-3">
                                <div class="search_video_key">
                                    <label>Search video by keyword</label>
                                    <div class="serach_video">
										<?php
											$val="";									
																					
											if(isset($_REQUEST['btn_search_video'])){												
												$val=$_REQUEST['search_video'];
											}
											if(isset($_REQUEST['s'])){
												$val=$_REQUEST['s'];
											}
										
										
										?>
										<form name="frm_search_training_video" id="frm_search_training_video" method="POST" action="<?php echo site_url();?>/training-videos">
											<input class="form-control" type="text" name="search_video" id="search_video" value="<?php echo $val;?>">
											<input type="hidden" name="s_args" id="s_args" value="<?php echo $val;?>">
											<button type="submit" class="btn btn-default btn-block submitBtn" name="btn_search_video" id="btn_search_video"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="register_course_info">
                                    <p>If you need more help than the videos below can offer, you can 
                                        <a href="">register for an Edit Micro course online.</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="training_video_list">
										<?php 
										$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
										
										global $search_video;	
										if(isset($_POST['search_video']) || isset($_GET['s'])){
											$search_video= isset($_POST['search_video']) ? $_POST['search_video'] : $_GET['s'];
											//echo $search_video;
											$args = array( 's'=>$search_video,'post_type' => 'videos', 'post_status'=>'publish','posts_per_page' => 2,
											'paged' => $paged, );
										}else{
										$args = array('post_type' => 'videos', 'post_status'=>'publish','posts_per_page' => 2,
											'paged' => $paged, );
										}
										$loop = new WP_Query( $args );
										while ( $loop->have_posts() ) : $loop->the_post();	
											$thumb_id = get_post_thumbnail_id();
											$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
											$thumb_url = $thumb_url_array[0];
											$id=get_the_ID();
											$youtube_link=get_post_meta(get_the_ID(),'Youtube_link',true);	
											$y_link=explode("=",$youtube_link);
											$vimeo_link=get_post_meta(get_the_ID(),'vimeo_link',true);
											
											$video_link=get_post_meta(get_the_ID(),'video_link',true);
											
											if($video_link=='youtube'){
												$f_link="https://www.youtube.com/embed/".$y_link[1];//$y_link;
											}else{
												$f_link=$vimeo_link;
											}
											
											//echo $id."-".$youtube_link."<br>";
										?>
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="video_images">
                                                <a href="#<?php echo get_the_ID(); ?>">
                                                    <img src="<?php echo $thumb_url;?>" alt="">
                                                    <p><?php the_title(); ?></p>
                                                </a>
                                                <!-- lightbox container hidden with CSS -->
                                                <a href="#_" class="lightbox" id="<?php echo get_the_ID(); ?>">
                                                    <div id="videoModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="false" style="display: block;">
                                                      <div class="popup_video_main">
                                                        <div class="modal-header">
                                                            <button type="button" class="close full-height" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                          <div class="modal-body">
															  
                                                              <iframe width="500px" height="500px" src="<?php echo $f_link;?>" frameborder="0" allowfullscreen=""></iframe>
                                                              
                                                          </div>
                                                      </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div> 
                                        <?php endwhile; ?>                                       
                                    </div>
                                </div>
									<div class="pagination_main">
									 <?php
										$total_pages = $loop->max_num_pages;
										$previmg=get_stylesheet_directory_uri()."/assets/images/pagination_left_arrow.png";
										$nextimg=get_stylesheet_directory_uri()."/assets/images/pagination_right_arrow.png";
											if ($total_pages > 1){
												$current_page = max(1, get_query_var('paged'));
												echo paginate_links(array(
													'base' =>preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
													'format' => '/page/%#%',
													'current' => $current_page,
													'total' => $total_pages,
													'prev_text'    => __('<img src="'.$previmg.'">'),
													'next_text'    => __('<img src="'.$nextimg.'"'),
													 'add_args' => array(
														 's' =>$search_video,													
													 )
												));
											}    
										
										wp_reset_postdata();
									?>
								</div>
                            </div>
                        </div>
                    </div>
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
             <p>Some text in the modal.</p>
              <p>Some text in the modal.</p>
               <p>Some text in the modal.</p>
                <p>Some text in the modal.</p>
                 <p>Some text in the modal.</p>
                  <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
<!--popup 1 -->
