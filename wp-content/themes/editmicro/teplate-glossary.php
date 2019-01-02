<?php
/* Template Name: Glossary Template */
get_header('second');
?>
        <!-- section end Here -->
       <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>/training">Training</a></li>
                      <li><?php the_title(); ?></li>
                    </ul> 
                    <h1><?php the_title(); ?></h1>   
                    <div class="glossary_contain">
                        <ul class="nav nav-tabs">
							<?php
							$terms = get_terms([
								'taxonomy' => 'alpha-char',
								'hide_empty' => false,
							]);							
							foreach ( $terms as $term ) {							   
							   if($term->name=='A'){
								
							?>
								   <li class="active"><a data-toggle="tab" href="#<?php echo $term->slug; ?>" class="alpha" name="<?php echo $term->term_id;?>" id="<?php echo $term->term_id;?>"><?php echo $term->name; ?></a></li>
								   
							<?php
							   }else{
							?>
								   <li><a data-toggle="tab" href="#<?php echo $term->slug;?>" class="alpha" name="<?php echo $term->term_id;?>" id="<?php echo $term->term_id;?>"><?php echo $term->name;?></a></li>
							<?php
									}	
									$cat_id=$term->term_id;
									//echo $cat_id;
									$cat=$term->name;	
									echo '<input type="hidden" name="cat_id" id="cat_id" value="">';									
							}
							?>
							
                        </ul>
                        <div class="tab-content glossary_info">
                            <div id="" class="tab-pane fade in active">
                              <div class="col-sm-1">
                                <h1 class="headalpha">A</h1>  
                              </div>
                              <div class="col-sm-11">
                                <ul class="post_list">
									<?php
										$args = [
										'post_type' => 'glossary',
										'tax_query' => [
											[
												'taxonomy' => 'alpha-char',
												'terms' =>24,											
											],
										],									
									];	
									$posts = get_posts($args);		
									foreach($posts as $post){
										$result.='<li><h4>'.$post->post_title.'</h4><p>'.$post->post_content.'</p></li>';
									}
									echo $result;
									?>
                                </ul>
                              </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <?php get_footer();?>
	
		
		
	<!--popup 1 -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		  <div class="modal-cont<li>ent">
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

 <script type="text/javascript" language="javascript">
	 jQuery(".alpha").click(function(){
		 //alert("OK");
		 var alpha=jQuery(this).attr('href');
		 var id=jQuery(this).attr('id');
		 var r_alpha=alpha.replace('#','');
		 var u_alpha=r_alpha.toUpperCase();
		 //alert(r_alpha);
		 jQuery(".fade").attr("id",r_alpha);
		 jQuery(".headalpha").text(u_alpha);
		 jQuery("#cat_id").val(id);
		 jQuery(".post_list").text('');
		 
			jQuery.ajax({
						url: ajaxurl,
						type: 'post',												
						data:'id='+id+"&action=display_glossary",
						success: function(result) {
							jQuery('.post_list').html(result);
						},
							error: function(){
								//alert("Error!  Please try again.");
							}
					});
	 });
 </script>


