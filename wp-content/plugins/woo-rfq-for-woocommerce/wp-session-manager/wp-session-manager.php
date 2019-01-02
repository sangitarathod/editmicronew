<?php
// let users change the session cookie name


$cookie_append=get_option('settings_gpls_woo_rfq_cookie',false);

if ($cookie_append == false) {

    require_once( ABSPATH . 'wp-includes/class-phpass.php' );
    $hash = new \PasswordHash( 8, false );

    $cookie_append = md5( $hash->get_random_bytes( 1 ) );

    update_option('settings_gpls_woo_rfq_cookie',$cookie_append);

}


    if (!defined('RFQTK_WP_SESSION_COOKIE')) {

        define('RFQTK_WP_SESSION_COOKIE', 'rfqtk_wp_session_'.$cookie_append);
    }



    if (!class_exists('RFQTK_Recursive_ArrayAccess')) {
        include 'includes/class-recursive-arrayaccess.php';
    }

// Include utilities class
    if (!class_exists('RFQTK_WP_Session_Utils')) {
        include 'includes/class-wp-session-utils.php';
    }

// Include WP_CLI routines early
    if (defined('RFQTK_WP_CLI') && WP_CLI) {
        include 'includes/wp-cli.php';
    }

// Only include the functionality if it's not pre-defined.
    if (!class_exists('RFQTK_WP_Session')) {
        include 'includes/class-wp-session.php';
        include 'includes/wp-session.php';
    }


    function rfq_cart_get_item_data($cart_item, $flat = false)
    {
        $item_data = array();

        // Variation data
        if (isset($cart_item['data']->variation_id) && is_array($cart_item['variation'])) {

            foreach ($cart_item['variation'] as $name => $value) {

                if ('' === $value)
                    continue;

                $taxonomy = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', urldecode($name)));

                // If this is a term slug, get the term's nice name
                if (taxonomy_exists($taxonomy)) {
                    $term = get_term_by('slug', $value, $taxonomy);
                    if (!is_wp_error($term) && $term && $term->name) {
                        $value = $term->name;
                    }
                    $label = wc_attribute_label($taxonomy);

                    // If this is a custom option slug, get the options name
                } else {
                    $value = apply_filters('woocommerce_variation_option_name', $value);
                    $product_attributes = $cart_item['data']->get_attributes();
                    if (isset($product_attributes[str_replace('attribute_', '', $name)])) {
                        if (isset($product_attributes[str_replace('attribute_', '', $name)]['name'])) {
                            $label = wc_attribute_label($product_attributes[str_replace('attribute_', '', $name)]['name']);
                        }

                    } else {
                        $label = $name;
                    }
                }

                $item_data[] = array(
                    'key' => $label,
                    'value' => $value
                );
            }
        }

        // Filter item data to allow 3rd parties to add more to the array
        $item_data = apply_filters('woocommerce_get_item_data', $item_data, $cart_item);

        // Format item data ready to display
        foreach ($item_data as $key => $data) {
            // Set hidden to true to not display meta on cart.
            if (isset($data['hidden'])) {
                unset($item_data[$key]);
                continue;
            }
            $item_data[$key]['key'] = isset($data['key']) ? $data['key'] : $data['name'];
            $item_data[$key]['display'] = isset($data['display']) ? $data['display'] : $data['value'];
        }

        // Output flat or in list format
        if (sizeof($item_data) > 0) {
            //ob_start();

            if ($flat) {
                foreach ($item_data as $data) {
                    echo esc_html($data['key']) . ': ' . wp_kses_post($data['display']) . "\n";
                }
            } else {
                wc_get_template('cart/cart-item-data.php', array('item_data' => $item_data));
                return;
            }

            //return ob_get_clean();
        }

        return '';
    }

    function gpls_woo_rfq_cart_tran_key()
    {
        $wp_session = RFQTK_WP_Session::get_instance();

        $tran_key = apply_filters('set_gpls_rfq_cart_tran_key', $wp_session->session_id);

        return $wp_session->session_id;

    }

    function gpls_woo_rfq_get_item($key)
    {

        $wp_session = RFQTK_WP_Session::get_instance();

        $key = sanitize_key($key);


        return isset($wp_session[$key]) ? maybe_unserialize($wp_session[$key]) : false;


    }

    function gpls_woo_rfq_cart_set($key, $value)
    {

               $wp_session = RFQTK_WP_Session::get_instance();

               $key = sanitize_key($key);

               if (is_array($value)) {
                   $wp_session[$key] = serialize($value);
               } else {
                   $wp_session[$key] = $value;
               }

               $wp_session->write_data();

        return isset($wp_session[$key]) ? maybe_unserialize($wp_session[$key]) : false;






    }

    function gpls_woo_rfq_cart_delete($key)
    {


        $wp_session = RFQTK_WP_Session::get_instance();

        $key = sanitize_key($key);

        unset($wp_session[$key]);

        $wp_session->write_data();

        return $wp_session[$key];
    }
