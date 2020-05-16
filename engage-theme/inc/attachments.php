<?php

function add_lazy_loading_to_image_attributes($attr){
    if ( ! isset($attr['loading']) ) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'add_lazy_loading_to_image_attributes' );


function register_custom_image_sizes() {
    set_post_thumbnail_size( 200, 132, true );    // 3:2
    add_image_size( 'feature', 1024, 512, true ); // 2:1
}
add_action( 'after_setup_theme', 'register_custom_image_sizes' );
