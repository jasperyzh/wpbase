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
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);



/**
 * shortcode-latest posts
 */
add_shortcode('latest_posts', 'get_latest_posts');
function get_latest_posts($atts)
{
    $atts = shortcode_atts([
        'category_name' => '',
    ], $atts, 'get_latest_posts');

    $query = new WP_Query([
        'post_status' => "published",
        'posts_per_page' => 5,
        'category_name' => $atts['category_name'],
    ]);
    ob_start();

    if ($query->have_posts()) :
        echo '<article>';
        while ($query->have_posts()) :
            $query->the_post();

            echo get_the_date();
            echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' .
                '<h4>' . get_the_title() . '</h4>' . '
            </a>';

        endwhile;
        echo '</article>';
    endif;

    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * shortcode-add-template-parts
 */

add_shortcode('get_template_part', 'get_get_template_part');
function get_get_template_part($atts)
{
    $atts = shortcode_atts([
        'slug' => '',
        'name' => '',
        'args' => ''
    ], $atts, 'get_template_part');

    ob_start();
    get_template_part($atts['slug'], $atts['name'], $atts['args']);

    return ob_get_clean();
}

/**
 * declare layout
 */
add_filter('body_class', 'wp_body_classes_layout', 1);
function wp_body_classes_layout($classes)
{
    if (is_front_page()) {
        $classes[] = 'layout_full_width_content';
    } else if (is_single()) {
        $classes[] = 'layout_content_sidebar';
    }
    return $classes;
}

/**
 * do_action
 */
// add_action('wpbase_do_header', 'wpbase_do_header', 1);
function wpbase_do_header()
{
    get_template_part('template-parts/wpbase', 'header');
}

// add_action('wpbase_do_footer', 'wpbase_do_footer', 1);
function wpbase_do_footer()
{
    get_template_part('template-parts/wpbase', 'footer');
}

// add_action('wpbase_do_after_content', 'wpbase_do_sidebar', 1);
function wpbase_do_sidebar()
{
    get_sidebar();
}
