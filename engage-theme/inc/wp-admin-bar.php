<?php

function register_handy_admin_bar_submenu( $wp_admin_bar ) {

    // Don't need handy links if already on an admin page.
    if ( is_admin() ) {
        return;
    }

    $wp_admin_bar->add_group(
        array(
            'parent' => 'site-name',
            'id'     => 'handy',
        )
    );
    $wp_admin_bar->add_node(
        array(
            'parent' => 'handy',
            'id' => 'posts',
            'title' => 'Posts',
            'href' => admin_url( 'edit.php' ),
        )
    );
    $wp_admin_bar->add_node(
        array(
            'parent' => 'handy',
            'id' => 'pages',
            'title' => 'Pages',
            'href' => admin_url( 'edit.php?post_type=page' ),
        )
    );
    $wp_admin_bar->add_node(
        array(
            'parent' => 'handy',
            'id' => 'events',
            'title' => 'Events',
            'href' => admin_url( 'edit.php?post_type=event' ),
        )
    );
    $wp_admin_bar->add_node(
        array(
            'parent' => 'handy',
            'id' => 'media',
            'title' => 'Media',
            'href' => admin_url( 'upload.php' ),
        )
    );
    $wp_admin_bar->add_node(
        array(
            'parent' => 'handy',
            'id' => 'tags',
            'title' => 'Tags',
            'href' => admin_url( 'edit-tags.php?taxonomy=post_tag' ),
        )
    );
}

add_action('admin_bar_menu', 'register_handy_admin_bar_submenu', 31);