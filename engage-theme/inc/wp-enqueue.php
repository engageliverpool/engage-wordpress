<?php

function enqueue_frontend_stylesheet() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Quicksand:ital,wght@0,500;0,700;1,500;1,700&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'engage-frontend-style',
        get_theme_file_uri( 'assets/css/frontend-style.css' ),
        array(),
        filemtime(get_theme_file_path( 'assets/css/frontend-style.css' ))
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_frontend_stylesheet' );

function enqueue_frontend_scripts() {
    wp_enqueue_script(
        'html5shiv',
        get_theme_file_uri( 'assets/js/html5shiv.min.js' ),
        array(),
        '3.7.3'
    );
    wp_script_add_data(
        'html5shiv',
        'conditional',
        'lt IE 9'
    );
    wp_enqueue_script(
        'bootstrap-js',
        get_theme_file_uri( 'assets/js/bootstrap.bundle.min.js' ),
        array('jquery'),
        '3.3.7'
    );
    wp_enqueue_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . urlencode(carbon_get_theme_option('google_maps_api_key')),
        array(),
        null
    );
    wp_enqueue_script(
        'engage-frontend-js',
        get_theme_file_uri( 'assets/js/frontend.js' ),
        array('jquery'),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_frontend_scripts' );

function enqueue_admin_stylesheet() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Quicksand:ital,wght@0,500;0,700;1,500;1,700&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'engage-admin-style',
        get_theme_file_uri( 'assets/css/admin-style.css' ),
        array(),
        filemtime(get_theme_file_path( 'assets/css/admin-style.css' ))
    );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_stylesheet' );

function enqueue_editor_stylesheet() {
    add_editor_style(
        '/assets/css/editor-style.css'
    );
}
add_action( 'admin_init', 'enqueue_editor_stylesheet' );
