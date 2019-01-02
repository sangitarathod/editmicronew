<?php
/* Template Name: LogaFault Template */

if (is_user_logged_in()) {
get_header('second');
$uid=get_current_user_id();

?>
		<script type="text/javascript">
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			var logfault2="<?php echo site_url();?>/log-a-fault-2";
		</script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <!-- section end Here -->
       <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><?php echo the_title();?></li>
                    </ul> 
                    <h1><?php echo the_title(); ?></h1>
                    <div class="log_fault_page">
                        <div class="col-sm-9">
                            <?php while ( have_posts() ) : the_post();?>
							<?php the_content();?>
							<?php endwhile; ?>
                            <div class="log_fault_from">
                                <p><?php the_excerpt();?></p>
                                <div class="logfault_main">
									<label id="msg"></label>
                                    <div class="row">
                                        <form class="login-form" name="frm_logfault" id="frm_logfault" method="POST" action="" enctype="multipart/form-data">
											<input type="hidden" name="action" value="logfault_frontend">
											<input type="hidden" name="userid" id="userid" value="<?php echo $uid;?>">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" name="log_user_name" id="log_user_name">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email Address</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="email_label"></label>
                                        <input class="form-control" type="text" name="log_user_email" id="log_user_email">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input class="form-control" type="text" name="log_user_contactno" id="log_user_contactno">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Search Product by Name</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="prod_label"></label>
                                        <input class="form-control" type="text" name="log_product_name" id="log_product_name" autocomplete="off"/> 
                                        <div id="key"></div>
                                   </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Type of issue</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="issue_label"></label>
                                        <div class="select_box">
                                            <select name="log_type_of_issue" id="log_type_of_issue">
                                                <option></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Invoice No</label><span style="color:red;"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;<label id="invoice_label"></label>
                                        <input class="form-control" type="text" name="log_invoice_no" id="log_invoice_no">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <input class="form-control" type="text" name="log_serial_no" id="log_serial_no">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Description of the problem</label>
                                         <textarea rows="4" cols="50" name="log_desc_issue" id="log_desc_issue"></textarea> 
                                   </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                   <div class="form-group" id="fields_wrapper">
                                    
                                      <div class="input-group">										  
                                        <div class="input-group-btn" >											
                                            <span class="fileUpload btn btn-success">												 
                                              <span class="upl" id="upload1">Choose file</span>
                                              <input type="file" class="upload up" name="attachment[]" id="attachment[]" data-multiple-caption="{count} files selected" onchange="javascript: onFileSelectForMulti(this, 1);"/>
                                            </span><!-- btn-orange -->
                                            
                                         </div><!-- btn -->
                                         <input type="text" class="form-control" readonly>                                         
                                         <a href="#"><i class="fa fa-remove"></i></a>
                                     </div><!-- group -->
                                     
                                    
                                     
                                     
                                   </div><!-- form-group -->
                                    <a class="add_file"  id="btn_add_more"  data-hover="Add More" href="#">Add another file</a>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                     <button type="submit" class="login-btn" name="btn_logfault" id="btn_logfault">Submit</button>
                                </div>
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-3 customer_support">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/cutomer_support_icon.png" alt="">
                            <p>If you’d like some advice, call us on </p>
                            <span>086 111 3973</span>
                        </div> 
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
			 function ValidateEmail(email) {
				var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				return expr.test(email);
			};
		
		

			var file_counter = 1;
			var total_file = 1;
			jQuery(document).ready(function () {
				jQuery("#btn_add_more").click(function (e) {
					
						file_counter++;
						total_file++;
						jQuery('#fields_wrapper').append('<div class="input-group" id="file_group' + file_counter + '"><div class="input-group-btn"><span class="fileUpload btn btn-success"><span class="upl" id="upload' + file_counter + '">Choose file</span><input type="file" class="upload up" name="attachment[]" id="attachment[]" data-multiple-caption="{count} files selected" onchange="javascript: onFileSelectForMulti(this,' + file_counter + ');"/></span> </div><input type="text" class="form-control" readonly><a href="javascript:removeFile(' + file_counter + ');"><i class="fa fa-remove"></i></a></div>');
						console.log("after add - " + file_counter);					
				});
				
				 	/* form validation and submission code start */

								
							jQuery("#frm_logfault").submit(function(e){
									e.preventDefault();
									var log_user_email=jQuery("#log_user_email").val();									
									var log_product_name = jQuery("#log_product_name" ).val();
									var log_type_of_issue=jQuery("#log_type_of_issue").val();
									var log_invoice_no=jQuery("#log_invoice_no").val();
									
									
									
									if(log_user_email=='')
									{
									  jQuery("#log_user_email").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#log_user_email").val())) {
										jQuery("#log_user_email").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");                                        
										return false;
									}
									else{									
										jQuery("#log_user_email").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}									
									if(log_product_name=='')
									{	jQuery("#log_product_name").css("border-color","red");
										jQuery("#prod_label").text("Please enter product name");
										jQuery("#prod_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#log_product_name").css("border-color","#8d8d8d");
									    jQuery("#prod_label").empty();
									}
									if(log_type_of_issue=='')
									{	jQuery("#log_type_of_issue").css("border-color","red");
										jQuery("#issue_label").text("Please select type of issue");
										jQuery("#issue_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#log_type_of_issue").css("border-color","#8d8d8d");
									    jQuery("#issue_label").empty();
									}
									if(log_invoice_no=='')
									{	jQuery("#log_invoice_no").css("border-color","red");
										jQuery("#invoice_label").text("Please enter invoice no");
										jQuery("#invoice_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#log_invoice_no").css("border-color","#8d8d8d");
									    jQuery("#invoice_label").empty();
									}
									var formData = new FormData(this);

									//form submit
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:formData,																				
										success: function(result) {
											console.log(result);
											
												
											if(result["success"] == true){	
												var logid=result['log_id'];																							
												jQuery('#msg').text("Ticket has been opened successfully.");
												jQuery('#msg').css("color","green");
												var url = logfault2+"?logid="+logid;
												setTimeout(function () {													
												 jQuery('#msg').text("");
												 jQuery('#frm_logfault')[0].reset(); 
												 window.location.href = url;
												}, 2500);
											} else {							
												alert("error");
											}
										},
										cache: false,
										contentType: false,
										processData: false,
									});
									return false;
							});
						/* form validation and submission code end */
						
						
						
							/* product name autocomplete start */
							
							var data ={ action: "getwooproducts_nm_action"};
							jQuery.post(ajaxurl, data, function (response){
								//alert(response);
								
								var availableTags=jQuery.parseJSON(response);;
								//alert(availableTags);
								jQuery( "#log_product_name" ).autocomplete({
									source: availableTags
								});
							});
							
							/* product name autocomplete end */
					});
				
				
			

			function removeFile(file_number) {
				console.log("before-" + total_file);
				jQuery('#file_group' + file_number).remove();
				total_file--;
				console.log("after-" + total_file);
			}


			function onFileSelectForMulti(curr_file_ele, file_number) {

				if (curr_file_ele.value == '') {
					jQuery("#upload" + file_number).html("No file chosen");
				} else {
					jQuery("#upload" + file_number).html(curr_file_ele.value.replace(/C:\\fakepath\\/i, ''));
				}
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
