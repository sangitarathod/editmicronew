<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="order_review" class="woocommerce-checkout-review-order user_details">
<ul class="quotation_details">		
			<li class="col-sm-10 col-xs-10 table_heading product-name"><?php _e( 'Product', 'woocommerce' ); ?></li>
			<li class="col-sm-2 col-xs-2 table_heading product-total"><?php _e( 'Quantity', 'woocommerce' ); ?></th>		
</ul>
	
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$image=wp_get_attachment_image_src( get_post_thumbnail_id($_product->get_ID()), 'single-post-thumbnail' );
					?>
					<ul class="product_quotation_details <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<li class="col-sm-10 col-xs-10">
								<span class="col-sm-2 col-xs-2">
									<img src="<?php echo $image[0];?>" alt="">
                                </span>
								<p class="col-sm-10 col-xs-10">
								<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
								</p>
							</li>
							<li class="col-sm-2 col-xs-2">							
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity',sprintf( '%s', $cart_item['quantity'] ) , $cart_item, $cart_item_key ); ?>							
							</li>											
					</ul>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
	

