
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var customadminlist = "<?php echo site_url(); ?>/wp-admin/admin.php?page=manage_admins";
</script>
<br>
<input type="button" name="btn_add_new_admin" id="btn_add_new_admin" value="Add New Admin" data-toggle="modal" data-target="#myModal">

<div>
<?php
$args1 = array(
 'role' => 'customadmin',
 'orderby' => 'user_nicename',
 'order' => 'ASC'
);
 $customadmins = get_users($args1);

?>
<br><br>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>DATE ADDED</th>
                <th>PERMISSIOM</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
			<?php
			foreach ($customadmins as $user) {
			?>
            <tr>
                <td><?php echo $user->ID;?></td>
                <td><?php echo $user->display_name;?></td>
                <td><?php echo $user->user_email;?></td>
                <td><?php echo date('d M Y',strtotime($user->user_registered));?></td>
                <td>
					<?php
					$capabilities=km_get_user_capabilities($user->ID);
					for($i=1;$i<count($capabilities);$i++){
						echo ucfirst($capabilities[$i])."<br>";
					}
					?>
                </td>
                <td>
				<?php
				//$user_id=$user->ID; //ID of the user to be deleted.
				//$url = add_query_arg(array('action'=>'myprefix_delete_user', 'user_id'=>$user_id));
				//echo  "<a href='".$url. "' onclick=>Delete</a>"; 
				?>
				<form id="frm_delete_user" name="" method="POST" action="">
				<input type="hidden" name="userid<?php echo $user->ID;?>" id="userid<?php echo $user->ID;?>" value="<?php echo $user->ID;?>">
                <a  href="#" class="delete" data-confirm="Are you sure to delete this item?" data-id="<?php echo $user->ID;?>">Delete</a>
                </form>
               
                
                <a  href="#" data-toggle="modal" data-target="#myEditModal" data-whatever=<?php echo $user->ID;?>>Edit</a>
                
                </td>
            </tr>
           <?php }?>
         </tbody>
        <tfoot>
           <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>DATE ADDED</th>
                <th>PERMISSIOM</th>
                <th>ACTION</th>
            </tr>
        </tfoot>
    </table>
   

</div>

