<?php

/**
 * Main class
 *
 */
if (!class_exists('gpls_woo_rfq_CART')) {

    class gpls_woo_rfq_CART
    {
        public function __construct()
        {


            add_action("woocommerce_add_to_cart", "gpls_woo_rfq_woocommerce_add_to_cart", PHP_INT_MAX - 1, 6);

            add_filter('woocommerce_product_single_add_to_cart_text', array($this, 'woo_custom_cart_button_text'), 100, 2);
            add_filter('woocommerce_product_add_to_cart_text', array($this, 'woo_custom_cart_button_text'), 100, 2);
            add_filter('woocommerce_loop_add_to_cart_link', array($this, 'gpls_woo_rfq_add_to_cart_link_shop'), -1000, 2);
            add_action('woocommerce_after_add_to_cart_button', array($this, 'gpls_woo_rfq_after_add_to_cart_button'), 1000);
            add_action('woocommerce_before_add_to_cart_button', array($this, 'gpls_woo_rfq_before_add_to_cart_button'), 1000);
            add_action('woocommerce_after_shop_loop_item', array($this, 'gpls_woo_rfq_after_after_shop_loop_item'), 100);
            add_filter('woocommerce_cart_item_remove_link', 'gpls_woo_rfq_cart_item_remove_link', 100, 2);
            add_action("woocommerce_after_cart", array($this, "gpls_woo_rfq_woocommerce_after_cart"), 1000);
            add_action("woocommerce_after_cart_totals", array($this, "gpls_woo_rfq_woocommerce_after_cart"), 1000);



            $is_checkout_cart_routine = false;
            $checkout_option = $GLOBALS["gpls_woo_rfq_checkout_option"];

            if ($checkout_option == "normal_checkout" || isset($_POST["rfq_product_id"])) {

                $is_checkout_cart_routine = true;

            }

            if ($checkout_option == "rfq") {

                $is_checkout_cart_routine = false;

            }

            $is_checkout_cart_routine = apply_filters('gpls_woo_rfq_normal_cart_routine_filter', $is_checkout_cart_routine, $checkout_option, $_REQUEST);

            if ($is_checkout_cart_routine == true) {

                $this->gpls_woo_rfq_normal_checkout_cart_routine();

            }


            $ajax_cart_en = get_option( 'woocommerce_enable_ajax_add_to_cart' ,'no');
            if ($ajax_cart_en =="yes" ) {
                add_action('wp_print_footer_scripts', array($this, 'gpls_woo_rfq_ajax_add_to_quote_print_script'), 1000);
            }

        }


        public function gpls_woo_rfq_ajax_add_to_quote_print_script()
        {

            ?>
            <script type="application/javascript">
                jQuery(window).load(function () {

                    // this is the ID of your FORM tag
                    jQuery(".woo_rfq_after_shop_loop_button").submit(function (e) {
                        e.preventDefault(); // this disables the submit button so the user stays on the page
                        // this collects all of the data submitted by the form

                        var form = jQuery(this); //wrap this in jQuery
                        var rfq_button_id = "#rfq_button_" + jQuery(form).data('rfq-product-id');
                        var image_div = "#image_" + jQuery(form).data('rfq-product-id');
                        jQuery(image_div).show();
                        var str = jQuery(this).serialize();
                        jQuery.ajax({
                            type: "POST", // the kind of data we are sending
                            url: form.attr('action'), // this is the file that processes the form data
                            data: str, // this is our serialized data from the form
                            success: function (msg) {	// anything in this function runs when the data has been successfully processed
                                <?php
                                $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();
                                $view_your_cart_text = get_option('rfq_cart_wordings_view_rfq_cart', __('View List', 'woo-rfq-for-woocommerce'));
                                $view_your_cart_text = __($view_your_cart_text, 'woo-rfq-for-woocommerce');

                                ?>
                                // This is shown when everything goes okay
                                result = "<a  class='link_to_rfq_page_link' href='<?php echo $link_to_rfq_page ?>' >&nbsp;<?php echo $view_your_cart_text ?>&nbsp;</a>";
                                var note_id = "#note_" + jQuery(form).data('rfq-product-id');

                                if (typeof msg.data !== 'undefined' && typeof msg.data.location !== 'undefined') {
                                    //alert(msg.data.location);
                                    window.location.replace( msg.data.location );

                                }else{
                                    jQuery(note_id).html(result); // display the messages in the #note DIV
                                    jQuery(image_div).hide();
                                    jQuery(rfq_button_id).addClass('gpls_hidden');
                                   // return false;
                                }
                                ;
                            }
                        });
                    });
                });
            </script>

            <?php
        }


        public function gpls_woo_rfq_normal_checkout_cart_routine()
        {
            //  if (!is_admin())
            {
                /*    */

                // gpls_woo_rfq_remove_filters_normal_checkout();
                if (!is_admin()) {
                    add_action('init', 'gpls_woo_rfq_print_script', -1000);
                }

                add_filter('woocommerce_add_cart_item_data', array($this, 'gpls_woo_rfq_add_cart_item_data'), 1000, 3);
                add_action("gpls_woo_rfq_before_cart", array($this, "gpls_woo_rfq_cart_before_cart"), 1000);
                add_filter('woocommerce_widget_cart_is_hidden', array($this, 'filter_woocommerce_widget_cart_is_hidden'), 1000, 1);


            }
        }


        public function filter_woocommerce_widget_cart_is_hidden($is_cart)
        {

            $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();

            if (trim($link_to_rfq_page) == trim(preg_replace('{/$}', '', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])) || isset($_REQUEST['removed_item'])) {

                $is_cart = true;
            }

            return $is_cart;


        }

        public function gpls_woo_rfq_cart_before_cart()
        {
            $gpls_woo_rfq_cart = gpls_woo_rfq_get_item(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart');
        }


        public function gpls_woo_rfq_wwoocommerce_get_cart_item_from_session($session_data, $values, $key)
        {
            if (is_cart() == true)

                if (isset($key['rfq'])) {
                    if ($key['rfq'] == 'yes') {
                        $session_data = null;
                    }
                }

            return $session_data;

        }


        public function gpls_woo_rfq_woocommerce_cart_is_empty()
        {


        }

        public function gpls_woo_rfq_woocommerce_before_cart()
        {


        }


        public function gpls_woo_rfq_woocommerce_after_mini_cart()
        {
        }

        public function gpls_woo_rfq_woocommerce_before_mini_cart()
        {


        }

        public function gpls_woo_rfq_woocommerce_after_cart()
        {
            $rfq_check = false;
            $normal_check = false;

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {

                $rfq_check = true;
                $normal_check = false;
            }

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
                $rfq_check = false;
                $normal_check = true;
            }

            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $rfq_check = true;
                    $normal_check = false;

                }
            }


            if ($rfq_check) {

                $rfq_product_script = "<script>jQuery( document ).ready( function() { jQuery( '.tax-rate' ).hide(); jQuery( '.cart-subtotal' ).hide(); jQuery( '.order-total' ).hide();jQuery( '.tax-total' ).hide();} ); </script>";
            } else {
                $rfq_product_script = '';
            }
            echo $rfq_product_script;


        }


        public function gpls_woo_rfq_woocommerce_cart_item_visible($visible, $cart_item, $cart_item_key)
        {
            // echo 'gpls_woo_rfq_woocommerce_cart_item_visible';
            if (isset($cart_item['rfq'])) {
                if ($cart_item['rfq'] == 'yes') {
                    $visible = false;
                }
            }

            return $visible;

        }


        public function gpls_woo_rfq_add_cart_item_data($cart_item_data, $product_id, $variation_id)
        {
            //echo 'gpls_woo_rfq_add_cart_item_data';

            $checkout_option = $GLOBALS["gpls_woo_rfq_checkout_option"];

            if ($checkout_option == "rfq") {
                return;
            }
            //echo $_REQUEST["rfq_product_id"].'<br />';
            $is_an_rfq = false;

            $rfq_enable = get_post_meta($product_id, '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product_id);

            if ($rfq_enable == 'yes' && isset($_REQUEST["rfq_product_id"])) {
                $is_an_rfq = true;
            }

            if (isset($_REQUEST['action'])) {
                if ($_REQUEST['action'] == "add_vpc_configuration_to_cart") {
                    //$is_an_rfq_true_false = true;
                }
            }


            $is_an_rfq = apply_filters('gpls_woo_rfq_is_an_rfq_add_cart_item_data', $is_an_rfq, $_REQUEST, $cart_item_data, $product_id, $variation_id, $rfq_enable);

            if ($is_an_rfq) {
                $cart_item_data['rfq'] = 'yes';
                $cart_item_data['restore'] = 'no';
                $cart_item_data['man_deleted'] = 'no';
            } else {
                $cart_item_data['rfq'] = 'no';
                $cart_item_data['restore'] = 'no';
                $cart_item_data['man_deleted'] = 'no';
            };


            return $cart_item_data;

        }


        public function gpls_woo_rfq_remove_rfq_cart_item()
        {
        }


        public function gpls_woo_rfq_after_after_shop_loop_item()
        {
            global $product;

            if ($product->get_type() == 'external') {
                return;
            }

            $hide_button = apply_filters('gplsrfq_hide_after_shop_loop_item', false, $product);
            if ($hide_button) {
                return;
            }


            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()
                    && get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout"
                ) {
                    return;
                }
            }


            $form_label = gpls_woo_rfq_INQUIRE_TEXT;

            $rfq_product_script = "";

            $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());


            if ($rfq_enable != 'yes' && $GLOBALS["gpls_woo_rfq_checkout_option"] != "rfq") {

                if ('yes' == get_option('woocommerce_manage_stock') && $product->get_stock_status() != 'instock') {

                    $request_quote = __('Read more', 'woo-rfq-for-woocommerce', '');// "Request Quote"
                    $read_more = get_option('settings_gpls_woo_rfq_read_more', '');// "Request Quote"
                    $read_more = __($read_more, 'woo-rfq-for-woocommerce');

                    if ($read_more != "") {
                        $request_quote = $read_more;// "Request Quote"
                    }

                    $request_quote = apply_filters('gpls_woo_rfq_out_of_stock_text', $request_quote);
                }

                global $rfq_cart;

                global $rfq_variations;

                $in_rfq = false;

                $gpls_woo_rfq_cart = gpls_woo_rfq_get_item(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart');

                if (($gpls_woo_rfq_cart != false)) {

                    foreach ($gpls_woo_rfq_cart as $cart_item_key => $values) {

                        if (isset($values['product_id'])) {
                            $product_id = $values['product_id'];


                            if (get_the_ID() == $product_id && $values['rfq'] == "yes" && $values['restore'] == 'yes') {
                                $in_rfq = true;
                            }
                        }
                    }

                }

                if (($in_rfq == true && $product->get_type() != 'variable' && $product->get_type() != 'bundle')) {

                    $request_quote = get_option('rfq_cart_wordings_in_rfq', __('In Quote List', 'woo-rfq-for-woocommerce'));//"In RFQ"
                    $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                    $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);

                } else {
                    $request_quote = get_option('rfq_cart_wordings_add_to_rfq', __('Add To Quote', 'woo-rfq-for-woocommerce'));// "Request Quote"
                    $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                    $request_quote = apply_filters('gpls_woo_rfq_request_quote_text', $request_quote);
                }


                $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();

                $view_your_cart_text = get_option('rfq_cart_wordings_view_rfq_cart', __('View List', 'woo-rfq-for-woocommerce'));
                $view_your_cart_text = __($view_your_cart_text, 'woo-rfq-for-woocommerce');


                ?>

                <?php if (($in_rfq == true) && isset($link_to_rfq_page)) : ?>
                    <?php

                    echo <<< eod
<div style="display: block"><a  class="link_to_rfq_page_link" href="{$link_to_rfq_page}" >&nbsp;{$view_your_cart_text}&nbsp;</a></div>
eod;

                    ?>
                <?php endif; ?>

                <?php
            }


            ?>
            <?php if ($rfq_enable == 'yes' && $GLOBALS["gpls_woo_rfq_checkout_option"] == "normal_checkout") : ?>

            <?php

            $rfq_check = false;
            $normal_check = false;

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {

                $rfq_check = true;
                $normal_check = false;
            }

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
                $rfq_check = false;
                $normal_check = true;
            }

            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $rfq_check = true;
                    $normal_check = false;

                }
            }
            if ($rfq_check) {
                $rfq_product_script = "";
            }


            $rfq_id = $product->get_id();

            global $rfq_cart;

            global $rfq_variations;

            $in_rfq = false;

            $gpls_woo_rfq_cart = gpls_woo_rfq_get_item(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart');

            if (($gpls_woo_rfq_cart != false)) {

                foreach ($gpls_woo_rfq_cart as $cart_item_key => $values) {

                    if (isset($values['product_id'])) {
                        $product_id = $values['product_id'];


                        if (get_the_ID() == $product_id && $values['rfq'] == "yes" && $values['restore'] == 'yes') {
                            $in_rfq = true;
                        }
                    }
                }

            }

            if (($in_rfq == true && $product->get_type() != 'variable' && $product->get_type() != 'bundle')) {

                $request_quote = get_option('rfq_cart_wordings_in_rfq', __('In Quote List', 'woo-rfq-for-woocommerce'));//"In RFQ"
                $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);

            } else {
                $request_quote = get_option('rfq_cart_wordings_add_to_rfq', __('Add To Quote', 'woo-rfq-for-woocommerce'));// "Request Quote"
                $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                $request_quote = apply_filters('gpls_woo_rfq_request_quote_text', $request_quote);
            }

            $no_add_to_cart = get_post_meta($product->get_id(), '_gpls_woo_rfq_no_add_to_cart', true);
            if ($no_add_to_cart == null) {
                $no_add_to_cart = 'no';
            }

            $no_add_to_cart = apply_filters('gpls_woo_rfq_no_add_to_cart', $no_add_to_cart, $product, $normal_check);

            if ($normal_check == true) {

                if (($in_rfq == false && $product->get_type() == 'simple')) {
                    //return;
                }
                if (($in_rfq == false && $product->get_type() == 'variable')) {


                    if (get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'yes' && $no_add_to_cart == 'no') {

                        return;

                    }

                    if (get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'yes' && $no_add_to_cart == 'yes') {
                        //  return;
                        $request_quote = __('Select options', 'woo-rfq-for-woocommerce');//"In RFQ"
                        $select_options = get_option('settings_gpls_woo_rfq_Select_Options', $request_quote);// "Request Quote"
                        $select_options = __($select_options, 'woo-rfq-for-woocommerce');

                        if ($select_options != "") {
                            $request_quote = $select_options;// "Request Quote"
                        }

                        $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);
                    }


                    if (get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'no' && $no_add_to_cart == 'no') {
                        //  return;
                        $request_quote = __('Select options', 'woo-rfq-for-woocommerce');//"In RFQ"
                        $select_options = get_option('settings_gpls_woo_rfq_Select_Options', $request_quote);// "Request Quote"
                        $select_options = __($select_options, 'woo-rfq-for-woocommerce');

                        if ($select_options != "") {
                            $request_quote = $select_options;// "Request Quote"
                        }

                        $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);


                    }

                    if (get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'no' && $no_add_to_cart == 'yes') {
                        //  return;
                        $request_quote = __('Select options', 'woo-rfq-for-woocommerce');//"In RFQ"
                        $select_options = get_option('settings_gpls_woo_rfq_Select_Options', $request_quote);// "Request Quote"
                        $select_options = __($select_options, 'woo-rfq-for-woocommerce');

                        if ($select_options != "") {
                            $request_quote = $select_options;// "Request Quote"
                        }

                        $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);


                    }


                }
            }


            $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();

            $view_your_cart_text = get_option('rfq_cart_wordings_view_rfq_cart', __('View List', 'woo-rfq-for-woocommerce'));
            $view_your_cart_text = __($view_your_cart_text, 'woo-rfq-for-woocommerce');


            $proceed = apply_filters('gpls_woo_rfq_after_after_shop_loop_item_proceed', true);


            ?>

            <?php if ($in_rfq == false)  : ?>


                <?php if ($proceed == true) : ?>

                    <?php
                    $gpls_woo_rfq_file_add_to_quote_styles = array();
                    $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_styles'] = '';
                    $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_onmouseover'] = '';
                    $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_background_onmouseover'] = '';
                    $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_onmouseout'] = '';
                    $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_background_onmouseout'] = '';

                    $gpls_woo_rfq_file_add_to_quote_styles = apply_filters('gpls_woo_rfq_add_to_quote_styles', $gpls_woo_rfq_file_add_to_quote_styles);


                    ?>


                    <form style="display: block" class="woo_rfq_after_shop_loop_button"
                          data-rfq-product-id='<?php echo $rfq_id; ?>'
                          action='<?php echo esc_url($product->add_to_cart_url()) ?>' method='post'>
                        <?php $nonce = wp_create_nonce('rfq_id_nonce');
                        wp_nonce_field('rfq_id_nonce'); ?>
                        <input type='hidden' value='<?php echo $rfq_id; ?>' name='rfq_id' id='rfq_id'/>
                        <input class='variation_id' type='hidden' id='rfq_variation_id' name='rfq_variation_id'/>
                        <input type='hidden' value='<?php echo $product->get_id(); ?>' name='rfq_product_id'
                               id='rfq_product_id'/>
                        <input type='submit' name='submit' value='<?php echo $request_quote ?>' id='rfq_button_<?php echo $rfq_id; ?>' class='button rfq_button'
                               style="<?php echo $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_styles'] ?>"
                               onmouseover="<?php echo $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_onmouseover'] . ';' . $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_background_onmouseover'] ?>"
                               onmouseout="<?php echo $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_onmouseout'] . ';' . $gpls_woo_rfq_file_add_to_quote_styles['gpls_woo_rfq_page_button_background_onmouseout'] ?>"/>
                        <div style="display:none" id='image_<?php echo $rfq_id; ?>'><image  src="<?php echo gpls_woo_rfq_URL ?>/gpls_assets/img/select2-spinner.gif" /></div>
                        <div id='note_<?php echo $rfq_id; ?>'></div>

                    </form>
                <?php endif; ?>

                <?php

                // $single_add_to_cart_after_shop_loop_button = ob_get_clean();

                // $single_add_to_cart_after_shop_loop_button = apply_filters('gpls_woo_rfq_after_shop_loop_button', $single_add_to_cart_after_shop_loop_button, $in_rfq, $rfq_check, $normal_check, $rfq_enable, $product);
                // echo $single_add_to_cart_after_shop_loop_button;
                ?>
                <?php

                ?>

            <?php elseif (($in_rfq == true) && isset($link_to_rfq_page)) : ?>
                <?php

                echo <<< eod
