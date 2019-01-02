<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
 <!-- section end Here -->
<script type="text/javascript">

var carturl = "<?php echo site_url();?>/cart";

</script>

    <div class="body_content">
            <div class="product_listing">
                <div class="container">
                    <div class="row">
                    <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                        <div class="filtter_result_section">
                            <div class="filtter_result">
								<?php  
									$url=getAddress();									
									$exploded = explode('/', $url);
									//print_r($exploded);
									$cat_slug=$exploded[6];
									//echo "cat_slug=".$cat_slug."<br>";
									$category_slug = get_term_by( 'slug', $cat_slug, 'product_cat' );
									$cat_id = $category_slug->term_id;
									//echo "cat_id=".$cat_id;
								?>
                                <p>FILTER RESULTS BY :</p>
                                <div class="dropdown filtter_result_main">
                                    <a class="btn btn-default dropdown-toggles" type="button" id="menu1" data-toggle="dropdown">Sub-Categories <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <?php 
											if ( is_shop() ) {
												woocommerce_subcats_from_parentcat_by_ID(21);
											}
											if($cat_id!=""){
												woocommerce_subcats_from_parentcat_by_ID($cat_id);
											}
										?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="product_listing_main">
								<?php
								if ( woocommerce_product_loop() ) {

									/**
									 * Hook: woocommerce_before_shop_loop.
									 *
									 * @hooked wc_print_notices - 10
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									//do_action( 'woocommerce_before_shop_loop' );

									woocommerce_product_loop_start();

									if ( wc_get_loop_prop( 'total' ) ) {
										while ( have_posts() ) {
											the_post();

											/**
											 * Hook: woocommerce_shop_loop.
											 *
											 * @hooked WC_Structured_Data::generate_product_data() - 10
											 */
											
											do_action( 'woocommerce_shop_loop' );
												
											wc_get_template_part( 'content', 'product' );
										}
									}

									woocommerce_product_loop_end();

									/**
									 * Hook: woocommerce_after_shop_loop.
									 *
									 * @hooked woocommerce_pagination - 10
									 */
									do_action( 'woocommerce_after_shop_loop' );
								} else {
									/**
									 * Hook: woocommerce_no_products_found.
									 *
									 * @hooked wc_no_products_found - 10
									 */
									do_action( 'woocommerce_no_products_found' );
								}

								/**
								 * Hook: woocommerce_after_main_content.
								 *
								 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
								 */
								do_action( 'woocommerce_after_main_content' );

								/**
								 * Hook: woocommerce_sidebar.
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
            </div>
        </div>
    </section>
    
<?php get_footer();?> 
<!--popup 1 -->
<div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <label id="msg"></label>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <form name="frm_custom_add_to_cart" id="frm_custom_add_to_cart" method="POST" action="">
          <div class="modal-body">		
			<label>Enter Quantity:</label><input type="hidden" name="prod_id"	 id="prod_id">  			
			<input type="number" name="qty" id="qty" min="1" value="1">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="mybutton" name="btn_custom_add_to_cart" id="btn_custom_add_to_cart">Request Quote</button>
          </div>
          </form>
    </div>
  </div>
</div>
<!--popup 1 -->
<script type="text/javascript" language="javascript">
	jQuery(document).ready(function(){
		
				jQuery('.mybutton').click(function(){
					jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_custom_add_to_cart").serialize()+"&action=custom_addcart",
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){
												//var userid=result['user_id'];																						
												//alert(result['success']);
												jQuery('#msg').text("Product has been added to quotes list successfully.");
												jQuery('#msg').css("color","green");
												var url =carturl;												
												setTimeout(function () {
													jQuery('#myModel').modal('hide');
													window.location.href = url;
												}, 2500);											
											} else {			
												jQuery("#msg").text("Error.");
												jQuery("#msg").css("color","red");				
												//alert("error");
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
									return false;
				});		
				
				jQuery('#myModal').on('show.bs.modal', function (event) {
				  var button = jQuery(event.relatedTarget) // Button that triggered the modal
				  var recipient = button.data('whatever') // Extract info from data-* attributes
				  //alert(recipient);
				  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				  var modal = jQuery(this)
				  modal.find('.modal-title').text('Add Quantity')
				  modal.find('.modal-body input[name=prod_id]').val(recipient)
				});
				
	});			
		
<?php

/*if(isset($_REQUEST['btn_custom_add_to_cart'])){
	$qty=$_POST['qty'];
	$prod_id=$_POST['prod_id'];
	global $woocommerce;
	$woocommerce->cart->add_to_cart($prod_id,$qty);
	
}*/
?>		
				
</script>
</body>
</html>
