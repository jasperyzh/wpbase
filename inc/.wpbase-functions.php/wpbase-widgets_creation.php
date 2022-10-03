<?php

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
