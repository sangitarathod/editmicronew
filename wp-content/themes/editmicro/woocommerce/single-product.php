<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header('second'); ?>
<div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/shop">Products</a></li>
                      <li><?php $cat=get_the_terms($post->ID, 'product_cat');?><a href="<?php echo site_url();?>/product-category/<?php echo $cat[0]->slug?>"><?php echo $cat[0]->name;?></a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <div class="row">
                        <div class="product_details_page">
							<?php
								/**
								 * woocommerce_before_main_content hook.
								 *
								 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								 * @hooked woocommerce_breadcrumb - 20
								 */
								//do_action( 'woocommerce_before_main_content' );
							?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'single-product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php
								/**
								 * woocommerce_after_main_content hook.
								 *
								 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
								 */
								do_action( 'woocommerce_after_main_content' );
							?>

							<?php
								/**
								 * woocommerce_sidebar hook.
								 *
								 * @hooked woocommerce_get_sidebar - 10
								 */
								do_action( 'woocommerce_sidebar' );
							?>
						</div>
                    </div>
                </div>
            </div>
        </div>
 </section>
 <style>
	#st-el-3 .st-btn[data-network='blogger']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='delicious']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='digg']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='flipboard']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='livejournal']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='mailru']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='meneame']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='odnoklassniki']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='reddit']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='tumblr']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='vk']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='weibo']{
		display:none;
	}
	#st-el-3 .st-btn[data-network='xing']{
		display:none;
	}
</style>

<?php get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
