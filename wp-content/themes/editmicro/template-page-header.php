<?php 
/*
 * Template Name: Page template With Defualt header
*/
get_header();
// wp_head();
?>
        <!-- section end Here -->
        <div class="body_content">
        <div class="banner_section">
            <div class="container">
                <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                    <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/page/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </div>
    </div>   
  
    </section>

<?php get_footer();
