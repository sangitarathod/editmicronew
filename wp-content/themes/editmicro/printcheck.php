<?php
/*
 * Template Name: printcheck Template
 */
 
 ?>

<?php
	$boot_path=get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css';
	$style_path=get_stylesheet_directory_uri().'/assets/css/style.css';
	$p_style_path=get_stylesheet_directory_uri().'/assets/css/print.css';

	?>
	<!-- printdiv-->
	
	<!DOCTYPE html>
	<html lang="en">	
	<head>
	<link href=<?php echo $boot_path;?> rel="stylesheet" type="text/css">
	<link href="<?php echo $style_path;?>" rel="stylesheet" type="text/css">		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri();?>/asstes/js/jspdf.min.js"></script>
	</head>
	<body>    
    <section class="subpage_main">       
        <div class="body_content">
            <div class="container">
                <div class="subpages_cont">                                      
                    <div class="invoice_page" id="printdiv2">
                        <div class="row">
                            <div style="width: 100%;height:100px;">
                                <div class="col-sm-8">
                                    <img src="http://editmicrosystem.php-dev.in/wp-content/themes/editmicro/assets/images/logo.png" alt="logo">
                                </div>
                                <div class="col-sm-4">
                                    <p>Edit Representative - '.$a_info->display_name.'</p>
                                    <p>Email - <a href="">'.$a_info->user_email.'</a></p>
                                </div>
                            </div>
                            <div style="width:100%;height:200px;padding-top:20px;">
                                <div style="margin-right: -15px;margin-left: -15px;">
                                    <div style="width: 33.33333333%;float:left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                                        <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;text-transform: uppercase;font-size: 1.1em;color: #272727;letter-spacing: 1px;" class="alert-danger">Issued To</h3>
                                        <p style="font-size: 1em;color: #464646;line-height: 25px;padding: 15px 0px 0px 15px;">'.ucfirst($first_nm)." ".ucfirst($last_nm).'<br>
                                        '.$s_add.''.$citee.''.$z_code.''.$country.'                                       
                                        </p>
                                    </div>
                                    <div style="width: 33.33333333%;float:left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                                        <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;text-transform: uppercase;font-size: 1.1em;color: #272727;letter-spacing: 1px;">Contact</h3>
                                        <p style="font-size: 1em;color: #464646;line-height: 25px;padding: 15px 0px 0px 15px;">'.ucfirst($first_nm)." ".ucfirst($last_nm).'<br>
                                        + '.$contact_no.'<br>
                                        '.$u_info->user_email.'</p>
                                    </div>
                                    <div style="width: 33.33333333%;float:left;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;">
                                        <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;text-transform: uppercase;font-size: 1.1em;color: #272727;letter-spacing: 1px;">Date</h3>
                                        <p style="font-size: 1em;color: #464646;line-height: 25px;padding: 15px 0px 0px 15px;">'.$quote_date.'</p>
                                        <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;text-transform: uppercase;font-size: 1.1em;color: #272727;letter-spacing: 1px;">Quote Reference</h3>
                                        <p style="font-size: 1em;color: #464646;line-height: 25px;padding: 15px 0px 0px 15px;">#'.$qid.'</p>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice_table table-responsive">
                                <table>
                                    <thead>
                                        <th class="radius_left">Description</th>   
                                        <th>Qty</th> 
                                        <th>Unit Price (ex vat)</th> 
                                        <th class="radius_right">Total Price</th>
                                    </thead>
                                    <tbody>'.$dynamic_d.'                                                                             
                                        <tr>
                                            <td class="remove_border" rowspan="3"><p></p>Due to the volatility with the Rand /Dollar / Pound exchange rate quotes<br>
                                            could change without prior notice
                                            <p>E&O E<br>
                                            All goods remain the property of Edit Microsystems until payment received in full.    
                                            </p>
                                            </td>
                                            <td colspan="2" class="remove_border">Quotation Sub-Total</td>
                                            <td class="chnage_padding">R '.$p_sub_total.'</td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2">15% VAT</td>
                                            <td class="chnage_padding">R '.$p_vat.'</td>
                                        </tr>
                                        <tr>
                                            <td class="remove_border" colspan="2">
                                                <strong>Total Price Including VAT</strong></td>
                                            <td class="chnage_padding"><strong>'.$p_total_with_vat.'</strong></td>
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
                            <div style="width:100%;text-align:center;">
                                <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;text-transform: uppercase;font-size: 1.1em;color: #272727;letter-spacing: 1px;">Bank - ABSA l EDIT MICROSYSTEMS (PTY) LTD l Current Business Account l 40-5489-3780 l SEA POINT l BRANCH CODE 630309</h3>
                                <p style="color: #1f1e1e;font-size: 0.9em;text-align: center;line-height: 20px;padding: 15px 0px 0px 15px;">DIRECTORS <br>
                                PIETER LABUSCHAGNE AND JENNY LABUSCHAGNE<br>
                                Company Reg No. 2001/027043/07</p>
                            </div>
                            <div style="width:100%;">
                                <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;font-size: 1.1em;color: #272727;letter-spacing: 0.5px;text-transform: uppercase;">Additional Comments Received</h3>
                                <p style="color: #6b666e;font-size: 1em;line-height: 20px;padding: 15px 0px 0px 15px;">'.$additional_comment.'</p>
                            </div>
                            <div style="width:100%;">
                                <h3 style="background-color: #e6e6e6;padding: 5px 15px;font-weight: 700;font-size: 1.1em;color: #272727;letter-spacing: 0.5px;text-transform: uppercase;">Your Message</h3>
                                <p style="color: #6b666e;font-size: 1em;line-height: 20px;padding: 15px 0px 0px 15px;">'.$quote_message.'</p>
                            </div>
                            <div style="width:100%;margin: 20px 0px;">
                                <div class="col-sm-3" style="background-color: transparent;border: 2px solid #2e3192;color:blue;font-size: 1.1em;text-align: center;padding: 7px 0px;border-radius: 6px;"><a href="javascript:void(0);" onclick="print1('printdiv2')">Print Quote</a></div>
                                <div class="col-sm-3" style="background-color: #2e3192;border: 2px solid #2e3192;color:white;font-size: 1.1em;text-align: center;float: right;padding: 7px 0px;border-radius: 6px;"><a href="" onclick="javascript:genPDF();">Send Quote</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="print-button"><a href="javascript:void(0);" onClick="printDiv('printableArea')"><?php _e('PRINT', 'fap'); ?></a></div>
            <div id="printableArea" style="display:none;">
				AAA
            </div>
			</section>
		
			<script type="text/javascript">     
			function print() {    
			   var divToPrint = document.getElementById('printdiv2');
			   var popupWin = window.open('', '_blank', 'width=300,height=300');
			   popupWin.document.open();
			   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
			   popupWin.document.close();
			  // popupWin.focus();
				//setTimeout(function(){popupWin.print();},500000);
				//popupWin.close();
			}        
			
			function print1(printdiv2)
				{
				
					var values = document.getElementById(printdiv2);
					var printing =
					window.open('','','left=0,top=0,width=550,height=400,toolbar=0,scrollbars=0,sta­?tus=0');
					printing.document.write(values.innerHTML);
					printing.document.close();
					printing.focus();
					printing.print();
					printing.close();
				
			}		
			
		function genPDF(){
			html2canvas(document.getElementById('printdiv2'),{
				onrendered: function (canvas){
					var img=canvas.toDataURL("image/png");
					var doc=new jsPDF();
					doc.addImage(img, 'JPEG',10,10,190,200);
					var q_id=<?php echo $qid; ?>	
					doc.autoPrint();				
					//doc.save(q_id+'.pdf');
				}
			});
		}
	
			
        </script>
		</body>
		</html>
