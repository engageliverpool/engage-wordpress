<?php

function post_list( $posts, $args = array() ) {
    echo '<div class="post-list">' . "\n";
    foreach( $posts as $p ) {
        echo post_list_item( $p, $args );
    }
    echo '</div>' . "\n";
}

function post_list_item( $post, $args = array() ) {
    $defaults = array(
        'show_excerpt' => true,
        'heading_tag' => 'h2',
    );
    $a = wp_parse_args( $args, $defaults );

    echo '<div class="post-list__item">' . "\n";

    echo sprintf(
        '<%s class="post-list__item__title"><a href="%s">%s</a></%s>' . "\n",
        esc_html( $a['heading_tag'] ),
        esc_url( get_permalink($post) ),
        esc_html( get_the_title($post) ),
        esc_html( $a['heading_tag'] )
    );
    if ( get_post_type($post) == 'post' ) {
        echo sprintf(
            '<time class="post-list__item__date" datetime="%s">%s</time>' . "\n",
            get_the_time( 'Y-m-d', $post ),
            get_the_time( 'jS F Y', $post )
      );
    }
    if ( $a['show_excerpt'] ) {
        echo sprintf(
            '<div class="post-list__item__excerpt">%s</div>' . "\n",
            get_the_excerpt($post)
        );
    }

    echo '</div>';
}


function the_dates() {
    $html = '';
    $published = get_the_time( 'Y-m-d' );
    $updated = get_the_modified_time( 'Y-m-d' );

    $html .= sprintf(
        'Published by %s on <time datetime="%s">%s</time>',
        get_the_author_posts_link(),
        $published,
        get_the_time('jS F Y')
    );

    if ( $published != $updated ) {
        $html .= sprintf(
            ', updated <time datetime="%s">%s</time>',
            $updated,
            get_the_modified_time('jS F Y')
        );
    }

    echo $html;
}


function has_feature_image() {
    return has_post_thumbnail();
}


function the_feature_image() {
    if ( has_post_thumbnail() ) {
        $css = sprintf(
            "background-image: url(%s);",
            esc_attr( wp_get_attachment_url( get_post_thumbnail_id() ) )
        );
        echo sprintf(
            '<div class="post__feature-image" style="%s">%s</div>',
            $css,
            get_the_post_thumbnail()
        );
    }
}
