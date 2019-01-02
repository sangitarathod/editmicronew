 <?php
// If uninstall not called from WordPress exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();
    
 delete_option('tx_woo_slider_settings');