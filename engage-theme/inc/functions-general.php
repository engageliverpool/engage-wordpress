<?php

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


function get_site_logo() {
    $site_logo_html = '';
    $custom_logo_id = get_theme_mod( 'custom_logo' );

    if ( $custom_logo_id ) {
        $custom_logo_attr = array(
            'class' => 'site-logo site-logo--custom',
        );

        // If the logo alt attribute is empty, get the site title and explicitly
        // pass it to the attributes used by wp_get_attachment_image().
        $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
            $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
        }

        $site_logo_html = wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr );

    } else {
        $site_logo_html = sprintf(
            '<span class="site-logo site-logo--default">%1$s</span>',
            get_bloginfo( 'name', 'display' )
        );
    }

    return $site_logo_html;
}


function start_site_content() {
    echo '<div class="site-content">' . "\n";
    echo '<div class="container">' . "\n";
}

function end_site_content() {
    echo '</div>' . "\n";
    echo '</div>' . "\n";
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
