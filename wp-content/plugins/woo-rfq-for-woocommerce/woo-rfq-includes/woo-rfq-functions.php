<?php
/**
 * Functions used by plugins
 */

add_filter('woocommerce_valid_order_statuses_for_payment_complete','rfqtk_statuses_for_payment',100,2);
add_filter('woocommerce_valid_order_statuses_for_payment','rfqtk_statuses_for_payment',100,2);

if (!function_exists('rfqtk_first_main')) {

    function rfqtk_first_main()
    {
        if (isset($_REQUEST['pay_for_order']) && strpos($_REQUEST['key'], 'wc_order_', 0) === 0) {

            $GLOBALS["gpls_woo_rfq_show_prices"] = "yes";
            $GLOBALS["hide_for_visitor"] = "no";

            return true;
        }


    }
}



if (!function_exists('rfqtk_statuses_for_payment')) {

    function rfqtk_statuses_for_payment($array, $order)
    {

        array_push($array, 'gplsquote-sent');
        array_push($array, 'wc-gplsquote-sent');
        return $array;
    }
}


if (!function_exists('gpls_woo_rfq_get_mode')) {
    function gpls_woo_rfq_get_mode(&$rfq_check, &$normal_check)
    {
        $rfq_check = false;
        $normal_check = false;

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
            add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_cart_needs_payment', 1000, 2);
            $rfq_check = true;
            $normal_check = false;
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
            $rfq_check = false;
            $normal_check = true;
        }

        if(function_exists('wp_get_current_user')) {
            if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                $rfq_check = true;
                $normal_check = false;

            }
        }

    }
}

    if (!function_exists('gpls_woo_wc_price')) {
        function gpls_woo_wc_price($return, $price, $args)
        {
            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq") {

                if (trim($price) === '') {
                    return ' ';
                }
            }

        }
    }

    if (!function_exists('gpls_woo_rfq_woocommerce_empty_price_html')) {
        function gpls_woo_rfq_woocommerce_empty_price_html($html, $product=null)
        {
            if (isset($product) && is_object($product)) {

                if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq") {


                    $data = $product->get_data();

                    $this_price = $data["price"];

                    if (trim($data["sale_price"]) != '') {
                        $this_price = $data["sale_price"];
                    }
                    if (trim($this_price) === '') {

                        return ' ';
                    }
                }
            }
            return $html;
        }
    }


if(!function_exists('gpls_woo_rfq_plus_startsWith')) {
    function gpls_woo_rfq_plus_startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}

if(!function_exists('gpls_woo_rfq_plus_endsWith')) {
    function gpls_woo_rfq_plus_endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}

if (!function_exists('gpls_empty')) {
    function gpls_empty($var)
    {
        if(!isset($var) || $var == false){
            return true;
        }else{
            return false;
        }

    }
}