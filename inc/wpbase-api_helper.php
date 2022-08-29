<?php

// shortcode_api
add_shortcode('msg', 'func_msg_shortcode');
function func_msg_shortcode($atts, $content)
{
    $atts = shortcode_atts([
        "type" => "information"
    ], $atts, 'msg');

    $content = do_shortcode($content); // allow nested shortcodes

    ob_start();
?>
    <pre>helloworldmsg</pre>
    <?= $content ?>
<?php
    return ob_get_clean();
}
/* 
shortcode_exists(); // check if shortcode $tag has been registered
has_shortcode(); // check if ashortcode $tag appears within the content variable 
shortcode_parse_atts($text); // pull attributes out of a shortcode
strip_shortcodes($text); // strips all shortcodes out of $text variable, replace with empty text
*/


// widgets_api
// codex/widgets_api
/* 
// adding_widgets
class My_Widget extends WP_Widget
{
    public function __construct()
    {
        // actual processes
    }
    public function widget($args, $instance)
    {
        // outputs the content
    }
    public function form($instance)
    {
        // outputs the options form on admin
    }
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }
}
add_action('widget_init', function () {
    register_widget('My_Widget');
});
 */

// defining widget_area
/* 
register_sidebar([
    'name' => 'assignment papers sidebar',
    'id' => 'assignment_papers_sidebar',
])

// if(!dynamic_sidebar('assignment_papers_sidebar')) // check sidebar

// if(is_active_sidebar(''assignment_papers_sidebar')) // check widget_area in use
*/

// embed widget without widget_area(sidebar)
// the_widget('assignment_papers_sidebar', ['note' => ''], ['before_widget' => '']);


// dashboard_widgets_api

// removing_dashboard_widgets
/* 
// main_column
$wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag'];
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'];
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'];
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'];
// side_column
$wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'];
$wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'];
$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'];
$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']; 
*/

function wpbase_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');

    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
}
// add_action('wp_dashboard_setup', 'wpbase_remove_dashboard_widgets');


function wpbase_remove_network_dashboard_widgets()
{
    remove_meta_box('network_dashboard_right_now', 'dashboard-network', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard-network', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard-network', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard-network', 'side');
}
// add_action('wp_dashboard_setup', 'wpbase_remove_network_dashboard_widgets');

// add own dashboard_widget
function wpbase_add_dashboard_widgets()
{
    wp_add_dashboard_widget(
        'schoolpress_assignments',
        'Assignments',
        'wpbase_sample_dashboard_widget', // callback 1
        'wpbase_sample_dashboard_widget_config' // callback 2
    );
}
// add_action('wp_dashboard_setup', 'wpbase_add_dashboard_widgets');

// settings_api

// consider using global variable to store an array of options
/* 
global $schoolpress_settings;
$schoolpress_settings = [
    "info_email" => "info@email.com",
    "info_email_name" => "SchoolPress"
];
 */

// use hook/filter to check user's capabilities
/* 
$caps = apply_filters('wpdoc_caps', array());
if (!empty($caps)) {
    $hascap = false;

    if (is_user_logged_in()) {
        foreach ($caps as $cap) {
            if (current_user_can($cap)) {
                $hascap = true;
                break; //stop check
            }
        }
    }
    if (!$hascap) {
        // if user DOES NOT have capability
        // dont show the files
        echo "503 Service Unavailable";
        exit;
    }
} 
// override wpdoc_caps array by adding
// require any user account
add_filter('wpdoc_caps', function($caps){ return ['read']; });

// require admin account
add_filter('wpdoc_caps', function($caps){ return ['manage_options']; });

// require custom capability (doc)
add_filter('wpdoc_caps', function($caps){ return ['edit_post', 'doc']; });
*/



// rewrite_api
// apache module 'mod_rewrite' allows to route incoming URLs to different URLS or file locations using rules that typically added to .htaccess file

// add_rewrite_rules

// visit to /contact/special-offer/ would redirect to /contact/ page,
// populate global $wp_query->query_vars['subject'] with value 'special-offer'
/* 
function wpbase_activation(){
    add_rewrite_rule(
        '/contact/([^/]+)/?',
        'index.php?name=contact&subject=' . $matches[1],
        'top'
    ); 
    flush_rewrite_rules();
    // flushing rewrite rules
    // wordpress cache rewrite rules, after add/edit rule, nee to flush the rewrite_api so it can take effect
    // use with caution as it "expensive" to flush
}
register_activation_hook(__FILE__, 'wpbase_activation');
*/

// other rewrite functions

// another way to add custom querystring variable // http://bit.ly/rewrite-api
// add_rewrite_tag();

// add a new kind of feed to function like RSS and ATOM feeds // http://bit.ly/rewrite-add
// add_feed();

// add querystring variables to the end of a URL // http://bit.ly/rewrite-end
// add_rewrite_endpoint();

// EP_PERMALINK | EP_PAGES when defining endpoint, which will add the endpoint to single-post-pages, post-pages. some endpoint mask constants below: -
/* 
EP_NONE
EP_PERMALINK
EP_DATE
EP_ROOT
...
*/

// WP-CRON
// script run on a server at set intervals - cron jobs, events
// typically use: digest emails, syncing data with 3rdpartyAPI, preprocessing CPU-intensive computations used in reports

/* wp_schedule_event(time(), 'daily', 'wpbase_daily_cron');

wp_clear_schedule_hook('wpbase_daily_cron');

function wpbase_daily_cron()
{
    // do this daily
}
add_action('wpbase_daily_cron', 'wpbase_daily_cron');
 */

// add custom intervals
/* function wpbase_cron_schedules($schedules)
{
    $schedules['monthly'] = [
        "interval" => 60 * 60 * 24 * 30, //30days
        "display" => "Once a month"
    ];
}
add_filter('cron_schedules', 'wpbase_cron_schedules'); */
// unlike unix-based cron-jobs, wp-cron doesnt support intervals based on day of the week
// use function below to called check the day of the week
/* function wpbase_monday_cron()
{
    // get day of the week, 0-6, start with sunday
    $weekday = date("w");

    // is it monday?
    if ($weekday == "1") {
        //execute code
    }
}
add_action("wpbase_daily_cron", "wpbase_monday_cron");
 */

// wordpress check is done on every page load, cron job may not fire off that day until next page load

// define('DISABLE_WP_CRON', true);

// manually hit wp-cron.php

// crontab -e command:
// 0 0 * * * wget -0 - -q -t 1http://yoursite.com/wp-cron.php?doing_wp_cron=1 
// http://bit.ly/cronwiki - http://bit.ly/gnu-manual


// wp_mail()
// replacement for PHP's mail();


// file_header_api
// consists of 3 functions
/* 
get_plugin_data();
wp_get_theme();
get_file_data();
 */