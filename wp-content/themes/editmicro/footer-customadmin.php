<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>		
		 <footer>
                    <p>Copyright © 2018 EditMicrosystem</p>
         </footer>
	

<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/customadmin/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             jQuery(document).ready(function () {
                 jQuery('#sidebarCollapse').on('click', function () {
                     jQuery('#sidebar').toggleClass('active');
                 });
             });
         </script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                jQuery('#example,#example2').DataTable( {
                    initComplete: function () {
                        this.api().columns().every( function () {
                            var column = this;
                            var select = jQuery('<select><option value=""></option></select>')
                                .appendTo( jQuery(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = jQuery.fn.dataTable.util.escapeRegex(
                                        jQuery(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'jQuery' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                    }
                } );
            } );
            </script>


