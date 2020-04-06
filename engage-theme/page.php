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

    <?php the_feature_image(); ?>

    <div class="row">
        <div class="col-md-8">

            <h1 class="post__title">
                <?php the_title(); ?>
            </h1>

        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <div class="post__content">
                <?php the_content(); ?>
            </div>

        </div>
        <div class="col-md-3 offset-md-1">

            <?php the_sidebar(); ?>

        </div>
    </div>

    <?php
    }
}

end_site_content();

get_footer();
