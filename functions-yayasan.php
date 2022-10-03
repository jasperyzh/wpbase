<?php

// yayasan_define
if (!defined('UPLOAD_DIR_YAYASAN')) {
    define('YAYASAN_VERSION', '1.1.0');
    define("UPLOAD_DIR_YAYASAN", wp_upload_dir()['baseurl'] . "/yayasan");
}

require get_template_directory() . '/template-yayasan/yayasan-cpt.php';

require get_template_directory() . '/template-yayasan/yayasan-legacy-shortcodes.php';


// yayasan_customize
remove_action('wpbase_do_header', 'wpbase_do_header');
remove_action('wpbase_do_footer', 'wpbase_do_footer');
remove_action('wpbase_do_after_content', 'wpbase_do_sidebar');
remove_filter('body_class', 'wpbase_body_classes_layout');

add_action('wpbase_do_before_content', 'wpbase_do_before_content');
add_action('wpbase_do_header', 'yayasan_do_header');
add_action('wpbase_do_footer', 'yayasan_do_footer');
add_action('wpbase_do_after_content', 'yayasan_do_sidebar');
add_filter('body_class', 'single_people_classes_layout');

function wpbase_do_before_content()
{
    if (is_front_page()) {
        echo do_shortcode('[smartslider3 slider="1"]');

        get_template_part('template-yayasan/content', 'frontpage');
    } else if (!is_front_page() || is_page() || is_singular() || is_single()) {
        get_template_part('template-yayasan/page', 'banner');
    }
}

/**
 * template_yayasan
 */

function yayasan_do_header()
{
    get_template_part('template-yayasan/header');
}


function yayasan_do_footer()
{
    get_template_part('template-yayasan/footer');
}

function yayasan_do_sidebar()
{
    if (is_single() && get_post_type() !== "people") {
        get_sidebar();
    }
}

function single_people_classes_layout($classes)
{
    if (is_front_page() || get_post_type() === "people") {
        $classes[] = 'layout_full_width_content';
    } else if (is_single()) {
        $classes[] = 'layout_content_sidebar';
    }
    return $classes;
}
