<?php

function get_the_feature_image() {
    return get_the_post_thumbnail( null, 'feature' );
}

function get_the_feature_carousel() {
    $html = '';

    $blocks = parse_blocks( get_the_content() );
    if ( isset($blocks) && count($blocks) > 1 ) {
        if ( $blocks[0]['blockName'] === 'carbon-fields/page-carousel' ) {
            $html .= render_block( $blocks[0] );
        }
    }

    return $html;
}

function the_feature_section() {
    $html = '';

    // First, try extracting a carousel.
    $feature_html = get_the_feature_carousel();

    // If no carousel, try the thumbnail image.
    if ( ! $feature_html ) {
        $feature_html = get_the_feature_image();
    }

    if ( $feature_html ) {
        $html .= '<div class="page-section page-section--feature">' . "\n";
        $html .= '<div class="page-section__only">' . "\n";
        $html .= $feature_html;
        $html .= '</div>' . "\n";
        $html .= '</div>' . "\n";
    }

    echo $html;
}
