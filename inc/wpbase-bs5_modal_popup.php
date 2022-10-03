<?php

function wpbase_bs5_modal_popup()
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
add_action('wp_footer', 'wpbase_bs5_modal_popup');

function wpbase_bs5_modal_popup_init()
{
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
}
add_action('widgets_init', 'wpbase_bs5_modal_popup_init');


// add_action('wp_enqueue_scripts', 'wpbase_bs5_modal_popup_scripts');
function wpbase_bs5_modal_popup_scripts()
{
    wp_add_inline_script('bs5_modal_popup', "(function($) {
        document.addEventListener('DOMContentLoaded', () => {
            $('#bs5_modal_popup').modal_popup('show');
            console.log($('#bs5_modal_popup'));
        });
    })(jQuery)");
}