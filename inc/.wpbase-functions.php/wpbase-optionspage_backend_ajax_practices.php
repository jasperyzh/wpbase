<?php
/**
 * creating option page, using ajax to pull items from other website
 */
$optionspage_url = WP_PLUGIN_URL . "/inc/wpbase-optionspage.php";
$optionspage_theme_url = get_stylesheet_directory_uri() . "/inc/wpbase-optionspage.php";
$options = [];

function wpbase_options_page()
{
    add_options_page(
        'Wpbase Options Page', //page_title
        'Wpbase Options Page', //menu_title,
        'manage_options', //capability
        'wpbase-options', //menu_slug
        'callback_wpbase_options_page' //callback
        //position
    );
}
add_action('admin_menu', 'wpbase_options_page');

function callback_wpbase_options_page()
{
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    global $optionspage_url;
    global $optionspage_theme_url;
    global $options;

    $wpbase_username = "";

    if (isset($_POST['wpbase_form_submitted'])) {

        $hidden_field = esc_html($_POST['wpbase_form_submitted']);

        if ($hidden_field == "Y") {
            $wpbase_username = esc_html($_POST['wpbase_username']);
            $wpbase_post_id = esc_html($_POST['wpbase_post_id']);

            $wpbase_post = wpbase_get_cmsjy_post($wpbase_post_id);

            $options['wpbase_username'] = $wpbase_username;
            $options['wpbase_post'] = $wpbase_post;
            $options['last_updated'] = time();

            update_option('wpbase_trophy', $options);
        } else {
            echo "no username found.";
        }
    }

    $options = get_option('wpbase_trophy');
    if ($options != "") {
        $wpbase_username = $options['wpbase_username'];
        $wpbase_post = $options['wpbase_post'];


        // refresh to delete available options
        // delete_option('wpbase_trophy');

        echo '<br>';
        echo 'wpbase_username: ' . $wpbase_username;
    }

    echo '<br>';
    echo $optionspage_url;
    echo '<br>';
    echo $optionspage_theme_url;
    echo '<br>';

?>

    <h1>wpbase_options_page</h1>
    <p>Welcome to our plugin page!</p>

    <?php if (!isset($wpbase_username) || $wpbase_username == '') : ?>
        <form name="wpbase_username_form" method="post" action="">

            <input type="hidden" name="wpbase_form_submitted" value="Y">

            <table class="form-table">
                <tr>
                    <td>
                        <label for="wpbase_username">Wpbase Username</label>
                    </td>
                    <td>
                        <input type="text" name="wpbase_username" id="wpbase_username">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="wpbase_post_id">Wpbase Post ID</label>
                    </td>
                    <td>
                        <input type="text" name="wpbase_post_id" id="wpbase_post_id">
                    </td>
                </tr>
            </table>

            <p>
                <input type="submit" name="wpbase_username_submit" class="button-primary" value="Save">
            </p>
        </form>
    <?php endif; ?>

    <?php if (isset($wpbase_username) && $wpbase_username != '') : ?>

        <?php $post = $options['wpbase_post']; ?>
        <h1><?= $post->title->rendered ?></h1>
        <a href="<?= $post->link ?>"><?= $post->link ?></a>

        <hr>

        <pre>
        display options
        <?php print_r($post); ?>

        </pre>


    <?php endif; ?>
<?php
}

function wpbase_options_page_styles()
{
    wp_enqueue_style("wpbase_options_page", get_stylesheet_directory_uri() . "/dist/css/admin-style.css");
}
// add_action("admin_head", "wpbase_options_page_styles");



/**
 * working with json
 * 
 */

function wpbase_get_cmsjy_post($post_id)
{
    $url = "http://cms.jasperyong.com/wp-json/wp/v2/pages/$post_id";

    $args = ['timeout' => 120,];

    $response = wp_remote_get($url, $args);

    $response = json_decode($response['body']);

    return $response;
}


function wpbase_post_refresh()
{
    $is_success = false;
    if ($is_success) {
        return wp_send_json_success(array(
            'name' => 'Andrew',
            'call' => 'From some API/trigger',
            'variable' => $var,
        ), 200);
    } else {
        $error = new WP_Error('001', 'No user information was retrieved.', 'Some information');

        return wp_send_json_error($error);
    }


    /* $options = get_option('wpbase_trophy');
    $last_updated = $options['last_updated'];

    $current_time = time();

    $update_difference = $current_time - $last_updated;

    if ($update_difference > 86400) { //24hours
        $wpbase_username = $options['wpbase_username'];

        $options['wpbase_post'] = wpbase_get_cmsjy_post(3);
        $options['last_updated'] = time();

        update_option('wpbase_trophy', $options);
    }

    die(); */
}

add_action('wp_ajax_wpbase_post_refresh', 'wpbase_post_refresh');

function wpbase_post_enable_frontend_ajax()
{
?>
    <script defer>
        var ajax_url = "<?= admin_url('admin-ajax.php') ?>";

        // execution codes

        (function($) {
            return;
            $.post(ajax_url, {
                action: "wpbase_post_refresh",
            }, function(res) {
                console.log("ajax complete", res)
            })
        })(jQuery);
    </script>
<?php
}

add_action("wp_footer", 'wpbase_post_enable_frontend_ajax');
