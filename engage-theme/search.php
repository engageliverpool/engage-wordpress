<?php

// search.php
// Displays search results.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

echo sprintf(
    '<h1>%s</h1>' . "\n",
    get_the_title()
);

get_search_form();

get_template_part( 'partials/post-list' );
the_posts_pagination();

get_footer();
