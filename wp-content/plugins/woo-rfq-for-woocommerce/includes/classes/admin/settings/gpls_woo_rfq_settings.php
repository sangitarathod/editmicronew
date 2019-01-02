<?php

/**
 * Created by PhpStorm.
 * Author: GPLSAVER
 * Date: 1/27/2016
 * Time: 4:07 PM
 */


if (!class_exists('GPLS_Woo_RFQ_Settings')) {

    class GPLS_Woo_RFQ_Settings extends WC_Settings_Page
    {

        /**
         * Constructor for the settings.
         */


        /**
         * Bootstraps the class and hooks required actions & filters.
         *
         */
        public function __construct()
        {

            $this->id = 'settings_gpls_woo_rfq';
            add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_tab'), 50);
            add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));
            add_action('woocommerce_settings_' . $this->id, array($this, 'output'));
            add_action('woocommerce_settings_save_' . $this->id, array($this, 'save'));


        }


        public function get_sections()
        {

            $sections = array(
                '' => __('General', 'woo-rfq-for-woocommerce'),
                'translations' => __('Labels', 'woo-rfq-for-woocommerce'),
                'links' => __('Links', 'woo-rfq-for-woocommerce'),
                'rfq_page' => __('Quote Request Page', 'woo-rfq-for-woocommerce'),


            );


            return apply_filters('woocommerce_get_sections_' . $this->id, $sections);
        }

        public function output()
        {
            global $current_section;
            $settings = $this->get_settings($current_section);
            WC_Admin_Settings::output_fields($settings);
        }

        /**
         * Add a new settings tab to the WooCommerce settings tabs array.
         *
         * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
         * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
         */
        public function add_settings_tab($settings_tabs)
        {
            $settings_tabs[$this->id] = 'RFQ-ToolKit';
            return $settings_tabs;
        }
        /**
         * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
         *
         * @uses woocommerce_admin_fields()
         * @uses self::get_settings()
         */
        /* public  function settings_tab() {
             woocommerce_admin_fields( self::get_settings() );



         }*/
        /**
         * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
         *
         * @uses woocommerce_update_options()
         * @uses self::get_settings()
         */

        public function ad_filter_menu($sorted_menu_objects, $args)
        {

            if ($args->theme_location != 'primary')
                return $sorted_menu_objects;


            foreach ($sorted_menu_objects as $key => $menu_object) {


                $rfq_page = pls_woo_rfq_get_link_to_rfq();
                if ($menu_object->title == $rfq_page) {
                    unset($sorted_menu_objects[$key]);
                    break;
                }
            }

            return $sorted_menu_objects;
        }

        /**
         * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
         *
         * @return array Array of settings for @see woocommerce_admin_fields() function.
         */
        public function get_settings($section = null)
        {
            $settings = array();

            switch ($section) {
                case '' :
                    $settings =

                        array(

                            'general_section_title' => array(
                                'name' => __('RFQ-ToolKit General Options', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('RFQ-ToolKit general options ', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_general_section_title'
                            ),
                            'checkout_option' => array(
                                'name' => '1- ' . __('Checkout Option', 'woo-rfq-for-woocommerce'),
                                'type' => 'select',
                                'options' => array(
                                    'normal_checkout' => __('Normal Checkout', 'woo-rfq-for-woocommerce'),
                                    'rfq' => __('RFQ', 'woo-rfq-for-woocommerce')),
                                'desc' => '<h4>' .
                                    __('RFQ turns WooCommerce shopping cart into a request for quote. In premium version there are additional options to buy or request a quote the whole cart at WooCommerce checkout.<br />RFQ option provides very high compatibility with other third party plugins and products. Normal option allows checking out normally or request a quote using a quote cart.', 'woo-rfq-for-woocommerce') .
                                    '</h4><h4>' . __('Normal Checkout: If normal checkout, prices will be shown except for selected products (managed in product setup-advanced tab) and customer can only inquire about the products that you specify in product setup in the advanced tab.<br />
<br>RFQ Checkout: In RFQ mode the plugin is integrated with the WooCommerce cart and the entire cart is submitted as a quote request.<br /> All the prices are hidden and at checkout the option is to submit a quote request.<br />', 'woo-rfq-for-woocommerce') . '</h4>',

                                'default' => 'normal_checkout',
                                'id' => 'settings_gpls_woo_rfq_checkout_option'
                            ),

                            'settings_gpls_woo_rfq_show_prices' => array(
                                'name' => '2- ' . __('Always Show Product Prices With RFQ Checkout', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Applicable to RFQ checkout option only.<br /> Prices are shown for products but checkout is still a request for quote. Premium version show prices in the email and thank you page also.', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_prices'
                            ),

                            'settings_gpls_woo_rfq_normal_checkout_show_prices' => array(
                                'name' => '3- ' . __('Show Prices With Normal Checkout', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Applicable to normal checkout option only.<br /> Prices are shown on the site but customer can inquire or checkout with selected products.< br />
                            This allows customers to checkout using the published prices or to request a personalized quote.  Premium version show prices in the email and thank you page also', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_normal_checkout_show_prices'
                            )
                        ,

                            'settings_gpls_woo_rfq_hide_visitor_prices' => array(
                                'name' => '4- ' . __('Hide Prices from Visitors', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Hide Prices From Visitor. Visitors who are not logged in can only submit a quotes request. <br />.Enable guest checkout so the customers can submit requests as guest', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_hide_visitor_prices'
                            ),


                            'general_section_end345' => array(
                                'type' => 'sectionend',
                                'id' => 'settings_gpls_woo_rfq_general_section_end345'
                            )
                        ,
                            'general_section_title45' => array(
                                'name' => '====================================================================================================================================================================',
                                'type' => 'title',
                                'desc' => '<hr width="100%" size="2" />',
                                'id' => 'general_section_title45'
                            ),

                            'twitter_checkout_option' => array(
                                'name' => '',
                                'type' => 'title',
                                'desc' => !class_exists('GPLS_WOO_RFQ_PLUS')?'<br /><h4><a target="_blank" href="https://www.neahplugins.com/product/rfq-toolkit-plus/"><span style="color:blue">RFQ-ToolKit Plus</span></a>' . __(' provides many more customization options and features.', 'woo-rfq-for-woocommerce') . '' . '<h4>' . '<br /><h4><a target="_blank" href="https://www.neahplugins.com/product/woocommerce-upload-files/"><span style="color:blue">RFQ-ToolKit Uploads</span></a>' . __(' Allows customer to upload files along with Quote Requests and WooCommerce orders.', 'woo-rfq-for-woocommerce') . '' . '<h4>' . '<h4>' . '<br /><h4><a target="_blank" href="https://www.neahplugins.com/product/rfq-toolkit-prod-extra-fields/"><span style="color:blue">RFQ-ToolKit Extra Product Fields</span></a>' . __(' Allows custom forms in the product page for Quote Requests and WooCommerce orders.', 'woo-rfq-for-woocommerce') .  '<br /><h4><a target="_blank" href="https://www.neahplugins.com/product/woocommerce-quickbooks-connector"><span style="color:blue">WooCommerce-QuickBooks Desktop Connector</span></a>' . __(' Sync your orders and inventory between WooCommerce and QuickBooks.', 'woo-rfq-for-woocommerce') . '<h4><h4><br /><h4>' . __('<strong>If RFQ-ToolKit is helpful to you, a <a target="_blank" href="https://wordpress.org/support/plugin/woo-rfq-for-woocommerce/reviews/">rating</a> would be appreciated. Thank you in advance.<strong><br /><br /><b>Please follow us on Twitter for news on features & updates <a target="_blank" href="https://twitter.com/@NeahPlugins" class="twitter-follow-button" data-show-count="true">@NeahPlugins</a> and visit us at <a target="_blank" href="http://www.neahplugins.com/">NeahPlugins</a>. You can <a  target="blank" href="mailto:contact@neahplugins.com" >contact</a> us for feedback or suggestions.</b>', 'woo-rfq-for-woocommerce'):"",
                                'id' => 'twitter_checkout_option',
                                'css' => 'width:600px; margin-top:50px'
                            ),
                            'general_section_end3455' => array(
                                'type' => 'sectionend',
                                'id' => 'general_section_end3455'
                            )

                        );
                    break;

                case 'translations':
                    $settings =

                        array(

                            'rfq_cart_wordings_section_title' => array(
                                'name' => __('Custom Labels', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('Manage labels and wordings', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_section_title'
                            ),


                            'rfq_cart_wordings_add_to_cart' => array(
                                'name' => '1- Normal or RFQ Checkout-' . __('Add To Cart Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Add to Cart" - (Change to Add To Quote in RFQ Checkout)', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add to Cart', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_add_to_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_in_cart' => array(
                                'name' => '2- Normal or RFQ Checkout-' . __('Add To Cart Again Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Already in the Cart"- (Change to Add To Quote in RFQ Checkout) ', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add to Cart', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_in_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_add_to_rfq' => array(
                                'name' => '3- Normal Checkout-' . __('Add To Quote Request Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal Checkout Only. Choose the text for "Request Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add To Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_add_to_rfq',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_in_rfq' => array(
                                'name' => '4- Normal Checkout-' . __('Add To Quote Request Again Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal Checkout Only. Choose the text for "Already In Quote Request"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add To Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_in_rfq',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_proceed_to_rfq' => array(
                                'name' => '5- ' . __('RFQ Checkout- Proceed To Submit Your Quote Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('RFQ Checkout- Choose the text for "Proceed To Submit Your Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Proceed To Submit Your Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_proceed_to_rfq',
                                'css' => 'width:400px'
                            ),


                            'rfq_cart_wordings_submit_your_rfq_text' => array(
                                'name' => '6- ' . __('Normal & RFQ Checkout- Submit Your Quote Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal Checkout- Choose the text for "Submit Your Request For Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Proceed To Submit Your Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_submit_your_rfq_text',
                                'css' => 'width:400px'
                            ),


                            'rfq_cart_wordings_view_rfq_cart' => array(
                                'name' => '7- Normal & RFQ Checkout- ' . __('VIEW LIST', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "View Your Quote Cart"', 'woo-rfq-for-woocommerce'),
                                'default' => __('View List', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_view_rfq_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_rfq_cart_is_empty' => array(
                                'name' => '8- Normal Checkout- ' . __('Quote Request List Is Empty Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "You Quote cart is empty and was not submitted"', 'woo-rfq-for-woocommerce'),
                                'default' => __('You quote request list is empty and was not submitted', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_rfq_cart_is_empty',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_return_to_shop' => array(
                                'name' => '9- Normal Checkout- ' . __('Return To Shop In Quote Request Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Return To Shop In Quote Request Page"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Return To Shop', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_return_to_shop',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_product_was_added_to_quote_request' => array(
                                'name' => '10- Normal & RFQ Checkout- ' . __('Product Was Added To The Quote Request', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Added to Quote List"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Product was successfully added to quote request.', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_product_was_added_to_quote_request',
                                'css' => 'width:400px'
                            ),
                            'gpls_woo_rfq_quote_submit_confirm_message' => array(
                                'name' => '11- Normal & RFQ Checkout- ' . __('Your Request Has Been Submitted', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Your quote request has been successfuly submitted!', 'woo-rfq-for-woocommerce'),
                                'default' => __('Your request has been successfuly submitted!', 'woo-rfq-for-woocommerce'),
                                'id' => 'gpls_woo_rfq_quote_submit_confirm_message',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_quote_request_currently_empty' => array(
                                'name' => '12- Normal Checkout- ' . __('Your Quote Request List Is Currently Empty', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => '',
                                'default' => __('Your Quote Request List is Currently Empty.', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_quote_request_currently_empty',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_gpls_woo_rfq_update_rfq_cart_button' => array(
                                'name' => '13- Normal & RFQ Checkout-' . __('Update Quote Request', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'Button Text to update Quest Request List in Quote Request Page',
                                'default' => __('Update Quote Request', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_gpls_woo_rfq_update_rfq_cart_button',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_customer_info_label' => array(
                                'name' => '14- Normal Checkout-' . __('Customer Information', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'Section title for customer information in the quote request page',
                                'default' => __('Customer Information', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_customer_info_label',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_read_more' => array(
                                'name' => '15-  Normal & RFQ Checkout-' . __('Read more', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'label for products with options or no prices',
                                'default' => __('Read more', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_read_more',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_Select_Options' => array(
                                'name' => '16-  Normal & RFQ Checkout-' . __('Select Options', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'label for products with options or no prices',
                                'default' => __('Select options', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_Select_Options',
                                'css' => 'width:400px'
                            ),


                            'general_section_end' => array(
                                'type' => 'sectionend',
                                'id' => 'settings_gpls_woo_rfq_general_section_end'
                            ),


                        );
                    break;

                case 'links':
                    $settings =

                        array(
                            'rfq_cart_section_title' => array(
                                'name' => __('Show links to Quote Request Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('Manage links to "Request Quote Page" - (normal checkout)', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_section_title'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_archive_top' => array(
                                'name' => '1- ' . __('Show Link To Quote Request Page At The Top of the Product Archives Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_archive_top'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_archive_end' => array(
                                'name' => '2- ' . __('Show Link To Quote Request Page At The Bottom of the Product Archives Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_archive_end'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_cart' => array(
                                'name' => '3- ' . __('Show Link To Quote Request Page in the Normal Cart Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_cart'
                            ),


                            'settings_gpls_woo_rfq_show_cart_single_page' => array(
                                'name' => '4- ' . __('Show Link To Quote Request Page in the Single Product Description', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_single_page'
                            ),

                            'settings_gpls_woo_rfq_show_cart_thank_you_page' => array(
                                'name' => '5- ' . __('Show Link To Quote Request Page in the Thank you page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_thank_you_page'
                            ),

                            'rfq_cart_section_title_end' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_section_title_end'
                            ),
                        );
                    break;
                case 'rfq_page':
                    $settings =

                        array(

                            'rfq_cart_sc_section_title' => array(
                                'name' => __('Default Request for Quote Page: Applicable In Normal Checkout Mode(Exclude from your cache)', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('<p>Exclude from your cache. In the Normal Checkout mode, a default page called <i>Quote Request</i> is created to view the RFQ list. This page
                                            is only needed if in the Normal Checkout mode. (In RFQ mode, the WooCommerce cart
                                           is used to display the items requested for quote.)</p></b> Depending on your theme, you may need to manually add the <i>Quote Request</i> page to the menu. 
                                           You can modify to the <i>Quote Request</i> page by using the template in "plugins/woo-rfq-for-woocommerce/woocommerce/woo-rfq/rfq-cart.php".
                                           Copy the folder to the WooCommerce directory in your theme directory and modify it if you wish .<br /><br />
                                           You can also use the short code <b>[gpls_woo_rfq_get_cart_sc]</b>  in your own page.</p>
                                           You can control the layout and the page template for this page in your WordPress admin area.                                            
                                            <i> Typically the <i>Quote Request</i> page looks better with a full-width template without any side-bars.</i>', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_sc_section_title',
                                'css' => 'width:600px'
                            ),


                            'rfq_cart_sc_section_show_link_to_rfq_page' => array(
                                'name' => __('Request for Quote Page URL', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Request for Quote Page URL', 'woo-rfq-for-woocommerce'),
                                'default' => '/quote-request/',
                                'id' => 'rfq_cart_sc_section_show_link_to_rfq_page',
                                'css' => 'width:400px;'
                            ),

                            'rfq_cart_sc_section_title_end' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_sc_section_title_end'
                            ),

                        );
                    break;


            }

            $settings = apply_filters('wc_settings_gpls_woo_rfq_settings', $settings, $section);

            return $settings;

        }


        public function get_page_by_name($pagename)
        {
            if (get_page_by_title($pagename)) return true;

            return false;
        }

        public function save()
        {
            global $current_section;
            $settings = $this->get_settings($current_section);
            WC_Admin_Settings::save_fields($settings);
        }


    }

}

if (!isset($GLOBALS["GPLS_Woo_RFQ_Settings"])) {

    $GLOBALS["GPLS_Woo_RFQ_Settings"] = new GPLS_Woo_RFQ_Settings();
}

return $GLOBALS["GPLS_Woo_RFQ_Settings"];


?>
