<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make(
    'theme_options',
    'Theme Options'
)->set_page_parent(
    'themes.php'
)->add_fields(
    array(
        Field::make(
            'set',
            'suppress_term_archives',
            'Suppress the automatic list of posts at the end of term pages in the following taxonomies:'
        )->set_options(
            'set_options_automatic_term_archives'
        )
    )
);

function set_options_automatic_term_archives() {
    $options = array();
    $taxonomies = get_taxonomies( array(
        "public" => 1,
        "show_ui" => 1,
    ), 'objects' );
    foreach ($taxonomies as $taxonomy ) {
        $options[ $taxonomy->name ] = sprintf(
            '%s – %s/…',
            $taxonomy->labels->name,
            get_taxonomy_archive_path( $taxonomy->name )
        );
    }
    return $options;
}
