<?php

function register_widget_areas() {
    register_sidebar( array(
        'name' => 'Footer widget area',
        'id' => 'footer-sidebar',
        'description' => 'Shown beside the footer menu.',
        'class' => 'footer-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<h2 class="widget__title">',
        'after_title'   => "</h2>\n",
    ) );
}
add_action( 'widgets_init', 'register_widget_areas' );
