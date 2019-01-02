<?php 
									$location = is_user_logged_in() ? 'signout' : 'signin';
                                                                    
									$defaults = array(
									'theme_location'  => $location,
									'container'=>'',
									'container_class'=>'',
									'echo' => false,
									);

									$menu = wp_nav_menu($defaults);
									echo preg_replace(array(
										'#^<ul[^>]*>#',
										'#</ul>$#'
									), '', $menu);
									
									/*$defaults = array(
									'theme_location'  => 'manageprofile',
									'container'=>'',
									'container_class'=>'',
									'echo' => false,
									);

									$menu = wp_nav_menu($defaults);
									echo preg_replace(array(
										'#^<ul[^>]*>#',
										'#</ul>$#'
									), '', $menu);
									*/
                                  ?>
