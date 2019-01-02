<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.jfontsize-1.0.js"></script>

<!--mCSB_1_scrollbar -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
		(function(jQuery){
			jQuery(window).on("load",function(){
				
				jQuery("#content-3").mCustomScrollbar({
					scrollButtons:{enable:true},
					theme:"light-thick",
					scrollbarPosition:"outside"
				});
				
			});
		})(jQuery);
</script>  

<!--banner slider-->
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
    	<script type="text/javascript">
        	jQuery(document).ready(function() {
        		jQuery('.owl-carousel').owlCarousel({
          		loop: true,
          		margin: 10,
          		responsiveClass: true,
          		dots: true,
          		autoplay: true,
          		autoplayTimeout:5000,
          		autoplayTimeout:5000,
                transitionStyle : "fade",
          		nav: true,
          		responsive: {
            			0: {
              			items: 1,                		
              			loop: true,
            			},
            			600: {
              			items: 1,
              			loop: true,
            			},
            			1000: {
              			items: 1,               		
              			margin: 20
            			}
          		}
        		});
        	});
        </script>
    
<!--fillter script-->
        <script>
            function myFunction() {
               var element = document.getElementById("filter_content");
               element.classList.toggle("filter_1");
            }
            jQuery("#fillter_btn button").click(function(){
                if (typeof(jQuery(this).data('expanded')) === "undefined" || jQuery(this).data('expanded') == "0") {
                    jQuery("#fillter_btn").height(jQuery("#fillter_btn").height()+20);
                    jQuery(this).data('expanded', "1");
            } else {
                    jQuery("#fillter_btn").height(jQuery("#fillter_btn").height()-20);     
                    jQuery(this).data('expanded', "0");
            }
            });
        </script>
    
<!--font size script-->
        <script type="text/javascript" language="javascript">
             jQuery(document).ready(function() {

                            jQuery("#sizeUp").click(function() {

                                jQuery("body").css("font-size","16px");

                            });

                            jQuery("#normal").click(function() {

                                jQuery("body").css("font-size","14px");

                            })

                            jQuery("#sizeDown").click(function() {

                                jQuery("body").css("font-size","12px");

                            })
                        });
        </script> 
    


<script>
 jQuery(document).ready(function() {
  /* vp_h will hold the height of the browser window */
  var vp_h = jQuery(window).height();
  /* b_g will hold the height of the html body */
  var b_g = jQuery('body').height();
  /* If the body height is lower than window */
  if(b_g < vp_h) {
   /* Set the footer css -> position: absolute; */
   jQuery('footer').css("position","absolute");
  }
 });
</script>

<script>
jQuery(document).ready(function(){
	//alert("OK");
	   var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
	   //alert(path);
		jQuery('.list-group-item a').each(function() {
			//alert("OKKKK");
			var a_path=jQuery(this).attr('href');
			//alert(a_path);
      if(a_path === path) {
       jQuery(this).addClass('active');
      }
     });
     
     
     
     
});
</script>
<style>
	.active, a.active {
    color: red;
}
</style>
