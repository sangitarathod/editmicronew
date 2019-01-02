<?php
/* Template Name: Gallery Album Template */
get_header('second');
if(isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
}

global $wpdb;

?>     <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><a href="<?php echo site_url();?>/gallery">Gallery</a></li>
                      <li><?php echo get_the_title( $id); ?></li>
                    </ul> 
                    <h1><?php echo get_the_title( $id); ?></h1> 
                    
                    <div class="row">
                        <div class="album_images">
						<?php                    
							if (isset($id) && !empty($id)) {
                                $gallerydatas = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}postmeta` WHERE `post_id` =" . $id . " AND `meta_key` = 'wpcf-gallery-images'");
                            }
                            $count = count($gallerydatas);                            
							if($count>0 && $gallerydatas[0]->meta_value!=""){ 
								for($i=0;$i<$count;$i++){
						?>
									<a class="col-sm-4 col-xs-6 col-md-3 col-lg-3 fancybox" href="<?php echo $gallerydatas[$i]->meta_value?>" data-fancybox-group="gallery">
										<img src="<?php echo $gallerydatas[$i]->meta_value?>" alt="sonali" />
									</a>
						<?php	 }
							}else{
								echo "<p align='center'>NO DATA FOUND</p>";
							}
							?>
		                 
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
	
jQuery('.parentlist .toggle').click(function(e) {
		if(jQuery(this).parent().hasClass('parentlist')){
					
					if(jQuery(this).siblings().hasClass('gallery_right')){
						jQuery(this).siblings().addClass('album_contain');
						var getTextis=jQuery(this).siblings().html();
						jQuery('.content-Insert').html(getTextis);
					}
					jQuery('.parentlist .toggle').removeClass('active');
				    jQuery(this).addClass('active');
					if(jQuery(this).hasClass('active')){
						var nextSlide=jQuery(this).next();
						jQuery(this).toggleClass('ToggleMe');
						if(jQuery(this).hasClass('ToggleMe')){
							jQuery(nextSlide).find('li:first').find('.toggle').trigger('click');
						}
						jQuery(nextSlide).slideToggle();
						checkEle();
				    }
		}else{

				var nextSlide=jQuery(this).next().html();
				console.log(nextSlide);
				jQuery('.content-Insert').html(nextSlide);
		}
});
var flag=true;
jQuery('.parentlist .toggle:first').trigger('click');
function checkEle(){
	 jQuery('.parentlist .toggle').each(function(e){
	 		   var ele=jQuery(this);  
		       if(!(jQuery(ele).hasClass('active'))){
		       		jQuery(ele).next().slideUp(500);
		       }
     });
}

</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery.fancybox.css" media="screen" />
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.fancybox').fancybox();
		});
	</script>

</body>
</html>
