<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Microsystems</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags -->

    <!-- CSS links -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- CSS links -->

    <!-- font awesome links -->
    <link href="https://use.fontawesome.com/6f4d530519.css" media="all" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet"> 
    <!-- scroller Stylesheets -->    
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style_scroller.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery.mCustomScrollbar.css">
    
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.theme.default.min.css"/> 
<?php wp_head(); ?>
	

</head>

<body>
    <!-- Header Starts Here -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="logo">
                       <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Logo" width="HERE" height="HERE" />
						</a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="main_menu">
                       <nav class="navbar navbar-default">
                          <div class="container">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                             <?php
							$defaults = array(
									'theme_location'  => 'top',
									'container'       => 'ul',
									'menu_class'      => 'nav navbar-nav',																											
									'walker'          => new Primary_Walker_Nav_Menu()
							);

							wp_nav_menu( $defaults );
														
							?>	
                            </div><!-- /.navbar-collapse -->
                          </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="header_right">
                        <div class="sizer">
                            <p>Font Size</p>
                            <span id="sizeDown"><a href="#">A-</a></span>
                            <span id="normal"><a href="#" >A</a></span>
                            <span id="sizeUp"><a href="#">A+</a></span>
                        </div>
                    </div>
                    <div class="sign_in">
                         <div class="col-sm-6 col-xs-6">
                            <div class="dropdown">
                               <?php if (is_user_logged_in()){?>
                                <a class="btn btn-default dropdown-toggle signin_main" type="button" id="menu1" data-toggle="dropdown">
									<p>Hello! 
										<span>
											<?php
												global $current_user;
												$nm=get_user_meta($current_user->ID,'first_name',true);
												//echo ucfirst($current_user->display_name);
												echo ucfirst($nm);
											?>
											
										</span>
									</p>
                                    
                                </a>
                                <?php }else{?>
									<a class="btn btn-default dropdown-toggle signin_main" type="button" href="<?php echo site_url();?>/sign-in">
									<p>Hello! 
										<span>
											Sign In
										</span>
									</p>
                                </a>
                                <?php }?>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                 <?php include('inc/sing_in_out.php');?>                                  
                                </ul>
                            </div>
                         </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="dropdown">
                                <a class="btn btn-default dropdown-toggle quotes_sec" type="button" id="menu1" data-toggle="dropdown"><p>
									<span class="quotes_count"> <?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span><span>Quotes</span></p>
                                    
                                </a>
                               <!-- <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">-->
                                  <?php woocommerce_mini_cart(); ?>                                  
                                <!--</ul>-->
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header end Here -->
    <section class="subpage_main">
        <!-- section Starts Here -->
        <div class="blue_bar">
            <div class="container">
                <div class="col-sm-3">
                    <div class="all_categories_list">
                          <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a href="#collapse1" data-toggle="collapse" data-target="#demo" aria-expanded="true">
                                      <i class="fa fa-bars" aria-hidden="true"></i>  All Categories
                                  </a>
                                </h4>
                              </div>
                              <div id="demo" class="panel-collapse collapse in">
                                <ul id="content-3" class="content list-group">
								<?php
								$orderby = 'name';
								$order = 'asc';
								$hide_empty = false ;
								$cat_args = array(
									'orderby'    => $orderby,
									'order'      => $order,
									'hide_empty' => $hide_empty,
									'parent' => 0
								);
								 
								$product_categories = get_terms( 'product_cat', $cat_args );
								 
								if( !empty($product_categories) ){
									foreach ($product_categories as $key => $category) {
										if($category->name != 'Uncategorized'){
								?>									
								<?php	
											if($category->name == 'Early Childhood Development'){
											?>
												<li class="list-group-item categories_icon">
												  <a href="<?php echo get_term_link($category);?>" ><span><?php echo $category->name;?></span></a>
												</li> 
											<?php	
											
											}else if($category->name == 'STEAM'){
											?>
												<li class="list-group-item">
												  <a href="<?php echo get_term_link($category);?>"><span><?php echo $category->name;?><span class="small_text">(Science, Technology, Engineering, Art & Mathematics)</span></span></a>
												</li> 
											<?php
											}else{
											?>
												<li class="list-group-item">
												  <a href="<?php echo get_term_link($category);?>"><span><?php echo $category->name;?></span></a>
												</li>
											<?php
											}
									}
								}
							}
								?>	
                                </ul>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-7 filter_dropdown">
                        <div id="fillter_btn">
                            <button onclick="myFunction()">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                                Click here to filter based on your needs<span class="caret"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-5 serach_bar">
                        <div class="col-sm-9 promotions_link">
                            <a href="#">Promotions & Catalogue</a>
                        </div>
                        <ul>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      <form class="" role="search" name="frm_woo_pro_search" id="frm_woo_pro_search" method="POST" >
                                          <div class="form-group">
										 
                                          <input class="form-control" placeholder="Search" type="text" name="woo_pro_search" id="woo_pro_search">
                                          </div>
                                          <button type="submit" class="btn btn-default btn-block submitBtn" name="btn_woo_pro_search"  id="btn_woo_pro_search">Submit</button>
                                      </form>
                                    </li>
                                </ul>
                            </li>
			             </ul>
                    </div>
                </div>
                <div id="filter_content" class="filter_1">
                            <div class="main_filtter_cont">
                                <div class="filter_section_1">
									<?php 									
									$args = array(
										'hide_empty' => false, // also retrieve terms which are not used yet
										'meta_query' => array(
											array(
											   'key'       => 'tag_group',
											   'value'     => 'Users Needs',
											   'compare'   => 'LIKE'
											)
										)
										);
										echo "<pre>";
										$terms = get_terms( 'product_tag', $args );
										print_r($terms);
										echo "</pre>";
									?>
                                    <h3>User Needs</h3>
                                    <ul>
										<?php 
										foreach($terms as $term){
										?>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="<?php echo $term->term_id;?>">
                                                <label for="optinosCheckbox2"><?php echo $term->name;?></label>
                                            </div>
                                        </li>
                                       
                                        <?php }?>
                                    </ul>
                                </div>
                                
                                <div class="filter_section_1">
									<?php 									
									$args_c = array(
										'hide_empty' => false, // also retrieve terms which are not used yet
										'meta_query' => array(
											array(
											   'key'       => 'tag_group',
											   'value'     => 'User Conditions',
											   'compare'   => 'LIKE'
											)
										)
										);
										echo "<pre>";
										$terms_conditions = get_terms( 'product_tag', $args_c );
										print_r($terms_conditions);
										echo "</pre>";
										$c=count($terms_conditions);
										
									?>
                                    <h3>User Conditions</h3>
                                    <ul>
										<?php 
										$i=0;
										foreach($terms_conditions as $terms_condition){
											if($i++ == $c-3 ) break;
										?>
										
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="<?php echo $terms_condition->term_id;?>">
                                                <label for="optinosCheckbox2"><?php echo $terms_condition->name; ?></label>
                                            </div>
                                        </li>
                                        
                                        <?php }?>
                                    </ul>
                                </div>
                                
                                <div class="filter_section_1">
                                    <h3>User Conditions</h3>
                                    <ul>
										<?php 
											$ii=0;
											foreach($terms_conditions as $terms_condition_l){
												if ($c - $ii < 4){
										?>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="<?php echo $terms_condition_l->term_id;?>">
                                                <label for="optinosCheckbox2"><?php echo $terms_condition_l->name;?></label>
                                            </div>
                                        </li>
                                        
										<?php }$ii++;
											
										}?>
                                        <li>
                                            <a class="serach_btn" href="#">Search Products</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

