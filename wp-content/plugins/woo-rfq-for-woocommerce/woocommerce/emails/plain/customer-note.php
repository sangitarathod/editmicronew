<?php
/**
 * Customer note email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/customer-note.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version		3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $show_prices;

$show_prices=false;

$show_prices = apply_filters('gpls_woo_rfq_show_prices_customer_email',$show_prices);

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><?php printf( __( "Hello, a note has just been added to your order:", 'woo-rfq-for-woocommerce' )); ?></p>

    <blockquote><?php echo wpautop( wptexturize( $customer_note ) ) ?></blockquote>

    <p><?php printf( __( "For your reference, your order details are shown below.", 'woo-rfq-for-woocommerce' )); ?></p>
    <h2><?php printf(__('Order #%s', 'woo-rfq-for-woocommerce'), $order->get_order_number()); ?></h2>

    <table class="td" cellspacing="0" cellpadding="6"
           style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
        <thead>
        <tr>
            <th class="td" scope="col" style="text-align:left;"><?php printf( __('Product', 'woo-rfq-for-woocommerce')); ?></th>
            <th class="td" scope="col" style="text-align:left;"><?php printf( __('Quantity', 'woo-rfq-for-woocommerce')); ?></th>
            <?php if ($show_prices  == 'yes')  : ?>

                <th class="td" scope="col" style="text-align:left;"><?php printf( __('Price', 'woo-rfq-for-woocommerce')); ?></th>
            <?php endif; ?>

        </tr>
        </thead>
        <tbody>
        <?php



        ?>

        <?php echo wc_get_email_order_items ($order,array(
            'show_sku' => false,
            'show_image' => true,
            'image_size' => array(128, 128),
            'plain_text' => $plain_text,
            'show_prices' => $show_prices
        )); ?>

        </tbody>
        <tfoot>
        <?php if ($show_prices==true)  : ?>

            <?php
            if ($totals = $order->get_order_item_totals()) {
                $i = 0;
                foreach ($totals as $total) {
                    $i++;
                    ?>
                    <tr>
                    <th class="td" scope="row" colspan="2"
                        style="text-align:left; <?php if ($i == 1) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
                    <td class="td"
                        style="text-align:left; <?php if ($i == 1) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
                    </tr><?php
                }
            }
            ?>

        <?php endif; ?>

        </tfoot>
    </table>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.
 * @since 2.5.0
 */


/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
