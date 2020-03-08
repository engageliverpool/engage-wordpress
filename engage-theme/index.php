<?php

// index.php
// Used by WordPress if a more specific template cannot be found.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

get_template_part( 'partials/post-list' );
the_posts_pagination();

get_footer();
