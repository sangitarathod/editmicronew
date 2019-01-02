
<?php wp_head();?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div id="wpbody" role="main">

<div id="wpbody-content" aria-label="Main content" tabindex="0">
		
		<div class="wrap">
<h1 class="wp-heading-inline">Webinar Users</h1>

 <!-- <a href="http://editmicrosystem.php-dev.in/wp-admin/post-new.php?post_type=page" class="page-title-action">Add New </a> -->
<hr class="wp-header-end">


<h2 class="screen-reader-text">Filter pages list</h2><ul class="subsubsub" style="display:none;">
	<li class="all"><a href="edit.php?post_type=page" class="current" aria-current="page">All <span class="count">(25)</span></a> |</li>
	<li class="publish"><a href="edit.php?post_status=publish&amp;post_type=page">Published <span class="count">(24)</span></a> |</li>
	<li class="draft"><a href="edit.php?post_status=draft&amp;post_type=page">Draft <span class="count">(1)</span></a> |</li>
	<li class="trash"><a href="edit.php?post_status=trash&amp;post_type=page">Trash <span class="count">(3)</span></a></li>
</ul>
<form id="posts-filter" method="get">

<p class="search-box" style="display:none; min-height:35px;">
	<label class="screen-reader-text" for="post-search-input">Search Pages:</label>
	<input type="search" id="post-search-input" name="s" value="">
	<input type="submit" id="search-submit" class="button" value="Search Pages"></p>

<input type="hidden" name="post_status" class="post_status_page" value="all">
<input type="hidden" name="post_type" class="post_type_page" value="page">



<input type="hidden" id="_wpnonce" name="_wpnonce" value="f51aa5c67a"><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit.php?post_type=page">	<div class="tablenav top" style="display:none; min-height:50px;">

				<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label><select name="action" id="bulk-action-selector-top">
<option value="-1">Bulk Actions</option>
	<option value="edit" class="hide-if-no-js">Edit</option>
	<option value="trash">Move to Trash</option>
</select>
<input type="submit" id="doaction" class="button action" value="Apply">
		</div>
				<div class="alignleft actions">
		<label for="filter-by-date" class="screen-reader-text">Filter by date</label>
		<select name="m" id="filter-by-date">
			<option selected="selected" value="0">All dates</option>
<option value="201809">September 2018</option>
<option value="201808">August 2018</option>
		</select>
<input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">		</div>
<h2 class="screen-reader-text">Pages list navigation</h2><div class="tablenav-pages"><span class="displaying-num">25 items</span>
<span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">2</span></span></span>
<a class="next-page" href="http://editmicrosystem.php-dev.in/wp-admin/edit.php?post_type=page&amp;paged=2"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
		<br class="clear">
	</div>
