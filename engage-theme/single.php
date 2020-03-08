<?php

// single.php
// Individual blog posts will be presented via this template.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <h1>
        <?php the_title(); ?>
    </h1>

    <time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time('jS F Y'); ?></time>

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
