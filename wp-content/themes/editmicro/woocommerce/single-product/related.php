<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
<!--col 3 start -->
	<div class="col-sm-3">
		<div class="you_may_like_cont">	
			<h2><?php esc_html_e( 'You May Like', 'woocommerce' ); ?></h2>
					
			<?php woocommerce_product_loop_start(); ?>

				<?php foreach ( $related_products as $related_product ) : ?>
					 
					<?php
						$post_object = get_post( $related_product->get_id() );					
						$image=wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID), 'single-post-thumbnail' );
						setup_postdata( $GLOBALS['post'] =& $post_object );
				?>
						<div class="like_product_listing">
							<span class="col-sm-5 col-xs-6"><a href="<?php the_permalink();?>"><img style="width:100%;" src="<?php echo $image[0];?>" alt=""></a></span>
							<p class="col-sm-7 col-xs-6"><?php echo $post_object->post_title; ?></p>
						</div>
				<?php
						//wc_get_template_part( 'content', 'product' ); ?>
										
				<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>	
	</div>
</div>
<?php endif;

wp_reset_postdata();
