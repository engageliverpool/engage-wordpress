<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class FeaturedPostWidget extends Widget {
    function __construct() {
        $this->setup( 'featured_post_widget', 'Featured Post', 'Display a post, with optional custom image', array(
            Field::make( 'association', 'related_posts', 'Post' )->set_types(
                array(
                    array( 'type' => 'post', 'post_type' => 'post' ),
                    array( 'type' => 'post', 'post_type' => 'page' ),
                    array( 'type' => 'post', 'post_type' => 'event' ),
                )
            )->set_max( 1 )->set_classes( 'cf-association-stacked' ),
            Field::make( 'image', 'image_id', 'Custom image (optional)' )
        ) );
    }

    function front_end( $args, $instance ) {
        if ( $instance['related_posts'] ) {
            $post = get_post( $instance['related_posts'][0]['id'] );

            if ( $post ) {
                $permalink_escaped = esc_url( get_permalink($post) );

                echo '<div class="featured-post">' . "\n";

                if ( has_post_thumbnail( $post ) ) {
                    echo sprintf(
                        '<a href="%1$s">%2$s</a>' . "\n",
                        $permalink_escaped,
                        get_the_post_thumbnail( $post, 'full' )
                    );
                }

                echo sprintf(
                    '<a href="%1$s">%2$s</a>' . "\n",
                    $permalink_escaped,
                    esc_html( get_the_title($post) )
                );

                echo '</div>' . "\n";

            }
        }
    }
}

function register_featured_post_widget() {
    register_widget( 'FeaturedPostWidget' );
}

add_action( 'widgets_init', 'register_featured_post_widget' );
