    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-footer__logo">
                        <?php echo get_site_logo(); ?>
                    </a>

                    <?php bootstrap_menu( 'location-footer', array(
                        'menu_class' => 'nav flex-column'
                    ) ); ?>

                    <ul class="nav flex-column">
                      <?php if ( is_user_logged_in() ) { ?>
                        <?php $current_user = wp_get_current_user(); ?>
                        <li class="nav-item nav-item--mixed-content">
                            Logged in as
                            <a href="<?php echo get_edit_user_link(); ?>"><?php echo $current_user->display_name; ?></a>
                          </li>
                        <li class="nav-item">
                            <a href="<?php echo get_dashboard_url(); ?>" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo wp_logout_url(get_permalink()); ?>" class="nav-link">Log out</a>
                        </li>
                      <?php } else { ?>
                        <li class="nav-item">
                            <a href="<?php echo wp_login_url(); ?>" class="nav-link">Staff login</a>
                        </li>
                      <?php } ?>
                    </ul>

                </div>
                <div class="col-md-8 offset-md-1 col-lg-9 offset-lg-0">

                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>

                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>

</body>
</html>
