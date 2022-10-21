<?php
/**
 * @package  wpbase_muplugins
 */

// namespace Inc\Base;

/**
 *
 */
class YayasanCmb2
{
    private $cmb2_boxes = array();

    public function register()
    {
        array_push($this->cmb2_boxes, $this->yayasan_page());
        array_push($this->cmb2_boxes, $this->yayasan_cmb2_people());
        // array_push($this->cmb2_boxes, $this->yayasan_page_sidebar());
        // array_push($this->cmb2_boxes, $this->yayasan_frontpage_carousel());
        // array_push($this->cmb2_boxes, $this->yayasan_donation_faq());
        // array_push($this->cmb2_boxes, $this->yayasan_single_related_article());

        add_action('cmb2_admin_init', array($this, 'register_cmb2_boxes'));
    }
    /**
     * store and parse all cmb2 elements
     */
    public function register_cmb2_boxes()
    {
        foreach ($this->cmb2_boxes as $key => $cmb2_box) {
            // prefix
            $prefix = $cmb2_box['prefix'];

            if (!isset($cmb2_box['priority'])) {
                $cmb2_box['priority'] = 'high';
            }

            if (!isset($cmb2_box['context'])) {
                $cmb2_box['context'] = 'normal';
            }

            $cmb_args = array(
                'id' => $cmb2_box['prefix'] . $cmb2_box['id'],
                'title' => (!empty($cmb2_box['title'])) ? $cmb2_box['title'] : '',
                'object_types' => (!empty($cmb2_box['object_types'])) ? $cmb2_box['object_types'] : '',
                'context' => (!empty($cmb2_box['context'])) ? $cmb2_box['context'] : '',
                'priority' => (!empty($cmb2_box['priority'])) ? $cmb2_box['priority'] : '',
                'show_names' => (!empty($cmb2_box['show_names'])) ? $cmb2_box['show_names'] : '',
                'show_on_cb' => (!empty($cmb2_box['show_on_cb'])) ? $cmb2_box['show_on_cb'] : '',
                'exclude_ids' => (!empty($cmb2_box['exclude_ids'])) ? $cmb2_box['exclude_ids'] : '',
            );

            if (isset($cmb2_box['show_on'])) {
                $cmb_args['show_on'] = $cmb2_box['show_on'];
            }

            $cmb_new_box[$key] = new_cmb2_box($cmb_args);

            foreach ($cmb2_box['fields'] as $field) {

                // prefix for all fields within cmb2_box
                $field['prefix'] = $prefix;

                // get the field parameters
                $field_everything = $this->populate_field($field);

                if ($field_everything["type"] == "group") {

                    /**
                     * add group
                     * @var group_fields - array contains the group's fields
                     */
                    $group_id = $cmb_new_box[$key]->add_field($field_everything);

                    foreach ($field_everything['group_fields'] as $group_field) {
                        $cmb_new_box[$key]->add_group_field($group_id, $this->populate_field($group_field));
                    }
                } else {
                    $cmb_new_box[$key]->add_field($field_everything);
                }
            }
        }
    }

    private function populate_field($field)
    {
        (!empty($field['id'])) ?: $field['id'] = strtolower(str_replace(' ', '_', $field['name']));

        $prefix = (!empty($field['prefix'])) ? $field['prefix'] : '';
        $id = (!empty($field['id'])) ? $field['id'] : '';
        $desc = (!empty($field['desc'])) ? $field['desc'] : '';
        $desc = '[' . $prefix . $id . '] ' . $desc;

        return array(
            'type' => (!empty($field['type'])) ? $field['type'] : '',
            'name' => (!empty($field['name'])) ? $field['name'] : '',
            'desc' => $desc,
            'id' => $prefix . $id,
            'show_on_cb' => (!empty($field['show_on_cb'])) ? $field['show_on_cb'] : '',
            'sanitization_cb' => (!empty($field['sanitization_cb'])) ? $field['sanitization_cb'] : '',
            'escape_cb' => (!empty($field['escape_cb'])) ? $field['escape_cb'] : '',
            'on_front' => (!empty($field['on_front'])) ? $field['on_front'] : '',
            'default' => (!empty($field['default'])) ? $field['default'] : '',
            'repeatable' => (!empty($field['repeatable'])) ? $field['repeatable'] : '',
            'before_field' => (!empty($field['before_field'])) ? $field['before_field'] : '',
            'attributes' => (!empty($field['attributes'])) ? $field['attributes'] : '',
            'timezone_meta_key' => (!empty($field['timezone_meta_key'])) ? $field['timezone_meta_key'] : '',
            'date_format' => (!empty($field['date_format'])) ? $field['date_format'] : '',
            'show_option_none' => (!empty($field['show_option_none'])) ? $field['show_option_none'] : '',
            'options' => (!empty($field['options'])) ? $field['options'] : '',
            'taxonomy' => (!empty($field['taxonomy'])) ? $field['taxonomy'] : '',
            'text' => (!empty($field['text'])) ? $field['text'] : '',
            'remove_default' => (!empty($field['remove_default'])) ? $field['remove_default'] : '',
            'query_args' => (!empty($field['query_args'])) ? $field['query_args'] : '',
            'preview_size' => (!empty($field['preview_size'])) ? $field['preview_size'] : '',
            'group_fields' => (!empty($field['group_fields'])) ? $field['group_fields'] : '',
        );
    }

