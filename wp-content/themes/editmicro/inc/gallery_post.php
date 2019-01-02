<?php 
function gallery_post_type() {
    $args = array(
        'public' => true,
        'label' => 'Gallery',
        'supports' => array('title','thumbnail')
    );
    register_post_type('gallery', $args);
}
add_action('init', 'gallery_post_type');
?>
