<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ) :
?>

	<!--<aside class="widget-area" role="complementary" aria-label="<?php //esc_attr_e( 'Footer', 'twentyseventeen' ); ?>">-->
	<div class="container">
			<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			
				<div class="col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php }
			if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
				<div class="col-sm-6 col-xs-12">			
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php } ?>
	 </div>
	<!--</aside>--><!-- .widget-area -->

<?php endif; ?>
