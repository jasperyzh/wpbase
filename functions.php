<?php

/**
 * Wpbase functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wpbase
 */

if (!defined('WPBASE_VERSION')) {
	// Replace the version number of the theme on each release.
	define('WPBASE_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpbase_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Wpbase, use a find and replace
		* to change 'wpbase' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('wpbase', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus([
		'primary' => esc_html__('Primary', 'wpbase'),
		'footer' => esc_html__('Footer', 'wpbase'),
		'social' => esc_html__('Social', 'wpbase'),
		'quick' => esc_html__('Quick', 'wpbase'),
	]);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wpbase_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// https://speckyboy.com/styling-wide-full-width-gutenberg-blocks-wordpress/
	add_theme_support('align-wide');

	// https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#block-color-palettes
	add_theme_support('editor-color-palette', [
		array(
			'name'  => esc_attr__('Primary', 'wpbase'),
			'slug'  => 'bs-primary',
			'color' => '#0d6efd',
		),
		array(
			'name'  => esc_attr__('Indigo', 'wpbase'),
			'slug'  => 'bs-indigo',
			'color' => '#6610f2',
		),
		/* array(
			'name'  => esc_attr__('very light gray', 'wpbase'),
			'slug'  => 'very-light-gray',
			'color' => '#eee',
		),
		array(
			'name'  => esc_attr__('very dark gray', 'wpbase'),
			'slug'  => 'very-dark-gray',
			'color' => '#444',
		), */
	]);
}
add_action('after_setup_theme', 'wpbase_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
/* function wpbase_content_width()
{
	$GLOBALS['content_width'] = apply_filters('wpbase_content_width', 640);
}
add_action('after_setup_theme', 'wpbase_content_width', 0); */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpbase_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'wpbase'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'wpbase'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Popup Modal', 'wpbase'),
			'id'            => 'popup-modal',
			'description'   => esc_html__('Add content here to activate a popup-modal on frontpage.', 'wpbase'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Toast Notification', 'wpbase'),
			'id'            => 'toast-notification',
			'description'   => esc_html__('Add content here to activate a toast-notification on frontpage.', 'wpbase'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'wpbase_widgets_init');

/**
 * Enqueue scripts and styles.
 */
/* function wpbase_scripts()
{
	// wp_enqueue_style('wpbase-style', get_stylesheet_uri(), array(), WPBASE_VERSION);
	// wp_style_add_data('wpbase-style', 'rtl', 'replace');

	// moved to src
	// wp_enqueue_script('wpbase-navigation', get_template_directory_uri() . '/js/navigation.js', array(), WPBASE_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'wpbase_scripts'); */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
/* if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
} */

/**
 * Load WooCommerce compatibility file.
 */
/* if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
} */

/**
 * wpbas3 functions
 */
require get_template_directory() . '/functions-wpbas3.php';

require get_template_directory() . '/inc/wpbase-clearwordpress.php';

require get_template_directory() . '/inc/wpbase-contactform.php';

require get_template_directory() . '/inc/wpbase-widgets.php';

// require get_template_directory() . '/inc/wpbase-sendmail.php';

require get_template_directory() . '/inc/wpbase-hooks.php';

/**
 * yayasan_functions
 */
require get_template_directory() . '/functions-yayasan.php';
