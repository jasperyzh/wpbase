<?php

/**
 * clear wpdefault
 * https://github.com/WordPress/gutenberg/issues/36834#issuecomment-1021980079
 */
function custom_wp_remove_global_css()
{
    // remove global styles/svg
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

    // remove wp-embed
    add_action('wp_footer', function () {
        wp_deregister_script('wp-embed');
    });

    // clean up wordpress <head>
    // https://bhoover.com/remove-unnecessary-code-from-your-wordpress-blog-header/
    // https://orbitingweb.com/blog/remove-unnecessary-tags-wp-head/

    // removes meta name generator. -> SecureWordPress.php
    remove_action('wp_head', 'wp_generator');

    // removes EditURI/RSD (Really Simple Discovery) link
    remove_action('wp_head', 'rsd_link');

    // removes wlwmanifest (Windows Live Writer) link
    remove_action('wp_head', 'wlwmanifest_link');

    // removes shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // removes feed links
    remove_action('wp_head', 'feed_links', 2);

    // removes comments feed.
    remove_action('wp_head', 'wp_resource_hints', 2);

    remove_action('wp_head', 'feed_links_extra', 3);

    // Removes prev and next links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

    // https://thomas.vanhoutte.be/miniblog/remove-api-w-org-rest-api-from-wordpress-header/
    remove_action('wp_head', 'rest_output_link_wp_head', 10);

    // Disables Pesky Emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // source: https://codebard.com/wordpress-talk/disable-wp-emoji-and-wp-embed

    // Remove the REST API endpoint.
    /**
     * !!! this disabled embed link in editor
     */
    // remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');

    add_filter('tiny_mce_plugins', function ($plugins) {
        return array_diff($plugins, array('wpembed'));
    });

    // Remove all embeds rewrite rules.
    add_filter('rewrite_rules_array', function ($rules) {
        foreach ($rules as $rule => $rewrite) {
            if (false !== strpos($rewrite, 'embed=true')) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    });
}
add_action('init', 'custom_wp_remove_global_css');

function custom_wp_remove_admin_global_css()
{
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_global_styles_css_custom_properties');
    remove_action('in_admin_header', 'wp_global_styles_render_svg_filters');
}
add_action('admin_init', 'custom_wp_remove_admin_global_css');


/**
 * wordpress_secure - via webapp_with_wordpress
 * @since 220818
 * 
 * 1. update frequently
 * 2. avoid 'admin' username
 * 3. strong password
 * 
 */

/**
 * wp_config_php
 */

// dont allow admins to edit plugins/themes
// define("DISALLOW_FILE_EDIT", true);

// change default database table prefix
/* 
// $table_prefix = 'wp_'; 
// // to
// $table_prefix = "anyprefix_";

// rename table wp_commentmeta to anyprefix_commentmeta;
// rename table wp_comments to anyprefix_comments;
// rename table wp_links to anyprefix_links;
// rename table wp_openssl_get_cert_locationspostmeta to anyprefix_openssl_get_cert_locationspostmeta;
// rename table wp_posix_strerrorterms to anyprefix_posix_strerrorterms;
// rename table wp_term_relationships to anyprefix_term_relationships;
// rename table wp_term_taxonomy to anyprefix_term_taxonomy;
// rename table wp_usermeta to anyprefix_usermeta;
// rename table wp_users to anyprefix_users;
*/

// move wp-config.php : move file up a level in a nonpublic directory
// var/www/public_html/wp-config.php
// to
// var/www/wp-config.php

// hide wordpress version
add_filter('the_generator', '__return_null');

// dont allow logins via wp-login.php
// add following rewrite rules to .htaccess
// RewriteRule ^new-login$ wp-login.php
// new-login will be the URL to login to wp-admin
function wpbase_wp_login_filter($url, $path, $orig_scheme)
{
    $old = ["/(wp-login\.php)/"];

    $new = ["new-login"];

    return preg_replace($old, $new, $url, 1);
}
// add_filter("site_url", "wpbase_wp_login_filter", 10, 3);

function wpbase_wp_login_redirect()
{
    if (strpos($_SERVER["REQUEST_URI"], "new-login") === false) {
        wp_redirect(site_url());
        exit();
    }
}
// add_action("login_init", "wpbase_wp_login_redirect");

// add custom .htaccess rules for locking down wp-admin
// restrict access to the backend by certain IPaddresses
// create .htaccess in wp-admin directory
// replacing 127.0.0.1 with actual external IP

/* 
# WHITELIST
order deny,allow
allow from 127.0.0.1 #(repeat this line for multiple IP addresses)
deny from all

# BLACKLIST
order allow,deny
allow from 127.0.0.1 #(repeat this line for multiple IP addresses)
allow from all

# HTACCESS AUTHENTICATION
AuthType Basic
AuthName "restricted area"
AuthUserFile /path/to/protected/dir/.htpasswd
require valid-user
# user tool like htaccess password generator (http://it.ly/htaccess-pw)
# add encrypted password to .htpasswd
*/

/**
 * good to have plugins
 * 
 * - security
 * - spam blocking
 * - backup
 * - scanner
 * - login/password protection
 */

/**
 * // check user capabilities
 * 
 * all functions located in /wp-includes/capabilities.php
 */
function check_user_capabilities()
{
    user_can($user, $capability);

    current_user_can($capability);

    current_user_can_for_blog($capability); // for multisite_network
}


// escape custom_sql_statements
// esc_sql()
// $wpdb->prepare()

/**
 * data validation_sanitation_escaping
 * 
 * DO NOT TRUST YOUR USERS
 * 
 * validate - correct format; correct data before saving into database
 * sanitizing - cleaning data before saving to database
 * 
 * sanitize_option()
 * sanitize_text_field()
 * sanitize_user()
 * sanitize_title()
 * sanitize_email()
 * sanitize_file_name()
 * wp_kses()
 * 
 * escaping - clean data already have before displaying
 * 
 * esc_url()
 * esc_url_raw()
 * esc_html()
 * esc_js()
 * esc_attr()
 * esc_textarea()
 * 
 */

/**
 * nonces - Number Used Once
 NEED TO TRY OUT ALL THE FUNCTIONS
 * protect against CSRF (cross-site request forgery)
 * 
 * 1. generate a nonce string every time a page is loaded
 * 2. add the nonce string as a hidden element on form
 * 3. when processing a submitted form, generate the nonce the same way and check it matches the one submitted frm the form
 * 
 * nonce is generated using combination of the secret salt keys in wp-config.php/server-time
 * 
 * useful for nonform links and AJAX calls
 * 
 * wp_create_nonce($action = -1);
 * 
 * wp_verify_nonce($nonce, $action = -1);
 * 
 * check_admin_referer($action = -1, $query_arg = _wpnonce);
 * 
 * wp_nonce_url($actionurl, $action = -1);
 * 
 * wp_nonce_field($action = -1, $name = "_wpnonce", $referer = true, $echo = true);
 * 
 * check_ajax_referer($action = -1, $query_arg = false, $die = true);
 */
