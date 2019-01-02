<?php 
add_action( 'init', 'create_post_type_success_stories' );

function create_post_type_success_stories() {	
	register_post_type( 'success_stories',
		array(
		'labels' => array(
		'name' => __( 'Success Stories' ),
		'singular_name' => __( 'Success Stories' ),
		'menu_name'           => __( 'Success Stories', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Success Stories', 'twentysixteen' ),
		'all_items'           => __( 'All Success Stories', 'twentysixteen' ),
		'view_item'           => __( 'View Success Stories', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Success Story', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Success Story', 'twentysixteen' ),
		'update_item'         => __( 'Update Success Story', 'twentysixteen' ),
		'search_items'        => __( 'Search Success Story', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail','editor','excerpt'),		
		)
	);
}

?>
