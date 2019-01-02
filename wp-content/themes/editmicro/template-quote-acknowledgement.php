<?php
/* Template Name: Quote Acknowledge Template */
get_header('second');
?>
        <!-- section end Here -->
       <div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="">Quotes</a></li>
                      <li>Request Quotes</li>
                    </ul> 
                    <h1>Request Quotes</h1>   
                    <div class="thank_you_text">
                        <img src="<?php echo  get_stylesheet_directory_uri();?>/assets/images/thank_you_icon.png" alt="">
                        <p><strong>Thank you</strong> for your request, <br> we will respond as soon as possible</p>
                        <a href="<?php echo site_url(); ?>/shop">Continue Shopping</a>
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



</body>
</html>
