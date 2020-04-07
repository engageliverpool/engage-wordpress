<?php

// single.php
// Individual blog posts will be presented via this template.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

  <?php if ( has_feature_image() ) { ?>
    <div class="page-section">
        <div class="page-section__only">
            <?php the_feature_image(); ?>
        </div>
    </div>
  <?php } ?>

    <div class="page-section">
        <div class="page-section__primary">

            <h1 class="post__title">
                <?php the_title(); ?>
            </h1>

            <p class="post__date">
                <?php the_dates(); ?>
            </p>

        </div>
    </div>
    <div class="page-section">
        <div class="page-section__primary">

            <div class="post__content">
                <?php the_content(); ?>
            </div>

        </div>
        <div class="page-section__secondary">

            <?php the_sidebar(); ?>

        </div>
    </div>

    <?php
    }
}

end_site_content();

get_footer();
