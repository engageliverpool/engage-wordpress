<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Registers the `event` post type.
 */
function event_init() {
    register_post_type( 'event', array(
        'labels'                => array(
            'name'                  => 'Events',
            'singular_name'         => 'Event',
            'all_items'             => 'All Events',
            'archives'              => 'Event Archives',
            'attributes'            => 'Event Attributes',
            'insert_into_item'      => 'Insert into Event',
            'uploaded_to_this_item' => 'Uploaded to this Event',
            'featured_image'        => 'Featured Image',
            'set_featured_image'    => 'Set featured image',
            'remove_featured_image' => 'Remove featured image',
            'use_featured_image'    => 'Use as featured image',
            'filter_items_list'     => 'Filter Events list',
            'items_list_navigation' => 'Events list navigation',
            'items_list'            => 'Events list',
            'new_item'              => 'New Event',
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New Event',
            'edit_item'             => 'Edit Event',
            'view_item'             => 'View Event',
            'view_items'            => 'View Events',
            'search_items'          => 'Search Events',
            'not_found'             => 'No Events found',
            'not_found_in_trash'    => 'No Events found in trash',
            'parent_item_colon'     => 'Parent Event:',
            'menu_name'             => 'Events',
        ),
        'public'                => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_nav_menus'     => true,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
        'taxonomies'            => array( 'post_tag', 'category' ),
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'events', 'with_front' => false),
        'query_var'             => 'event',
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_rest'          => true,
        'rest_base'             => 'event',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ) );
}
add_action( 'init', 'event_init' );

/**
 * Sets the post updated messages for the `event` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `event` post type.
 */
function event_updated_messages( $messages ) {
    global $post;

    $permalink = get_permalink( $post );

    $messages['event'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => sprintf( 'Event updated. <a target="_blank" href="%s">View Event</a>', esc_url( $permalink ) ),
        2  => 'Custom field updated.',
        3  => 'Custom field deleted.',
        4  => 'Event updated.',
        5  => isset( $_GET['revision'] ) ? sprintf( 'Event restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => sprintf( 'Event published. <a href="%s">View Event</a>', esc_url( $permalink ) ),
        7  => 'Event saved.',
        8  => sprintf( 'Event submitted. <a target="_blank" href="%s">Preview Event</a>', esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
        9  => sprintf( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>',
        date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( $permalink ) ),
        10 => sprintf( 'Event draft updated. <a target="_blank" href="%s">Preview Event</a>', esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
    );

    return $messages;
}
add_filter( 'post_updated_messages', 'event_updated_messages' );


// https://developer.wordpress.org/reference/functions/get_query_var/#custom-query-vars
function register_date_query_vars_for_events( $qvars ) {
    $qvars[] = 'event_month';
    $qvars[] = 'event_year';
    return $qvars;
}
add_filter( 'query_vars', 'register_date_query_vars_for_events' );


// https://codex.wordpress.org/Rewrite_API/add_rewrite_rule
function register_date_rewrite_rules_for_events( $wp_rewrite ) {
    add_rewrite_rule(
        'events/([0-9]{4})/([0-9]{1,2})/?$',
        'index.php?post_type=event&event_year=$matches[1]&event_month=$matches[2]',
        'top'
    );
    add_rewrite_rule(
        'events/([0-9]{4})/?$',
        'index.php?post_type=event&event_year=$matches[1]',
        'top'
    );
}
add_filter( 'init', 'register_date_rewrite_rules_for_events' );


function handle_event_queries($query) {
    if ( $query->is_post_type_archive('event') && $query->is_main_query() ) {
        // Sort "event" archives by our custom start_date field.
        $query->set( 'meta_key', '_event_start' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'ASC' );
        $query->set( 'nopaging', true );

        $year = get_query_var( 'event_year', false );
        $month = get_query_var( 'event_month', false );
        $meta_query = array();

        // Limit results to the given month and/or year, if requested.
        if ( $year ) {
            if ( $month ) {
                // First and last day of the requested month.
                $iso_start_day = sprintf( '%04d-%02d-%02d', $year, $month, 1 );
                $iso_end_day = date( 'Y-m-t', strtotime($iso_start_day) );
            } else {
                // First and last day of the requested year.
                $iso_start_day = sprintf( '%04d-%02d-%02d', $year, 1, 1 );
                $iso_end_day = sprintf( '%04d-%02d-%02d', $year, 12, 31 );
            }
            $meta_query[] = array(
                'key' => '_event_start',
                'type' => 'DATE',
                'compare' => 'BETWEEN',
                'value' => array( $iso_start_day, $iso_end_day )
            );
        } else {
            $meta_query[] = array(
                'key' => '_event_start',
                'type' => 'DATE',
                'compare' => '>=',
                'value' => date('Y-m-d')
            );
        }

        $query->set( 'meta_query', $meta_query );
    }
}
add_action( 'pre_get_posts', 'handle_event_queries' );


// WordPress will automatically generate a title of "Events" for our event
// archive pages. But we want to add the month and/or year if present.
function add_dates_to_event_archive_titles( $title_parts ) {
    global $wp_locale;

    if ( is_post_type_archive('event') ) {
        $active_year = get_query_var( 'event_year', false );
        $active_month = get_query_var( 'event_month', false );

        if ( $active_year && $active_month ) {
            $new = sprintf(
                '%s %04d',
                $wp_locale->get_month( (int) $active_month ),
                $active_year
            );
        } elseif ( $active_year ) {
            $new = sprintf(
                '%04d',
                $active_year
            );
        }

        if ( isset($new) ) {
            if ( isset($title_parts['title']) ) {
                // We’re generating a document title in wp_get_document_title().
                $sep = apply_filters( 'document_title_separator', '-' );
                $title_parts['title'] = sprintf(
                    '%s %s %s',
                    $title_parts['title'],
                    $sep,
                    $new
                );
            } else {
                // We’re generating a page title in wp_title().
                $title_parts[] = $new;
            }
        }
    }

    return $title_parts;
}
add_filter( 'wp_title_parts', 'add_dates_to_event_archive_titles' );
add_filter( 'document_title_parts', 'add_dates_to_event_archive_titles' );


Container::make(
    'post_meta',
    'Event Details'
)->where(
    'post_type', '=', 'event'
)->add_fields(
    array(
        Field::make(
            'map',
            'event_location',
            'Location'
        )->set_position(
            53.403005, -2.987465, 14
        ),
        Field::make(
            'checkbox',
            'event_display_map',
            'Display map on event page'
        )->set_option_value(
            '1'
        )->set_default_value(
            '1'
        ),
        Field::make(
            'date_time',
            'event_start',
            'Start date and time'
        )->set_input_format(
            'Y-m-d H:i',
            'Y-m-d H:i'
        )->set_picker_options(
            array(
                'time_24hr' => true,
                'enableSeconds' => false,
            )
        )->set_width(
            50
        ),
        Field::make(
            'date_time',
            'event_end',
            'End date and time'
        )->set_input_format(
            'Y-m-d H:i',
            'Y-m-d H:i'
        )->set_picker_options(
            array(
                'time_24hr' => true,
                'enableSeconds' => false,
            )
        )->set_width(
            50
        ),
    )
);
