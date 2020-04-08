<?php

// page.php
// Static "pages" (ie: post_type!='post') will be presented via this template.
// That includes the front page, if get_option('show_on_front')=='page'.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <?php the_feature_section(); ?>

  <?php if ( ! is_front_page() ) { ?>
    <div class="page-section">
        <div class="page-section__primary">

            <h1 class="post__title">
                <?php the_title(); ?>
            </h1>

        </div>
    </div>
  <?php } ?>

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
