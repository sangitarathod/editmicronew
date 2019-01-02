jQuery(document).ready(function(){
	
	/* login 
	jQuery("#frm_login").validationEngine('attach', {
        onValidationComplete: function(form, status){
            if(status){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize()+"&action=login_user",
                    success: function(result) {
						console.log(result);
						 
                        if(result["success"] == true)
                        {							
                            generateNotification("You are logged in successfully.","success");                           
                            var redirecturl = homeurl;
                            setTimeout(function () {
								window.location.href = redirecturl;
                            }, 2500);
                        }
                        else if(result['status']==0)
                        {							
                            generateNotification(result['error'],"error");                            
                            var userid=result['userid'];
                            var redirecturl = complete_profile+"?userid="+userid;                            
                            setTimeout(function () {
                            window.location.href = redirecturl;
                            }, 2500);
                        }else{
							generateNotification(result['error'],"error");							
						}     
                    },
                    error: function(){						
                        generateNotification("Error in login. Please try again.","error");
                    }
                });
            }
        }
    });
    
 /*check existing user usremail 
    jQuery("#usremail").on("blur", function(){
        var useremail = jQuery("#usremail").val();
        
            if(useremail!=""){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: "useremail="+useremail+"&action=check_existing_user_email",
                    success: function(result) { 						
                        if(result['success'] == true){
							//alert(result['success']);
                            jQuery("input[name='usrconfirmemail']").focus();
                        } else {
							//alert(result['error']);
                            generateNotification(result['error'], "error");
                            jQuery("input[name='usremail']").val(function() {
                                return this.defaultValue;
                            });
                            jQuery("input[name='usremail']").focus();
                        }
                    }
                });
            }
    });

    /*check existing user username 
    jQuery("#usrname").on("blur", function(){
        var usrname = jQuery("#usrname").val();
        if(usrname!=""){
            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                dataType: 'json',
                data: "usrname="+usrname+"&action=check_existing_user_username",
                success: function(result) { 
                    if(result['success'])
                    {
						
                    } 
                    else 
                    {						
                       generateNotification(result['error'],"error");
                       jQuery("input[name='usrname']").val(function() {
                           return this.defaultValue;
                       });
                       jQuery("input[name='usrname']").focus();
                    }
                }
            });
        }
    });    
    
    
/* Member Registration Form Validation 
    jQuery("#frm_register").validationEngine('attach', {
        promptPosition : "bottomLeft",
        scroll: false,
        
        onValidationComplete: function(form, status){           
            //if status is true submit event on ajax call
            if(status){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize()+"&action=register_member",
                    success: function(result) { 						
                        if(result["success"] == true){
							var userid=result['user_id'];
							//alert("success");
							generateNotification(result['message'],"success");
                            var url = complete_profile+"?userid="+userid;
                            setTimeout(function () {
								window.location.href = url;
							}, 2500);
                        } else {							
                            generateNotification(result["error"],'error');
                        }
                    },
                    error: function(){
						//alert("Error!  Please try again.");
                        generateNotification("Error!  Please try again.","error");
                    }
                });
            }
        }
    });
    
   
    /* Complete profile Form Validation 
    jQuery("#frm_complete_profile").validationEngine('attach', {
        promptPosition : "bottomLeft",
        scroll: false, 
        custom_error_messages: {
            '#contact_no': {
                'custom[number]': {
                    'message': "Please Enter Valid Mobile Number"
                },
                'minSize': {
                    'message': "Mobile number should be atleast 10 digits"
                }
            },
            '#zip_code': {
                'custom[number]': {
                    'message': "Please Enter Valid zipcode"
				}
           }
        },            
        onValidationComplete: function(form, status){           
            //if status is true submit event on ajax call
            if(status){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize()+"&action=user_complete_profile",
                    success: function(result) { 
						console.log(result);						
                        if(result["success"] == true){
							var userid=result['user_id'];
							//alert("success");
							generateNotification(result['message'],"success");
                            var url = signinurl;
                            setTimeout(function () {
								window.location.href = url;
							}, 3500);
                        } else {							
                            generateNotification(result["message"],'error');
                        }
                    },
                    error: function(){
						//alert("Error!  Please try again.");
                        generateNotification("Error!  Please try again.","error");
                    }
                });
            }
        }
    });    
    */
	
	jQuery('#country').on('change',function(){ 
		var countryID = jQuery(this).val();
		//alert(countryID);
	    if(countryID){
		 jQuery.ajax({ 
				 type:'POST', 
				 url:ajaxurl,
				 data:'country_id='+countryID+"&action=state_frontend",
				 success:function(html){ 
					 //alert(html);
					 jQuery('#state').html(html); 
					
				 }
				}); 
		 }else{ 
			 jQuery('#state').html('<option value="">Select country first</option>'); 			 
		} 
	});
	jQuery('#mp_country').on('change',function(){ 
		var countryID = jQuery(this).val();
		var stateid=jQuery("#stateid").val();
		var dataString = 'country_id='+ countryID+'&stateid=' + stateid;        
                        
		//alert(countryID);
	    if(countryID){
		 jQuery.ajax({ 
				 type:'POST', 
				 url:ajaxurl,
				 data:dataString+"&action=state_frontend",
				 success:function(html){ 
					 //alert(html);
					 jQuery('#state').html(html); 
					
				 }
				}); 
		 }else{ 
			 jQuery('#state').html('<option value="">Select country first</option>'); 			 
		} 
	});
	/* Fortog password 
	
    jQuery("#frm_forgot_pwd").validationEngine('attach', {
        promptPosition : "bottomLeft",
        scroll: false,         
        onValidationComplete: function(form, status){           
            //if status is true submit event on ajax call
            if(status){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize()+"&action=forgot_pwd",
                    success: function(result) { 
						console.log(result);						
                        if(result["success"] == true){							
							var token=result['token'];						
							generateNotification(result['message'],"success");
                            var url = homeurl;
                            setTimeout(function () {
								window.location.href = url;
							}, 3500);
                        } else {							
                            generateNotification(result["message"],'error');
                        }
                    },
                    error: function(){
						//alert("Error!  Please try again.");
                        generateNotification("Error!  Please try again.","error");
                    }
                });
            }
        }
    });
	/* Reset password 
	
    jQuery("#frm_reset_pwd").validationEngine('attach', {
        promptPosition : "bottomLeft",
        scroll: false,         
        onValidationComplete: function(form, status){           
            //if status is true submit event on ajax call
            if(status){
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize()+"&action=reset_pwd",
                    success: function(result) { 
						console.log(result);						
                        if(result["success"] == true){							
							generateNotification(result['message'],"success");
                            var url = homeurl;
                            setTimeout(function () {
								window.location.href = url;
							}, 3000);
                        } else {							
                            generateNotification(result["message"],'error');
                        }
                    },
                    error: function(){
						//alert("Error!  Please try again.");
                        generateNotification("Error!  Please try again.","error");
                    }
                });
            }
        }
    });*/
	
	

});
