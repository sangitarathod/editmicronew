<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.3
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
do_action('gpls_woo_rfq_before_proceed_to_checkout');

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

?>

<?php if ($remove_totals == true) : ?>

    <?php $proceed_to_rfq = get_option('rfq_cart_wordings_proceed_to_rfq', __('RFQ', 'woo-rfq-for-woocommerce'));
    $proceed_to_rfq = __($proceed_to_rfq,'woo-rfq-for-woocommerce');
    $proceed_to_rfq = apply_filters('gpls_woo_rfq_proceed_to_rfq', $proceed_to_rfq);
    ?>
    <?php if(is_user_logged_in()){ ?>
    <button type="btton" onclick="location.href='<?php echo esc_url(wc_get_checkout_url());?>'">Request Quote</button>
	<?php }?>
	
	<?php if(!is_user_logged_in()){ ?>
    <button type="button" data-toggle="modal" data-target="#myModal">Request Quote</button>
	<?php }?>
	
	

<?php else : ?>
    <a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="checkout-button button alt wc-forward">
        <?php printf( __( 'Proceed to checkout', 'woo-rfq-for-woocommerce' )); ?>
    </a>
<?php endif; ?>


