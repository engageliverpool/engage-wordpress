<?php

// archive-event.php
// A custom archive page template for posts with post_type==event.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

// TODO: This cover page handling is similar to, but not quite identical to,
// the cover page handling in taxonomy.php. It should be DRYed up.

$post_type_obj = get_post_type_object( 'event' );
$cover_page_query = new WP_Query(array(
    'pagename' => $post_type_obj->rewrite['slug'],
    'post_type' => 'any',
));

$cover_page = array(
    "the_feature_section" => null,
    "the_content" => null,
);

while ( $cover_page_query->have_posts() ) {
    $cover_page_query->the_post();

    ob_start();
    the_feature_section();
    $cover_page['the_feature_section'] = ob_get_clean();

    ob_start();
    the_content();
    $cover_page['the_content'] = ob_get_clean();
}

wp_reset_postdata();

?>

<?php if ( $cover_page['the_feature_section'] ) { ?>
    <?php echo $cover_page['the_feature_section']; ?>
<?php } ?>

<div class="page-section">
    <div class="page-section__primary">

        <?php the_page_title_and_description(); ?>

        <?php echo get_earlier_event_archive_link(); ?>
        <?php echo get_later_event_archive_link(); ?>

    </div>
</div>
<div class="page-section">
    <div class="page-section__primary">

      <?php if ( $cover_page['the_content'] ) { ?>
        <div class="post__content">
            <?php echo $cover_page['the_content']; ?>
        </div>
      <?php } ?>

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