    private function yayasan_page()
    {
        $output = array(
            'prefix' => '_page_',
            'id' => 'page',
            'title' => 'Page Custom Fields',
            'object_types' => array('page', 'post', 'people', 'program'),
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'show_on_cb' => 'cmb2_exclude_for_single_id',
            'exclude_ids' => array(5), // Exclude homepage
            'fields' => array(
                // array(
                //     'type' => 'checkbox',
                //     'name' => 'Hide Entry Title',
                //     'desc' => 'hide_title; If checked, Entry Title will be disabled.',
                //     'id' => 'hide_title',
                // ),
                // array(
                //     'type' => 'checkbox',
                //     'name' => 'Title on page banner\'s title',
                //     'desc' => 'banner_use_title; If checked, Page banner title will be placed with page title.',
                //     'id' => 'banner_use_title',
                // ),
                array(
                    'type' => 'file',
                    'id' => 'banner',
                    'name' => 'Page Banner\'s Image',
                    'desc' => 'banner; ' . 'Upload an image for Page-banner, or a default image will be display',
                    'options' => array(
                        'url' => false, // Hide the text input for the url
                    ),
                    'text' => array(
                        'add_upload_file_text' => 'Add Image',
                    ),
                    'query_args' => array(
                        'type' => array(
                            'image/jpeg',
                        ),
                    ),
                    'preview_size' => 'large', // Image size to use when previewing in the admin.
                ),
                // array(
                //     'type' => 'text',
                //     'id' => 'banner_title',
                //     'name' => 'Page Banner Title',
                //     'desc' => 'banner_title; ' . 'By default, page title will be used.',
                // ),
                // array(
                //     'type' => 'text',
                //     'id' => 'banner_subtitle',
                //     'name' => 'Page Banner Subtitle',
                //     'desc' => 'banner_subtitle; ' . 'Add page subtitle',
                // ),
                // array(
                //     'type' => 'colorpicker',
                //     'id' => 'overlay',
                //     'name' => 'Background overlay',
                //     'desc' => 'overlay; ' . 'Add overlay on page banner.',
                //     'default' => 'rgba(0, 0, 0, .3)',
                //     'options' => array(
                //         'alpha' => true,
                //     ),
                // ),
            ),
        );
        return $output;
    }
    private function yayasan_cmb2_people()
    {
        $output = array(
            'prefix' => '_people_',
            'id' => 'people',
            'title' => 'Yayasan People Metabox',
            'object_types' => array('people'),
            'fields' => array(
                array(
                    'type' => 'text',
                    'id' => 'position',
                    'name' => 'Position',
                    'desc' => 'position',
                ),
                array(
                    'type' => 'text',
                    'id' => 'speech_quote',
                    'name' => 'Speech Quote',
                    'desc' => 'speech_quote',
                ),
                array(
                    'type' => 'file',
                    'id' => 'image',
                    'name' => 'Person Image',
                    'desc' => 'Image will be displayed on person\'s page. Keep image size below 200kb',
                    'options' => array(
                        'url' => false, // Hide the text input for the url
                    ),
                    'text' => array(
                        'add_upload_file_text' => 'Add Image',
                    ),
                    'query_args' => array(
                        'type' => array(
                            'image/jpeg',
                        ),
                    ),
                    'preview_size' => 'large', // Image size to use when previewing in the admin.
                ),
            ),
        );
        return $output;
    }
    /* public function yayasan_page_sidebar()
    {
        $output = array(
            'prefix' => '_page_',
            'id' => 'page_sidebar',
            'title' => 'Page Sidebar',
            'object_types' => array('page'),
            'show_names' => true,
            'show_on_cb' => 'cmb2_exclude_for_single_id',
            'exclude_ids' => array(5), // Exclude homepage
            'fields' => array(
                array(
                    'type' => 'wysiwyg',
                    'id' => 'sidebar_navigation',
                    'name' => 'Page sidebar custom navigation',
                    'desc' => 'custom sidebar navigation, replacing the auto-generated navigation.',
                    'options' => array(
                        'teeny' => false,
                        'textarea_rows' => get_option('default_post_edit_rows', 3),
                    ),
                ),
            ),
        );
        return $output;
    }

    public function yayasan_frontpage_carousel()
    {
        $output = array(
            'prefix' => '_page_',
            'id' => 'frontpage_carousel',
            'title' => 'Frontpage Carousel',
            'object_types' => array('page'),
            'fields' => array(
                array(
                    'type' => 'group',
                    'name' => 'frontpage_carousel_group',
                    'description' => 'frontpage_carousel_group',
                    'repeatable' => true,
                    'options' => array(
                        'group_title' => __('Entry {#}', 'cmb2'),
                        'add_button' => __('Add Another Entry', 'cmb2'),
                        'remove_button' => __('Remove Entry', 'cmb2'),
                        'sortable' => true,
                        'closed' => true,
                        'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
                    ),
                    'group_fields' => array(
                        array(
                            'type' => 'file',
                            'id' => 'carousel',
                            'name' => 'Frontpage Carousel\'s Image',
                            'desc' => 'Upload an image for Carousel, or a default image will be display',
                            'options' => array(
                                'url' => false,
                            ),
                            'text' => array(
                                'add_upload_file_text' => 'Add Image',
                            ),
                            'query_args' => array(
                                'type' => array(
                                    'image/jpeg',
                                ),
                            ),
                            'preview_size' => 'large',
                        ),
                        array(
                            'name' => 'Title',
                            'id' => 'title',
                            'type' => 'text',
                        ),
                        array(
                            'name' => 'Description',
                            'id' => 'description',
                            'type' => 'textarea_small',
                        ),
                        array(
                            'name' => 'Background overlay',
                            'id' => 'background_overlay',
                            'type' => 'colorpicker',
                            'default' => 'rgba(0,0,0,.3)',
                            'options' => array(
                                'alpha' => true,
                            ),
                        ),
                    ),
                ),
            ),
        );
        return $output;
    }

    public function yayasan_donation_faq()
    {
        $output = array(
            'prefix' => '_donation_',
            'id' => 'metabox',
            'title' => 'Donation FAQs entries',
            'object_types' => array('page'),
            'show_on' => array('key' => 'id', 'value' => array(1590, 1892, 3666)), // donation/derma
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true,
            'fields' => array(
                array(
                    'type' => 'group',
                    'name' => 'faq',
                    'description' => 'faq',
                    'repeatable' => true,
                    'options' => array(
                        'group_title' => __('Entry {#}', 'cmb2'),
                        'add_button' => __('Add Another Entry', 'cmb2'),
                        'remove_button' => __('Remove Entry', 'cmb2'),
                        'sortable' => true,
                        'closed' => true,
                        'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
                    ),
                    'group_fields' => array(
                        array(
                            'name' => 'Question',
                            'id' => 'question',
                            'type' => 'textarea_small',
                        ),
                        array(
                            'name' => 'Answer',
                            'id' => 'answer',
                            'type' => 'textarea_small',
                        ),
                    ),
                ),
            ),
        );
        return $output;
    }



    public function yayasan_single_related_article()
    {
        $output = array(
            'prefix' => 'single_',
            'id' => 'related_article',
            'title' => 'Related Articles',
            'object_types' => array('post'),
            'show_names' => true,
            'fields' => array(
                array(
                    'type' => 'group',
                    'id' => 'post_cta_button',
                    'name' => 'Post CTA Button',
                    'options' => array(
                        'group_title' => __('Entry {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
                        'add_button' => __('Add Another Entry', 'cmb2'),
                        'remove_button' => __('Remove Entry', 'cmb2'),
                        'sortable' => true,
                        'repeatable' => true,
                    ),
                    'group_fields' => array(
                        array(
                            'type' => 'text',
                            'id' => 'cta_text',
                            'name' => 'CTA Text',
                            'desc' => 'Use semicolon (;) to split the text for multiple attached posts',
                        ),
                        array(
                            'type' => 'select',
                            'id' => 'attached_posts',
                            'name' => 'Attached Posts',
                            'desc' => 'Select an option',
                            'show_option_none' => true,
                            'options' => 'cb_get_attached_post',
                        ),
                    ),
                ),
            ),
        );
        return $output;
    }
    // cpt_people
     */
}
