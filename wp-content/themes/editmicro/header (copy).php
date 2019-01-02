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
<?php //wp_head(); ?>
</head>
<body>
	<!-- Header Starts Here -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="logo">
                        <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="logo_img"></a>
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
                            <!-- Collect the nav links, forms, and other content for toggling -->                            
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
                                <a class="btn btn-default dropdown-toggle signin_main" type="button" id="menu1" data-toggle="dropdown"><p>Hello! <span>Sign in</span></p>
                                    
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li><a href="#">HTML</a></li>
                                  <li><a href="#">CSS</a></li>
                                  <li><a href="#">About Us</a></li>
                                </ul>
                            </div>
                         </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="dropdown">
                                <a class="btn btn-default dropdown-toggle quotes_sec" type="button" id="menu1" data-toggle="dropdown"><p><span class="quotes_count">0</span><span>Quotes</span></p>
                                    
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li><a href="#"></a></li>
                                  <li><a href="#"></a></li>
                                  <li><a href="#"></a></li>
                                </ul>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header end Here -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		//echo '<div class="single-featured-image-header">';
		//echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		//echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<section>
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
                                  <li class="list-group-item categories_icon">
                                      <a href="#"><span>Early Childhood Development</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Sensory</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Learning + Literacy</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>STEAM <span class="small_text">(Science, Technology, Engineering,Art & Mathematics)</span></span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Vocation</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Blind and Low Vision</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Auditory & Hearing Impairment</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Communication and AAC</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Accessibility</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Innovative ICT</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Resources</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Independent Living</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Healthcare Related Products</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Support and Training</span></a>
                                  </li>
                                  <li class="list-group-item">
                                      <a href="#"><span>Neurological & Neurodevelepmental Impairments</span></a>
                                  </li>
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
                            <a href="#">Promotions & Offers</a>
                        </div>
                        <ul>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      <form class="" role="search">
                                          <div class="form-group">
                                          <input class="form-control" placeholder="Search" type="text">
                                          </div>
                                          <button type="submit" class="btn btn-default btn-block submitBtn">Submit</button>
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
                                    <h3>User Needs</h3>
                                    <ul>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Cognition assessment</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Communication (AAC)</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Computer & home <br> 
                                                    automation access</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Special education</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="filter_section_1">
                                    <h3>User Conditions</h3>
                                    <ul>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">ALS / Lou Gehrig disease</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Childhood apraxia of speech</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Minimally conscious / PVS</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Rett syndrome</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Angelman syndrome</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Down syndrome</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Multiple sclerosis</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Spinal cord injury</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Aphasia / stroke</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Dyslexia</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Muscular dystrophy</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Spinal muscular atrophy</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Autism</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Head and neck cancer</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Neurological conditions</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Tracheostomy</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Brain stem stroke</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Huntington's disease</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Parkinson's disease</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Traumatic brain injury</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Cerebral palsy</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Intellectual disability</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Pura syndrome</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="filter_section_1">
                                    <h3>User Conditions</h3>
                                    <ul>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Can read & write</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Is learning to read & write</label>
                                            </div>
                                        </li>
                                        <li class="col-sm-3">
                                            <div class="checkbox">
                                                <input type="checkbox" id="optinosCheckbox2" value="">
                                                <label for="optinosCheckbox2">Can not read & write</label>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="serach_btn" href="#">Search Products</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
