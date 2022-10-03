<?php

function wpbase_bs4_toast_render()
{
    if (is_active_sidebar('staging-toast-notification')) {
        $post = get_post();
        if (post_password_required() && !empty($post->post_password)) {
            wpbase_bs4_toast_html("staging-toast-notification");
        }
        return;
    }

    if (is_active_sidebar('toast-notification')) {
        wpbase_bs4_toast_html("toast-notification");
    }
}
add_action('wp_footer', 'wpbase_bs4_toast_render', 15);


function wpbase_bs4_toast_html($widget_id)
{
?>
    <div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 2rem; right: 2rem">
        <div id="bs4_toast" class="toast" data-autohide="false">
            <div class="toast-header">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" style="max-width: 220px;">
                <?php dynamic_sidebar($widget_id); ?>
            </div>
        </div>
    </div>
    <script>
        (function($) {
            document.addEventListener('DOMContentLoaded', () => {
                $('#bs4_toast').toast('show');
                console.log($('#bs4_toast'));
            });
        })(jQuery)
    </script>
<?php
}


function wpbase_bs4_toast_init()
{
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
    register_sidebar(
        array(
            'name'          => esc_html__('[staging] Toast Notification', 'wpbase'),
            'id'            => 'staging-toast-notification',
            'description'   => esc_html__('Staging for toast-notification.', 'wpbase'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'wpbase_bs4_toast_init');


add_action('wp_enqueue_scripts', 'wpbase_bs4_toast_scripts');
function wpbase_bs4_toast_scripts()
{
    // wp_enqueue_style("bs4_toast", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css");
    wp_enqueue_script('bs4_toast', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js", ['jquery'], "4.6.2", true);

    // wp_enqueue_script('wpdocs-my-script', 'https://url-to/my-script.js');
    wp_add_inline_script('bs4_toast', "(function($) {
       document.addEventListener('DOMContentLoaded', ()=>{
        $('#bs4_toast').toast('show');
        console.log($('#bs4_toast'));
       });
    })(jQuery)");
}
