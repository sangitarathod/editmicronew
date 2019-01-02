<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$acf_fields = acf_get_fields_by_id(479);
if ( ! empty( $tabs ) ) : ?>
							<div class="product_tab_panel">
                                    <ul class="nav nav-tabs">
                                        <?php foreach ( $acf_fields as $acf_field ) : 
                                        if($acf_field['name']=='overview'){?>
											<li class="active">
												<a href="#<?php echo $acf_field['name']; ?>" data-toggle="tab"><?php echo $acf_field['label']; ?></a>
											</li>
											
										<?php }else{
                                        ?>                                        
											<li>
												<a href="#<?php echo $acf_field['name']; ?>" data-toggle="tab"><?php echo $acf_field['label']; ?></a>
											</li>
									<?php }
										endforeach; ?>
                                      </ul>

                                      <div class="tab-content">
                                       <?php foreach ( $acf_fields as $acf_field ) : 
                                       if($acf_field['name']=='overview'){?>
										   <div id="<?php echo $acf_field['name']?>" class="tab-pane fade in active product_overview">
											 <?php if( get_field($acf_field['name']) ): ?>
												<?php the_field($acf_field['name']); ?>
											 <?php endif;?>
											</div>
									   <?php
									   }else{
                                       ?>
											<div id="<?php echo $acf_field['name']?>" class="tab-pane fade">
												 <?php if( get_field($acf_field['name']) ): ?>
													<?php the_field($acf_field['name']); ?>
												 <?php endif;?>
											</div>
									<?php }
										endforeach;
									 ?>
                                      </div>
                                </div>

<?php endif; ?>


</div><!-- col-9 end-->
