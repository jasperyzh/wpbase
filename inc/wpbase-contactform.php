<?php

/**
 * wpbase_form
 * 
 * # 1. frontend form
 * # 1.1. validation
 * # 1.2. sanitization
 * # 2. make sure image upload possible /uploads/wpbaseform
 * # 3. shortcode form to frontpage
 * # 4. mysql accepts leads
 * # 5. options page to view data
 * # 6. optional - protect /uploads/wpbaseform from public view
 */

/**
 * prefix
 */
define("WEBFORM", "wpbaseform");

add_action('init', 'wpbaseform_create_table');

add_shortcode('wpbaseform_form', 'wpbaseform_frontend_form');

add_action("init", "wpbaseform_form_submission");
add_action('admin_init', 'wpbaseform_settings_init');
add_action('admin_menu', 'wpbaseform_options_page');

add_action('admin_enqueue_scripts', 'wpbaseform_enqueue_admin_script');
// add_action('wp_enqueue_scripts', 'wpbaseform_enqueue_wp_script');


/**
 * create table
 */
function wpbaseform_create_table()
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
firstname varchar(255),
lastname varchar(255),
email varchar(255),
phone varchar(255),
upload_photo varchar(255),
upload_file varchar(255),
-- upload_log text,
-- dob varchar(20),
-- age varchar(20),
-- height varchar(20),
-- weight varchar(20),
-- chest varchar(20),
-- hip varchar(20),
-- address text,
-- agreement varchar(20),
-- photo2_url varchar(255),
PRIMARY KEY  (id)
) $wpdb_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        print_r("wpbaseform_create_table");
    }
}


