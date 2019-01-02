<?php
/* Template Name: Meet-Team Template */
get_header('second');
?>
          <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <h1>Meet our Team</h1>   
                    <div class="row">
                        <div class="team_member_list">
                            <?php  $args = array( 'post_type' => 'Teams', 'posts_per_page' => -1, 'order' => 'Asc', 'orderby' => 'id');
                                 $loop = new WP_Query($args);
                                    while ( $loop->have_posts() ) : $loop->the_post();
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
									$thumb_url = $thumb_url_array[0];
									$imageurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
									//$image = fly_get_attachment_image_src( $thumb_id, 'MEET_THE_TEAM_IMAGE', array(330,169), false );
                                ?>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <?php //the_post_thumbnail();?>
                                     
                                     <?php
                                     //echo $imageurl;
                                     if ($imageurl) {
										 $res_imageurl = site_url() . "/wp-content/themes/editmicro/resize_team_image.php?image=".$imageurl;
									}
									?>
									<img src="<?php echo $res_imageurl;?>" alt="">
                                    <div class="member_details">
                                        <h4><?php the_title();?></h4>
                                        <?php
                                         if ( !empty( get_the_content() ) ){ 
												the_content();
											}else{
												echo '<p>&nbsp;</p>';
											}
										?> 
                                        <span class="qualification_details">
                                        <?php if( get_field('team_member_qualification') ): ?>
											<?php the_field('team_member_qualification'); ?>
                                        <?php endif;?>                                                                             
                                        </span>
                                        
                                        <ul>
											<?php if( get_field('team_member_contact') ):?>
                                            <li>                                                
                                                <a href="tel:<?php the_field('team_member_contact'); ?>" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: <?php the_field('team_member_contact'); ?></span>
                                                </a>                                                 
                                            </li>
                                            <?php endif; ?>
                                            
                                            <?php if( get_field('team_member_whatsapp') ): ?>
                                             <li>                                                
                                                <a href="https://api.whatsapp.com/send?phone=<?php the_field('team_member_whatsapp'); ?>" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/whatsapp.png" alt="">
                                                  <span class="tooltiptext">Whatsapp: <?php the_field('team_member_whatsapp'); ?></span>
                                                </a>                                                 
                                            </li>
                                            <?php endif; ?>
                                            
                                            <?php if( get_field('team_member_email') ): ?>
                                            <li>                                                
                                                <a href="mailto:<?php the_field('team_member_email'); ?>" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext"><?php the_field('team_member_email'); ?></span>
                                                </a>                                               
                                            </li>
                                             <?php endif; ?>
                                             
                                             <?php if( get_field('team_member_skype') ): ?>
                                            <li>                                                
                                                <a href="skype:<?php the_field('team_member_skype'); ?>?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>                                                
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;?>
                            <!-- <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img2.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Jenny Labuschagne</h4>
                                        <p>Director</p>
                                        <ul>
                                            <li>
                                                <a href="tel:082 444 6795" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 444 6795</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:jenny@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">jenny@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img3.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Elviera Kassim</h4>
                                        <p>Office & Internal Sales Manager</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:elviera@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">elviera@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img4.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Coenie Labuschagne</h4>
                                        <p>ManagBusiness Manager</p>
                                        <ul>
                                            <li>
                                                <a href="tel:" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 786 7286</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:coenie@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">coenie@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="skype:coenielab?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img5.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Wilfred Demas</h4>
                                        <p>Customer Accounts Manager</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:wilfred@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">wilfred@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="skype:Wilfred Demas?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img6.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Andrew Milner (BCom Fin Acc)</h4>
                                        <p>Financial Manager</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Cell: 076 792 2535</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:andrew@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">andrew@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="skype:Andrew.j.milner?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img7.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Gerhard Erasmus</h4>
                                        <p>Sales - Blindness & Low Vision Project Manager</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 966 9132</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:gerhard@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">gerhard@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="skype:Gerhard-editmicro?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img8.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Doretta Higgins</h4>
                                        <p>Reception/Office Assistant </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:doretta@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">doretta@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img9.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Francoise Berling </h4>
                                        <p>Data Capturer </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:fran@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">fran@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img10.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Rofhiwa Lambani </h4>
                                        <p>Sales & Support Guateng </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 071 642 5635</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:rofhiwa@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">rofhiwa@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img11.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Salie Moegamat Gamiet</h4>
                                        <p>National Technical Manager</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 0553 325</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:salie@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">salie@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img12.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Shukier de Beer </h4>
                                        <p>Junior Support Manager (Electronics)</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Cell: 079 490 6275</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:shukier@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">shukier@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="skype:Andrew.j.milner?call">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img13.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Zoe Michaelides </h4>
                                        <p>Assistive Technology Specialist </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 776 6142</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:zoe@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">zoe@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img14.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Michelle van der Berg </h4>
                                        <p>Speech, Language and Hearing Therapist</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 082 301 3188</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:michelle@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">michelle@editmicro.co.za </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img15.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Fidel Present </h4>
                                        <p>Design Specialist </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:fidel@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">fidel@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img16.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Kyle Williams</h4>
                                        <p>Junior Project Manager - E-Braille Project</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520 </span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:kyle@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">kyle@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img17.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Costa Chikulo</h4>
                                        <p>Technician</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:wilfred@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img18.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Theo Adams</h4>
                                        <p>Sales & Support</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Cell: 0664726579</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:theo@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">theo@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img19.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Petros Mntambo </h4>
                                        <p>KZN Technician</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img20.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Vishal Ramparsad</h4>
                                        <p>KZN Technician </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 071 608 3954</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:vishal@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">vishal@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img21.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Albert Peters</h4>
                                        <p>Blind and Low Vision Product Manager </p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 076 171 1895</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:albert@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">albert@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img22.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Edwin Segwabe</h4>
                                        <p>Junior Project Manager - E-Braille Project</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img23.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Ezekiel Ngwatle</h4>
                                        <p>Blind & Low Vision Support Limpopo</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img24.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Martins Ngwatle</h4>
                                        <p>Blind & Low Vision Support Limpopo</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Cell: 021 433 2520 </span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img25.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Sherene Labuschagne (BSc Audiology)</h4>
                                        <p>Audiologist Consultant</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: 021 433 2520</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img26.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Diana Shonhiwa</h4>
                                        <p>Edit Consultant- Zimbabwe</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Call: +263 77 291 3967</span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:info@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">info@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="team_member">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/team_img27.jpg" alt="">
                                    <div class="member_details">
                                        <h4>Natasia Marx</h4>
                                        <p>Office Manageress - Mpumalanga Branch</p>
                                        <ul>
                                            <li>
                                                <a href="" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon.png" alt="">
                                                  <span class="tooltiptext">Cell: 017 811 2998 </span>
                                                </a> 
                                            </li>
                                            <li>
                                                <a href="mailto:natasia@editmicro.co.za" class="tooltip2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mail_icon.png" alt="">
                                                  <span class="tooltiptext">natasia@editmicro.co.za</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/skype_icon.png" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                             -->
                            
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
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
		</div>
	  </div>
	</div>
	<!--popup 1 -->



</body>
</html>
