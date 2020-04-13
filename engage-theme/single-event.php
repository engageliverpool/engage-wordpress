<?php

// single-event.php
// Events (ie: post_type=='event') will be presented via this template.
// https://developer.wordpress.org/themes/basics/template-hierarchy/

get_header();

start_site_content();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <?php
        $event_meta = array(
            'location' => carbon_get_the_post_meta( 'event_location' ),
            'display_map' => carbon_get_the_post_meta( 'event_display_map' ),
            'start_date' => carbon_get_the_post_meta( 'event_start_date' ),
            'start_time' => carbon_get_the_post_meta( 'event_start_time' ),
            'end_date' => carbon_get_the_post_meta( 'event_end_date' ),
            'end_time' => carbon_get_the_post_meta( 'event_end_time' ),
        );
    ?>

    <?php the_feature_section(); ?>

    <div class="page-section">
        <div class="page-section__primary">

            <h1 class="post__title">
                <?php the_title(); ?>
            </h1>

          <?php if ( $event_meta['location']['address'] ) { ?>
            <p class="event__location"><?php echo esc_html( $event_meta['location']['address'] ); ?></p>
          <?php } ?>

          <?php if ( $event_meta['start_date'] ) { ?>
            <p class="event__date"><?php echo esc_html( event_times( $event_meta ) ); ?><p>
          <?php } ?>

        </div>
    </div>

    <div class="page-section">
        <div class="page-section__primary">

            <div class="post__content">
                <?php the_content(); ?>
            </div>

          <?php if ( $event_meta['location']['address'] && $event_meta['display_map'] ){ ?>
            <div class="event__map" data-google-map-coordinates="<?php echo esc_attr( $event_meta['location']['value'] ); ?>"></div>
            <p class="event__directions">
                View map and directions on:
                <a href="https://maps.google.com/maps?q=<?php echo urlencode( $event_meta['location']['value'] ); ?>" target="_blank">Google Maps</a>
                /
                <a href="https://duckduckgo.com/?q=<?php echo urlencode( $event_meta['location']['value'] ); ?>&ia=web&iaxm=maps" target="_blank">Apple Maps</a>
            </p>
          <?php } ?>

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