<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<label id="msg"></label>
			<h4 class="modal-title" id="myModalLabel">Add New Admin</h4>
		  </div>
		  <form name="frm_add_new_admin"  id="frm_add_new_admin"  method="POST" action="">
			  <input type="hidden" name="u_id" id="u_id" value="">
			  <div class="modal-body">				  
				<input type="text" name="admin_name" id="admin_name" placeholder="Enter admin name.">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="name_label"></label>&nbsp;&nbsp;&nbsp;
				<input type="text" name="admin_department" id="admin_department" placeholder="Enter Department">
				<br><br>
				<input type="text" name="admin_email" id="admin_email" placeholder="Enter email">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="email_label"></label>&nbsp;&nbsp;&nbsp;
				<input type="password" name="admin_pwd" id="admin_pwd" placeholder="Enter Password">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="pwd_label"></label>&nbsp;&nbsp;&nbsp;
				<br><br>
				<label>Access To</label> <span style="color:red;"> * </span>&nbsp;<label id="access_label"></label>
				<br><br>
				<input type="checkbox" name="capability[]" value="messages">Messages &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="capability[]" value="quotes" >Quotes  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="capability[]" value="fault_logs">Fault Logs  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="capability[]" value="training_requests">Training Requests  
				<br>
				<input type="checkbox" name="capability[]" value="employment">Employment  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="capability[]" value="users">Users				
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-primary myButton" id="btn_add_new_admin" name="btn_add_new_admin">Send</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Edit popup -->
	<!-- Modal -->
	<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<label id="e_msg"></label>
			<h4 class="modal-title" id="myModalLabel">Edit Admin</h4>
		  </div>
		  <form name="frm_edit_admin"  id="frm_edit_admin"  method="POST" action="">
			  
			  <div class="modal-body">	
				  <input type="hidden" name="u_id" id="u_id" value="">			  
				<input type="text" name="e_admin_name" id="e_admin_name" placeholder="Enter admin name.">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="e_name_label"></label>&nbsp;&nbsp;&nbsp;
				<input type="text" name="e_admin_department" id="e_admin_department" placeholder="Enter Department">
				<br><br>
				<input type="text" name="e_admin_email" id="e_admin_email" placeholder="Enter email">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="e_email_label"></label>&nbsp;&nbsp;&nbsp;
				<input type="password" name="e_admin_pwd" id="e_admin_pwd" placeholder="Enter Password">&nbsp;<span style="color:red;"> * </span>&nbsp;<label id="e_pwd_label"></label>&nbsp;&nbsp;&nbsp;
				<br><br>
				<label>Access To</label> <span style="color:red;"> * </span>&nbsp;<label id="e_access_label"></label>
				<br><br>
				<input type="checkbox" name="e_capability[]" value="messages">Messages &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="e_capability[]" value="quotes" >Quotes  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="e_capability[]" value="fault_logs">Fault Logs  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="e_capability[]" value="training_requests">Training Requests  
				<br>
				<input type="checkbox" name="e_capability[]" value="employment">Employment  &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="e_capability[]" value="users">Users				
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-primary myEditButton" id="btn_edit_admin" name="btn_edit_admin">Update</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<?php
	$a=km_get_user_capabilities(96);
	print_r($a);
	/*echo "<br>";
	$roles = wp_roles()->get_names();

	foreach( $roles as $role ) {
		echo translate_user_role( $role );
	}*/
	?>
	<script type="text/javascript" language="javascript">
		 function ValidateEmail(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
		};
					jQuery(".myButton").click(function(){
									var admin_name=jQuery("#admin_name").val();
									var admin_email = jQuery("#admin_email" ).val();
									var admin_pwd=jQuery("#admin_pwd").val();
									
									
									
									if(admin_name=='')
									{
										jQuery("#admin_name").css("border-color","red");
										jQuery("#name_label").text("Please Enter Full Name");
										jQuery("#name_label").css("color","red");                                        
										return false;									
									}else{									
										jQuery("#admin_name").css("border-color","#8d8d8d");
									    jQuery("#name_label").empty();
									}
									if(admin_email=='')
									{
									  jQuery("#admin_email").css("border-color","red");
									  jQuery("#email_label").text("Please enter email");
									  jQuery("#email_label").css("color","red");                                        
									  return false;
									}else if (!ValidateEmail(jQuery("#admin_email").val())) {
										jQuery("#admin_email").css("border-color","red");
										jQuery("#email_label").text("Please enter valid email");
										jQuery("#email_label").css("color","red");  
										                                
										return false;
									}
									else{									
										jQuery("#admin_email").css("border-color","#8d8d8d");
										jQuery("#email_label").empty();
									}
									
									if(admin_pwd=='')
									{	jQuery("#admin_pwd").css("border-color","red");
										jQuery("#pwd_label").text("Please enter password");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}else if(admin_pwd.length < 6)
									{	jQuery("#admin_pwd").css("border-color","red");
										jQuery("#pwd_label").text("Please enter minimum six characters");
										jQuery("#pwd_label").css("color","red");                                        
										return false;									
									}
									else{									
										jQuery("#admin_pwd").css("border-color","#8d8d8d");
									    jQuery("#pwd_label").empty();
									}
									if(jQuery('input[name="capability[]"]:checked').length < 1){
											jQuery("#access_label").text("Please select at least one capability");
											jQuery("#access_label").css("color","red");  
												return false;
									}else{
										 jQuery("#access_label").empty();
									}

									// form submit									
								jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:jQuery("#frm_add_new_admin").serialize()+"&action=add_new_admin",
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){
												var userid=result['user_id'];																						
												//alert(result['success']);
												var url = customadminlist;
												jQuery('#msg').text("Admin is created successfully.");
												jQuery('#msg').css("color","green");
												setTimeout(function() {jQuery('#myModal').modal('hide');
													window.location.href = url;
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
							
							/*check existing user usremail */
							jQuery("#admin_email").on("blur", function(){
								var admin_email = jQuery("#admin_email").val();
								
									if(admin_email!=""){
										jQuery.ajax({
											url: ajaxurl,
											type: 'post',
											dataType: 'json',
											data: "useremail="+admin_email+"&action=check_existing_user_email",
											success: function(result) { 						
												if(result['success'] == true){
													//alert(result['success']);
													//jQuery("input[name='usrconfirmemail']").focus();
												} else {
													//alert(result['error']);
													//generateNotification(result['error'], "error");
													jQuery("#email_label").text("Email already exists");													
													jQuery("#email_label").css("color","red");                                        
													jQuery("input[name='admin_email']").focus();
												}
											}
										});
									}
    });
		
	</script>
	<script>
		jQuery(document).ready(function() {
			jQuery('#example').DataTable();
			
			// delete code starts 
			
			jQuery('.delete').on("click", function (e) {
				e.preventDefault();
				var choice = confirm(jQuery(this).attr('data-confirm'));
				var uid = jQuery(this).attr('data-id');
				var userid=jQuery('#userid'+uid).val();
							
				
				if (choice) {									
							jQuery.ajax({
										url: ajaxurl,
										type: 'post',
										dataType: 'json',
										data:"userid="+userid+"&action=delete_custom_admin_byid",
										success: function(result) {
											console.log(result);	
																					 						
											if(result["success"] == true){
												var userid=result['user_id'];																						
												//alert(result['success']);
												location.reload();
																								
											} else {			
												
											}
										},
										error: function(){
											//alert("Error!  Please try again.");
											
										}
									});
								}
							});
				// delete code starts 
	} );
    </script>

	<?php	
	include('edit_custom_admin.php');
	?>
