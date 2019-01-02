;(function($) {

$( document ).ready(function() {
    console.log( wpgs_var );
    console.log( wpgs_var.warrows );

    if (wpgs_var.warrows == 'true') {var wpgs_arrows = true;} else {var wpgs_arrows = false;}
    if (wpgs_var.wautoPlay == 'true') {var wpgs_wautoPlay = true;} else {var wpgs_wautoPlay = false;}
    if (wpgs_var.wcaption == 'true') {var wpgs_wcaption = 'title';} else {var wpgs_wcaption = ' ';}

   // var jarrow = wpgsData.warrows;
 // alert(wpgsData.warrows)
 $('.venobox').venobox({
 	 framewidth: wpgs_var.wLightboxframewidth+'px',  
 	 titleattr:wpgs_wcaption ,
 	 numerationPosition: 'bottom',
 	 numeratio:'true',
 	 titlePosition:'bottom'
 	 //
 });  // lightbox

 	
    jQuery('.wpgs img').removeAttr('srcset');
   $('.wpgs-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: wpgs_arrows,
	  fade: false,
	infinite: false,
	autoplay: wpgs_wautoPlay,
	 //pauseOnHover:true,
	  nextArrow: '<i class="flaticon-right-arrow"></i>',
      prevArrow: '<i class="flaticon-back"></i>',
	  asNavFor: '.wpgs-nav'
	});
	$('.wpgs-nav').slick({
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  asNavFor: '.wpgs-for',
	  dots: false,
   		infinite:false,

	  arrows: wpgs_arrows,
	  centerMode: false,
	  focusOnSelect: true,
	   responsive: [
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 1,
		        vertical: false,
		        draggable: true,
		        autoplay: false,//no autoplay in mobile
				isMobile: true,// let custom knows on mobile
				arrows: false //hide arrow on mobile
		      }
		    },
		    ],
	});

   
    // 
    	$('.woocommerce-product-gallery__image img').load(function() {

	    var imageObj = $('.woocommerce-product-gallery__image img');


	    if (!(imageObj.width() == 1 && imageObj.height() == 1)) {
	    	//alert(imageObj.attr('src'));
	    	$('.attachment-shop_thumbnail').attr('src', imageObj.attr('src'));
	    	$('.attachment-shop_thumbnail').trigger('click');
	    	
	   			
	    }
	});


});


     


})( jQuery );