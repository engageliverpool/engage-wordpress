<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function rename_tags_and_categories_to_topics_and_projects() {
    global $wp_taxonomies;
    $wp_taxonomies['post_tag']->labels->name = 'Topics';
    $wp_taxonomies['post_tag']->labels->singular_name = 'Topic';
    $wp_taxonomies['post_tag']->labels->search_items = 'Search Topics';
    $wp_taxonomies['post_tag']->labels->popular_items = 'Popular Topics';
    $wp_taxonomies['post_tag']->labels->all_items = 'All Topics';
    $wp_taxonomies['post_tag']->labels->edit_item = 'Edit Topic';
    $wp_taxonomies['post_tag']->labels->view_item = 'View Topic';
    $wp_taxonomies['post_tag']->labels->update_item = 'Update Topic';
    $wp_taxonomies['post_tag']->labels->add_new_item = 'Add New Topic';
    $wp_taxonomies['post_tag']->labels->new_item_name = 'Add Topic Name';
    $wp_taxonomies['post_tag']->labels->separate_items_with_commas = 'Separate topics with commas';
    $wp_taxonomies['post_tag']->labels->add_or_remove_items = 'Add or remove topics';
    $wp_taxonomies['post_tag']->labels->choose_from_most_used = 'Choose from the most used topics';
    $wp_taxonomies['post_tag']->labels->not_found = 'No topics found.';
    $wp_taxonomies['post_tag']->labels->no_terms = 'No topics';
    $wp_taxonomies['post_tag']->labels->items_list_navigation = 'Topics list navigation';
    $wp_taxonomies['post_tag']->labels->items_list = 'Topics list';
    $wp_taxonomies['post_tag']->labels->most_used = 'Most Used';
    $wp_taxonomies['post_tag']->labels->back_to_items = '← Back to Topics';
    $wp_taxonomies['post_tag']->labels->menu_name = 'Topics';
    $wp_taxonomies['post_tag']->labels->name_admin_bar = 'post_tag';

    $wp_taxonomies['category']->labels->name = 'Projects';
    $wp_taxonomies['category']->labels->singular_name = 'Project';
    $wp_taxonomies['category']->labels->search_items = 'Search Projects';
    $wp_taxonomies['category']->labels->popular_items = 'Popular Projects';
    $wp_taxonomies['category']->labels->all_items = 'All Projects';
    $wp_taxonomies['category']->labels->edit_item = 'Edit Project';
    $wp_taxonomies['category']->labels->view_item = 'View Project';
    $wp_taxonomies['category']->labels->update_item = 'Update Project';
    $wp_taxonomies['category']->labels->add_new_item = 'Add New Project';
    $wp_taxonomies['category']->labels->new_item_name = 'Add Project Name';
    $wp_taxonomies['category']->labels->separate_items_with_commas = 'Separate projects with commas';
    $wp_taxonomies['category']->labels->add_or_remove_items = 'Add or remove projects';
    $wp_taxonomies['category']->labels->choose_from_most_used = 'Choose from the most used projects';
    $wp_taxonomies['category']->labels->not_found = 'No projects found.';
    $wp_taxonomies['category']->labels->no_terms = 'No projects';
    $wp_taxonomies['category']->labels->items_list_navigation = 'Projects list navigation';
    $wp_taxonomies['category']->labels->items_list = 'Projects list';
    $wp_taxonomies['category']->labels->most_used = 'Most Used';
    $wp_taxonomies['category']->labels->back_to_items = '← Back to Projects';
    $wp_taxonomies['category']->labels->menu_name = 'Projects';
    $wp_taxonomies['category']->labels->name_admin_bar = 'category';
}
add_action( 'init', 'rename_tags_and_categories_to_topics_and_projects' );


function modify_tag_and_category_rewrite_rules( $args, $taxonomy ) {
    // Note: remember to to flush_rewrite_rules() or `$ wp rewrite flush`
    // after changing any of these rewrite rule settings.
    if ( 'post_tag' == $taxonomy ) {
        $args['rewrite']['with_front'] = false;
        $args['rewrite']['slug'] = 'topics';
    }
    if ( 'category' == $taxonomy ) {
        $args['rewrite']['with_front'] = false;
        $args['rewrite']['slug'] = 'projects';
    }
    return $args;
}
add_filter( 'register_taxonomy_args', 'modify_tag_and_category_rewrite_rules', 99, 2 );
