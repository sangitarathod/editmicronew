<?php
/**
 * Admin new RFQ email
 *
 * @author Neah Plugins
 * @package WooCommerce/Emails/HTML
 * @version 1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$plain_text=false;
?>
<?php

?>
<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php printf( __( 'You have received an request for a quote from %s. The request is as follows:', 'woo-rfq-for-woocommerce' ), $order->get_formatted_billing_full_name() ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order,  $sent_to_admin, $plain_text, $email ); ?>

<h2><a class="link" href="<?php echo admin_url( 'post.php?post=' . $order->get_id() . '&action=edit' ); ?>"><?php printf( __( 'Order #%s', 'woo-rfq-for-woocommerce'), $order->get_order_number() ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->get_date_created() ) ), date_i18n( wc_date_format(), strtotime( $order->get_date_created() ) ) ); ?>)</h2>

<table class="td" cellspacing="0" cellpadding="6"
       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
    <thead>
    <tr>
        <th class="td" scope="col" style="text-align:left;"><?php printf( __('Product', 'woo-rfq-for-woocommerce')); ?></th>
        <th class="td" scope="col" style="text-align:left;"><?php printf(  __('Quantity', 'woo-rfq-for-woocommerce')); ?></th>
        <th class="td" scope="col" style="text-align:left;"><?php printf(  __('Price', 'woo-rfq-for-woocommerce')); ?></th>


    </tr>
    </thead>
    <tbody>
	<?php

	$show_prices=true;
    add_filter( 'woocommerce_email_order_items_args','filter_gpls_woo_rfq_add_show_prices_to_wc_emails', 100, 1 );

    gpls_woo_rfq_remove_filters_normal_checkout();

    echo wc_get_email_order_items($order,array(
        'show_sku' => true,
        'show_image' => true,
        'image_size' => array(128, 128),
        'plain_text' => $plain_text,
        'show_prices' => $show_prices,
        'sent_to_admin'=>true

    )); ?>

	</tbody>
	<tfoot>
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
	</tfoot>
</table>

<?php


?>

<?php do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email); ?>


<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text , $email); ?>

<?php do_action( 'woocommerce_admin_email_order_meta', $order, $sent_to_admin, $plain_text , $email); ?>

<?php  do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>


<?php do_action( 'woocommerce_email_footer', $email ); ?>

<?php gpls_woo_rfq_add_filters_normal_checkout(); ?>