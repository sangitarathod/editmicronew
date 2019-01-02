<?php 
add_action( 'init', 'create_post_type_events' );

function create_post_type_events() {	
	register_post_type( 'events',
		array(
		'labels' => array(
		'name' => __( 'Events' ),
		'singular_name' => __( 'Events' ),
		'menu_name'           => __( 'Events', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Events', 'twentysixteen' ),
		'all_items'           => __( 'All Events', 'twentysixteen' ),
		'view_item'           => __( 'View Events', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Events', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Events', 'twentysixteen' ),
		'update_item'         => __( 'Update Events', 'twentysixteen' ),
		'search_items'        => __( 'Search Events', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail','editor','excerpt'),		
		)
	);
}

?>
