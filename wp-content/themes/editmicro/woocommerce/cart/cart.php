<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var homeurl = "<?php echo get_site_url();?>";
var checkouturl= "<?php echo site_url();?>/checkout";
var complete_profile="<?php echo site_url();?>/complete-profile";
</script>
<div class="body_content">
            <div class="container">
                <div class="subpages_cont"> 
                    <h1>Quotes List</h1>
                    <div class="quotes_list_page">
                        <div class="row">
                        <div class="col-sm-9">
                            <div class="quotes_list_main">								 
									<form  class="login-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
										<?php do_action( 'woocommerce_before_cart_table' ); ?>
												<?php do_action( 'woocommerce_before_cart_contents' ); ?>
												<?php
												foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
													$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
													$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

													if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
														$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
														?>
														<ul class="quotes_listing woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">															
															<li class="col-xs-2 quotes_product_img">
															<span>
															<?php
															$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

															if ( ! $product_permalink ) {
																echo wp_kses_post( $thumbnail );
															} else {
																//printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
																printf('%s',wp_kses_post( $thumbnail ));
															}
															?>
															</span>
															</li>

															<li class="col-xs-5">
																<p class="quotes_product_name">
																	<?php
																	if ( ! $product_permalink ) {
																		echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
																	} else {
																		echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '%s',$_product->get_name() ), $cart_item, $cart_item_key ) );
																	}
																	?>
																</p>
															</li>
															<li class="col-xs-3 quotes_quantity">																 
																		<?php
																		if ( $_product->is_sold_individually() ) {
																			$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
																		} else {
																			$product_quantity = woocommerce_quantity_input( array(
																				'input_name'   => "cart[{$cart_item_key}][qty]",
																				'input_value'  => $cart_item['quantity'],
																				'max_value'    => $_product->get_max_purchase_quantity(),
																				'min_value'    => '0',
																				'product_name' => $_product->get_name(),
																			), $_product, false );
																		}

																		echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
																		?>
																	
															</li>
															<li class="col-xs-2 quotes_request_delete">
															<span>
															<?php
																$url=get_stylesheet_directory_uri()."/assets/images/delete_btn_icon.png";
																// @codingStandardsIgnoreLine
																echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
																	'<a href="%s"  aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="'.$url.'"></a>',
																	esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
																	__( 'Remove this item', 'woocommerce' ),
																	esc_attr( $product_id ),
																	esc_attr( $_product->get_sku() )
																), $cart_item_key );
															?>	
															Delete													
														</span>
														</li>
														</ul> 
														<?php
													}
												}
												?>

												<?php do_action( 'woocommerce_cart_contents' ); ?>												
														<?php /*if ( wc_coupons_enabled() ) { ?>
															<div class="coupon">
																<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
																<?php do_action( 'woocommerce_cart_coupon' ); ?>
															</div>
														<?php } */?>
														<button  type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" style="display:none;"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
														<?php do_action( 'woocommerce_cart_actions' ); ?>

														<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
													

												<?php do_action( 'woocommerce_after_cart_contents' ); ?>
										
										<?php do_action( 'woocommerce_after_cart_table' ); ?>
									</form>
								                              
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="quotes_request_right">
                                <h6>
									<?php
										$cartcount = WC()->cart->get_cart_contents_count();
										if ($cartcount > 0) { echo $cartcount." Items in the list"; }
									?>
                                </h6>									
										<?php
											/**
											 * Cart collaterals hook.
											 *
											 * @hooked woocommerce_cross_sell_display
											 * @hooked woocommerce_cart_totals - 10
											 */
											do_action( 'woocommerce_cart_collaterals' );
										?>									
									</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!--popup 1 -->
<div id="myModal" class="modal fade sign_in_popup" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/close_btn.png" alt="close"></button>
        </div>
        <div class="sign_in_popup">
            <div class="login-screen">
				<label style="display:none;" id="success_msg"></label>
                <h1>Sign in to Continue</h1>
                 <form class="login-form" name="frm_login" id="frm_login" method="POST">
					<div class="form-group">
						<label>Email Address</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                        <input class="form-control validate[required,custom[email]]" type="email" name="lgnusername" id="lgnusername">
                     </div>
                     <div class="form-group">
                        <label>Password</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="pwd_label"></label>
                        <input class="form-control validate[required]" type="password" name="lgnpassword" id="lgnpassword">
                     </div>                     
                     <p class="forgot text-center"><a href="<?php echo site_url();?>/forgot-password">Forgot Password?</a></p>
                     <button type="submit" class="login-btn" name="btn_login" id="btn_login">Sign In</button>
                     <div class="popup_footer_link">New User? <a href="<?php echo site_url(); ?>/sign-up" class="create_account_btn">Create your account</a></div>
               </form>
            </div>
        </div>
    </div>
  </div>
</div>
<!--popup 1 -->

<?php include('inc/footer_all_script.php');?>
<script type="text/javascript" language="javascript">
			function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		};
           	/* form validation and submission code start */

								
							jQuery("#btn_login").click(function(){
									//alert("ok");								
									var lgnusername = jQuery("#lgnusername" ).val();
									var lgnpassword=jQuery("#lgnpassword").val();								
									
									
									if(lgnusername=='')
									{
									  jQuery("#lgnusername").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#lgnusername").val())) {
										jQuery("#lgnusername").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#lgnusername").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}
									
									if(lgnpassword=='')
									{	jQuery("#lgnpassword").css("border-color","red");
										jQuery("#pwd_label").text("Please enter password");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#lgnpassword").css("border-color","#8d8d8d");
									    jQuery("#pwd_label").empty();
									}
									
									// form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_login").serialize()+"&action=login_user",
										success: function(result) {
											console.log(result);
											 
											if(result["success"] == true)
											{							
												//generateNotification("You are logged in successfully.","success");                           
												jQuery("#success_msg").css('display','block');
												jQuery("#success_msg").text("You are logged in successfully. continue your shopping.");
												jQuery("#success_msg").css('color','green');
												var redirecturl = checkouturl;
												setTimeout(function () {
													window.location.href = redirecturl;
												}, 2500);
											}
											else if(result['status']==0)
											{							
												//generateNotification(result['error'],"error");      
												jQuery("#success_msg").css('display','block');
												jQuery("#success_msg").text(result['error']);
												jQuery("#success_msg").css('color','red');                     
												var userid=result['userid'];
												var redirecturl = complete_profile+"?userid="+userid;                            
												setTimeout(function () {
												window.location.href = redirecturl;
												}, 2500);
											}else{
												//generateNotification(result['error'],"error");	
												jQuery("#success_msg").css('display','block');
												jQuery("#success_msg").text(result['error']);
												jQuery("#success_msg").css('color','red');  						
											}     
										},
										error: function(){						
											//generateNotification("Error in login. Please try again.","error");
										}
									});
									return false;
							});

							/* form validation and submission code end */
</script>


<?php do_action( 'woocommerce_after_cart' ); ?>
