<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ShareThisWidget extends Widget {
    function __construct() {
        $this->setup( 'share_this_widget', 'Share This…', 'Facebook and Twitter buttons to easily share the current page', array(
            Field::make( 'text', 'title', 'Title (optional)' )
        ) );
    }

    function front_end( $args, $instance ) {
        if ( isset( $instance['title'] ) ) {
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        }

        echo sprintf(
            '<p><a href="http://www.facebook.com/sharer.php?u=%s" class="btn btn-block btn-facebook">Share on Facebook</a></p>',
            urlencode( $GLOBALS['current_request_url'] )
        );

        echo sprintf(
            '<p><a href="https://twitter.com/intent/tweet?text=%s" class="btn btn-block btn-twitter">Share on Twitter</a></p>',
            urlencode( $GLOBALS['current_request_url'] )
        );
    }
}

function register_share_this_widget() {
    register_widget( 'ShareThisWidget' );
}

add_action( 'widgets_init', 'register_share_this_widget' );
