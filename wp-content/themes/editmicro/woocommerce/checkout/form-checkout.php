<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}                  

global $current_user;
$uid=get_current_user_id();
$street_add=get_user_meta($uid,'street_add',true);
$zip_code=get_user_meta($uid,'zip_code',true);
$country=get_user_meta($uid,'country',true);
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>
<div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li>Request Quotes</li>
                    </ul> 
                    <h1>Request Quotes</h1> 
                                       
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 col-xs-12 request_quotes_user_page">
								
								<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

									<?php if ( $checkout->get_checkout_fields() ) : ?>

										<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

										
											<div class="request_quotes_main" id="customer_details">
												<div style="display:none;">
												<?php do_action( 'woocommerce_checkout_billing' ); ?>
												</div>
												<h2><span>Your Details</span></h2>
													<div class="user_details">
													   <h6><?php echo ucfirst(get_user_meta($uid,'first_name',true))." ".ucfirst(get_user_meta($uid,'last_name',true));?></h6>
													   <p><?php echo get_user_meta($uid,'org_name',true); ?></p>
													   <div class="col-sm-6 user_address_details">
															<span class="col-sm-3">
																<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/address_icon.png" alt="address">
															</span>
															<div class="col-sm-9">
																<h5>Address</h5>
																<p>
																	<?php if($street_add!=''){echo $street_add;} 
																		  if($street_add!="" && $zip_code!=''){echo ", ".$zip_code;}
																		  if($street_add=="" && $zip_code!=""){ echo $zip_code;}
																		  if($street_add=="" && $zipcode=="" && $country!=""){echo $country;}else if($street_add!="" && $zipcode =="" && $country!=""){ echo ", ".$country;} else if($zip_code!="" && $country!=""){echo ", ".$country;}
																	?>
																</p>
																<a href="<?php echo site_url();?>/manage-profile">Edit Info</a>
															</div>
													   </div>
													   <div class="col-sm-6 user_address_details">
															<span class="col-sm-3">
																<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/chat_icon.png" alt="address">
															</span>
															<div class="col-sm-9">
																<h5>Contact Info</h5>
																<p><?php echo get_user_meta($uid,'contact_no',true);?></p>
																<p>
																	<?php $user_info = get_userdata($uid);
																		echo $user_info->user_email;
																	?>
																</p>
																<a href="<?php echo site_url();?>/manage-profile">Edit Info</a>
															</div>
													   </div>
													</div>
											</div>

											<div class="request_quotes_main">
												<?php do_action( 'woocommerce_checkout_shipping' ); ?>
											</div>
										

										<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

									<?php endif; ?>
									<div class="request_quotes_main"><!--quatiation details start -->
										<h2 id="order_review_heading"><span><?php _e( 'Quotation Details', 'woocommerce' ); ?></span></h2>
										<?php //do_action( 'woocommerce_checkout_before_order_review' ); ?>
										
										
										<?php do_action( 'woocommerce_checkout_order_review' ); ?>
										

										<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
									</div><!--quatation details end-->
								</form>

								<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
							</div>
						</div>
					</div>
                </div>
            </div>
    </section>
