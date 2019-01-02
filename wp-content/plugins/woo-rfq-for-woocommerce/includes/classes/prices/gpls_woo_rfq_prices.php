<?php

/**
 * Main class
 *
 */

if (!class_exists('gpls_woo_rfq_prices')) {

    class gpls_woo_rfq_prices
    {
        public function __construct()
        {



            if (!is_admin()) {

                $rfq_check = false;
                $normal_check = false;
                //gpls_woo_rfq_get_mode($rfq_check,$normal_check);
                $rfq_check = false;
                $normal_check = false;

                if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
                    add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_cart_needs_payment', 1000, 2);

                    $rfq_check = true;
                    $normal_check = false;

                    if (get_option('settings_gpls_woo_rfq_show_prices', 'no') == 'yes')
                    {
                      $rfq_check = false;
                      $normal_check = true;
                    }
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


                if ($rfq_check == true) {

                    $GLOBALS["gpls_woo_rfq_checkout_option"] = "rfq";

                    if(!is_admin()) {
                        add_action('init', 'gpls_woo_rfq_init_wp_enqueue_scripts', 1000);


                        if (get_option('settings_gpls_woo_rfq_show_prices', 'no') === 'no') {
                            add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_css', 1000);
                        }
                    }

                    add_filter('woocommerce_is_purchasable', 'gpls_woo_rfq_is_purchasable', 1000, 2);

                    add_filter( 'woocommerce_variation_is_purchasable', 'gpls_woo_rfq_is_purchasable', 1000, 2 );

                    add_filter( 'woocommerce_cart_needs_payment','gpls_woo_rfq_cart_needs_payment',1000,2);

                    $this->price_handling_function_for_rfq_only();

                }
                if ($normal_check == true) {

                    add_filter('woocommerce_is_purchasable', 'gpls_woo_rfq_normal_is_purchasable', 1000, 2);
                    add_filter('woocommerce_variation_is_purchasable', 'gpls_woo_rfq_normal_is_purchasable', 1000, 2);
                }



                add_filter('woocommerce_coupons_enabled', 'gpls_woo_rfq_woocommerce_coupons_enabled', 10, 1);

                $this->price_handling_function_for_rfq_and_normal();

                $this->subtotals_and_totals_for_rfq_and_normal();


                if(!is_admin()) {
                    if (($GLOBALS["gpls_woo_rfq_show_prices"] == 'no' || $GLOBALS["hide_for_visitor"] === "yes")
                        && $GLOBALS["gpls_woo_rfq_checkout_option"] == "normal"
                    ) {
                        add_action('wp_enqueue_scripts', 'gpls_woo_add_rfq_cart_custom_css', 1000);
                    }
                }

                if (get_option('settings_gpls_woo_rfq_show_cart_link_archive_top') == "yes") {
                    add_action('woocommerce_archive_description', 'gpls_woo_rfq_before_main_content', 100);
                }

                if (get_option('settings_gpls_woo_rfq_show_cart_link_archive_end') == "yes") {
                    add_action('woocommerce_after_main_content', 'gpls_woo_rfq_before_main_content', 100);
                }

                if (get_option('settings_gpls_woo_rfq_show_cart_link_cart') == "yes") {
                    add_action('woocommerce_before_cart', 'gpls_woo_rfq_before_main_content', 100);
                }


                if (get_option('settings_gpls_woo_rfq_show_cart_single_page') == "yes") {
                    add_action('woocommerce_before_single_product', 'gpls_woo_rfq_before_main_content', 100);
                }

                if (get_option('settings_gpls_woo_rfq_show_cart_thank_you_page') == "yes") {

                    add_action('woocommerce_thankyou', 'gpls_woo_rfq_woocommerce_thankyou', 100, 1);

                }



                add_action('woocommerce_cart_emptied', 'gpls_woo_rfq_filter_check', 100);
                add_action('gpls_woo_rfq_before_thankyou', 'gpls_woo_rfq_filter_check', 100);



            }

        }

        public function price_handling_function_for_rfq_only()
        {




            if (($GLOBALS["gpls_woo_rfq_show_prices"] == 'no' || $GLOBALS["hide_for_visitor"] === "yes")
                && $GLOBALS["gpls_woo_rfq_checkout_option"] == "normal") {

                add_filter('woocommerce_cart_totals_order_total_html', 'gpls_woo_rfq_total_prices', 1000);

                add_filter('woocommerce_cart_item_price', 'gpls_woo_rfq_hide_cart_prices', 1000, 3);

                add_filter('woocommerce_cart_product_price', 'gpls_woo_rfq_hide_woocommerce_cart_product_price', 1000, 2);

                add_filter('woocommerce_cart_product_subtotal', 'gpls_woo_rfq_hide_woocommerce_cart_product_subtotal', 1000, 3);

                add_filter('woocommerce_cart_item_subtotal', 'gpls_woo_rfq_hide_woocommerce_cart_item_subtotal', 1000, 3);

                add_filter('woocommerce_cart_subtotal', 'gpls_woo_rfq_hide_woocommerce_cart_subtotal', 1000, 3);
                add_filter('woocommerce_cart_totals_taxes_total_html', 'gpls_woo_rfq_total_prices');
                add_filter('woocommerce_cart_totals_fee_html', 'gpls_woo_rfq_woocommerce_cart_totals_fee_html', 1000, 2);
            }


            add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_woocommerce_order_needs_payment', 1000, 2);
            add_filter('wc_add_to_cart_message_html', 'gpls_woo_rfq_remove_cart_notices', 1, 2);

            $remove_totals = false;

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
                //if (get_option('settings_gpls_woo_rfq_show_prices','no') == 'no' )
                {

                    $remove_totals = true;
                }
            }
            if(function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $remove_totals = true;

                }
            }


            if ($remove_totals == true) {

                //  remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
                //  add_action('woocommerce_after_cart', 'woocommerce_button_proceed_to_checkout', 20);

            }

            add_action( 'woocommerce_before_calculate_totals','gpls_woo_rfq_remove_filters', -1000);


        }


        public function price_handling_function_for_rfq_and_normal()
        {



            add_filter('woocommerce_cart_product_price', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_get_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_sale_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);


            add_filter('woocommerce_bundle_sale_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_bundle_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_grouped_free_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_bundled_free_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_variation_free_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_variable_free_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_free_sale_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);
            add_filter('woocommerce_free_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);            //
            add_filter('woocommerce_get_variation_price_html', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);


            add_filter('woocommerce_product_is_on_sale', 'gpls_woo_rfq_product_is_on_sale', 1000, 2);
            add_filter('woocommerce_bundle_is_on_sale', 'gpls_woo_rfq_product_is_on_sale', 1000, 2);

            add_filter( 'woocommerce_get_variation_price', 'gpls_woo_rfq_individual_price_hidden_variation_html', 1000, 4 );
            add_filter( 'woocommerce_get_variation_sale_price', 'gpls_woo_rfq_individual_price_hidden_variation_html', 1000, 4  );
            add_filter( 'woocommerce_get_variation_regular_price', 'gpls_woo_rfq_individual_price_hidden_variation_html', 1000, 4  );

          //  add_action( 'woocommerce_before_calculate_totals','gpls_woo_rfq_remove_filters_normal_checkout', -1000);

            //  add_filter('woocommerce_get_price_excluding_tax', 'gpls_woo_rfq_individual_price_hidden_tax', 1000, 3);//remove at checkout
            //  add_filter('woocommerce_get_price_including_tax', 'gpls_woo_rfq_individual_price_hidden_tax', 1000, 3);//remove at checkout
            //  add_filter('woocommerce_product_get_price', 'gpls_woo_rfq_individual_price_hidden_html', 1000, 2);//remove at checkout
            // add_filter('woocommerce_get_price_html_from_to', 'gpls_woo_rfq_individual_price_html_from_to', 1000, 4);//remove at checkout


        }

        public function subtotals_and_totals_for_rfq_and_normal()
        {

            //if (($GLOBALS["gpls_woo_rfq_show_prices"] == 'no' || $GLOBALS["hide_for_visitor"] === "yes") && $GLOBALS["gpls_woo_rfq_checkout_option"] == "normal")
            {

                add_filter('woocommerce_order_formatted_line_subtotal', 'gpls_woo_rfq_order_formatted_line_subtotal', 100, 3);
                add_filter('woocommerce_get_formatted_order_total', 'gpls_woo_rfq_get_formatted_order_total', 100, 2);
                add_filter('woocommerce_get_order_item_totals', 'gpls_woo_rfq_woocommerce_get_order_item_totals', 100, 2);
            }

        }

        /**
         * Hides the 'Free!' price notice
         */
       public function hide_simple_free_price_notice($price, $product)
        {
            $price = ' ';
            return $price;
        }

        public function hide_free_price_notice($product)
        {

            return ' ';
        }








    }
}
