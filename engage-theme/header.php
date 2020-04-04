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

    <div class="site-header">
        <div class="site-header__top-bar navbar navbar-expand-md navbar-dark">
            <div class="container">
                <?php bootstrap_menu( 'location-top', array(
                    'menu_class' => 'navbar-nav nav top-links'
                ) ); ?>
                <?php bootstrap_menu( 'location-social', array(
                    'menu_class' => 'social-links'
                ) ); ?>
            </div>
        </div>
        <div class="site-header__main navbar navbar-expand-md navbar-light">
            <div class="container">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home">
                    <?php echo get_site_logo(); ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-main-collapse" aria-controls="header-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                </button>
                <div class="collapse navbar-collapse" id="header-main-collapse">
                    <?php get_search_form(); ?>
                    <?php bootstrap_menu( 'location-header', array(
                        'menu_class' => 'navbar-nav nav main-links'
                    ) ); ?>
                    <?php bootstrap_menu( 'location-top', array(
                        'menu_class' => 'navbar-nav nav top-links'
                    ) ); ?>
                    <?php bootstrap_menu( 'location-social', array(
                        'menu_class' => 'social-links'
                    ) ); ?>
                </div>
            </div>
        </div>
    </div>
