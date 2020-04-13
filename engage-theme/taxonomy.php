<?php

// taxonomy.php
// Used by WordPress to display posts in a custom taxonomy.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

// We do something clever here.
//
// If there's a *page* with the same slug as the term in question,
// then we temporarily override the $post variable, to pull out the
// title and content of that page, before reverting back to the default
// term archive listing behaviour.
//
// There's a theme option to suppress the archive list too, in case the
// admin wants to make term archive pages act just like normal pages.
// (Perhaps they'll handle the archive list themselves using a Block.)
//
// This gives us the best of both worlds: a fully customisable (and
// optional) "landing page" for a term, and an automatic (and optional)
// post archive for a term, all on one page.

$term = get_queried_object();
$taxonomy = get_taxonomy( $term->taxonomy );
$cover_page_query = new WP_Query(array(
    'pagename' => $taxonomy->rewrite['slug'] . '/' . $term->slug,
    'post_type' => 'any',
));

$cover_page = array(
    "the_feature_section" => null,
    "the_title" => null,
    "the_content" => null,
);

while ( $cover_page_query->have_posts() ) {
    $cover_page_query->the_post();

    ob_start();
    the_feature_section();
    $cover_page['the_feature_section'] = ob_get_clean();

    ob_start();
    the_title();
    $cover_page['the_title'] = ob_get_clean();

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

      <?php if ( $cover_page['the_title'] ) { ?>
        <h1 class="post__title">
            <?php echo $cover_page['the_title']; ?>
        </h1>
      <?php } else { ?>
        <?php the_page_title_and_description(); ?>
      <?php } ?>

    </div>
</div>
<div class="page-section">
    <div class="page-section__primary">

      <?php if ( $cover_page['the_content'] ) { ?>
        <div class="post__content">
            <?php echo $cover_page['the_content']; ?>
        </div>
      <?php } ?>

        <?php
            $suppressed_archives = carbon_get_theme_option('suppress_term_archives');
            if ( ! in_array( $taxonomy->name, $suppressed_archives ) ) {
                get_template_part( 'partials/post-list' );
                the_posts_pagination();
            }
        ?>

    </div>
    <div class="page-section__secondary">

        <?php the_sidebar(); ?>

    </div>
</div>

<?php

end_site_content();

get_footer();
