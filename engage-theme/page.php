<?php

// page.php
// Static "pages" (ie: post_type!='post') will be presented via this template.
// That includes the front page, if get_option('show_on_front')=='page'.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <h1>
        <?php the_title(); ?>
    </h1>

  <?php if ( has_post_thumbnail() ) { ?>
    <?php the_post_thumbnail(); ?>
  <?php } ?>

    <div>
        <?php the_content(); ?>
    </div>

    <?php
    }
}

get_footer();
