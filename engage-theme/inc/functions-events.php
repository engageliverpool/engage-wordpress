<?php

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


function get_earlier_event_archive_link( $attrs = array() ) {
    global $wp_locale;

    $active_year = get_query_var( 'event_year', false );
    $active_month = get_query_var( 'event_month', false );

    if ( $active_year && $active_month ) {
        // Fun fact! mktime() loops around year boundaries automatically
        // (eg: 1 means January, and 0 means "December of previous year").
        $previous_month = ( (int) $active_month ) - 1;
        $iso_start_day = date( 'Y-m-d', mktime(0, 0, 0, $previous_month, 1, $active_year) );
        $iso_end_day = date( 'Y-m-t', strtotime($iso_start_day) );
    } elseif ( $active_year ) {
        $previous_year = ( (int) $active_year ) - 1;
        $iso_start_day = sprintf( '%04d-%02d-%02d', $previous_year, 1, 1 );
        $iso_end_day = sprintf( '%04d-%02d-%02d', $previous_year, 12, 31 );
    } else {
        $iso_start_day = date( 'Y-01-01' );
        $iso_end_day = date( 'Y-12-31' );
    }

    // Check that there’s at least one event in the target range.
    if ( get_events_in_range( $iso_start_day, $iso_end_day ) ) {
        if ( $active_year && $active_month ) {
            $url = sprintf(
                '%s%s/%s/',
                get_post_type_archive_link( 'event' ),
                date( 'Y', strtotime($iso_start_day) ),
                date( 'm', strtotime($iso_start_day) )
            );
            $title = sprintf(
                '%s %s',
                $wp_locale->get_month( date( 'm', strtotime($iso_start_day) ) ),
                date( 'Y', strtotime($iso_start_day) )
            );
        } elseif ($active_year) {
            $url = sprintf(
                '%s%s/',
                get_post_type_archive_link( 'event' ),
                date( 'Y', strtotime($iso_start_day) )
            );
            $title = sprintf(
                '%s',
                date( 'Y', strtotime($iso_start_day) )
            );
        } else {
            $url = sprintf(
                '%s%s/',
                get_post_type_archive_link( 'event' ),
                date( 'Y', strtotime($iso_start_day) )
            );
            $title = sprintf(
                'All %s events',
                date( 'Y', strtotime($iso_start_day) )
            );
        }

        return sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $url ),
            isset($attrs['classes']) ? esc_attr($attrs['classes']) : '',
            esc_html( $title )
        );
    } else {
        return '';
    }
}


function get_later_event_archive_link( $attrs = array() ) {
    global $wp_locale;

    $active_year = get_query_var( 'event_year', false );
    $active_month = get_query_var( 'event_month', false );

    // Special case! "Upcoming events" link (to /events) if we’re currently
    // viewing the latest year’s, or latest month’s, archive.
    if ( $active_year == date('Y') && ( $active_month == date('m') || $active_month == false ) ) {
        $url = get_post_type_archive_link( 'event' );
        $title = 'Back to upcoming events';
        return sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $url ),
            isset($attrs['classes']) ? esc_attr($attrs['classes']) : '',
            esc_html( $title )
        );
    }

    if ( $active_year && $active_month ) {
        // Fun fact! mktime() loops around year boundaries automatically
        // (eg: 12 means December, and 13 means "January of next year").
        $next_month = ( (int) $active_month ) + 1;
        $iso_start_day = date( 'Y-m-d', mktime(0, 0, 0, $next_month, 1, $active_year) );
        $iso_end_day = date( 'Y-m-t', strtotime($iso_start_day) );
    } elseif ( $active_year ) {
        $next_year = ( (int) $active_year ) + 1;
        $iso_start_day = sprintf( '%04d-%02d-%02d', $next_year, 1, 1 );
        $iso_end_day = sprintf( '%04d-%02d-%02d', $next_year, 12, 31 );
    } else {
        // We must be on the /events page, and you can’t get "later" than that!
        return '';
    }

    // Check that there’s at least one event in the target range.
    if ( get_events_in_range( $iso_start_day, $iso_end_day ) ) {
        if ( $active_year && $active_month ) {
            $url = sprintf(
                '%s%s/%s/',
                get_post_type_archive_link( 'event' ),
                date( 'Y', strtotime($iso_start_day) ),
                date( 'm', strtotime($iso_start_day) )
            );
            $title = sprintf(
                '%s %s',
                $wp_locale->get_month( date( 'm', strtotime($iso_start_day) ) ),
                date( 'Y', strtotime($iso_start_day) )
            );
        } elseif ($active_year) {
            $url = sprintf(
                '%s%s/',
                get_post_type_archive_link( 'event' ),
                date( 'Y', strtotime($iso_start_day) )
            );
            $title = sprintf(
                '%s',
                date( 'Y', strtotime($iso_start_day) )
            );
        }

        return sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $url ),
            isset($attrs['classes']) ? esc_attr($attrs['classes']) : '',
            esc_html( $title )
        );
    } else {
        return '';
    }
}


function get_events_in_range( $iso_start_day, $iso_end_day ) {
    return get_posts( array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'meta_key' => '_event_start',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => '_event_start',
                'type' => 'DATE',
                'compare' => 'BETWEEN',
                'value' => array( $iso_start_day, $iso_end_day )
            )
        )
    ) );
}