<h2 class="screen-reader-text">Pages list</h2><table class="wp-list-table widefat fixed striped pages">
	<thead>
	<tr>
		<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><!-- <input id="cb-select-all-1" type="checkbox"> --></td>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href=""><span>Webinar User Name</span><span class="sorting-indicator"></span></a></th>
		<th scope="col" id="send_email" class="manage-column column-author" style="width:250px;">Send Email</th>
		<th scope="col" id="author" class="manage-column column-author">Institue</th>		
		<th scope="col" id="date" class="manage-column column-date sortable asc">Contact Number</th>	</tr>
	</thead>

	<tbody id="the-list">

	<!-- neosoft tr starts  -->
	<?php
	
	global $wpdb;
	$items_per_page = 2;
	$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
	$offset = ( $page * $items_per_page ) - $items_per_page;	
	$query="SELECT * FROM {$wpdb->prefix}webinar_users";
	//$query = "SELECT * FROM wp_webinar_users";
	$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
	$total = $wpdb->get_var( $total_query );	
	$res_webinars_user_list = $wpdb->get_results($query.' ORDER BY webinar_user_id DESC LIMIT '. $offset.', '. $items_per_page, OBJECT );	
	
	?>
    
	<?php if(count($res_webinars_user_list)>0){ 
	
	foreach($res_webinars_user_list as $res_webinars_user_list_item){ 
	
	?>
    
	<tr id="post-73" class="iedit author-self level-0 post-73 type-page status-publish hentry">
	<th scope="row" class="check-column"><label class="screen-reader-text" for="cb-select-73">Select About Edit Microsystems</label>
	<!-- <input id="cb-select-73" type="checkbox" name="post[]" value="73"> -->
	<div class="locked-indicator">
	<span class="locked-indicator-icon" aria-hidden="true"></span>
	<span class="screen-reader-text">“About Edit Microsystems” is locked</span>
	</div>
	</th><td class="title column-title has-row-actions column-primary page-title" data-colname="Title"><div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
	<strong><?php  echo $res_webinars_user_list_item->webinar_user_name; ?></strong>

	<div class="hidden" id="inline_73">
	<div class="post_title">
	
	</div><div class="post_name">about-edit-microsystems</div>
	<div class="post_author">1</div>
	<div class="comment_status">closed</div>
	<div class="ping_status">closed</div>
	<div class="_status">publish</div>
	<div class="jj">31</div>
	<div class="mm">08</div>
	<div class="aa">2018</div>
	<div class="hh">04</div>
	<div class="mn">18</div>
	<div class="ss">45</div>
	<div class="post_password"></div><div class="post_parent">0</div><div class="page_template">default</div><div class="menu_order">0</div></div>
	
	<div class="row-actions" style="display:none;">
	
	<span class="edit"><a href="http://editmicrosystem.php-dev.in/wp-admin/post.php?post=73&amp;action=edit" aria-label="Edit “About Edit Microsystems”">Edit</a> | </span><span class="inline hide-if-no-js"><a href="#" class="editinline" aria-label="Quick edit “About Edit Microsystems” inline">Quick&nbsp;Edit</a> | </span><span class="trash"><a href="http://editmicrosystem.php-dev.in/wp-admin/post.php?post=73&amp;action=trash&amp;_wpnonce=43326666a3" class="submitdelete" aria-label="Move “About Edit Microsystems” to the Trash">Trash</a> | </span><span class="view"><a href="http://editmicrosystem.php-dev.in/about-edit-microsystems/" rel="bookmark" aria-label="View “About Edit Microsystems”">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
	</td>
	<td class="author column-author" data-colname="Author" style="width:250px;"><a href="" data-toggle="modal" data-target="#myModel" data-whatever="<?php  echo $res_webinars_user_list_item->webinar_user_email; ?>"><?php  echo $res_webinars_user_list_item->webinar_user_email; ?></a></td>
	<td class="author column-author" data-colname="Author"><?php echo $res_webinars_user_list_item->webinar_user_institute; ?></td>	
	<td class="date column-date" data-colname="Date"><?php  echo $res_webinars_user_list_item->webinar_user_contact_num; ?>
	</td>		
    </tr>
	
    <?php } 
	}
	
	?>
   
	<!-- neosoft tr row ends  -->

		</tbody>

	<tfoot>
	<tr>
		<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><!-- <input id="cb-select-all-1" type="checkbox"> --></td>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href=""><span>Webinar User Name</span><span class="sorting-indicator"></span></a></th>
		<th scope="col" class="manage-column column-author" style="width:250px;">Send Email</th>
		<th scope="col" class="manage-column column-author">Institue</th>		
		<th scope="col" id="date" class="manage-column column-date sortable asc">Contact Number</th>	</tr>
	</tfoot>

</table>
<div class="tablenav bottom">
<div class="tablenav-pages"><span class="displaying-num"><?php echo $total;?> items</span>
<?php
				echo paginate_links( array(
                        'base' => add_query_arg( 'cpage', '%#%' ),
                        'format' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total' => ceil($total / $items_per_page),
                        'current' => $page
                    ));
             ?>
</div>
<br class="clear">
</div>

