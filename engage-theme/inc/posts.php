<?php

function sort_posts_by_modified_time( $query ) {
    // Note: we don’t change the sorting on search, archive, or term pages.
    // On search and term pages, news posts are likely to mixed in with
    // other post types, so sorting by modification date is less important.
    // And on archive pages (eg: date archives) sorting by original date
    // published is actually preferable.
    if ( $query->is_main_query() && ! is_admin() && is_home() ) {
        $query->set( 'orderby', 'modified' );
    }
}
add_action( 'pre_get_posts', 'sort_posts_by_modified_time' );
