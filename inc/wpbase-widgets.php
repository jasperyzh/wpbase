<?php

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
