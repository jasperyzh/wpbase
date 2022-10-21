<?php

/**
 * yayasan_webform
 * @since 221012
 * 
 * @reference - /inc/wpbase-functions.php/wpbase-contactform.php
 */

// global
define("WEBFORM", "yayasan_webform");

// html_form
add_shortcode('display__form_contact', 'yayasan_display__form_contact');

// init / submission
add_action('init', function () {
    if (!shortcode_exists('display__form_contact')) {
        return;
    }
    yayasan_webform_create_table();
    yayasan_webform_submission();
});

// yayasan_webform_backend
add_action('admin_init', 'yayasan_webform_settings_init');
add_action('admin_menu', 'yayasan_webform_options_page');
add_action('admin_enqueue_scripts', 'yayasan_webform_enqueue_admin_script');

/**
 * shortcode_for_yayasan_webform
 */
function yayasan_display__form_contact()
{
    ob_start();
    get_template_part('template-yayasan/display', 'contact_us');
    return ob_get_clean();
}

/**
 * create table
 */
function yayasan_webform_create_table()
{
    // make sure table exist
    global $wpdb;
    $table_name = $wpdb->prefix . WEBFORM;
    $wpdb_collate = $wpdb->get_charset_collate();

    // check if table exist
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql =
            "CREATE TABLE $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
area_of_interest varchar(255),
fullname varchar(255),
email varchar(255),
phone varchar(255),
state varchar(255),
subject varchar(255),
focus varchar(255),
message TEXT,
form_id varchar(12) DEFAULT '1' NOT NULL,
PRIMARY KEY  (id)
) $wpdb_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function yayasan_webform_submission()
{
    // check - no empty input
    if (empty($_POST["fullname"]) && empty($_POST["email"])) return;

    // check - email sanitize
    $email = sanitize_email($_POST["email"]);
    if (!is_email($email)) {
        echo "submitted email address is invalid";
        return;
    }

    // check - email duplication; deny same day submission
    global $wpdb;
    $table_name = $wpdb->prefix . WEBFORM;
    $duplicateEmail = $wpdb->get_results("SELECT * FROM {$table_name} WHERE email = '{$email}' ORDER BY time DESC");
    if (count($duplicateEmail) > 0) {
        $today = new DateTime(current_time('mysql'));
        $today = date_format($today, "ymd");
        $latest_duplicate_date = new DateTime($duplicateEmail[0]->time);
        $latest_duplicate_date = date_format($latest_duplicate_date, "ymd");

        if ($today == $latest_duplicate_date) {
            echo "$today, $latest_duplicate_date - duplicate email, on the same day!";
            return;
        } elseif ($today > $latest_duplicate_date) {
            echo "$today, $latest_duplicate_date - duplicate email, latest submission already 1 day old!";
        }
    }

    // sanitize form_data
    $form_data = [
        "time" => current_time('mysql'),
        "area_of_interest" => sanitize_text_field($_POST["area_of_interest"]),
        "fullname" => sanitize_text_field($_POST["fullname"]),
        "email" => $email,
        "phone" => sanitize_key($_POST["phone"]),
        "state" => sanitize_text_field($_POST["state"]),
        "subject" => sanitize_text_field($_POST["subject"]),
        "focus" => sanitize_text_field($_POST["focus"]),
        "message" => sanitize_text_field($_POST["message"]),
    ];

    // insert data
    $wpdb->insert($table_name, $form_data);
    return "success";
}


/**
 * custom option and settings
 */
function yayasan_webform_settings_init()
{
    register_setting(WEBFORM, 'yayasan_webform_options');
    add_settings_section(
        'yayasan_webform_section',
        __('Yayasan Web Form', WEBFORM),
        'yayasan_webform_section_callback',
        WEBFORM
    );
}
function yayasan_webform_section_callback($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Print or download the data below.', WEBFORM); ?></p>
<?php
}

function yayasan_webform_options_page()
{
    add_menu_page(
        WEBFORM . '\'s Lead',
        WEBFORM . ' Lead',
        'moderate_comments',
        WEBFORM,
        'yayasan_webform_options_page_html',
        'dashicons-id'
    );
}

/**
 * Top level menu callback function
 */
function yayasan_webform_options_page_html()
{
    if (!current_user_can('moderate_comments')) {
        return;
    }
    if (isset($_GET['settings-updated'])) {
        add_settings_error('yayasan_webform_messages', 'yayasan_webform_message', __('Settings Saved', WEBFORM), 'updated');
    }
    settings_errors('yayasan_webform_messages');

?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields(WEBFORM);
            do_settings_sections(WEBFORM);
            ?>
        </form>
        <hr>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . WEBFORM;
        $result = $wpdb->get_results("SELECT * FROM {$table_name}");
        if (!empty($result)) :
        ?>
            <table id="datatables_table" class="display">
                <thead>
                    <tr>
                        <?php
                        foreach ($result[0] as $key => $lead) {
                            if ($key != "files") {
                                echo '<td>' . $key . '</td>';
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key => $lead) {
                        echo '<tr>';
                        echo '<td>' . $lead->id . '</td>';
                        echo '<td>' . $lead->time . '</td>';
                        echo '<td>' . $lead->area_of_interest . '</td>';
                        echo '<td>' . $lead->fullname . '</td>';
                        echo '<td>' . $lead->email . '</td>';
                        echo '<td>' . $lead->phone . '</td>';
                        echo '<td>' . $lead->state . '</td>';
                        echo '<td>' . $lead->subject . '</td>';
                        echo '<td>' . $lead->focus . '</td>';
                        echo '<td>' . $lead->message . '</td>';
                        echo '<td>' . $lead->form_id . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('#datatables_table').DataTable({
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ],
                            // dom: 'Bfrtip',
                            buttons: [
                                'print',
                                'csv'
                            ]
                        });
                    });
                })(jQuery)
            </script>
        <?php else : ?>
            <p>No result or submissions. Submit one to try again.</p>
        <?php endif; ?>
    </div>
<?php
}

function yayasan_webform_enqueue_admin_script($hook)
{
    if ('toplevel_page_' . WEBFORM != $hook) {
        return;
    }
    wp_enqueue_script('datatables', get_stylesheet_directory_uri() . "/dist/yayasan_webform/jquery.dataTables.js", array('jquery'), '1.11.3');
    wp_enqueue_style('datatables', get_stylesheet_directory_uri() . "/dist/yayasan_webform/jquery.dataTables.css", false, '1.11.3');
    wp_enqueue_script('datatables-buttons', get_stylesheet_directory_uri() . "/dist/yayasan_webform/dataTables.buttons.min.js", array('jquery'), '2.0.0');
    wp_enqueue_script('buttons-html5', get_stylesheet_directory_uri() . "/dist/yayasan_webform/buttons.html5.min.js", array('jquery'), '2.0.0');
    wp_enqueue_script('buttons-print', get_stylesheet_directory_uri() . "/dist/yayasan_webform/buttons.print.min.js", array('jquery'), '2.1.0');
}
