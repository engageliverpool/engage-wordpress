<?php

function get_taxonomy_archive_path( $taxonomy ) {
    $t = get_taxonomy( $taxonomy );
    if ( $t ) {
        $r = $t->rewrite;
        if ( isset($r) && isset($r['with_front']) && $r['with_front'] ) {
            return sprintf(
                '%s/%s',
                get_posts_page_path(),
                $r['slug']
            );
        } else {
            return sprintf(
                '/%s',
                $r['slug']
            );
        }
    }
    return site_url();
}
