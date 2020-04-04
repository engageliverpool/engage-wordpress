<?php

function register_navwalker(){
    require get_theme_file_path( 'vendor/class-wp-bootstrap-navwalker.php' );
}
add_action( 'after_setup_theme', 'register_navwalker' );

function register_custom_nav_menus(){
    register_nav_menus(
        array(
            'location-top' => 'Top bar',
            'location-header' => 'Main header',
            'location-social' => 'Social links',
            'location-footer' => 'Footer links',
        )
    );
}
add_action( 'after_setup_theme', 'register_custom_nav_menus' );
