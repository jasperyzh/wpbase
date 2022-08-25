<?php

// yayasan_define
if (!defined('UPLOAD_DIR_YAYASAN')) {
    define('YAYASAN_VERSION', '1.1.0');
    define("UPLOAD_DIR_YAYASAN", wp_upload_dir()['baseurl'] . "/yayasan");
}

// yayasan_customize
require get_template_directory() . '/template-yayasan/yayasan-cpt.php';
require get_template_directory() . '/template-yayasan/yayasan-legacy-shortcodes.php';


add_action('wpbase_do_before_content', 'wpbase_do_before_content');
function wpbase_do_before_content()
{
    if (is_front_page()) {
        // get_template_part('template-parts/masthead');

        echo do_shortcode('[smartslider3 slider="1"]');

        get_template_part('template-yayasan/content', 'frontpage');
    } else if (!is_front_page() || is_page() || is_singular() || is_single()) {
        get_template_part('template-yayasan/page', 'banner');
    }
}

/**
 * template_yayasan
 */
add_action('wpbase_do_header', 'yayasan_do_header');
function yayasan_do_header()
{
    get_template_part('template-yayasan/header');
}

add_action('wpbase_do_footer', 'yayasan_do_footer');
function yayasan_do_footer()
{
    get_template_part('template-yayasan/footer');
}
add_action('wpbase_do_after_content', 'yayasan_do_sidebar');
function yayasan_do_sidebar()
{
    if (is_single() && get_post_type() !== "people") {
        get_sidebar();
    }
}

remove_filter('body_class', 'wp_body_classes_layout');
add_filter('body_class', 'single_people_classes_layout');
function single_people_classes_layout($classes)
{
    if (is_front_page() || get_post_type() === "people") {
        $classes[] = 'layout_full_width_content';
    } else if (is_single()) {
        $classes[] = 'layout_content_sidebar';
    }
    return $classes;
}

/**
 * @todo
 * 
 * // migrate: ACF
 * // PageBanner; page_banner, image_url; post_type = post,page,people,programme
 * 
 * // styling
 * // display__signature_programme - yayasan_programmes_card
 * 
 * // shortcodes
 */

 // migrate: replace webform

 // webform - backup
 // webform - renew fields
 // webform - test datatables

 // single - http://localhost/yayasan/yayasan-petronas-introduces-bold-programme-for-underprivileged-literacy-challenged-students/

 // category - http://localhost/yayasan/category/press-release/page/2/

 // search - http://localhost/yayasan/?s=press