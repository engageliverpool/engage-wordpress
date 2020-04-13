<?php

// Load Composer packages
require get_parent_theme_file_path( '/vendor/autoload.php' );

require get_theme_file_path( 'inc/wp-theme-support.php' );
require get_theme_file_path( 'inc/wp-tidy.php' );
require get_theme_file_path( 'inc/wp-fixes.php' );
require get_theme_file_path( 'inc/wp-compat.php' );
require get_theme_file_path( 'inc/wp-enqueue.php' );
require get_theme_file_path( 'inc/wp-admin-bar.php' );

require get_theme_file_path( 'inc/carbon-fields.php' );

require get_theme_file_path( 'inc/functions-general.php' );
require get_theme_file_path( 'inc/functions-posts.php' );
require get_theme_file_path( 'inc/functions-taxonomies.php' );
require get_theme_file_path( 'inc/functions-menus.php' );
require get_theme_file_path( 'inc/functions-sidebars.php' );
require get_theme_file_path( 'inc/functions-feature-images.php' );

require get_theme_file_path( 'inc/taxonomies.php' );

require get_theme_file_path( 'inc/menus.php' );
require get_theme_file_path( 'inc/widgets.php' );
require get_theme_file_path( 'inc/attachments.php' );

require get_theme_file_path( 'post-types/post.php' );
require get_theme_file_path( 'post-types/event.php' );

require get_theme_file_path( 'widgets/related-tags.php' );
require get_theme_file_path( 'widgets/featured-post.php' );
require get_theme_file_path( 'widgets/image-list.php' );
require get_theme_file_path( 'widgets/share-this.php' );

require get_theme_file_path( 'blocks/page-carousel.php' );

require get_theme_file_path( 'admin/theme-options.php' );
