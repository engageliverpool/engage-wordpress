<?php

// https://codex.wordpress.org/Automatic_Feed_Links
add_theme_support( 'automatic-feed-links' );


// https://codex.wordpress.org/Title_Tag
add_theme_support( 'title-tag' );


// https://developer.wordpress.org/reference/functions/add_theme_support/#html5
// We also include 'script' and 'style' here, so that WordPress 5.3+ uses
// the HTML5-style tags without `type` attributes.
add_theme_support( 'html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'script',
    'style',
) );


// https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
add_theme_support( 'post-thumbnails' );


// https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
add_theme_support( 'customize-selective-refresh-widgets' );


// Hilariously not mentioned anywhere in the developer docs, but good to add for Block Editor support.
add_theme_support( 'align-wide' );


// Remove some default gubbins from wp_head.
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_generator' );


// Prevent a load of emoji gunk being inserted into wp_head.
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );


// Prevent Wordpress from wrapping shortcodes in paragraph tags.
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );


// Helper functions for dealing with "show on front:" options.
// Literally cannot believe Wordpress doesn’t include these functions.
function get_posts_page_url() {
    if( 'page' == get_option('show_on_front', false) ) {
        return get_permalink( get_option('page_for_posts') );
    } else {
        return home_url();
    }
}

function get_posts_page_title() {
    $posts_page_id_or_false = get_option('page_for_posts', false);
    if( $posts_page_id_or_false ) {
        return get_the_title( $posts_page_id_or_false );
    } else {
        return 'Blog';
    }
}


// Record the current template name when including a template.
// (Handy for debugging which templates are being rendered!)
function record_current_template( $template ) {
    $GLOBALS['current_theme_template'] = basename($template);
    return $template;
}
add_action('template_include', 'record_current_template', 1000);


// Make the requested URL available to the templates, without
// having to mess around with $wp or $SERVER['REQUEST_URI'].
function record_request_url( $template ) {
    global $wp;
    $GLOBALS['current_request_url'] = home_url( add_query_arg( array(), $wp->request ) );
    return $template;
}
add_action('template_include', 'record_request_url', 1000);