<div style="display: block"><a  class="link_to_rfq_page_link" href="{$link_to_rfq_page}" >&nbsp;{$view_your_cart_text}&nbsp;</a></div>
eod;

                ?>
            <?php endif; ?>


        <?php endif; ?>

            <?php
        }


        public function gpls_woo_rfq_before_add_to_cart_button()
        {


            global $product;

            if ($product->get_type() == 'external') {
                return;
            }

            $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

            if (!is_admin()) {


                $rfq_check = false;
                $normal_check = false;
                //gpls_woo_rfq_get_mode($rfq_check, $normal_check);
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

                if (function_exists('wp_get_current_user')) {
                    if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                        $rfq_check = true;
                        $normal_check = false;

                    }
                }


                if ($rfq_check == false) {

                    if ($rfq_enable == 'no' && $product->get_price() == 0) {

                        //   exit();
                    }


                }

            }


        }


        public function gpls_woo_rfq_after_add_to_cart_button()
        {

            global $product;

            if ($product->get_type() == 'external') {
                return;
            }

            $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

            $form_label = gpls_woo_rfq_INQUIRE_TEXT;

            $rfq_product_script = "";

            $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

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

                }
            }

            ?>


            <?php if ($rfq_enable == 'yes' && $GLOBALS["gpls_woo_rfq_checkout_option"] != "rfq") : ?>

            <?php
            if (($normal_check && get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'no')) {

                if (!is_admin()) {
                    add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script', -1000);
                    add_action('wp_add_inline_script', 'gpls_woo_rfq_print_script', -1000);
                    add_action('wp_enqueue_script', 'gpls_woo_rfq_print_script', -1000);

                    $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).hide();jQuery( '.single_add_to_cart_button' ).attr('style','display: none !important');
jQuery( '.gpls_rfq_set' ).show();jQuery( '.gpls_rfq_set' ).attr('style','display: block !important');
jQuery( '.amount,.bundle_price' ).hide();jQuery( '.amount,.bundle_price' ).attr('style','display: none !important');

} ); </script>";


                    echo $rfq_product_script;
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
                        add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_add_inline_script', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_enqueue_script', 'gpls_woo_rfq_print_script', 1000);

                        $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).hide();jQuery( '.single_add_to_cart_button' ).attr('style','display: none !important');
