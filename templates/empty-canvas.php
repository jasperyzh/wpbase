<?php 

/* Template Name: Empty Canvas*/

// remove page_banner
remove_action('wpbase_do_before_content', 'wpbase_do_before_content');

// full_width_layout
remove_filter('body_class', 'wp_body_classes_layout', 1);
add_filter('body_class', function($classes){
    $classes[] = 'layout_full_width_content';
    return $classes;
});

// remove main_yayasan_header_footer
remove_action('wpbase_do_header', 'yayasan_do_header');
remove_action('wpbase_do_footer', 'yayasan_do_footer');

// insert content_annual_report_2020 into page

get_header();

do_action('wpbase_do_before_content');

?>

<main id="primary" class="site-main">

    <?php the_content(); ?>
    <!-- get_template_part('template-yayasan/content', 'annual-report-2020'); -->

</main><!-- #main -->

<?php
do_action('wpbase_do_after_content');

get_footer();
