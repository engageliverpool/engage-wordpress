<?php

function rename_posts_to_news() {
    global $wp_post_types;
    // debug($wp_post_types['post']);
    $wp_post_types['post']->labels->name = 'News';
    $wp_post_types['post']->labels->singular_name = 'News item';
    $wp_post_types['post']->labels->add_new = 'Add New';
    $wp_post_types['post']->labels->add_new_item = 'Add a new news item';
    $wp_post_types['post']->labels->edit_item = 'Edit News Item';
    $wp_post_types['post']->labels->new_item = 'New News Item';
    $wp_post_types['post']->labels->view_item = 'View News Item';
    $wp_post_types['post']->labels->view_items = 'View News Items';
    $wp_post_types['post']->labels->search_items = 'Search News';
    $wp_post_types['post']->labels->not_found = 'No news items found.';
    $wp_post_types['post']->labels->not_found_in_trash = 'No news items found in Bin.';
    $wp_post_types['post']->labels->all_items = 'All News';
    $wp_post_types['post']->labels->archives = 'News Archives';
    $wp_post_types['post']->labels->attributes = 'News Attributes';
    $wp_post_types['post']->labels->insert_into_item = 'Insert into news item';
    $wp_post_types['post']->labels->uploaded_to_this_item = 'Uploaded to this news item';
    $wp_post_types['post']->labels->featured_image = 'Featured image';
    $wp_post_types['post']->labels->set_featured_image = 'Set featured image';
    $wp_post_types['post']->labels->remove_featured_image = 'Remove featured image';
    $wp_post_types['post']->labels->use_featured_image = 'Use as featured image';
    $wp_post_types['post']->labels->filter_items_list = 'Filter news list';
    $wp_post_types['post']->labels->items_list_navigation = 'News list navigation';
    $wp_post_types['post']->labels->items_list = 'News list';
    $wp_post_types['post']->labels->item_published = 'News item published.';
    $wp_post_types['post']->labels->item_published_privately = 'News item published privately.';
    $wp_post_types['post']->labels->item_reverted_to_draft = 'News item reverted to draft.';
    $wp_post_types['post']->labels->item_scheduled = 'News item scheduled.';
    $wp_post_types['post']->labels->item_updated = 'News item updated.';
    $wp_post_types['post']->labels->menu_name = 'News';
    $wp_post_types['post']->labels->name_admin_bar = 'News';
}
add_action( 'init', 'rename_posts_to_news' );