jQuery( '.gpls_rfq_set' ).show();jQuery( '.gpls_rfq_set' ).attr('style','display: block !important');
jQuery( '.amount,.bundle_price' ).hide();jQuery( '.amount, .bundle_price' ).attr('style','display: none !important');

} ); </script>";


                        echo $rfq_product_script;
                    }
                }

            }


            $rfq_id = $product->get_id();

            global $rfq_cart;

            global $rfq_variations;

            $in_rfq = false;


            $gpls_woo_rfq_cart = gpls_woo_rfq_get_item(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart');

            if (($gpls_woo_rfq_cart != false)) {

                foreach ($gpls_woo_rfq_cart as $cart_item_key => $values) {

                    if (isset($values['product_id'])) {
                        $product_id = $values['product_id'];


                        if (get_the_ID() == $product_id && $values['rfq'] == "yes" && $values['restore'] == 'yes') {
                            $in_rfq = true;
                        }
                    }
                }

            }

            if (($in_rfq == true && $product->get_type() != 'variable' && $product->get_type() != 'bundle')) {

                $request_quote = get_option('rfq_cart_wordings_in_rfq', __('Add To Quote', 'woo-rfq-for-woocommerce'));//"In RFQ"
                $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');
                $request_quote = apply_filters('gpls_woo_rfq_in_rfq_text', $request_quote);

            } else {
                $request_quote = get_option('rfq_cart_wordings_add_to_rfq', __('Add To Quote', 'woo-rfq-for-woocommerce'));// "Request Quote"
                $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                $request_quote = apply_filters('gpls_woo_rfq_request_quote_text', $request_quote);

            }
            $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();

            $view_your_cart_text = get_option('rfq_cart_wordings_view_rfq_cart', __('View List', 'woo-rfq-for-woocommerce'));
            $view_your_cart_text = __($view_your_cart_text, 'woo-rfq-for-woocommerce');
            $view_your_cart_text = apply_filters('gpls_woo_rfq_request_quote_text', $view_your_cart_text);

            $single_add_to_cart_button = "<div class='gpls_rfq_set_div' style='clear: both'>
                <button type='submit' name='add-to-cart' class='single_add_to_cart_button button alt  gpls_rfq_set' value='" . $product->get_id() . "'>" . esc_html($request_quote) . "</button>
                <input type='hidden' value='-1' name='rfq_product_id' id='rfq_product_id'/>
                <input type='hidden'  name='rfq_single_product' id='rfq_product_id'/>
                <!--<input type='hidden' name='rfq_id' id='rfq_id'/>-->";


            $single_add_to_cart_button = apply_filters('gpls_woo_rfq_single_add_to_cart_button', $single_add_to_cart_button, $in_rfq, $rfq_check, $normal_check, $rfq_enable, $product);

            ?>


            <?php
            echo $single_add_to_cart_button;
            echo $rfq_product_script;

            ?>


            <?php if (($in_rfq == true) && isset($link_to_rfq_page)) : ?>
                <?php
                $view_rfq_cart_button = "<a class='button gpls_rfq_set rfqcart-link' href='" . $link_to_rfq_page . "'>" . $view_your_cart_text . "</a>";


                $view_rfq_cart_button = apply_filters('gpls_woo_rfq_view_rfq_cart_button', $view_rfq_cart_button, $in_rfq, $rfq_check, $normal_check, $rfq_enable, $product);

                echo $view_rfq_cart_button;
                ?>


                <!--<a class='gpls_rfq_set rfqcart-link' href='<?php /*echo $link_to_rfq_page */ ?>'><?php /*echo $view_your_cart_text */ ?></a>-->
            <?php endif; ?>

            </div>

        <?php else: ?>
            <?php
            if (!is_admin()) {
                add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script_show_single_add', 1000);


                $rfq_product_script = "<script>jQuery(document ).ready( function() { 
    jQuery( '.single_add_to_cart_button' ).show();
    jQuery( '.single_add_to_cart_button' ).attr('style','display: block !important');
jQuery('.single_add_to_cart_button').prop('disabled',false);;
                 jQuery('.gpls_rfq_set').prop('disabled', false);
    }); </script>";


                echo $rfq_product_script;
            }
            ?>
        <?php endif; ?>

            <?php

            if ($rfq_check) {
                //  $rfq_product_script = "";
                if (get_option('settings_gpls_woo_rfq_show_prices', 'no') == "no") {

                    if (!is_admin()) {

                        add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_add_inline_script', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_enqueue_script', 'gpls_woo_rfq_print_script', 1000);

                        $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.amount,.bundle_price' ).hide();jQuery( '.amount,.bundle_price' ).attr('style','display: none !important');
            } ); </script>";
                        echo $rfq_product_script;
                    }


                } else {
                    $data = $product->get_data();

                    $this_price = $data["price"];

                    if (trim($data["sale_price"]) != '') {
                        $this_price = $data["sale_price"];
                    }
                    if (trim($this_price) === '') {

                        if (!is_admin()) {
                            add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script', 1000);
                            add_action('wp_add_inline_script', 'gpls_woo_rfq_print_script', 1000);
                            add_action('wp_enqueue_script', 'gpls_woo_rfq_print_script', 1000);

                            $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).hide();jQuery( '.single_add_to_cart_button' ).attr('style','display: none !important');
jQuery( '.gpls_rfq_set' ).hide();jQuery( '.gpls_rfq_set' ).attr('style','display: none !important');
jQuery( '.amount,.bundle_price' ).hide();jQuery( '.amount,.bundle_price' ).attr('style','display: none !important');

} ); </script>";


                            echo $rfq_product_script;
                        }
                    }
                }
            }

            if ($normal_check) {

                $data = $product->get_data();

                $this_price = $data["price"];

                if (trim($data["sale_price"]) != '') {
                    $this_price = $data["sale_price"];
                }
                if (trim($this_price) === '') {

                    if (!is_admin()) {
                        add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_add_inline_script', 'gpls_woo_rfq_print_script', 1000);
                        add_action('wp_enqueue_script', 'gpls_woo_rfq_print_script', 1000);

                        $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).hide();jQuery( '.single_add_to_cart_button' ).attr('style','display: none !important');
jQuery( '.gpls_rfq_set' ).hide();jQuery( '.gpls_rfq_set' ).attr('style','display: none !important');
jQuery( '.amount' ).hide();jQuery( '.amount' ).attr('style','display: none !important');

} ); </script>";


                        echo $rfq_product_script;
                    }
                }

                if (function_exists('wp_get_current_user')) {
                    if (get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == 'yes'

                        && !(get_option('settings_gpls_woo_rfq_hide_visitor_prices_normal', 'no') == 'yes' && !wp_get_current_user()->exists())) {
                        if (!is_admin()) {

                            $data = $product->get_data();

                            $this_price = $data["price"];

                            if (trim($data["sale_price"]) != '') {
                                $this_price = $data["sale_price"];
                            }
                            if (trim($this_price) === '') {
                                $rfq_product_script = "<script>jQuery(window).load( function() {  jQuery( '.single_add_to_cart_button' ).hide();jQuery( '.single_add_to_cart_button' ).attr('style','display: none !important');
jQuery( '.gpls_rfq_set' ).show();jQuery( '.gpls_rfq_set' ).attr('style','display: block !important');jQuery( '.amount,.bundle_price' ).hide();
jQuery( '.amount,.bundle_price' ).attr('style','display: none !important');} ); </script>";

                                $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).show();
jQuery( '.single_add_to_cart_button' ).attr('style','display: block !important');
jQuery('.single_add_to_cart_button').prop('disabled',false);;
                 jQuery('.gpls_rfq_set').prop('disabled', false);
} ); </script>";
                                echo $rfq_product_script;
                            } else {
                                $rfq_product_script = "<script>jQuery(document ).ready( function() { jQuery( '.single_add_to_cart_button' ).show();
jQuery( '.single_add_to_cart_button' ).attr('style','display: block !important');
jQuery('.single_add_to_cart_button').prop('disabled',false);;
                 jQuery('.gpls_rfq_set').prop('disabled', false);

} ); </script>";


                                echo $rfq_product_script;

                                add_action('wp_print_footer_scripts', 'gpls_woo_rfq_print_script_show_single_add', 1000);

                            }


                        }


                    }
                }
            }

        }


        public function gpls_woo_rfq_add_to_cart_link_shop($link, $product)
        {


            if ($product->get_type() == 'external') {
                return $link;
            }


            $read_more = "";
            //  global $product;

            $data = $product->get_data();

            $this_price = $data["price"];

            if (trim($data["sale_price"]) != '') {
                $this_price = $data["sale_price"];
            }

            $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());


            $form_label = gpls_woo_rfq_INQUIRE_TEXT;

            $rfq_product_script = "";


            $rfq_check = false;
            $normal_check = false;
            //gpls_woo_rfq_get_mode($rfq_check, $normal_check);
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
            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $rfq_check = true;
                    $normal_check = false;

                }
            }


            $pf = new WC_Product_Factory();
            $product = $pf->get_product($product->get_id());


            if ($rfq_enable == 'yes') {

                if (($GLOBALS["gpls_woo_rfq_checkout_option"] == "normal_checkout"
                    && get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == "no")
                ) {
                    return;
                }

            }

            if (($GLOBALS["gpls_woo_rfq_checkout_option"] == "normal_checkout"
            )
            ) {

                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes'

                ) {
                    $pf = new WC_Product_Factory();

                    $product = $pf->get_product($product->get_id());

                    $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
                    $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

                    //echo $product->id.' '.$rfq_enable.'<br />';
                    if ($rfq_enable == 'no') {

                        return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);

                    }

                    if ($rfq_enable == "yes") {
                        $data = $product->get_data();

                        $this_price = $data["price"];

                        if (trim($data["sale_price"]) != '') {
                            $this_price = $data["sale_price"];
                        }
                        if (trim($this_price) === '') {

                            if (trim($this_price) === '') {

                                $request_quote = __('Read more', 'woo-rfq-for-woocommerce', '');// "Request Quote"
                                $request_quote = get_option('settings_gpls_woo_rfq_read_more', $request_quote);// "Request Quote"
                                $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');


                                $id = $product->get_id();
                                $sku = $product->get_sku();
                                //$url=esc_url($product->add_to_cart_url());
                                $url = esc_url($product->get_permalink());


                                $link = '<a rel="nofollow" href="' . $url . '" data-product_id="' . $id . '" data-product_sku="' . $sku . '" class="button product_type_simple ajax_add_to_cart">' . $request_quote . '</a>';


                                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);;

                            }
                        }
                        return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);;
                    }
                }


                if ($rfq_enable == 'yes') {

                    if (($GLOBALS["gpls_woo_rfq_checkout_option"] == "normal_checkout"
                        && get_option('settings_gpls_woo_rfq_normal_checkout_show_prices', 'no') == "yes")
                    ) {


                        if (trim($this_price) === '') {

                            $request_quote = __('Read more', 'woo-rfq-for-woocommerce', '');// "Request Quote"
                            $read_more = get_option('settings_gpls_woo_rfq_read_more', '');// "Request Quote"

                            if ($read_more != "") {
                                $request_quote = $read_more;// "Request Quote"
                            }
                            $id = $product->get_id();
                            $sku = $product->get_sku();
                            //$url=esc_url($product->add_to_cart_url());
                            $url = esc_url($product->get_permalink());
                            $link = '<a rel="nofollow" href="' . $url . '" data-product_id="' . $id . '" data-product_sku="' . $sku . '" class="button product_type_simple ajax_add_to_cart">' . $request_quote . '</a>';

                            return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);

                        }
                    }
                    return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);
                }


            }

            if ($rfq_check == true) {

                $GLOBALS["gpls_woo_rfq_checkout_option"] = "rfq";

            }

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq"
                && get_option('settings_gpls_woo_rfq_show_prices', 'no') == "yes"
                && get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes'
            ) {

                if (trim($this_price) === '') {

                    $request_quote = __('Read more', 'woo-rfq-for-woocommerce', '');// "Request Quote"
                    $request_quote = get_option('settings_gpls_woo_rfq_read_more', $request_quote);// "Request Quote"
                    $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                    if ($read_more != "") {
                        $request_quote = $read_more;// "Request Quote"
                    }

                    $id = $product->get_id();
                    $sku = $product->get_sku();
                    //  $url=esc_url($product->add_to_cart_url());

                    $url = esc_url($product->get_permalink());


                    $link = '<a rel="nofollow" href="' . $url . '" data-product_id="' . $id . '" data-product_sku="' . $sku . '" class="button product_type_simple ajax_add_to_cart">' . $request_quote . '</a>';

                    return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);

                }
                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);
            }


            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq"
                && get_option('settings_gpls_woo_rfq_show_prices', 'no') == "yes"

            ) {

                if (trim($this_price) === '') {

                    $request_quote = __('Read more', 'woo-rfq-for-woocommerce', '');// "Request Quote"
                    $request_quote = get_option('settings_gpls_woo_rfq_read_more', '');// "Request Quote"
                    $request_quote = __($request_quote, 'woo-rfq-for-woocommerce');

                    if ($read_more != "") {
                        $request_quote = $read_more;// "Request Quote"
                    }

                    $id = $product->get_id();
                    $sku = $product->get_sku();
                    //  $url=esc_url($product->add_to_cart_url());

                    $url = esc_url($product->get_permalink());


                    $link = '<a rel="nofollow" href="' . $url . '" data-product_id="' . $id . '" data-product_sku="' . $sku . '" class="button product_type_simple ajax_add_to_cart">' . $request_quote . '</a>';

                    return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);

                }
                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);
            }

            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "normal_checkout" && $rfq_enable != 'yes') {

                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);

            }


            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq" && get_option('settings_gpls_woo_rfq_show_prices', 'no') == "no") {

                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);
            }

            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq" && get_option('settings_gpls_woo_rfq_show_prices', 'no') == "yes"
                && get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes'
            ) {
                return $link = apply_filters("gplsrfq_add_to_cart_link_shop", $link, $product);
            }


        }


        public function woo_custom_cart_button_text($product_add_to_cart_text, $product)
        {

//global $product;
            if ($product->get_type() == 'external') {
                return $product_add_to_cart_text;
            }

            if (($product->get_type() == 'variable') && !is_product()) {

                return $product_add_to_cart_text;//"In RFQ"

            }


            $rfq_check = false;
            $normal_check = false;
            //gpls_woo_rfq_get_mode($rfq_check, $normal_check);
            $rfq_check = false;
            $normal_check = false;
            $checkout = "";

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
                add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_cart_needs_payment', 1000, 2);
                $rfq_check = true;
                $normal_check = false;
                $checkout = "rfq";
            }

            if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
                $rfq_check = false;
                $normal_check = true;
                $checkout = "normal";
            }

            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {
                    $rfq_check = true;
                    $normal_check = false;
                    $checkout = "rfq";
                }
            }


            if ($rfq_check) {
                $default_text = __('Add to Quote', 'woo-rfq-for-woocommerce');
                $default_text = __($default_text, 'woo-rfq-for-woocommerce');
            } else {
                $default_text = __('Add to Cart', 'woo-rfq-for-woocommerce');
                $default_text = __($default_text, 'woo-rfq-for-woocommerce');
            }


            global $product;
            global $woocommerce;


            if ($normal_check) {

                $rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
                $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());


                if ($rfq_enable != "yes" || !isset($rfq_enable)) {
                    // if (!(get_option('settings_gpls_woo_rfq_hide_visitor_prices_normal', 'no') == 'yes' && !wp_get_current_user()->exists())) {
                    $add_txt = $product_add_to_cart_text;
                    return $product_add_to_cart_text;
                    // }
                }
            }


            $add_txt = get_option('rfq_cart_wordings_add_to_cart', $default_text);
            $add_txt = __($add_txt, 'woo-rfq-for-woocommerce');

            $in_txt = get_option('rfq_cart_wordings_in_cart', $default_text);
            $in_txt = __($in_txt, 'woo-rfq-for-woocommerce');


            if (function_exists('wp_get_current_user')) {
                if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !wp_get_current_user()->exists()) {

                    $add_txt = get_option('rfq_cart_wordings_add_to_rfq', $default_text);
                    $add_txt = __($add_txt, 'woo-rfq-for-woocommerce');

                    $in_txt = get_option('rfq_cart_wordings_in_rfq', $default_text);
                    $in_txt = __($in_txt, 'woo-rfq-for-woocommerce');

                }
            }


            if (isset($woocommerce) && $woocommerce != null && $woocommerce->cart != null) {
                foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
                    $_product = $values['data'];

                    if (get_the_ID() == $_product->get_id()) {

                        $add_txt = $in_txt;
                        break;

                    }
                }
            }

            $rfq_checkout_mode = $checkout;

            $add_txt = apply_filters('gpls_woo_rfq_custom_add_to_cart_button_text', $add_txt, $product, $rfq_checkout_mode);

            do_action('gpls_woo_rfq_add_to_cart_button_text_action', $add_txt, $product, $rfq_checkout_mode);


            return $add_txt;
            //return $btn_txt;


        }

        /**
         * @param $wp
         * @return array
         */
        public function get_url()
        {
            $link_to_rfq_page = pls_woo_rfq_get_link_to_rfq();
            global $wp;
            $current_url = gpls_woo_rfq_remove_http(home_url(add_query_arg(array(), $wp->request)));
            return $current_url;

        }


    }

}

