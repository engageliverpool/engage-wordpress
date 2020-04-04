<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ImageListWidget extends Widget {
    function __construct() {
        $this->setup( 'image_list_widget', 'Image List', 'Displays a list of clickable images.', array(
            Field::make( 'text', 'title', 'Title' ),
            Field::make( 'complex', 'items', 'List items' )->add_fields( array(
                Field::make( 'image', 'image', 'Image' )->set_width( 40 )->set_classes( 'cf-field--no-margin' ),
                Field::make( 'text', 'url', 'Link to' )->set_width( 60 )->set_classes( 'cf-field--no-margin' )
            ) )
        ) );
    }

    function front_end( $args, $instance ) {
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        echo '<div class="image-list">';
        foreach ( $instance['items'] as $item ) {
            echo sprintf(
                '<a href="%s" target="_blank">%s</a>',
                $item['url'],
                wp_get_attachment_image( $item['image'], 'full' )
            );
        }
        echo '</div>';
    }
}

function register_image_list_widget() {
    register_widget( 'ImageListWidget' );
}

add_action( 'widgets_init', 'register_image_list_widget' );
