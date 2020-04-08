<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class RelatedTagsWidget extends Widget {
    function __construct() {
        $this->setup( 'related_tags_widget', 'Related Tags', 'Display a list of tags for the current post or page', array(
            Field::make(
                'text',
                'title',
                'Title (optional)'
            ),
            Field::make(
                'select',
                'taxonomy',
                'Taxonomy'
            )->set_options(
                'get_taxonomy_options'
            )->set_default_value(
                'post_tag'
            )
        ) );
    }

    // Heavily inspired by get_the_term_list()
    // https://developer.wordpress.org/reference/functions/get_the_term_list/
    function front_end( $args, $instance ) {
        $taxonomy = $instance['taxonomy'];
        $terms = get_the_terms( 0, $taxonomy );

        if ($terms) {
            if ( isset( $instance['title'] ) ) {
                echo $args['before_title'] . $instance['title'] . $args['after_title'];
            }

            echo '<ul>' . "\n";

            foreach($terms as $term) {
                $term_url = get_term_link( $term, $taxonomy );
                echo sprintf(
                    '<li><a href="%1$s" rel="tag">%2$s</a></li>' . "\n",
                    esc_url( $term_url ),
                    $term->name
                );
            }

            echo '</ul>' . "\n";
        }
    }
}

function get_taxonomy_options() {
    $options = array();
    $taxonomies = get_taxonomies( array(
        "public" => 1
    ), 'objects' );
    foreach ($taxonomies  as $taxonomy ) {
        $options[ $taxonomy->name ] = $taxonomy->labels->name;
    }
    return $options;
}

function register_related_tags_widget() {
    register_widget( 'RelatedTagsWidget' );
}

add_action( 'widgets_init', 'register_related_tags_widget' );
