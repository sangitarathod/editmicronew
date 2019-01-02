<?php
/* Template Name: View Quote Template */

if (is_user_logged_in()) {
global $current_user;
$uid=$current_user->ID;
$user_info = get_userdata($uid);
get_header('second');

if(isset($_GET['qid'])){
	$qid=$_GET['qid'];
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/asstes/js/jspdf.min.js"></script>
        <!-- section end Here -->
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><a href="<?php echo site_url();?>/my-requested-quote">Requested Quotes</a></li>
                      <li>#<?php echo $qid;?></li>
                    </ul> 
                    <h1>Quote #<?php echo $qid;?></h1> 
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
                    <div class="invoice_page">
                        <div class="row"  id="printdiv">								
                            <div class="invoice_top">
                                <div class="col-sm-8">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/logo.png" alt="logo">
                                </div>
                                <div class="col-sm-4">
                                    <p>Edit Representative - Elviera Kassim </p>
                                    <p>Email - <a href="">elviera@editmicro.co.za</a></p>
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
                                <table>
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
                                            <td><?php echo $item['quantity'];?></td>
                                            <td>R30</td>
                                            <td>R300</td>
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
                                            <td class="chnage_padding">R600</td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2">15% VAT</td>
                                            <td class="chnage_padding">R90</td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2">
                                                <strong>Total Price Including VAT</strong></td>
                                            <td class="chnage_padding"><strong>R690</strong></td>
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
                                <h3>Message Recived</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            </div>  
                                                    
                            <div id="editor"></div>
                            <div class="invoice_btn">
                                <div class="col-sm-3 print_btn"><a  onclick="print();" >Print Quote</a></div>
                                <div class="col-sm-3 download_btn" id="btn_download" name="btn_download"  onclick="javascript:genPDF();"><a href="">Download Quote</a></div>
                            </div>
                        </div>
                       <?php }?>
                    </div>                  
                    
                </div>
            </div>
    </section>
    <?php get_footer();?>
	
		
		
	<!--popup 1 -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			  </div>
			  <div class="modal-body">
				<p>Some text in the modal.</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
		</div>
	  </div>
	</div>
	<!--popup 1 -->
	<script type="text/javascript">     
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
					doc.save('Quote.pdf');
				}
			});
		}
	
		
	</script>



</body>
</html>
<?php
}else{
	$u1=site_url();
	$u2="/sign-in/";
    wp_redirect(site_url()."/sign-in/", 307);
    exit;
}
?>
