<?php

define("WPBASE_SENDMAIL", "wpbase_sendmail");



add_shortcode('wpbaseform_sendmail', 'wpbaseform_sendmail');

add_action("init", "wpbase_send_mail");

// add_action("wpbase_do_before_content", 'wpbaseform_sendmail');


function wpbaseform_sendmail($atts)
{
    $atts = shortcode_atts([], $atts, 'wpbaseform_form');

    ob_start();

    // $redirect_url = "/thank-you";
    // $redirect_url = get_site_url() . "./";
    $redirect_url = "./";
?>
    <pre>
<?php // if ($_SERVER['REQUEST_METHOD'])
    print_r($_SERVER['REQUEST_METHOD']);
    echo htmlentities($_SERVER['SCRIPT_NAME']);
?>
</pre>
    <!-- <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') : ?>
        <form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>" method="post">
            what is your name?
            <input type="text" name="first_name" />
            <input type="submit" value="say hello">
        </form>
    <?php else : ?>
        <pre>hello <?php print_r($_POST); ?></pre>
    <?php endif; ?> -->

    <form id="<?php echo WPBASE_SENDMAIL; ?>" action="<?php echo $redirect_url; ?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="mail_firstname">Full name</label>
                    <input type="text" class="form-control" id="mail_firstname" name="mail_firstname" placeholder="e.g. Donna Haraway">
                </div>
            </div>
            <div class="col">
                <label for="mail_photo">Attach Photo</label>
                <input type="file" class="form-control-file" id="mail_photo" name="mail_photo" placeholder="Upload your photo">
            </div>
            <!--  <div class="col">
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
                <label for="upload_file">Documentation</label>
                <input type="file" class="form-control-file" id="upload_file" name="upload_file" placeholder="Upload your file">
            </div> -->
        </div>
        <!-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required>
            <label class="form-check-label" for="agreement">Agree to our Terms & Conditions and Privacy Policy.</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php
}



