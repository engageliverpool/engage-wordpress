<?php

// archive-event.php
// A custom archive page template for posts with post_type==event.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

?>

<div class="page-section">
    <div class="page-section__primary">

        <?php the_page_title_and_description(); ?>

        <?php echo get_earlier_event_archive_link(); ?>
        <?php echo get_later_event_archive_link(); ?>

    </div>
</div>
<div class="page-section">
    <div class="page-section__primary">

        <!-- TODO: Handle the case where there are no upcoming events -->
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