function wpbaseform_frontend_form($atts)
{
    $atts = shortcode_atts([], $atts, 'wpbaseform_form');

    ob_start();

    // $redirect_url = "/thank-you";
    $redirect_url = get_site_url() . "/thank-you";
?>

    <pre>

<?php // if ($_SERVER['REQUEST_METHOD'])

    print_r($_SERVER['REQUEST_METHOD']);

    echo htmlentities($_SERVER['SCRIPT_NAME']);

?>
</pre>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') : ?>
        <form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>" method="post">
            what is your name?
            <input type="text" name="first_name" />
            <input type="submit" value="say hello">
        </form>
    <?php else : ?>
        <pre>hello <?php print_r($_POST); ?></pre>
    <?php endif; ?>
    <form id="<?php echo WEBFORM; ?>" action="<?php echo $redirect_url; ?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="fullname">Full name</label>
                    <input type="text" class="form-control" id="fullname" name="firstname" placeholder="e.g. Donna Haraway">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="e.g. donna.h@email.com">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g. 010-888 1234">
                </div>
            </div>
            <div class="col">
                <label for="upload_photo">Profile Picture</label>
                <input type="file" class="form-control-file" id="upload_photo" name="upload_photo" placeholder="Upload your photo">
            </div>
            <div class="col">
                <label for="upload_file">Documentation</label>
                <input type="file" class="form-control-file" id="upload_file" name="upload_file" placeholder="Upload your file">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required>
            <label class="form-check-label" for="agreement">Agree to our Terms & Conditions and Privacy Policy.</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        (function($) {
            if (true) {
                // debug input
                $("[name='firstname']").val("AdamSmith");
                $("[name='email']").val("adam@smith.com");
                $("[name='phone']").val("0135552323");
                // $("[name='upload_photo']").val("Donna");
                // $("[name='upload_file']").val("Donna");
                $("[name='agreement']").prop('checked', true);
            }
        })(jQuery)
    </script>

    <!-- <script>
        (function($) {

            const DEBUG = true;
            if (DEBUG) {
                // debug input
                /* $("#fullname").val("Donna");
                $("#dob").val("12/25/2002");
                $("#age").val("20");
                $("#height").val("160");
                $("#weight").val("50");
                $("#chest").val("92");
                $("#hip").val("98");
                $("#email").val("donna@email.com");
                $("#phone").val("0135552313");
                $("#address").val("Address here.");
                $('#agreement').prop('checked', true); */

                let formItems = {
                    fullname: $("#fullname").val(),
                    dob: $("#dob").val(),
                    age: $("#age").val(),
                    height: $("#height").val(),
                    weight: $("#weight").val(),
                    chest: $("#chest").val(),
                    hip: $("#hip").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    phone: $("#address").val(),
                };
                console.log(formItems);
            }

            $("#dob").datepicker();

            // validate
            $("#").validate({
                // debug: DEBUG,
                rules: {
                    fullname: "required",
                    dob: "required",
                    age: "required",
                    height: "required",
                    weight: "required",
                    chest: "required",
                    hip: "required",
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 15,
                    },
                    address: "required",
                    photo1: "required",
                    photo2: "required",
                    agreement: "required",
                },
                messages: {
                    fullname: "Please enter your full name",
                    email: "Please enter a valid email address",
                    phone: {
                        required: "Please enter your contact number",
                        number: "Number only, no special character required",
                        minlength: "Your phone number is too short",
                        maxlength: "Your phone number is too long",
                    },
                    address: "Please enter your address",
                    photo1: "Please choose your half-shot photo",
                    agreement: "You are required to agree to our Terms & Conditions",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        })(jQuery)
    </script> -->
<?php
    return ob_get_clean();
}

// submission
function wpbaseform_form_submission()
{
    // check - no empty input
    if (empty($_POST["firstname"]) && empty($_POST["email"])) return;
    /* foreach ($form_data as $key => $value) {
        if ($value === "") {
            // THROW ERROR
            echo 'Some fields are missing, please check your submission again, thank you!';
        }
    } */

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

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

        if ($today == $latest_duplicate_date)
            echo "$today, $latest_duplicate_date - duplicate email, on the same day!";
        elseif ($today > $latest_duplicate_date)
            echo "$today, $latest_duplicate_date - duplicate email, latest submission already 1 day old!";
    }

    // sanitize form_data
    $form_data = [
        "time" => current_time('mysql'),
        "firstname" => sanitize_text_field($_POST["firstname"]),
        "phone" => sanitize_key($_POST["phone"]),
        "email" => $email,
    ];

    // check - photo
    if (!$_FILES['upload_photo']) {
        echo 'Photo is missing!';
    }
    // check - file
    if (!$_FILES['upload_file']) {
        echo 'File is missing!';
    }
    // check for wp_function
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $upload_files = [
        $_FILES['upload_photo'],
        $_FILES['upload_file']
    ];
    $upload_overrides = array('test_form' => false);

    /* You can use wp_check_filetype() function to check the file type and go on wit the upload or stop it.*/
    foreach ($upload_files as $key => $item) {
        // check filetype; filesize;
        if (!$item['type'] == "image/jpeg") {
            // THROW ERROR
            echo 'Image file is not .jpg or .jpeg. Please try again.';
            return;
        } else if (!$item['size'] >= 500000) {
            // THROW ERROR
            echo 'Photo size is too large, please resize the photo to less than 500kb.';
        }

        // rename filename
        $upload_files[$key]['name'] = date('ymd-His') . '-' . sanitize_key($form_data["firstname"]) . '-0' . $key . '-' . $item['name'];
    }

    // change upload_dir
    add_filter('upload_dir', 'wpbaseform_upload_dir');

    // upload
    foreach ($upload_files as $key => $file) {
        $upload_res[$key] = wp_handle_upload($file, $upload_overrides);
    }

    // recover upload_dir
    remove_filter('upload_dir', 'wpbaseform_upload_dir');

    // check files
    /**
     * Error generated by _wp_handle_upload()
     * @see _wp_handle_upload() in wp-admin/includes/file.php
     */
    if (!$upload_res && isset($upload_res['error'])) {
        echo $upload_res['error'];
    }

    $form_data["upload_photo"] = $upload_res[0]['url'];
    $form_data["upload_file"] = $upload_res[1]['url'];
    // $form_data["upload_log"] = serialize($upload_res);

    // insert data
    global $wpdb;
    $table_name = $wpdb->prefix . WEBFORM;
    $wpdb->insert($table_name, $form_data);

    return "success";
}

function wpbaseform_upload_dir($upload)
{
    $upload['subdir'] = '/' . WEBFORM . '/' . date("Y");
    $upload['path']   = $upload['basedir'] . $upload['subdir'];
    $upload['url']    = $upload['baseurl'] . $upload['subdir'];
    return $upload;
}

/**
 * custom option and settings
 */
function wpbaseform_settings_init()
{
    register_setting(WEBFORM, 'wpbaseform_options');
    add_settings_section(
        'wpbaseform_section',
        __('Wpbase Form', WEBFORM),
        'wpbaseform_section_callback',
        WEBFORM
    );
}


function wpbaseform_section_callback($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Print or download the data below.', WEBFORM); ?></p>
<?php
}

function wpbaseform_options_page()
{
    add_menu_page(
        WEBFORM . '\'s Lead',
        WEBFORM . ' Lead',
        'moderate_comments',
        WEBFORM,
        'wpbaseform_options_page_html',
        'dashicons-id'
    );
}

/**
 * Top level menu callback function
 */
function wpbaseform_options_page_html()
{
    // check user capabilities
    if (!current_user_can('moderate_comments')) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('wpbaseform_messages', 'wpbaseform_message', __('Settings Saved', WEBFORM), 'updated');
    }

    // show error/update messages
    settings_errors('wpbaseform_messages');
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting wpbaseform
            settings_fields(WEBFORM);
            // output setting sections and their fields
            // (sections are registered for wpbaseform, each field is registered to a specific section)
            do_settings_sections(WEBFORM);
            // output save settings button
            // submit_button('Save Settings');
            ?>
        </form>
        <hr>
        <?php
        // get data for datatables
        global $wpdb;
        $table_name = $wpdb->prefix . WEBFORM;
        $result = $wpdb->get_results("SELECT * FROM {$table_name}");
        // foreach ($result[0] as $key => $lead) {
        //     print_r($key);
        // }
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
                    echo '<td>' . $lead->firstname . '</td>';
                    echo '<td>' . $lead->lastname . '</td>';
                    echo '<td>' . $lead->email . '</td>';
                    echo '<td>' . $lead->phone . '</td>';
                    /*  echo '<td>' . $lead->dob . '</td>';
                    echo '<td>' . $lead->age . '</td>';
                    echo '<td>' . $lead->height . '</td>';
                    echo '<td>' . $lead->weight . '</td>';
                    echo '<td>' . $lead->chest . '</td>';
                    echo '<td>' . $lead->hip . '</td>';
                    echo '<td>' . $lead->email . '</td>';
                    echo '<td>' . $lead->phone . '</td>';
                    echo '<td>' . $lead->address . '</td>';
                    echo '<td>' . $lead->agreement . '</td>'; */
                    echo '<td style="text-align: center"><a target="_blank" href="' . $lead->upload_photo . '"><img style="aspect-ratio: 1/1; object-fit: cover" width="80" src="' . $lead->upload_photo . '"></a></td>';
                    echo '<td><a download target="_blank" href="' . $lead->upload_file . '">' . $lead->upload_file . '</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <script>
            (function($) {
                $(document).ready(function() {
                    $('#datatables_table').DataTable({
                        dom: 'Bfrtip',
                        // ajax: "../php/staff.php",
                        buttons: [
                            'print',
                            'csv'
                        ]
                    });
                });
            })(jQuery)
        </script>
        <style>
            .dataTables_wrapper .dataTables_length select {
                padding: 0 24px 0 8px;
            }
        </style>
    </div>
<?php
}

