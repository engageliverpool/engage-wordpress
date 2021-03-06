<?php

// index.php
// Used by WordPress if a more specific template cannot be found.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

?>

<div class="page-section">
    <div class="page-section__primary">

        <?php the_page_title_and_description(); ?>

    </div>
</div>
<div class="page-section">
    <div class="page-section__primary">

        <?php get_template_part( 'partials/post-list' );
                the_posts_pagination(); ?>

    </div>
    <div class="page-section__secondary">

        <?php the_sidebar(); ?>

    </div>
</div>

<?php

end_site_content();

get_footer();
