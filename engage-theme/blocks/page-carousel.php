<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function define_page_carousel_block() {
    Block::make(
        'Page carousel'
    )->add_fields( 
        array(
            Field::make(
                'association',
                'related_pages',
                'Pages'
            )->set_types(
                array(
                    array( 'type' => 'post', 'post_type' => 'post' ),
                    array( 'type' => 'post', 'post_type' => 'page' ),
                    array( 'type' => 'post', 'post_type' => 'event' ),
                )
            ),
        )
    )->set_icon(
        'slides'
    )->set_render_callback(
        'render_page_carousel_block'
    );
}

function render_page_carousel_block($fields, $attributes, $inner_blocks) {
    $id = 'carousel_' . uniqid();
    $className = 'carousel slide page-carousel';
    if ( isset($attributes['className']) ) {
        $className = $className . ' ' . $attributes['className'];
    }
    echo sprintf(
        '<div class="%s" id="%s" data-ride="carousel">' . "\n",
        esc_attr( $className ),
        esc_attr( $id )
    );

    echo '<div class="carousel-inner">' . "\n";

    $i = 0;
    foreach ( $fields['related_pages'] as $r ) {
        $slide_classes = 'carousel-item';
        if ( $i == 0 ) {
            $slide_classes .= ' active';
        }

        $p = get_post( $r['id'] );
        $slide_css = sprintf(
            "background-image: url(%s);",
            esc_attr( wp_get_attachment_url( get_post_thumbnail_id( $p ) ) )
        );

        $slide_content = sprintf(
            '<div>' . "\n" .
            '<small>%1$s</small>' . "\n" .
            '<h2>%2$s</h2>' . "\n" .
            '</div>' . "\n",
            get_the_ancestor_title( $p ),
            no_widow( get_the_title( $p ) )
        );

        echo sprintf(
            '<a href="%1$s" class="%2$s" style="%3$s">%4$s</a>' . "\n",
            get_the_permalink( $p ),
            $slide_classes,
            $slide_css,
            $slide_content
        );

        $i++;
    }

    echo '</div>' . "\n"; // close carousel-inner

    echo get_carousel_control( $id, 'prev' );
    echo get_carousel_control( $id, 'next' );

    echo '</div>' . "\n"; // close carousel
}

function get_carousel_control( $id, $direction ) {
    echo sprintf(
        '<a class="carousel-control-%2$s" href="#%1$s" role="button" data-slide="%2$s">' . "\n",
        esc_attr( $id ),
        esc_attr( $direction )
    );
    echo sprintf(
        '<span class="carousel-control-%1$s-icon" aria-hidden="true"></span>' . "\n",
        esc_attr( $direction )
    );
    echo sprintf(
        '<span class="sr-only">%1$s</span>' . "\n",
        $direction == 'prev' ? 'Previous' : 'Next'
    );
    echo '</a>';
}

add_action( 'carbon_fields_register_fields', 'define_page_carousel_block' );

// If a post begins with a carbon-fields/page-carousel block, then
// the_feature_section() will extract and render it at the top of the page.
// We don't want that carousel to get rendered *again* when the_content()
// is called, so we filter output of the_content() to remove the first
// block, if the first block is a carbon-fields/page-carousel block.
function ignore_first_carousel_in_the_content( $content ) {

    // Only want to run this filter if we're on a page or post,
    // and we are inside the main query (loop) on that page or post.
    if( is_singular() && is_main_query() ) {

        // Match the page-carousel block at the start of the content string.
        // Note, PCRE_MULTILINE (m) is not enabled, so ^ will only match at
        // the very start of the string, not at the start of every line.
        // We do this so that the page-carousel is removed *only* if it is
        // the first block in the content.
        // We include \s* tokens at the start and end of our pattern, so that
        // any spaces or new lines either side of the page-carousel component
        // are also removed.
        // And finally we use @ as the delimiter, to save escaping the slash
        // between "carbon-fields" and "page-carousel" ;-)
        $pattern = '@^\s*<!-- wp:carbon-fields/page-carousel.*-->\s*@';

        $replacement = '';
        $content = preg_replace( $pattern, $replacement, $content );
    }

    return $content;
}

// WordPress runs the do_blocks filter at priority 9 in the running order.
// We want to access the content before the do_blocks filter removes all the 
// handy block-identifying <!-- wp:some-block-name --> comments. So we run 
// just before the do_blocks filter, at priority 8.
add_filter( 'the_content', 'ignore_first_carousel_in_the_content', 8 );