</form>


	<form method="get"><table style="display: none"><tbody id="inlineedit">
		
		<tr id="inline-edit" class="inline-edit-row inline-edit-row-page quick-edit-row quick-edit-row-page inline-edit-page" style="display: none"><td colspan="5" class="colspanchange">

		<fieldset class="inline-edit-col-left">
			<legend class="inline-edit-legend">Quick Edit</legend>
			<div class="inline-edit-col">
	
			<label>
				<span class="title">Title</span>
				<span class="input-text-wrap"><input type="text" name="post_title" class="ptitle" value=""></span>
			</label>

			<label>
				<span class="title">Slug</span>
				<span class="input-text-wrap"><input type="text" name="post_name" value=""></span>
			</label>

	
				<fieldset class="inline-edit-date">
			<legend><span class="title">Date</span></legend>
				<div class="timestamp-wrap"><label><span class="screen-reader-text">Month</span><select name="mm">
			<option value="01" data-text="Jan">01-Jan</option>
			<option value="02" data-text="Feb">02-Feb</option>
			<option value="03" data-text="Mar">03-Mar</option>
			<option value="04" data-text="Apr">04-Apr</option>
			<option value="05" data-text="May">05-May</option>
			<option value="06" data-text="Jun">06-Jun</option>
			<option value="07" data-text="Jul">07-Jul</option>
			<option value="08" data-text="Aug" selected="selected">08-Aug</option>
			<option value="09" data-text="Sep">09-Sep</option>
			<option value="10" data-text="Oct">10-Oct</option>
			<option value="11" data-text="Nov">11-Nov</option>
			<option value="12" data-text="Dec">12-Dec</option>
</select></label> <label><span class="screen-reader-text">Day</span><input type="text" name="jj" value="31" size="2" maxlength="2" autocomplete="off"></label>, <label><span class="screen-reader-text">Year</span><input type="text" name="aa" value="2018" size="4" maxlength="4" autocomplete="off"></label> @ <label><span class="screen-reader-text">Hour</span><input type="text" name="hh" value="04" size="2" maxlength="2" autocomplete="off"></label>:<label><span class="screen-reader-text">Minute</span><input type="text" name="mn" value="18" size="2" maxlength="2" autocomplete="off"></label></div><input type="hidden" id="ss" name="ss" value="45">			</fieldset>
			<br class="clear">
	
	<label class="inline-edit-author"><span class="title">Author</span><select name="post_author" class="authors">
	<option value="1">root (root)</option>
</select></label>
			<div class="inline-edit-group wp-clearfix">
				<label class="alignleft">
					<span class="title">Password</span>
					<span class="input-text-wrap"><input type="text" name="post_password" class="inline-edit-password-input" value=""></span>
				</label>

				<em class="alignleft inline-edit-or">
					–OR–				</em>
				<label class="alignleft inline-edit-private">
					<input type="checkbox" name="keep_private" value="private">
					<span class="checkbox-title">Private</span>
				</label>
			</div>

	
		</div></fieldset>

	
		<fieldset class="inline-edit-col-right"><div class="inline-edit-col">

				<label>
				<span class="title">Parent</span>
	<select name="post_parent" id="post_parent">
	<option value="0">Main Page (no parent)</option>
	<option class="level-0" value="73">About Edit Microsystems</option>
	<option class="level-0" value="22">About Us</option>
	<option class="level-0" value="77">Awards</option>
	<option class="level-0" value="75">BEE Certificate</option>
	<option class="level-0" value="71">Careers</option>
	<option class="level-0" value="116">Complete Profile</option>
	<option class="level-0" value="20">Contact</option>
	<option class="level-0" value="133">Forgot Password</option>
	<option class="level-0" value="79">Gallery</option>
	<option class="level-0" value="7">Home</option>
	<option class="level-0" value="26">Log a Fault</option>
	<option class="level-0" value="108">Manage Profile</option>
	<option class="level-0" value="69">Meet The Team</option>
	<option class="level-0" value="81">News</option>
	<option class="level-0" value="83">Projects</option>
	<option class="level-0" value="97">Register for a course</option>
	<option class="level-0" value="135">Reset Password</option>
	<option class="level-0" value="104">Sign In</option>
	<option class="level-0" value="106">Sign Out</option>
	<option class="level-0" value="113">Sign Up</option>
	<option class="level-0" value="85">Success Stories</option>
	<option class="level-0" value="24">Training</option>
	<option class="level-0" value="99">Training Videos</option>
	<option class="level-0" value="123">Webinars</option>
