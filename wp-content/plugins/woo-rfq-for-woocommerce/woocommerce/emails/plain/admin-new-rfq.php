<?php
/**
 * Admin new RFQ email (plain text)
 *
 * @author		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version 	3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

echo sprintf( __( 'You have received a request for a quote from %s.', 'gplsquote' ), $order->get_formatted_billing_full_name() ) . "\n\n";

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text );

echo strtoupper( sprintf( __( 'Order number: %s', 'gplsquote' ), $order->get_order_number() ) ) . "\n";
echo date_i18n( __( 'jS F Y', 'gplsquote' ), strtotime( $order->get_date_created() ) ) . "\n";

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text );

echo "\n" . wc_get_email_order_items ($order, array(
		'show_sku'    => false,
		'show_image'  => false,
		'$image_size' => array( 32, 32 ),
		'plain_text'  => true
	) );

echo "==========\n\n";



echo "\n" . sprintf( __( 'View order: %s', 'gplsquote'), admin_url( 'post.php?post=' . $order->get_id() . '&action=edit' ) ) . "\n";

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

 do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text);

 //do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

 do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text );

 do_action( 'woocommerce_admin_email_order_meta', $order, $sent_to_admin, $plain_text );

 do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text);

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );

