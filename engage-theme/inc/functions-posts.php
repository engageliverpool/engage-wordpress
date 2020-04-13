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

    $post_type = get_post_type($post);

    echo '<div class="post-list__item">' . "\n";

    echo sprintf(
        '<%s class="post-list__item__title"><a href="%s">%s</a></%s>' . "\n",
        esc_html( $a['heading_tag'] ),
        esc_url( get_permalink($post) ),
        esc_html( get_the_title($post) ),
        esc_html( $a['heading_tag'] )
    );
    if ( $post_type == 'post' ) {
        echo sprintf(
            '<time class="post-list__item__date" datetime="%s">%s</time>' . "\n",
            get_the_time( 'Y-m-d', $post ),
            get_the_time( 'jS F Y', $post )
        );
    } elseif ( $post_type == 'event' ) {
        echo sprintf(
            '<p class="post-list__item__date">%s</p>' . "\n",
            esc_html( event_times(
                carbon_get_post_meta( $post->ID, 'event_start' ),
                carbon_get_post_meta( $post->ID, 'event_end' )
            ) )
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


function get_post_by_slug( $slug ) {
    $posts = get_posts( array(
        'name' => $slug,
        'post_type' => 'any',
        'post_status' => 'publish',
        'posts_per_page' => 1
    ) );
    if ( count( $posts ) ) {
        return $posts[0];
    }
}


function get_the_ancestor_title( $post = 0 ) {
    $post = get_post( $post );
    $url_parts = parse_url( get_permalink( $post ) );

    if ( $url_parts ) {
        $slugs = explode( '/', $url_parts['path'] );
        $slugs = array_values( array_filter( $slugs, 'strlen' ) );
        if ( count($slugs) > 1 ) {
            $top_slug = $slugs[0];
            $top_post = get_post_by_slug( $top_slug );
            if ( $top_post ) {
                return get_the_title( $top_post );
            }
        }
    }

    return '';
}


function event_times( $start, $end = null ) {
    $parts = array();

    $start_timestamp = strtotime($start);
    $end_timestamp = strtotime($end); // will be False if $end is null

    $start_format = 'H:i';
    $end_format = '';

    if ( $end_timestamp ) {
        if ( date( 'Y-m-d', $start_timestamp ) == date( 'Y-m-d', $end_timestamp ) ) {
            // Event starts and ends on the same day.
            // No need to print anything else about the start.
        } elseif ( date( 'Y-m', $start_timestamp ) == date( 'Y-m', $end_timestamp ) ) {
            // Event starts and ends in the same month.
            // Only need to print out the start day.
            $start_format .= ' l jS';
        } elseif ( date( 'Y', $start_timestamp ) == date( 'Y', $end_timestamp ) ) {
            // Event starts and ends in the same year.
            // Print out the start day and month.
            $start_format .= ' l jS F';
        } else {
            $start_format .= ' l jS F Y';
        }

        $end_format = 'H:i l jS F Y';
    } else {
        // No end date, so need to print out entire start date string.
        $start_format .= ' l jS F Y';
    }

    $parts[] = date( $start_format, $start_timestamp );
    if ( $end_format ) {
        $parts[] = '–';
        $parts[] = date( $end_format, $end_timestamp );
    }

    return implode( " ", $parts);
}
