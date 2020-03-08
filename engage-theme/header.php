<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <!-- URL requested: <?php echo $GLOBALS['current_request_url']; ?> -->
    <!-- Using template: <?php echo $GLOBALS['current_theme_template']; ?> -->

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php bloginfo( 'name' ); ?>
    </a>

  <?php if ( has_nav_menu( 'header' ) ) {
    wp_nav_menu(
        array(
            'theme_location' => 'header',
            'container' => false,
            'depth' => 2,
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker()
        )
    );
  } ?>
