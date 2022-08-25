<?php

add_action('init', 'register_cpt_yayasan_people');
add_action('init', 'register_taxonomy_yayasan_people');

add_action('init', 'register_cpt_yayasan_programme');
add_action('init', 'register_taxonomy_yayasan_programme');


function register_cpt_yayasan_people()
{
    $labels = [
        'name' => _x('Peoples', 'post type general name', 'text_yayasan'),
        'singular_name' => _x('People', 'post type singular name', 'text_yayasan'),
        'menu_name' => _x('Our People', 'admin menu', 'text_yayasan'),
        'name_admin_bar' => _x('People', 'add new on admin bar', 'text_yayasan'),
        'add_new' => _x('Add New', 'people', 'text_yayasan'),
        'add_new_item' => __('Add New People', 'text_yayasan'),
        'new_item' => __('New People', 'text_yayasan'),
        'edit_item' => __('Edit People', 'text_yayasan'),
        'view_item' => __('View People', 'text_yayasan'),
        'all_items' => __('All Peoples', 'text_yayasan'),
        'search_items' => __('Search Peoples', 'text_yayasan'),
        'parent_item_colon' => __('Parent Peoples:', 'text_yayasan'),
        'not_found' => __('No peoples found.', 'text_yayasan'),
        'not_found_in_trash' => __('No peoples found in Trash.', 'text_yayasan'),
    ];
    $args = [
        'labels' => $labels,
        'public' => 1,
        'publicly_queryable' => 1,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'rewrite' => ['slug' => 'people'],
        'capability_type' => 'post',
        'has_archive' => 1,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes',
        ],
        'show_in_rest' => 1,
        'menu_icon' => 'dashicons-universal-access',
        // 'map_meta_cap' => true,
    ];
    register_post_type('people', $args);
}

function register_taxonomy_yayasan_people()
{
    // [tag] - people tags
    $labels = [
        'name' => _x('People Tags', 'taxonomy general name', 'text_yayasan'),
        'singular_name' => _x('People Tag', 'taxonomy singular name', 'text_yayasan'),
        'search_items' => __('Search People Tags', 'text_yayasan'),
        'popular_items' => __('Popular People Tags', 'text_yayasan'),
        'all_items' => __('All People Tags', 'text_yayasan'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit People Tag', 'text_yayasan'),
        'update_item' => __('Update People Tag', 'text_yayasan'),
        'add_new_item' => __('Add New People Tag', 'text_yayasan'),
        'new_item_name' => __('New People Tag Name', 'text_yayasan'),
        'separate_items_with_commas' => __('Separate people tags with commas', 'text_yayasan'),
        'add_or_remove_items' => __('Add or remove people tags', 'text_yayasan'),
        'choose_from_most_used' => __('Choose from the most used people tags', 'text_yayasan'),
        'not_found' => __('No people tags found.', 'text_yayasan'),
        'menu_name' => __('People Tags', 'text_yayasan'),
    ];
    $args = [
        // 'public'                     => true,
        // 'show_ui'                    => true,
        // 'show_admin_column'          => true,
        // 'show_in_nav_menus'          => false,
        'show_in_rest' => true,
        // 'show_tagcloud'              => true,
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => ['slug' => 'people-tag'],
    ];
    register_taxonomy('people-tag', ['people'], $args);
}

function register_cpt_yayasan_programme()
{
    $labels = [
        'name' => _x('Programmes', 'post type general name', "text_yayasan"),
        'singular_name' => _x('Programme', 'post type singular name', "text_yayasan"),
        'menu_name' => _x('Programmes', 'admin menu', "text_yayasan"),
        'name_admin_bar' => _x('Programme', 'add new on admin bar', "text_yayasan"),
        'add_new' => _x('Add New', 'programme', "text_yayasan"),
        'add_new_item' => __('Add New Programme', "text_yayasan"),
        'new_item' => __('New Programme', "text_yayasan"),
        'edit_item' => __('Edit Programme', "text_yayasan"),
        'view_item' => __('View Programme', "text_yayasan"),
        'all_items' => __('All Programmes', "text_yayasan"),
        'search_items' => __('Search Programmes', "text_yayasan"),
        'parent_item_colon' => __('Parent Programmes:', "text_yayasan"),
        'not_found' => __('No programmes found.', "text_yayasan"),
        'not_found_in_trash' => __('No programmes found in Trash.', "text_yayasan"),
    ];
    $args = [
        'labels' => $labels,
        'public' => 1,
        'publicly_queryable' => 1,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'rewrite' => ['slug' => 'programs'],
        'capability_type' => 'post',
        'has_archive' => 1,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes',
        ],
        'show_in_rest' => 1,
        'menu_icon' => 'dashicons-awards',
        'map_meta_cap' => true,
    ];
    register_post_type('program', $args);
}

function register_taxonomy_yayasan_programme()
{
    // [tag] - program tags
    $labels = [
        'name' => _x('Program Tags', 'taxonomy general name', 'text_yayasan'),
        'singular_name' => _x('Program Tag', 'taxonomy singular name', 'text_yayasan'),
        'search_items' => __('Search Program Tags', 'text_yayasan'),
        'popular_items' => __('Popular Program Tags', 'text_yayasan'),
        'all_items' => __('All Program Tags', 'text_yayasan'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Program Tag', 'text_yayasan'),
        'update_item' => __('Update Program Tag', 'text_yayasan'),
        'add_new_item' => __('Add New Program Tag', 'text_yayasan'),
        'new_item_name' => __('New Program Tag Name', 'text_yayasan'),
        'separate_items_with_commas' => __('Separate program tags with commas', 'text_yayasan'),
        'add_or_remove_items' => __('Add or remove program tags', 'text_yayasan'),
        'choose_from_most_used' => __('Choose from the most used program tags', 'text_yayasan'),
        'not_found' => __('No program tags found.', 'text_yayasan'),
        'menu_name' => __('Program Tags', 'text_yayasan'),
    ];
    $args = [
        // 'public'                     => true,
        // 'show_ui'                    => true,
        // 'show_admin_column'          => true,
        // 'show_in_nav_menus'          => false,
        'show_in_rest' => true,
        // 'show_tagcloud'              => true,
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => ['slug' => 'program-tag'],
    ];
    register_taxonomy('program-tag', ['program'], $args);
}
