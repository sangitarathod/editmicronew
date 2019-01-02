<?php 
add_action( 'init', 'create_post_type_news' );

function create_post_type_news() {	
	register_post_type( 'news',
		array(
		'labels' => array(
		'name' => __( 'News' ),
		'singular_name' => __( 'News' ),
		'menu_name'           => __( 'News', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent News', 'twentysixteen' ),
		'all_items'           => __( 'All News', 'twentysixteen' ),
		'view_item'           => __( 'View news', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New news', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit news', 'twentysixteen' ),
		'update_item'         => __( 'Update News', 'twentysixteen' ),
		'search_items'        => __( 'Search News', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail','editor','excerpt'),		
		)
	);
}

?>
