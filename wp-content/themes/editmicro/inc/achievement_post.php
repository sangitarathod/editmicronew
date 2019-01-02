<?php 
add_action( 'init', 'create_post_type_achievements' );

function create_post_type_achievements() {	
	register_post_type( 'achievements',
		array(
		'labels' => array(
		'name' => __( 'Achievements' ),
		'singular_name' => __( 'Achievements' ),
		'menu_name'           => __( 'Achievements', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Achievements', 'twentysixteen' ),
		'all_items'           => __( 'All Achievements', 'twentysixteen' ),
		'view_item'           => __( 'View achievement', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New achievement', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit achievement', 'twentysixteen' ),
		'update_item'         => __( 'Update Achievements', 'twentysixteen' ),
		'search_items'        => __( 'Search Achievements', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail','editor'),
		'taxonomies'          => array( 'category' ),
		)
	);
}

?>
