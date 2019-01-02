<?php
/* Template Name: Admin Quotes View Template */

?>

<?php


if( current_user_can( 'quotes' ) ){	
	get_header('customadmin');
	
	$aid=get_current_user_id();
	$a_info=get_userdata($aid);
	
	if(isset($_GET['qid'])){
		$qid=$_GET['qid'];
		//echo $qid;
	}
	
	$order = wc_get_order($qid);    
    $uid = $order->get_user_id();
    
?>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/customadmin/js/jspdf.min.js"></script>
<div class="dashboard_main_contain">
                    <div class="page_headings">
                        <h1>quotes request</h1>                        
                        <ul class="breadcrumb">
                          <li><a href="<?php echo  site_url();?>/custom-dashboard">Dashboard</a></li>
                          <li><a href="<?php echo site_url();?>/admin-quotes-request">Quotes Requests</a></li>
                          <li>#<?php echo $qid; ?></li>
                        </ul>
                    </div>
                    <label id="msg"></label>
                    <div class="dashboard_body_contain" id="printdiv">
                      <?php 
						global $wpdb;
						$sql = "SELECT * FROM `{$wpdb->prefix}posts`  WHERE ID=".$qid;
						$results = $wpdb->get_results($sql); 		
						foreach($results as $result){	
							$id=$result->ID;
							$first_nm=get_user_meta($uid,'first_name',ture);
							$last_nm=get_user_meta($uid,'last_name',ture);
							$street_add=get_user_meta($uid,'street_add',ture);
							$country=get_user_meta($uid,'country',ture);
							$state=get_user_meta($uid,'state',ture);
							$zip_code=get_user_meta($uid,'zip_code',ture);
							$city=get_user_meta($uid,'city',ture);
							$contact_no=get_user_meta($uid,'contact_no',ture);

					?>	   
                    <div class="invoice_page" >
						
                        <div class="invoice_top">
                                <div class="col-sm-8">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/logo.png" alt="logo">
                                </div>
                                <div class="col-sm-4">
                                    <p>Edit Representative - <?php echo $a_info->display_name;?> </p>
                                    <p>Email - <a href=""><?php echo $a_info->user_email;?></a></p>
                                </div>
                            </div>
                        <div class="invoice_contact_info">
                                <div class="row">
                                     <div class="col-sm-4">
                                        <h3>Issued To</h3>
                                        <p><?php echo ucfirst($first_nm)." ".ucfirst($last_nm);?><br>
                                        <?php if($street_add!=""){echo $street_add."<br>";}?>
                                        <?php if($city != ""){echo $city."<br>";}?>
                                        <?php if($zip_code !="" && $country != ""){echo $zip_code.",";}if($zip_code !="" && $country == ""){echo $zip_code;}?><?php echo $country; ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h3>Contact</h3>
                                        <p><?php echo ucfirst($first_nm)." ".ucfirst($last_nm);?><br>
                                        <?php echo $contact_no;?><br>
                                        <?php echo $user_info->user_email;?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h3>Date</h3>
                                        <p><?php echo date('d M Y', strtotime($result->post_date));?></p>
                                        <h3>Quote Reference</h3>
                                        <p>#<?php echo $qid;?></p>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $quote = new WC_Order( $result->ID );
							$items = $quote->get_items();
							
                            ?>
                        <div class="invoice_table table-responsive">
                                <table id="myTable">
                                    <thead>
                                        <th class="radius_left">Description</th>   
                                        <th>Qty</th> 
                                        <th>Unit Price (ex vat)</th> 
                                        <th class="radius_right">Total Price</th>
                                    </thead>
                                    <tbody>
										<?php foreach($items as $item){?>
                                        <tr>
                                            <td><?php echo $item['name'];?></td>
                                            <td class="c_qty" name="prod_qty<?php  echo $item['product_id']; ?>" id="prod_qty<?php  echo $item['product_id']; ?>"><?php echo $item['quantity'];?></td>
                                            <td> 
												  <input type="hidden" name="prod_id" id="prod_id" value="">
												  <input type="hidden" name="orderid" id="orderid" value="<?php echo $qid;?>">
												  
                                                  <input class="c_u_price" name="prod_price_<?php echo $item['product_id'];?>" id="" class="" placeholder="" aria-controls="example" type="">
                                                
                                            </td>
                                            <td class="c_total_price" name="prod_tot_price<?php echo $item['product_id']; ?>" id="prod_tot_price<?php echo $item['product_id']; ?>"></td>
                                        </tr>
                                       <?php }?>
                                        <tr>
                                            <td class="remove_border" rowspan="3"><p></p>Due to the volatility with the Rand /Dollar / Pound exchange rate quotes<br>
                                            could change without prior notice
                                            <p>E&O E<br>
                                            All goods remain the property of Edit Microsystems until payment received in full.    
                                            </p>
                                            </td>
                                            <td colspan="2" class="remove_border">Quotation Sub-Total</td>
                                            <td class="chnage_padding c_sub_total" name="sub_total" id="sub_total"></td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2" data-vat="15" name="getvat" id="getvat">15% VAT</td>
                                            <td class="chnage_padding vat" name="vat" id="vat"></td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2">
                                                <strong>Total Price Including VAT</strong></td>
                                            <td class="chnage_padding" name="total_price_vat" id="total_price_vat"><strong></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <div class="invoice_terms">
                                <h3>Terms & Conditions</h3>
                                <ol>
                                    <li><strong>1) GENERAL TERMS & CONDITIONS : </strong>Please note that Edit Microsystems (Pty) Ltd General Terms and Conditions and Specific Conditions of Sale apply. </li>
                                    <li><strong>2) PRICING : </strong>Prices quoted exclude VAT unless stated in Quotation. </li>
                                    <li><strong>3) TERMS OF PAYMENT: </strong>Payment must be made before delivery. </li>
                                    <li><strong>4) WARRANTY: </strong>All equipment is covered by standard warranties as set out by manufacturers. </li>
                                    <li><strong>5) DELIVERY: </strong>Delivery of the equipment will be 4 to 6 weeks from date of official order. If stock is immediately available, ETA will be reduced to 5 working days. </li>
                                    <li><strong>6) VALIDITY: </strong>This proposal is valid for 7 days from date hereof. </li>
                                    <li><strong>7) INSTALLATION & TRAINING:</strong>Prices quoted exclude installation & training unless stated in the quote </li>
                                    <li><strong>8) OWNERSHIP AND RISK :</strong>
                                        <ul>
                                            <li>Ownership and all associated risks are transferred to the Customer upon delivery to site and the signing of a Delivery Note or Invoice. </li>
                                            <li>No equipment will be left on site without the signed acceptance of these terms by a company representative with the authority to do so. </li>
                                        </ul>
                                    </li>
                                    <li><strong>9) EXCLUSIONS: </strong>
                                        <ul>
                                            <li>All Electrical Work - This includes all electrical plug points, core drilling, electrical cable, floor boxes and conduits. </li>
                                            <li>Shop fitting - All cabinets and cupboards required. </li>
                                            <li>Ceiling Work - All ceiling construction and changes and cutouts for speakers as well as projectors. </li>
                                            <li>Structural - Any additional specialized brackets, or structures necessary to mount any of our equipment. </li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                        <div class="bank_details">
                                <h3>Bank - ABSA l EDIT MICROSYSTEMS (PTY) LTD l Current Business Account l 40-5489-3780 l SEA POINT l BRANCH CODE 630309</h3>
                                <p>DIRECTORS <br>
                                PIETER LABUSCHAGNE AND JENNY LABUSCHAGNE<br>
                                Company Reg No. 2001/027043/07</p>
                            </div>
                        <div class="spaical_massage">
                                <h3>Additional comments received</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                        <div class="spaical_massage">
                                <h3>Your Message</h3>
                                <form>
                                     <textarea name="quote_message" id="quote_message" rows="3" cols="50"></textarea> 
                                </form>
                        </div>
                        <div class="invoice_btn">
                            <div class="col-sm-2 col-xs-12 print_btn"><a onclick="print();">Print Quote</a></div>
                            <div class="col-sm-2 col-xs-12 download_btn" ><a href="">Send Quote</a></div>
                        </div>
                    </div>
                    
                    </div>
                    <?php }?>
                </div>
                <?php get_footer('customadmin');?>
            </div>                       
        </div>
        <script>
			jQuery(document).ready(function () {
				jQuery('input').change(function () {				
					 update_amounts();
				});
				
				
			});
			
			
			function update_amounts()
			{
				var sum = 0.0;
				jQuery('#myTable > tbody  > tr:has(input)').each(function() {
					var qty = jQuery(this).find('.c_qty').text();					
					var price = jQuery(this).find('.c_u_price').val();					
					var amount = (Number(qty)*Number(price));												
					sum+=amount;					
					jQuery(this).find('.c_total_price').text(''+amount);				
				});		
				var vat=jQuery('#getvat').data('vat');
				var vat1=Number(vat)*sum/100;
				var total_with_vat=sum+vat1;		
				jQuery('.c_sub_total').text('R'+sum);
				jQuery('.vat').text(vat1);
				jQuery('#total_price_vat').text('R'+total_with_vat);
			}
			
			
			jQuery('.download_btn').click(function(){
				var base64pdf=genPDF();
				var quote_message=jQuery('#quote_message').val();
				var qid=jQuery('#orderid').val();
				var p_qty=new Array();
				var p_price=new Array();
				var p_tot_price=new Array();
				var p_id=new Array();
				
				jQuery('#myTable > tbody  > tr:has(input)').each(function() {
					var qty = jQuery(this).find('.c_qty').text();					
					var price = jQuery(this).find('.c_u_price').val();
					var id=jQuery(this).find('.c_u_price').attr('name');														
					var f_p_id=id.split('_');					
					var tot_price=jQuery(this).find('.c_total_price').text();
					
					p_qty.push(qty);
					p_price.push(price);
					p_tot_price.push(tot_price);
					p_id.push(f_p_id[2]);
					
					
				});
				var p_sub_total=jQuery('.c_sub_total').text();
				var p_vat=jQuery('.vat').text();
				var p_total_with_vat=jQuery('#total_price_vat').text();
				var dataString = 'quote_message='+ quote_message+ '&p_qty=' + p_qty+ '&p_price=' + p_price + '&p_tot_price=' + p_tot_price+ '&p_sub_total=' + p_sub_total+ '&p_vat=' + p_vat+ '&p_total_with_vat=' + p_total_with_vat+ '&p_id=' + p_id+ '&qid=' + qid+ '&base64pdf=' + base64pdf;
								
								jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:dataString+"&action=store_admin_quote_view_data",
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){												
												//generateNotification("Quotation has been sent successfully.","success"); 																						
												//alert(result['success']);
												jQuery('#msg').text("Email has been sent successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function() {
													jQuery('#msg').hide();
												}, 4000);
																								
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
			
			
		
        function print() {    
           var divToPrint = document.getElementById('printdiv');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
        }        
        
		 
		 function genPDF(){
			html2canvas(document.getElementById('printdiv'),{
				onrendered: function (canvas){
					var img=canvas.toDataURL("image/png");
					var doc=new jsPDF();
					doc.addImage(img, 'JPEG',10,10,190,200);					
					//doc.save('Quote.pdf');
					var base64pdf = btoa(doc.output());
					return base64pdf;
				}
			});
		}
	
		
	</script>
		
        </body>
        </html>
<?php
}
?>

