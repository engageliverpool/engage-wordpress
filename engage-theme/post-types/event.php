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
            'date',
            'event_start_date',
            'Start date'
        )->set_width(
            50
        ),
        Field::make(
            'time',
            'event_start_time',
            'Start time'
        )->set_input_format(
            'H:i',
            'H:i'
        )->set_picker_options(
            array(
                'time_24hr' => true,
                'enableSeconds' => false,
            )
        )->set_width(
            50
        ),
        Field::make(
            'date',
            'event_end_date',
            'End date'
        )->set_width(
            50
        ),
        Field::make(
            'time',
            'event_end_time',
            'End time'
        )->set_input_format(
            'H:i',
            'H:i'
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
