<?php
/**
 * Customer new RFQ email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

echo __( "Your request has been received and is now being reviewed. Your request details are shown below for your reference:", 'gplsquote' ) . "\n\n";

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text );

echo strtoupper( sprintf( __( 'Order number: %s', 'woo-rfq-for-woocommerce' ), $order->get_order_number() ) ) . "\n";
echo date_i18n( __( 'jS F Y', 'woo-rfq-for-woocommerce' ), strtotime( $order->get_date_created() ) ) . "\n";

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text );


$show_prices=false;

$show_prices=apply_filters('gpls_woo_rfq_show_prices_customer_email',$show_prices);




echo "\n" . wc_get_email_order_items ($order, array(
		'show_sku'    => false,
		'show_image'  => false,
		'$image_size' => array( 32, 32 ),
		'plain_text'  => true,
		'show_prices' => $show_prices
	) );


echo "==========\n\n";



echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text);
//do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text);

do_action('woocommerce_email_confirmation_messages', $order, $sent_to_admin, $plain_text);

do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text);

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