</select>
			</label>

	
			<label>
				<span class="title">Order</span>
				<span class="input-text-wrap"><input type="text" name="menu_order" class="inline-edit-menu-order-input" value="0"></span>
			</label>

	
			<label>
			<span class="title">Template</span>
			<select name="page_template">
                				<option value="default">Default Template</option>
				
	<option value="template-completeprofile.php">Completeprofile Template</option>
	<option value="template-forgot-pwd.php">ForgotPWD  Template</option>
	<option value="front-page.php">Home Template</option>
	<option value="template-login.php">Login Template</option>
	<option value="template-register.php">Register Template</option>
	<option value="template-reset-pwd.php">ResetPWD  Template</option>
	<option value="template-signout.php">Signout Template</option>
	<option value="teplate-webinars.php">Webinars Template</option>			</select>
		</label>
	
	
	
			<div class="inline-edit-group wp-clearfix">
							<label class="alignleft">
					<input type="checkbox" name="comment_status" value="open">
					<span class="checkbox-title">Allow Comments</span>
				</label>
						</div>

	
			<div class="inline-edit-group wp-clearfix">
				<label class="inline-edit-status alignleft">
					<span class="title">Status</span>
					<select name="_status">
												<option value="publish">Published</option>
						<option value="future">Scheduled</option>
												<option value="pending">Pending Review</option>
						<option value="draft">Draft</option>
					</select>
				</label>

	
			</div>

	
		</div></fieldset>

			<div class="submit inline-edit-save">
			<button type="button" class="button cancel alignleft">Cancel</button>
			<input type="hidden" id="_inline_edit" name="_inline_edit" value="30f00e6067">				<button type="button" class="button button-primary save alignright">Update</button>
				<span class="spinner"></span>
						<input type="hidden" name="post_view" value="list">
			<input type="hidden" name="screen" value="edit-page">
						<br class="clear">
			<div class="notice notice-error notice-alt inline hidden">
				<p class="error"></p>
			</div>
		</div>
		</td></tr>
	
		<tr id="bulk-edit" class="inline-edit-row inline-edit-row-page bulk-edit-row bulk-edit-row-page bulk-edit-page" style="display: none"><td colspan="5" class="colspanchange">

		<fieldset class="inline-edit-col-left">
			<legend class="inline-edit-legend">Bulk Edit</legend>
			<div class="inline-edit-col">
				<div id="bulk-title-div">
				<div id="bulk-titles"></div>
			</div>

	
	
	
		</div></fieldset>

	
		<fieldset class="inline-edit-col-right"><div class="inline-edit-col">

	<label class="inline-edit-author"><span class="title">Author</span><select name="post_author" class="authors">
	<option value="-1">— No Change —</option>
	<option value="1">root (root)</option>
</select></label>			<label>
				<span class="title">Parent</span>
	<select name="post_parent" id="post_parent">
	<option value="-1">— No Change —</option>
	<option value="0">Main Page (no parent)</option>
	<option class="level-0" value="73">About Edit Microsystems</option>
	<option class="level-0" value="22">About Us</option>
	<option class="level-0" value="77">Awards</option>
	<option class="level-0" value="75">BEE Certificate</option>
	<option class="level-0" value="71">Careers</option>
	<option class="level-0" value="116">Complete Profile</option>
	<option class="level-0" value="20">Contact</option>
	<option class="level-0" value="133">Forgot Password</option>
	<option class="level-0" value="79">Gallery</option>
	<option class="level-0" value="7">Home</option>
	<option class="level-0" value="26">Log a Fault</option>
	<option class="level-0" value="108">Manage Profile</option>
	<option class="level-0" value="69">Meet The Team</option>
	<option class="level-0" value="81">News</option>
	<option class="level-0" value="83">Projects</option>
	<option class="level-0" value="97">Register for a course</option>
	<option class="level-0" value="135">Reset Password</option>
	<option class="level-0" value="104">Sign In</option>
	<option class="level-0" value="106">Sign Out</option>
	<option class="level-0" value="113">Sign Up</option>
	<option class="level-0" value="85">Success Stories</option>
	<option class="level-0" value="24">Training</option>
	<option class="level-0" value="99">Training Videos</option>
	<option class="level-0" value="123">Webinars</option>