/**
 * Enqueue a script in the WordPress admin on /wp-admin/admin.php?page=wpbaseform
 * 
 * @param int $hook Hook suffix for the current admin page.
 */
function wpbaseform_enqueue_admin_script($hook)
{
    // toplevel_page_ + (page_slug)'contact-form-lead'
    if ('toplevel_page_' . WEBFORM != $hook) {
        return;
    }

    wp_enqueue_script('datatables', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js", array('jquery'), '1.11.3');
    wp_enqueue_style('datatables', "https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css", false, '1.11.3');

    wp_enqueue_script('datatables-buttons', "https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js", array('jquery'), '2.0.0');
    wp_enqueue_script('buttons-html5', "https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js", array('jquery'), '2.0.0');
    wp_enqueue_script('buttons-print', "https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js", array('jquery'), '2.1.0');
}


// for bootstrap-less website
function wpbaseform_enqueue_wp_script()
{
    wp_enqueue_style('bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css", false, '4.6.1');
    wp_enqueue_script('bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js", array('jquery'), '4.6.1');
    wp_enqueue_script('jquery-validation', "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js", array('jquery'), '1.19.3');

    wp_enqueue_script('datepicker', "https://code.jquery.com/ui/1.13.0/jquery-ui.js", array('jquery'), '1.0.10');

    wp_enqueue_style('datatables', "https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css", false, '1.13.0');
}
