<?php 
add_action( 'init', 'create_post_type_projects' );

function create_post_type_projects() {	
	register_post_type( 'projects',
		array(
		'labels' => array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Projects' ),
		'menu_name'           => __( 'Projects', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Projects', 'twentysixteen' ),
		'all_items'           => __( 'All Projects', 'twentysixteen' ),
		'view_item'           => __( 'View projects', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New project', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit projects', 'twentysixteen' ),
		'update_item'         => __( 'Update projects', 'twentysixteen' ),
		'search_items'        => __( 'Search Projects', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail','editor'),		
		)
	);
}

?>
