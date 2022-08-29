<?php

/**
 * 
 * https://codex.wordpress.org/Plugin_API/Filter_Reference
 * 
 * 
 * https://codex.wordpress.org/Plugin_API/Action_Reference
 */


// echo '<pre>';
// var_export($wp_filter);
// print_r($wp_filter);
// echo '</pre>';

// use query_monitor


// wp_title
function custom_wp_title($title, $sep){
    global $page;

    // add the site name
    $title .= get_blogname('name');

    // add the site description
    $site_description = get_bloginfo('description', 'display');
    if($site_description && (is_home() || is_front_page())){
        $title = "$title $sep $site_description";
    }
    return $title;
}
// add_filter( "wp_title", "custom_wp_title", 20, 2);


// posts_column
function wpbase_manage_posts_column($columns){
    // if($columns['title']) unset( $columns['title']);

    unset( $columns['author'] );
    unset( $columns['categories'] );
    unset( $columns['tags'] );
    unset( $columns['comments'] );
    return $columns;

}
// add_filter( 'manage_posts_columns', 'wpbase_manage_posts_column');


// remove_all_actions()
// remove_all_filters()
// remove_all_shortcodes()

// single_arg
// do_action($tag, $arg);

// multiple_args
// do_action($tag, $arg_a, $arg_b, $arg_c);

// multiple_args
// do_action_ref_array($tag, $arg_array);

// if ( has_action('init', 'custom_plugin_code') ) {}

/**
 * look into documentation of plugins & themes > query_monitors > sourcecode/codebase
 */