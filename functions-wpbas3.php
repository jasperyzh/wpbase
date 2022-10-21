<?php

require get_template_directory() . '/inc/wpbase-disable_comment.php';

add_action('wp_enqueue_scripts', 'wp_enqueue');
add_action('wpbase_do_header', 'wpbase_do_header');
add_action('wpbase_do_footer', 'wpbase_do_footer');
add_action('wpbase_do_after_content', 'wpbase_do_sidebar');

add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 10, 3);
add_filter('body_class', 'wpbase_body_classes_layout');

/**
 * enqueue_scripts
 * @since 220629
 */

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
    wp_enqueue_script('vue-vendors', $dev_vendor, ['jquery'], WPBASE_VERSION, true);
    wp_enqueue_script('vue-app', $dev_js, ['jquery'], WPBASE_VERSION, true);

    // check if enqueue dev-files
    if (WP_DEBUG) {
        return;
    }
    $handle = 'app.js';
    $list = 'enqueued';
    if (!wp_script_is($handle, $list)) {
        // production
        wp_enqueue_script("vue-vendors", get_stylesheet_directory_uri() . "/dist/js/chunk-vendors.js", ["jquery"], WPBASE_VERSION, true);
        wp_enqueue_script("vue-app", get_stylesheet_directory_uri() . "/dist/js/app.js", ["jquery"], WPBASE_VERSION, true);
        wp_enqueue_style("vue-css", get_stylesheet_directory_uri() . "/dist/css/app.css", NULL, WPBASE_VERSION);
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

function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}

/**
 * declare layout
 */
function wpbase_body_classes_layout($classes)
{
    if (is_front_page()) {
        $classes[] = 'layout_full_width_content';
    } else if (is_single()) {
        $classes[] = 'layout_content_sidebar';
    }
    return $classes;
}

function wpbase_do_header()
{
    get_template_part('template-parts/wpbase', 'header');
}

function wpbase_do_footer()
{
    get_template_part('template-parts/wpbase', 'footer');
}

function wpbase_do_sidebar()
{
    get_sidebar();
}
