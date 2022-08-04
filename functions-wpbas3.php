<?php

/**
 * enqueue_scripts
 * @since 220629
 */
add_action('wp_enqueue_scripts', 'wp_enqueue');
function wp_enqueue()
{
    // localize script: window.localize
    wp_localize_script('jquery', 'localize', array(
        'SITE_URL' => get_site_url(),
    ));

    // development
    $dev_url = "http://localhost:8080";
    $dev_vendor = $dev_url . '/js/chunk-vendors.js';
    $dev_js = $dev_url . '/js/app.js';
    wp_enqueue_script('vue-vendors', $dev_vendor, array('jquery'), '', true);
    wp_enqueue_script('vue-app', $dev_js, array('jquery'), '', true);

    // check if enqueue dev-files
    if (WP_DEBUG) {
        return;
    }
    $handle = 'app.js';
    $list = 'enqueued';
    if (!wp_script_is($handle, $list)) {
        // production
        wp_enqueue_script("vue-vendors", get_stylesheet_directory_uri() . "/dist/js/chunk-vendors.js", array("jquery"), "", true);
        wp_enqueue_script("vue-app", get_stylesheet_directory_uri() . "/dist/js/app.js", array("jquery"), "", true);
        wp_enqueue_style("vue-css", get_stylesheet_directory_uri() . "/dist/css/app.css");
    }
}


/**
 * add nav classes
 * https://stackoverflow.com/questions/26180688/how-to-add-class-to-link-in-wp-nav-menu
 */
function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

