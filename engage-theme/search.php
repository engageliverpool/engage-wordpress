<?php

// search.php
// Displays search results.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

?>

<div class="row">
    <div class="col-md-8">

        <?php the_page_title_and_description(); ?>

        <?php get_search_form(); ?>

    </div>
</div>

<div class="row">
    <div class="col-md-8">

      <?php

        global $wp_query;
        if ( ! $wp_query->found_posts ) {
            echo '<p>We could not find any results for your search.';
        }

        get_template_part( 'partials/post-list' );
        the_posts_pagination();

      ?>

    </div>
    <div class="col-md-3 offset-md-1">

        <?php the_sidebar(); ?>

    </div>
</div>

<?php

end_site_content();

get_footer();
