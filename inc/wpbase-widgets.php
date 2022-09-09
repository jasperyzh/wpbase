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


/**
 * Class WPDocs_New_Widget
 */
class Wpbase_Card_Widget extends WP_Widget
{
    private $wpbase_post;

    /**
     * Constructs the new widget.
     *
     * @see WP_Widget::__construct()
     */
    function __construct()
    {
        // Instantiate the parent object.
        parent::__construct(false, __('Wpbase Card Widget', 'textdomain'));

        $options = get_option('wpbase_trophy');
        $this->wpbase_post = $options['wpbase_post'];
    }

    /**
     * The widget's HTML output.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
    function widget($args, $instance)
    {

        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        // can require frontend template here
        if (!isset($instance['title'])) {
            // Name is required, so display nothing if we don't have it.
            return;
        }
    ?>
        <h1><?= esc_html($instance['title']) ?></h1>
        <!-- <h3>Name: </h3> -->
        <!-- <h1>this is the card-widget title </h1> -->
        <!-- <p>display the wpbase_trophy's post under here</p> -->
        <!-- <pre></pre> -->
        <!-- <hr> -->
    <?php
    }

    /**
     * The widget update handler.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance The new instance of the widget.
     * @param array $old_instance The old instance of the widget.
     * @return array The updated instance of the widget.
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
        // return $new_instance;
    }

    /**
     * Output the admin widget options form HTML.
     *
     * @param array $instance The current widget settings.
     * @return string The HTML markup for the form.
     */
    function form($instance)
    {

        $title = esc_attr($instance['title']);
        $num_badges = esc_attr($instance['num_badges']);
        $display_tooltip = esc_attr($instance['display_tooltip']);

        // require widget-fields, html markup for title field
    ?>
        <p>
            <label for="">Title (Something causing some php error here)</label>
            <input type="text" class="widefat" name="<?= $this->get_field_name('title') ?>" value="<?= $title ?>">
        </p>
        <p>
            Post title: <?= $this->wpbase_post->title->rendered ?> (ID: <?= $this->wpbase_post->id ?>)
        </p>
        <p>
            <label for="">How many of your most recent badges would you like to display?</label>
            <input type="text" size="4" name="<?= $this->get_field_name('num_badges') ?>" value="<?= $num_badges ?>" />
        </p>
        <p>
            <label for="">Display tooltips?</label>
            <input type="checkbox" name="<?= $this->get_field_name('display_tooltip') ?>" value="1" <?= checked($display_tooltip, 1) ?> />
        </p>
<?php
        return '';
    }
}

add_action('widgets_init', 'wpbase_register_widgets');

/**
 * Register the new widget.
 *
 * @see 'widgets_init'
 */
function wpbase_register_widgets()
{
    register_widget('Wpbase_Card_Widget');
}
