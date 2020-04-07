<?php

// index.php
// Used by WordPress if a more specific template cannot be found.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

?>

<div class="row">
    <div class="col-md-8">

        <?php the_page_title_and_description(); ?>

    </div>
</div>
<div class="row">
    <div class="col-md-8">

        <?php get_template_part( 'partials/post-list' );
                the_posts_pagination(); ?>

    </div>
    <div class="col-md-3 offset-md-1">

        <?php the_sidebar(); ?>

    </div>
</div>

<?php

end_site_content();

get_footer();
