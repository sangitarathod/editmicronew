<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;


// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	 ?>
	  <div class="col-sm-4 col-xs-6 data">
		<div class="product_1">
			<?php 																	
			$id=get_the_ID();
			$imageurl = wp_get_attachment_url(get_post_thumbnail_id($id));
			 if ($imageurl) {
				$res_imageurl = site_url() . "/wp-content/themes/editmicro/resize_product_image.php?image=".$imageurl;
			 }
			?>
			
			<?php
			//do_action( 'woocommerce_before_shop_loop_item_title' );	
			if (has_post_thumbnail($id)) {
				echo  '<span class="product_img"><img src="'.$res_imageurl.'"></span>'; 
			}else {
				echo '<span class="product_img"><img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="" width="'.$woocommerce->get_image_size('shop_catalog_image_width').'px" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" /></span>';
			}
																
			?>
			
			<div class="pro_detail_short">				
					<?php
					/**
					 * Hook: woocommerce_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
					?>
				
	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
		<div class="request_btn">
			<?php echo $product->ID;?>
			
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			//do_action( 'woocommerce_after_shop_loop_item' );
			?>
			<button type="button" class="request_quote_btn" data-toggle="modal" data-target="#myModal" data-whatever="<?php echo $product->get_ID();?>">Request Quote</button>
			<a  href="<?php echo $product->get_permalink();?>">View Details</a>
            
			
			 </div>
         </div>
     </div>
</div>
<script type="text/javascript" language="javascript">
jQuery(document).ready(function(){
	//alert("OK");
	// save text
	var text=jQuery('.product_listing_main ul').html();
	//alert(text); 

	 //remove the ul
	 jQuery('.product_listing_main ul').remove();

	 // append the text to the div.test
	 jQuery('.product_listing_main').append(text);
	 
	 
	 
});
</script>
