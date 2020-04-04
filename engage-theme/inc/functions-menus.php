<?php

function bootstrap_menu( $location, $options = array() ) {
    if ( has_nav_menu( $location ) ) {
        $defaults = array(
            'theme_location' => $location,
            'container' => false,
            'depth' => 2,
            'fallback_cb' => false,
            'walker' => new WP_Bootstrap_Navwalker()
        );

        wp_nav_menu(
            wp_parse_args( $options, $defaults )
        );
    }
}