</select>
			</label>

	
			<label>
			<span class="title">Template</span>
			<select name="page_template">
				<option value="-1">— No Change —</option>
                				<option value="default">Default Template</option>
				
	<option value="template-completeprofile.php">Completeprofile Template</option>
	<option value="template-forgot-pwd.php">ForgotPWD  Template</option>
	<option value="front-page.php">Home Template</option>
	<option value="template-login.php">Login Template</option>
	<option value="template-register.php">Register Template</option>
	<option value="template-reset-pwd.php">ResetPWD  Template</option>
	<option value="template-signout.php">Signout Template</option>
	<option value="teplate-webinars.php">Webinars Template</option>			</select>
		</label>
	
	
	
			<div class="inline-edit-group wp-clearfix">
					<label class="alignleft">
				<span class="title">Comments</span>
				<select name="comment_status">
					<option value="">— No Change —</option>
					<option value="open">Allow</option>
					<option value="closed">Do not allow</option>
				</select>
			</label>
					</div>

	
			<div class="inline-edit-group wp-clearfix">
				<label class="inline-edit-status alignleft">
					<span class="title">Status</span>
					<select name="_status">
							<option value="-1">— No Change —</option>
												<option value="publish">Published</option>
						
							<option value="private">Private</option>
												<option value="pending">Pending Review</option>
						<option value="draft">Draft</option>
					</select>
				</label>

	
			</div>

	
		</div></fieldset>

			<div class="submit inline-edit-save">
			<button type="button" class="button cancel alignleft">Cancel</button>
			<input type="submit" name="bulk_edit" id="bulk_edit" class="button button-primary alignright" value="Update">			<input type="hidden" name="post_view" value="list">
			<input type="hidden" name="screen" value="edit-page">
						<br class="clear">
			<div class="notice notice-error notice-alt inline hidden">
				<p class="error"></p>
			</div>
		</div>
		</td></tr>
			</tbody></table></form>
			
<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div>

 <!-- Modal -->
	<div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<label id="msg"></label>
			<h4 class="modal-title" id="myModalLabel">Send Email</h4>
		  </div>
		  <form name="frm_web_res_email"  id="frm_web_res_email"  method="POST" action="">
		  <div class="modal-body">
			<input type="hidden" name="web_user_email" id="web_user_email" value=""> 
			Message &nbsp;&nbsp; <label id="web_user_msg_label"></label> <br><br>
			<textarea rows="3" cols="70" name="web_user_msg" id="web_user_msg"></textarea>	
			<br><Br>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary myButton" id="btn_web_usr_email" name="btn_web_usr_email">Send</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
 <script type="text/javascript" language="javascript">
/* form validation and submission code start */
						jQuery(document).ready(function(){
							jQuery(".myButton").click(function(){										
									var web_user_msg=jQuery("#web_user_msg").val();	
									var web_user_email=jQuery("#web_user_email").val();
									//var myVar = $("#start").find('.myClass').val();
									//alert(web_user_email);
									
									if(web_user_msg=='')
									{										
										jQuery("#web_user_msg").css("border-color","red");
										jQuery("#web_user_msg_label").text("Please Enter Message");
										jQuery("#web_user_msg_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#web_user_msg").css("border-color","#8d8d8d");
									    jQuery("#web_user_msg_label").empty();
									}
									
									/*form submit*/
									jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_web_res_email").serialize()+"&action=webinars_register_member",
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){
												var userid=result['user_id'];																						
												//alert(result['success']);
												jQuery('#msg').text("Email has been sent successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function() {jQuery('#myModel').modal('hide');}, 4000);
																								
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
			
							/* form validation and submission code end */
						});	
				
				
				jQuery('#myModel').on('show.bs.modal', function (event) {
				  var button = jQuery(event.relatedTarget) // Button that triggered the modal
				  var recipient = button.data('whatever') // Extract info from data-* attributes
				  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				  var modal = jQuery(this)
				  //modal.find('.modal-title').text('New message to ' + recipient)
				  modal.find('.modal-body input').val(recipient)
				});
</script>