// submission
function wpbase_send_mail()
{
    // check - no empty input
    if (empty($_POST["mail_firstname"])) return;
    // if (empty($_POST["firstname"]) && empty($_POST["email"])) return;
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
    // $email = sanitize_email($_POST["email"]);
    // if (!is_email($email)) {
    //     echo "submitted email address is invalid";
    //     return;
    // }

    // check - email duplication; deny same day submission
    // global $wpdb;
    // $table_name = $wpdb->prefix . WPBASE_SENDMAIL;
    // $duplicateEmail = $wpdb->get_results("SELECT * FROM {$table_name} WHERE email = '{$email}' ORDER BY time DESC");
    // if (count($duplicateEmail) > 0) {
    //     $today = new DateTime(current_time('mysql'));
    //     $today = date_format($today, "ymd");
    //     $latest_duplicate_date = new DateTime($duplicateEmail[0]->time);
    //     $latest_duplicate_date = date_format($latest_duplicate_date, "ymd");

    //     if ($today == $latest_duplicate_date)
    //         echo "$today, $latest_duplicate_date - duplicate email, on the same day!";
    //     elseif ($today > $latest_duplicate_date)
    //         echo "$today, $latest_duplicate_date - duplicate email, latest submission already 1 day old!";
    // }

    // sanitize form_data
    $form_data = [
        "time" => current_time('mysql'),
        "mail_firstname" => sanitize_text_field($_POST["mail_firstname"]),
        // "phone" => sanitize_key($_POST["phone"]),
        // "email" => $email,
        "mail_photo" => $_FILES['mail_photo']
    ];

    echo '<pre>';
    print_r($form_data);
    echo '</pre>';
    // $attachments = array( WP_CONTENT_DIR . '/uploads/file_to_attach.zip' );
    // $headers = 'From: My Name <myname@example.com>' . "\r\n";
    // wp_mail( 'test@example.org', 'subject', 'message', $headers, $attachments );


    // upload: mail_photo
    // upload
    // foreach ($upload_files as $key => $file) {
    //     $upload_res[$key] = wp_handle_upload($file, $upload_overrides);
    // }

    // if (!$_FILES['upload_file']) {
    //     echo 'File is missing!';
    // }
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    $upload_overrides = array('test_form' => false);

    // start upload
    add_filter('upload_dir', 'wpbase_sendmail_upload_dir');
    $upload_res = wp_handle_upload($form_data['mail_photo'], $upload_overrides);
    remove_filter('upload_dir', 'wpbase_sendmail_upload_dir');

    // debug
    if (!$upload_res && isset($upload_res['error'])) {
        print_r($upload_res['error']);
    } else {
        echo 'check upload';
        print_r($upload_res);
    }

    // $attachments = array(WP_CONTENT_DIR . '/uploads/file_to_attach.zip');
    $attachments[] = $upload_res['file'];
    // $headers = 'From: My Name <myname@example.com>' . "\r\n";
    $headers[] = 'From: Jasper <jasper@fishermen.co>';
    // $headers[] = 'Cc: Jasper <jasper@fishermen.co>';
    // $headers[] = 'Cc: pause13th@gmail.com'; // note you can just use a simple email address
    $to = 'jasper@fishermen.co';
    $subject = 'This is a test email';
    $message = 'hello world ' . $form_data['mail_firstname'];

    wp_mail($to, $subject, $message, $headers, $attachments);


    print_r('wp_mail sent');
    // wp_mail($to, $subject, $message, $headers, $attachments);


    // check - photo
    if (!$_FILES['mail_photo']) {
        echo 'Photo is missing!';
    }
    // // check - file
    // if (!$_FILES['upload_file']) {
    //     echo 'File is missing!';
    // }
    // // check for wp_function
    // if (!function_exists('wp_handle_upload')) {
    //     require_once(ABSPATH . 'wp-admin/includes/file.php');
    // }

    // $upload_files = [
    //     $_FILES['upload_photo'],
    //     $_FILES['upload_file']
    // ];
    // $upload_overrides = array('test_form' => false);

    // /* You can use wp_check_filetype() function to check the file type and go on wit the upload or stop it.*/
    // foreach ($upload_files as $key => $item) {
    //     // check filetype; filesize;
    //     if (!$item['type'] == "image/jpeg") {
    //         // THROW ERROR
    //         echo 'Image file is not .jpg or .jpeg. Please try again.';
    //         return;
    //     } else if (!$item['size'] >= 500000) {
    //         // THROW ERROR
    //         echo 'Photo size is too large, please resize the photo to less than 500kb.';
    //     }

    //     // rename filename
    //     $upload_files[$key]['name'] = date('ymd-His') . '-' . sanitize_key($form_data["firstname"]) . '-0' . $key . '-' . $item['name'];
    // }



    // // check files
    // /**
    //  * Error generated by _wp_handle_upload()
    //  * @see _wp_handle_upload() in wp-admin/includes/file.php
    //  */
    // if (!$upload_res && isset($upload_res['error'])) {
    //     echo $upload_res['error'];
    // }

    // $form_data["upload_photo"] = $upload_res[0]['url'];
    // $form_data["upload_file"] = $upload_res[1]['url'];
    // // $form_data["upload_log"] = serialize($upload_res);

    // // insert data
    // global $wpdb;
    // $table_name = $wpdb->prefix . WPBASE_SENDMAIL;
    // $wpdb->insert($table_name, $form_data);

    return "success";
}
// show wp_mail() errors
add_action('wp_mail_failed', 'onMailError', 10, 1);
function onMailError($wp_error)
{
    echo "<pre>";
    print_r($wp_error);
    echo "</pre>";
}
function wpbase_sendmail_upload_dir($upload)
{
    $upload['subdir'] = '/' . WPBASE_SENDMAIL . '/' . date("Y");
    $upload['path']   = $upload['basedir'] . $upload['subdir'];
    $upload['url']    = $upload['baseurl'] . $upload['subdir'];
    return $upload;
}
