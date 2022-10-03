<?php

function wpbase_bs5_toast()
{
    $widget_id = "toast-notification";

    if (!is_active_sidebar($widget_id)) {
        return;
    }
?>
    <div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
        <div class="toast-container p-3 position-fixed bottom-0 end-0" id="toastPlacement" data-original-class="toast-container p-3">
            <div class="toast fade show" data-bs-autohide="false">
                <div class="toast-header justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php dynamic_sidebar($widget_id); ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_action('wp_footer', 'wpbase_bs5_toast');

function wpbase_bs5_toast_init()
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
}
add_action('widgets_init', 'wpbase_bs5_toast_init');

// add_action('wp_enqueue_scripts', 'wpbase_bs5_toast_scripts');
function wpbase_bs5_toast_scripts()
{
    wp_add_inline_script('bs5_toast', "(function($) {
        document.addEventListener('DOMContentLoaded', () => {
            $('#bs5_toast').toast('show');
            console.log($('#bs5_toast'));
        });
    })(jQuery)");
}
