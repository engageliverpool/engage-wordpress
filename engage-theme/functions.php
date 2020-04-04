<?php

// Load Composer packages
require get_parent_theme_file_path( '/vendor/autoload.php' );

require get_theme_file_path( 'inc/wp-theme-support.php' );
require get_theme_file_path( 'inc/wp-tidy.php' );
require get_theme_file_path( 'inc/wp-fixes.php' );
require get_theme_file_path( 'inc/wp-compat.php' );
require get_theme_file_path( 'inc/wp-enqueue.php' );

require get_theme_file_path( 'inc/carbon-fields.php' );

require get_theme_file_path( 'inc/functions-general.php' );
require get_theme_file_path( 'inc/functions-posts.php' );
require get_theme_file_path( 'inc/functions-menus.php' );

require get_theme_file_path( 'inc/menus.php' );
require get_theme_file_path( 'inc/widgets.php' );

require get_theme_file_path( 'widgets/image-list.php' );
