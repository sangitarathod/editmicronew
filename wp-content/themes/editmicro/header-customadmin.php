<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Microsystems </title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags -->

    <!-- CSS links -->
    <link href="<?php echo get_stylesheet_directory_uri();?>/customadmin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_stylesheet_directory_uri();?>/customadmin/css/style.css" rel="stylesheet" type="text/css" />
    <!-- CSS links -->

    <!-- font awesome links -->
    <link href="https://use.fontawesome.com/6f4d530519.css" media="all" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet"> 
    <!-- scroller Stylesheets -->    
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/customadmin/css/responsive.css">
    <!--<link rel="stylesheet" href="<?php //echo get_stylesheet_directory_uri();?>/customadmin/css/jquery.mCustomScrollbar.css">-->
    <link type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css">
</head>
<body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar" class="active">
                <div class="sidebar-header">
                    <h3><a href="<?php echo site_url();?>/custom-dashboard"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/logo.png" alt=""></a></h3>
                    <strong><a href="<?php echo site_url();?>/custom-dashboard"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/logo_small.png" alt=""></a></strong>
                </div>
                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="<?php echo site_url();?>/custom-dashboard"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/dashboard_icon.png" alt="">Dashboard</a>
                    </li>
                    
                    <?php if( current_user_can( 'quotes' ) ){?>
                    <li><a href="<?php echo site_url();?>/admin-quotes-request"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/quotes_icon.png" alt="">Quotes Request</a></li>
                    <?php }?>
                    
                    <?php if( current_user_can( 'messages' ) ){?>
                    <li>
                        <a href="<?php echo site_url();?>/messages"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/messages_icon.png" alt="">Messages</a>
                    </li>
                    <?php } ?>
                    
                    <?php if( current_user_can( 'fault_logs' ) ){?>
                    <li>
                        <a href="<?php echo site_url();?>/admin-logfault1"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/fault_logs_icon.png" alt="">Fault Logs</a>
                    </li>
                   <?php }?> 
                   
                    <?php if( current_user_can( 'training_requests' ) ){?>
                    <li>
                        <a href="<?php echo site_url();?>/training-requests">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/training_icon.png" alt="">Training Requests
                        </a>
                    </li>
                    <?php }?>
                    
                    <?php if( current_user_can( 'employment' ) ){?>
                    <li><a href="<?php echo site_url();?>/job-listing"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/employment_icon.png" alt="">Employment</a></li>
                    <?php }?>
                    
                    <?php if( current_user_can( 'users' ) ){?>
                    <li><a href="<?php echo site_url();?>/manage-users"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/manage_user_icon.png" alt="">Manage Users</a></li>
                    <?php }?>
                    
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/manage_admins_icon.png" alt="">Manage Admins</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="main_content">
                <div class="container_header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="mobile_view_logo">
                                <a href="<?php echo site_url();?>/custom-dashboard"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/logo.png" alt="logo"></a>
                            </div>
                            <div class="navbar-header">
                                <button type="button" id="sidebarCollapse" class="navbar-btn">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/left_menu_icon.png" alt="">
                                </button>
                                <div class="user_login">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><img src="<?php echo get_stylesheet_directory_uri();?>/customadmin/images/user_icon.png" alt="user_icon">
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                          <li><a href="#">Manage Profile</a></li>
                                          <li><a href="<?php echo site_url();?>/sign-out">Log Out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </nav>
                </div>
