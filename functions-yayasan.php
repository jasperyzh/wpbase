<?php

/**
 * @require_plugins
 * - cmb2
 * - 
 */
// yayasan_define
if (!defined('UPLOAD_DIR_YAYASAN')) {
    define('YAYASAN_VERSION', '1.1.0');
    define("UPLOAD_DIR_YAYASAN", wp_upload_dir()['baseurl'] . "/yayasan");
}

require get_template_directory() . '/template-yayasan/yayasan-cpt.php';

require get_template_directory() . '/template-yayasan/yayasan-cmb2.php';
$yayasan_cmb2 = new YayasanCmb2();
$yayasan_cmb2->register();

require get_template_directory() . '/template-yayasan/yayasan-legacy-shortcodes.php';

require get_template_directory() . '/template-yayasan/yayasan-webform.php';

// yayasan_customize
remove_action('wpbase_do_header', 'wpbase_do_header');
remove_action('wpbase_do_footer', 'wpbase_do_footer');
remove_action('wpbase_do_after_content', 'wpbase_do_sidebar');
remove_filter('body_class', 'wpbase_body_classes_layout');

add_action('wpbase_do_header', 'yayasan_do_header');
add_action('wpbase_do_footer', 'yayasan_do_footer');
add_action('wpbase_do_after_content', 'yayasan_do_sidebar');
add_action('wpbase_do_before_content', 'yayasan_page_banner', 10);
add_filter('body_class', 'single_people_classes_layout');
add_action('widgets_init', 'yayasan_widgets_init');
add_action("wpbase_before_sidebar_content", "yayasan_sidebar_contact");

function yayasan_page_banner()
{
    if (!is_front_page()) {
        if (is_page() || is_singular() || is_single()) {
            get_template_part('template-yayasan/page', 'banner');
        }
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
    global $post;
    $slug = (!empty($post)) ? $post->post_name : "";

    if (is_single() && get_post_type() !== "people" || $slug === "contact") {
        get_sidebar();
    }
}

function single_people_classes_layout($classes)
{
    global $post;
    $slug = (!empty($post)) ? $post->post_name : "";

    if (is_front_page()) {
        $classes[] = 'layout_full_width_content';
    } else if (get_post_type() === "people" || get_post_type() === "program") {
        $classes[] = 'layout_content';
    } else if (is_single() || $slug === "contact") {
        $classes[] = 'layout_content_sidebar';
    }
    return $classes;
}

function yayasan_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar Contact', 'wpbase'),
            'id'            => 'sidebar-contact',
            'description'   => esc_html__('Add content for yayasan-contact-sidebar.', 'wpbase'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar Article', 'wpbase'),
            'id'            => 'sidebar-article',
            'description'   => esc_html__('Add content for yayasan-article-sidebar.', 'wpbase'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
}


function yayasan_sidebar_contact()
{
    global $post;
    $slug = $post->post_name;

    if (is_active_sidebar('sidebar-contact') && $slug === "contact") {
        dynamic_sidebar('sidebar-contact');
    }

    if (is_active_sidebar('sidebar-article') && $post->post_type === "post") {
        dynamic_sidebar('sidebar-article');
    }
}
