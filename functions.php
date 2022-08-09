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
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary', 'wpbase'),
			'footer' => esc_html__('Footer', 'wpbase'),
		)
	);

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

require get_template_directory() . '/inc/wpbase-contactform.php';


add_action('wp_footer', 'add_widget_popup_modal', 15);
function add_widget_popup_modal()
{
	// tips: elementor-section-stretch will be affected if widget enabled

	// apply to frontpage only
	if (!is_active_sidebar('popup-modal') || !is_front_page()) {
		return;
	}
?>
	<div class="modal fade" id="popup-modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <h5 class="modal-title" id="popup-modal__label">Modal title</h5> -->
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php dynamic_sidebar('popup-modal'); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php
}

add_action('wp_footer', 'add_widget_toast_notification', 15);
function add_widget_toast_notification()
{
	// apply to all pages
	if (!is_active_sidebar('toast-notification')) {
		return;
	}
?>
	<div class="toast-container position-fixed bottom-0 end-0 p-3">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<img width="16" src="https://via.placeholder.com/512x512?text=placeholder" class="rounded me-2" alt="...">
				<strong class="me-auto">New Announcement</strong>
				<small>since August 4, 2022</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
				<?php dynamic_sidebar('toast-notification'); ?>
			</div>
		</div>
	</div>

<?php
}


