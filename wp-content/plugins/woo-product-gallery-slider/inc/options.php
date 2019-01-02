<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if (!class_exists('wpgs_Settings_API')):
    class wpgs_Settings_API {

        private $settings_api;

        public function __construct() {
            $this->settings_api = new WeDevs_Settings_API;

            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'admin_menu'));
          

        }
     

        public function admin_init() {

            //set the settings
            $this->settings_api->set_sections($this->get_settings_sections());
            $this->settings_api->set_fields($this->get_settings_fields());

            //initialize settings
            $this->settings_api->admin_init();
            /**
             * If not, return the standard settings
             **/

        }

        public function admin_menu() {
            // add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test',  );
            add_submenu_page('woocommerce', 'Gallery Settings', 'Gallery Settings', 'delete_posts', 'wpgs_options', array($this, 'wpgs_plugin_page'));
        }

        public function get_settings_sections() {
            $sections = array(
                array(
                    'id'    => 'wpgs_settings',
                    'title' => __('Product Gallery Slider for WooCommerce Settings', 'wpgs'),
                ),

            );
            return $sections;
        }

        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        public function get_settings_fields() {
            $settings_fields = array(
                'wpgs_settings'   => array(
                    array(
                        'name'    => 'navIcon',
                        'label'   => __('Navigation Icons', 'wpgs'),
                        'desc'    => __('Show Navigation icons. Default: Yes', 'wpgs'),
                        'type'    => 'select',
                        'default' => 'true',
                        'options' => array(
                            'true' => 'Yes',
                            'false'  => 'No',
                        ),
                    ),
                    array(
                        'name'    => 'navColor',
                        'label'   => __('Theme Color', 'wpgs'),
                        'desc'    => __('', 'wpgs'),
                        'type'    => 'color',
                        'default' => '',
                    ),
                    
                    array(
                        'name'    => 'autoPlay',
                        'label'   => __('Auto Play', 'wpgs'),
                        'desc'    => __('Default: No', 'wpgs'),
                        'type'    => 'select',
                        'default' => 'false',
                        'options' => array(
                            'true' => 'Yes',
                            'false'  => 'No',
                        ),
                    ),
 					
                  
                    array(
                        'name'              => 'Lightboxframewidth',
                        'label'             => __('Lightbox Frame Width ', 'wpgs'),
                        'desc'              => __('Default: 600 px', 'wpgs'),

                        'type'              => 'text',
                        'default'           => '600',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                     array(
                        'name'    => 'caption',
                        'label'   => __('Lightbox Caption', 'wpgs'),
                        'desc'    => __('Show Image Attributes as caption in this Lightbox', 'wpgs'),
                        'type'    => 'select',
                        'default' => 'false',
                        'options' => array(
                            'true' => 'Yes',
                            'false'  => 'No',
                        ),
                    ),
                  
                   
                    
                ),
            );

            return $settings_fields;
        }

        public function wpgs_plugin_page() {
            echo '<div class="wrap">';

            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
?>
<div class="twist_pro">
	
 <h2 style="text-align: left;">Get The Pro Version Now</h2>
 <div class="notice notice-success  twist_oofer">
    <a href="https://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108"><img src="https://s3.envato.com/files/235338174/00_01_001_thumbnail.png" alt="Woocommerce Product Gallery slider"></a>
    <div class="offer_txt">
        <p style="font-size: 16px;

margin-bottom: 0;

padding-bottom: 0px;"><strong><?php _e( 'Cyber Monday Offer!', 'wpgs' ); ?></strong></p>
        <p class="about-description" style="padding-top: 0px;"><?php _e( 'Get Product Gallery slider for Woocommerce Pro version only at 13$', 'wpgs' ); ?></p>
    </div>
        
    </div>

 

 <img style="width: 100%;"src="https://image.prntscr.com/image/LELn9ECQQCSesPAHip7QAA.png" alt="">
 <h3>Was <del>$26</del> Now $13 </h3>
 <a target="_blank" href="https://codecanyon.net/item/twist-product-gallery-slidercarousel-plugin-for-woocommerce/14849108?utm_source=plugin&utm_medium=cpc" class="button button-primary">Buy Now</a>


</div>
</div>
    <style>
    .twist_oofer {

    width: 470px;
    height: 85px;

}
    .offer_txt {

    position: relative;
    top: -69px;
    left: 70px;

}
        .twist_oofer img{margin-top:10px;width:60px;}
    </style>
<?php
        }

        /**
         * Get all the pages
         *
         * @return array page names with key value pairs
         */
        public function get_pages() {
            $pages         = get_pages();
            $pages_options = array();
            if ($pages) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }

            return $pages_options;
        }

    }
endif;
