<?php

function add_lazy_loading_to_image_attributes($attr){
    if ( ! isset($attr['loading']) ) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'add_lazy_loading_to_image_attributes' );
