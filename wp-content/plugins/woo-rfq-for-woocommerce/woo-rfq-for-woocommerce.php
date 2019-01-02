<?php
/*
Plugin Name: RFQ-ToolKit For WooCommerce
Description: RFQ-ToolKit: Request For Quote For WooCommerce.
Plugin URI: https://wordpress.org/plugins/woo-rfq-for-woocommerce
Version: 1.8.94
Contributors: Neah Plugins
Author: Neah Plugins
Author URI: https://www.neahplugins.com/
Donate link: https://www.neahplugins.com/
Requires at least: 4.1
Tested up to: 4.9 and WooCommerce 3.x
Text Domain: woo-rfq-for-woocommerce
Copyright: � 2018 Neah Plugins.
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

require_once(plugin_dir_path(__FILE__) . '/woo-rfq-includes/woo-rfq-functions.php');


if (!is_admin()) {
    if (rfqtk_first_main()) return;
}


$GLOBALS['GPLS_WOO_RFQ'] = GPLS_WOO_RFQ::instance();


class GPLS_WOO_RFQ
{

    protected static $_instance = null;

    public static function instance()
    {

        if (is_null(self::$_instance))
            self::$_instance = new self();

        return self::$_instance;
    }

    public function __construct()
    {


        $this->gpls_rfq_setup_constants();
        $this->gpls_rfq_setup_includes();

        add_action('init', array($this, 'gpls_4woo_quote_wp_init'), -1);

        add_action('init', array($this, 'gpls_woo_rfq_setup_custom_css'), 100);

        add_action('plugins_loaded', array($this, 'gpls_woo_rfq_init'), 300);

        //emails
        $this->setup_email();


        if (isset($_POST['gpls-woo-rfq_checkout']) && $_POST['gpls-woo-rfq_checkout'] == "true") {

            add_action('wp_loaded', array($this, 'check_for_rfq_checkout'), 1000);

        }

        add_action('woocommerce_before_checkout_process', 'gpls_woo_rfq_woocommerce_RFQ_only_add_to_cart', 1000);

        add_action('init', 'gpls_woo_rfq_woocommerce_RFQ_load_payment_gateway', 1000);//


        add_action('wp_loaded', 'gpls_woo_rfq_order_recieved', 1000);

        add_action('wp_loaded', 'gpls_rfq_remove_rfq_cart_item', 1000);

        add_action('wp_loaded', 'gpls_rfq_update_rfq_cart', 1000);

        add_action('wp_loaded', array($this, 'gpls_woo_rfq_setup_menu'), 1000);

        add_filter('wp_get_nav_menu_items', 'gpls_woo_rfq_hide_rfq_page', 999, 3);

        add_action('wp_footer', array($this, 'footer_action'), 1000);

        add_action('plugins_loaded', array($this, 'gpls_woo_rfq_load_textdomain'));

        $rfq_page = get_option('rfq_cart_sc_section_show_link_to_rfq_page', '');

        if (isset($rfq_page)) {

            $link_to_rfq_page_url = parse_url($rfq_page);

            $link_to_rfq_page_path = $link_to_rfq_page_url['path'];
        }

        add_action('init', array($this, 'gpls_woo_rfq_setup_customer_cookie'), 1000);
        //add_action('wp', array($this,'gpls_woo_rfq_setup_customer_cookie'),99);


        add_action('wp_logout', array($this, 'gpls_woo_rfq_logout'), 100);

        if (!has_action('admin_head', array($this, 'gpls_woo_rfq_enqueue_admin_css'))) {
            add_action('admin_head', array($this, 'gpls_woo_rfq_enqueue_admin_css'));
        }


    }


    public function gpls_woo_rfq_enqueue_admin_css()
    {
        if (is_admin()) {
            $url_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_woo_admin.css';

            $url_css_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_woo_admin.css';
            wp_enqueue_style('gpls_woo_rfq_plus_css_admin', $url_css, array(), filemtime($url_css_path));

        }
    }


    public function check_for_rfq_checkout()
    {


        add_filter('woocommerce_payment_gateways', 'add_gpls_woo_rfq_class', 1, 1);

        require_once(gpls_woo_rfq_DIR . 'includes/classes/gateway/wc-gateway-gpls-request-quote.php');

        add_filter('woocommerce_available_payment_gateways', 'gpls_rfq_remove_other_payment_gateways', 1000, 1);


        gpls_woo_rfq_handle_checkout();


    }


    public function gpls_woo_rfq_settings()
    {


        if (is_admin()) {
            require_once(gpls_woo_rfq_DIR . 'includes/classes/admin/admin.php');
            $GPLS_Woo_RFQ_Admin = new GPLS_Woo_RFQ_Admin();
        }


    }


    public function gpls_woo_rfq_init()
    {


        $this->gpls_rfq_css_js();
        //gateway
        $this->setup_gateway();

        $plugin = plugin_basename(__FILE__);

        add_filter("plugin_action_links_$plugin", array($this, 'gpls_woo_rfq_plugin_settings_link'));

        $this->gpls_woo_rfq_settings();

        /**
         * Activation, Deactivation and Uninstall Functions
         *
         **/
        register_activation_hook(__FILE__, array($this, 'gpls_woo_rfq_activation'));

        register_deactivation_hook(__FILE__, array($this, 'gpls_woo_rfq_deactivation'));


        do_action('gpls_woo_rfq_loaded');

    }


    public function gpls_woo_rfq_load_textdomain()
    {
        load_plugin_textdomain('woo-rfq-for-woocommerce', false, dirname(plugin_basename(__FILE__)) . '/languages/');


    }


    public function gpls_woo_rfq_plugin_settings_link($links)
    {

        $settings_link = admin_url('admin.php?page=wc-settings&tab=settings_gpls_woo_rfq&section=');
        $settings_link = '<a href="' . $settings_link . '">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }


    public function setup_email()
    {
        require_once(gpls_woo_rfq_DIR . 'includes/classes/emails/class-wc-email-rfq.php');
        $wc_email_rfq = new WC_Email_RFQ();

    }

    public function setup_gateway()
    {
        require_once(gpls_woo_rfq_DIR . 'includes/classes/gateway/class-wc-gateway-rfq.php');
        $wc_gateway_frq = new WC_Gateway_RFQ();

    }


    public function gpls_4woo_quote_wp_init()
    {


        add_filter('woocommerce_is_purchasable', 'gpls_woo_rfq_is_purchasable', 1000, 2);
        add_filter('woocommerce_variation_is_purchasable', 'gpls_woo_rfq_is_purchasable', 1000, 2);

        add_filter('woocommerce_is_purchasable', 'gpls_woo_rfq_normal_is_purchasable', 1000, 2);
        add_filter('woocommerce_variation_is_purchasable', 'gpls_woo_rfq_normal_is_purchasable', 1000, 2);


        $status_label = __('Quote Request', 'woo-rfq-for-woocommerce');
        register_post_status('wc-gplsquote-req', array(
            'label' => $status_label,
            'public' => true,
            'exclude_from_search' => false,
            'show_in_admin_all_list' => true,
            'show_in_admin_status_list' => true,
            'label_count' => _n_noop($status_label . '<span class="count">(%s)</span>', $status_label . ' <span class="count">(%s)</span>')
        ));

        add_filter('wc_order_statuses', array($this, 'gpls_rfq_add_quote_request_to_order_statuses'), 100);


        if (!is_admin()) {


            $GLOBALS["gpls_4woo_quote_current_url"] = preg_replace('{/$}', '', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);


            $link_to_rfq_page = gpls_woo_rfq_remove_http(pls_woo_rfq_get_link_to_rfq());

            if (trim($link_to_rfq_page) == trim($GLOBALS["gpls_4woo_quote_current_url"]) || isset($_REQUEST['removed_item'])) {

                //  add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_css', 1000);

            }

            if (isset($_REQUEST['removed_item'])) {

                add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_css', 1000);

            }


            $rfq_check = false;
            $normal_check = false;

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
                if (get_option('settings_gpls_woo_rfq_show_prices', 'no') == 'no') {
                    $rfq_check = true;
                }
            }


            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {

                {
                    $normal_check = true;
                }
            }

            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $rfq_check = true;
                    $normal_check = false;
                }
            }


            if ($rfq_check) {

                //    add_filter( 'wc_price', 'gpls_woo_wc_price',1000,3 );

                add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_css', 1000);
                add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_mode_remove_subtotals_custom_css', 1000);

                add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_js', 1000);


            }
            //add_filter('woocommerce_empty_price_html', 'gpls_woo_rfq_woocommerce_empty_price_html',1000);
        }


    }


    // Add to list of WC Order statuses
    public function gpls_rfq_add_quote_request_to_order_statuses($order_statuses)
    {


        $rfq_page = get_option('rfq_cart_sc_section_show_link_to_rfq_page', '');

        if (isset($rfq_page)) {

            $link_to_rfq_page_url = parse_url($rfq_page);

            $link_to_rfq_page_path = $link_to_rfq_page_url['path'];
        }


        $order_statuses = array_reverse($order_statuses, True);
        $order_statuses["wc-gplsquote-req"] = __('Quote Request', 'woo-rfq-for-woocommerce');
        $order_statuses = array_reverse($order_statuses, True);


        return $order_statuses;
    }


    public function gpls_woo_rfq_activation()
    {


    }

    public function gpls_woo_rfq_setup_menu()
    {


        $this->gpls_woo_upgrade_routines();

        gpls_woo_rfq_create_page();

        // gpls_woo_rfq_check_menu();


    }

    function gpls_rfq_install()
    {


    }


    public function gpls_woo_rfq_deactivation()
    {


    }


    public function gpls_woo_rfq_uninstall()
    {


    }


    public function gpls_woo_rfq_pay_plugin_path()
    {


        return untrailingslashit(plugin_dir_path(__FILE__));

    }


    public function gpls_rfq_setup_includes()
    {
        require_once(gpls_woo_rfq_DIR . 'wp-session-manager/wp-session-manager.php');

        require_once(gpls_woo_rfq_DIR . 'includes/classes/gpls_woo_rfq_functions.php');

        require_once(gpls_woo_rfq_DIR . 'includes/classes/prices/gpls_woo_rfq_prices.php');
        $gpls_woo_rfq_prices = new gpls_woo_rfq_prices();

        require_once(gpls_woo_rfq_DIR . 'includes/classes/coupons/gpls_woo_rfq_coupons.php');
        $gpls_woo_rfq_coupons = new gpls_woo_rfq_coupons();

        require_once(gpls_woo_rfq_DIR . 'includes/classes/shipping/gpls_woo_rfq_shipping.php');
        $gpls_woo_rfq_shipping = new gpls_woo_rfq_shipping();

        require_once(gpls_woo_rfq_DIR . 'includes/classes/cart/gpls_woo_rfq_cart.php');
        $gpls_woo_rfq_cart = new gpls_woo_rfq_CART();

        require_once(gpls_woo_rfq_DIR . 'includes/classes/checkout/gpls_woo_rfq_checkout.php');

        $gpls_woo_rfq_checkout = new gpls_woo_rfq_CHECKOUT();


        require_once(gpls_woo_rfq_DIR . 'includes/classes/admin/gpls_woo_rfq_admin_functions.php');

        add_shortcode('gpls_woo_rfq_get_cart_sc', 'gpls_woo_rfq_get_rfq_cart');

        require_once(gpls_woo_rfq_DIR . 'includes/classes/checkout/gpls_woo_rfq_checkout.php');

        $gpls_woo_rfq_checkout = new gpls_woo_rfq_CHECKOUT();

    }


    public function gpls_woo_rfq_enqueue_scripts()
    {
        if (!is_admin()) {

            $url_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_woo_rfq.css';
            $url_css_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_woo_rfq.css';
            wp_enqueue_style('gpls_woo_rfq_css', $url_css, array(), filemtime($url_css_path));

            $list = 'enqueued';

            // if (!wp_script_is( 'gpls_woo_rfq.js', $list ))
            {
                $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/gpls_woo_rfq.js';
                $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/gpls_woo_rfq.js';
                wp_enqueue_script('gpls_woo_rfq_js', $url_js, array('jquery'), filemtime($url_js_path), true);

            }

            //  $required_text = __('Required', 'woo-rfq-for-woocommerce');
            //  $custom_js = "jQuery( document ).ready( function() {jQuery.extend(jQuery.validator.messages, {required: '".$required_text."', });});";

            //   wp_add_inline_script('gpls_woo_rfq_js', $custom_js);

            $hide_visitor = false;

            if (function_exists('wp_get_current_user')) {
                if ((get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' &&
                    !wp_get_current_user()->exists())) {

                    $hide_visitor = true;

                }
            }


            if ($hide_visitor) {

                if (!is_admin()) {
                    $url_gpls_wh_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_wh.css';
                    $url_gpls_wh_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_wh.css';
                    wp_enqueue_style('url_gpls_wh_css', $url_gpls_wh_css, array(), filemtime($url_gpls_wh_path));

                    $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/gpls_wh.js';
                    $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/gpls_wh.js';
                    wp_enqueue_script('url_gpls_wh_js', $url_js, array('jquery'), filemtime($url_js_path), true);
                }
            }


            if (is_product()) {

                global $product;

                //if(gpls_empty($product) )return;

                if (!is_object($product)) $product = wc_get_product(get_the_ID());

                if ($product->get_type() == 'external') {
                    return;
                }

                $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
                $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

                $form_label = gpls_woo_rfq_INQUIRE_TEXT;

                $rfq_product_script = "";

                $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
                $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());


                $hide_visitor = false;
                $rfq_check = false;
                $normal_check = false;
                //gpls_woo_rfq_get_mode($rfq_check, $normal_check);
                $rfq_check = false;
                $normal_check = false;

                if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
                    add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_cart_needs_payment', 1000, 2);

                    $rfq_check = true;
                    $normal_check = false;

                    if (get_option('settings_gpls_woo_rfq_show_prices', 'no') == 'yes') {
                        $rfq_check = false;
                        $normal_check = true;
                    }
                }

                if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
                    $rfq_check = false;
                    $normal_check = true;
                }

                if (function_exists('wp_get_current_user')) {
                    if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                        $rfq_check = true;
                        $normal_check = false;
                        $hide_visitor = true;

                    }
                }


                if (($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq")) {


                    $hide = false;

                    $hide_price = get_post_meta($product->get_id(), '_gpls_woo_rfq_hide_price', true);


                    $hide_all = get_option('settings_gpls_woo_rfq_limit_to_rfq_only_hide_prices', 'no');

                    $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
                    $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

                    if ($hide_price == 'yes' || ($hide_all == 'yes' && $rfq_enable == 'yes')) {

                        $hide = true;
                    }


                    if ((get_option('settings_gpls_woo_rfq_show_prices', 'no') == 'no') || $hide == true) {

                        if (!is_admin()) {
                            $url_gpls_wh_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_wh.css';
                            $url_gpls_wh_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_wh.css';
                            wp_enqueue_style('url_gpls_wh_css', $url_gpls_wh_css, array(), filemtime($url_gpls_wh_path));

                            $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/gpls_wh.js';
                            $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/gpls_wh.js';
                            wp_enqueue_script('url_gpls_wh_js', $url_js, array('jquery'), filemtime($url_js_path), true);
                        }
                    }


                }


                if (($rfq_enable == 'yes' && $GLOBALS["gpls_woo_rfq_checkout_option"] != "rfq")) {


                    if (($normal_check && get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'no')) {

                        if (!is_admin()) {
                            $url_gpls_wh_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_wh.css';
                            $url_gpls_wh_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_wh.css';
                            wp_enqueue_style('url_gpls_wh_css', $url_gpls_wh_css, array(), filemtime($url_gpls_wh_path));

                            $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/gpls_wh.js';
                            $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/gpls_wh.js';
                            wp_enqueue_script('url_gpls_wh_js', $url_js, array('jquery'), filemtime($url_js_path), true);
                        }
                    }


                    if ($normal_check && $rfq_enable == "yes") {
                        $data = $product->get_data();

                        $this_price = $data["price"];

                        if (trim($data["sale_price"]) != '') {
                            $this_price = $data["sale_price"];
                        }
                        if (trim($this_price) === '') {

                            if (!is_admin()) {
                                $url_gpls_wh_css = gpls_woo_rfq_URL . 'gpls_assets/css/gpls_wh.css';
                                $url_gpls_wh_path = gpls_woo_rfq_DIR . 'gpls_assets/css/gpls_wh.css';
                                wp_enqueue_style('url_gpls_wh_css', $url_gpls_wh_css, array(), filemtime($url_gpls_wh_path));

                                $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/gpls_wh.js';
                                $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/gpls_wh.js';
                                wp_enqueue_script('url_gpls_wh_js', $url_js, array('jquery'), filemtime($url_js_path), true);
                            }
                        }

                    }


                }

            }
        }

    }

    public function gpls_woo_rfq_enqueue_footer_scripts()
    {
        if (!is_admin()) {

            $rfq_product_script = "<script>jQuery(window ).load( function() { jQuery('form.checkout').removeAttr( 'novalidate');
    jQuery('.required').attr('required',true); } ); </script>";

            echo $rfq_product_script;
            // }


        }

    }


    public function gpls_rfq_css_js()
    {
        if (!is_admin()) {
            //  add_action('wp_enqueue_scripts', array($this, 'gpls_woo_rfq_enqueue_jquery_scripts'),1000);
            add_action('wp_enqueue_scripts', array($this, 'gpls_woo_rfq_enqueue_scripts'), 2000);
            add_action('wp_print_footer_scripts', array($this, 'gpls_woo_rfq_enqueue_footer_scripts'), 2000);


        }


    }


    public function gpls_rfq_setup_constants()
    {

        if (!defined('gpls_woo_rfq_DIR')) {

            DEFINE('gpls_woo_rfq_VERSION', '1.1');
            DEFINE('gpls_woo_rfq_DIR', plugin_dir_path(__FILE__));
            DEFINE('gpls_woo_rfq_URL', plugin_dir_url(__FILE__));
            DEFINE('gpls_woo_rfq_FILE_NAME', (__FILE__));
            DEFINE('gpls_woo_rfq_PLUGIN_PATH', untrailingslashit(plugin_basename(__FILE__)));
            DEFINE('gpls_woo_rfq_TEMPLATE_PATH', untrailingslashit(plugin_dir_path(__FILE__)) . '/templates/');
            DEFINE('gpls_woo_rfq_WOO_PATH', untrailingslashit(plugin_dir_path(__FILE__)) . '/woocommerce/');
            DEFINE('gpls_woo_rfq_GLOBAL_NINJA_FORMID', get_option('settings_gpls_woo_ninja_form_option'));
            DEFINE('gpls_woo_rfq_INQUIRE_TEXT', __(get_option('settings_gpls_woo_inquire_text_option'), 'woo-rfq-for-woocommerce'));
        }


        $GLOBALS["gpls_woo_rfq_checkout_option"] = get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout');

        if (trim($GLOBALS["gpls_woo_rfq_checkout_option"]) == '') {
            $GLOBALS["gpls_woo_rfq_checkout_option"] = 'normal_checkout';
            update_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout', true);
        }


        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
            if (get_option('settings_gpls_woo_rfq_show_prices', 'no') == 'no') {

                $GLOBALS["gpls_woo_rfq_checkout_option"] = "rfq";
            }
        }


        $run_option_old_shipping_coupon = get_option('settings_gpls_woo_rfq_old_shipping_coupon', false);

        if (!$run_option_old_shipping_coupon) {

            update_option('settings_gpls_woo_rfq_show_shipping', 'yes', true);
            update_option('settings_gpls_woo_rfq_allow_coupon_entry', 'yes', 'true');
            update_option('settings_gpls_woo_rfq_show_applied_coupons', 'yes', 'true');
            update_option('settings_gpls_woo_rfq_old_shipping_coupon', true);
            update_option('settings_gpls_woo_rfq_old_shipping_coupon', true);


        }


        $GLOBALS["gpls_woo_rfq_show_prices"] = "no";

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq"
            && get_option('settings_gpls_woo_rfq_show_prices', 'no') === 'yes'
        ) {
            $GLOBALS["gpls_woo_rfq_show_prices"] = "yes";
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout"
            && get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'yes'

        ) {
            $GLOBALS["gpls_woo_rfq_show_prices"] = "yes";
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq"
            && get_option('settings_gpls_woo_rfq_show_prices', 'no') === 'no'
        ) {

            $GLOBALS["gpls_woo_rfq_show_prices"] = "no";
        }

        if (function_exists('wp_get_current_user')) {

            if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {

                $GLOBALS["gpls_woo_rfq_show_prices"] = "no";
                $GLOBALS["gpls_woo_rfq_checkout_option"] = "rfq";
                $GLOBALS["hide_for_visitor"] = "yes";

            } else {
                $GLOBALS["hide_for_visitor"] = "no";
            }
        } else {
            $GLOBALS["hide_for_visitor"] = "no";
        }



        do_action('gpls_rfq_setup_constants_action');

    }

    public function gpls_woo_rfq_no_price_enqueue_scripts()
    {


    }


    function footer_action()
    {


    }

    public function remove_rfq_request_menu()
    {

        $home = home_url() . '/quote-request/';

        $rfq_page = get_option('rfq_cart_sc_section_show_link_to_rfq_page', $home);

        $link_to_rfq_page_url = $_SERVER['REQUEST_URI'];

        if ($link_to_rfq_page_url != false && isset($link_to_rfq_page_url)) {

            $link_to_rfq_page_path = $link_to_rfq_page_url;

        } else {
            return;
        }

        $menu_name = 'primary';

        $locations = get_nav_menu_locations();

        $menu_id = $locations[$menu_name];

        $mymenu = wp_get_nav_menu_object($menu_id);

        $menuID = (int)$mymenu->term_id;

        $menu_items = wp_get_nav_menu_items($menuID);

        foreach ($menu_items as $menu_item => $item) {

            if (isset($item->url)) {

                $url = trim($item->url);

                $url = trim(preg_replace('"' . $_SERVER['HTTP_HOST'] . '"', '', $url));
                $url = trim(preg_replace('#^https?://#', '', $url));


                if ($url != false && is_array($url) && isset($url['path'])) {
                    if ($url == trim($link_to_rfq_page_path)) {

                    }
                }
            }
        }


    }

    public function gpls_woo_rfq_setup_custom_css()
    {

    }

    public function gpls_woo_rfq_setup_customer_session()
    {

    }

    public function gpls_woo_rfq_setup_customer_cookie()
    {

        if (!is_admin()) {
            require_once(gpls_woo_rfq_DIR . 'wp-session-manager/wp-session-manager.php');
            require_once(ABSPATH . 'wp-includes/class-phpass.php');

            add_filter('_rfqtk_wp_session_expiration_variant', array($this, 'gpls_woo_rfq_set_expiration_time'), 24 * 60);
            add_filter('_rfqtk_wp_session_expiration', array($this, 'gpls_woo_rfq_set_expiration_variant_time'), 30 * 60);

            $wp_session = RFQTK_WP_Session::get_instance();
        }


    }

    public function gpls_woo_rfq_set_expiration_variant_time($exp)
    {
        return 60 * 30;
    }

    /**
     * Force the cookie expiration time to 24 minutes
     *
     * @access public
     * @since 2.9.18
     * @param int $exp Default expiration (1 hour)
     * @return int
     */
    public function gpls_woo_rfq_set_expiration_time($exp)
    {
        return 60 * 24;
    }


    public function gpls_woo_rfq_logout()
    {

        gpls_woo_rfq_cart_delete(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart');

    }

    /**
     * @param $wpdb
     * @return mixed
     */
    public function gpls_woo_upgrade_routines()
    {
        global $wpdb;
        update_option('gpls_woo_rfq_menu_check', true);
        $enable_fixed = get_option('settings_gpls_woo_rfq_enable_fixed', 'no');

        if ($enable_fixed == 'no') {

            $placeholders = array('_gpls_woo_rfq_rfq_enable', 'gpls_woo_rfq_rfq_enable');
            global $wpdb;

            $wpdb->query($wpdb->prepare(" UPDATE $wpdb->postmeta SET meta_key = %s
 	WHERE $wpdb->postmeta.meta_key = %s",
                $placeholders));

            update_option('settings_gpls_woo_rfq_enable_fixed', 'yes');
        }

        $crons_fixed = get_option('settings_gpls_woo_rfq_crons_fixed', 'no');

        if ($crons_fixed == 'no') {

            wp_clear_scheduled_hook('rfqtk_wp_session_garbage_collection');
            wp_clear_scheduled_hook('rfqtk_wp_session_daily_garbage_collection');
            wp_clear_scheduled_hook('rfqtk_wp_session_monthly_garbage_collection');
            wp_schedule_event(time(), 'twicedaily', 'rfqtk_wp_session_daily_garbage_collection');

            update_option('settings_gpls_woo_rfq_crons_fixed', 'yes');

        }


    }


}


?>