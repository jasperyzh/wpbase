<?php

/* Template Name: Main Fullwidth */

// remove page_banner
// remove_action('wpbase_do_before_content', 'wpbase_do_before_content');

// full_width_layout
/* remove_filter('body_class', 'wp_body_classes_layout', 1);
add_filter('body_class', function($classes){
    $classes[] = 'layout_mainfullwidth';
    return $classes;
}); */

// remove main_yayasan_header_footer
// remove_action('wpbase_do_header', 'yayasan_do_header');
// remove_action('wpbase_do_footer', 'yayasan_do_footer');

// insert content_annual_report_2020 into page

get_header();

do_action('wpbase_do_before_content');

?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

    ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            // <header class="entry-header">
            // the_title( '<h1 class="entry-title">', '</h1>' ); 
            // </header>.entry-header
            ?>

            <?php
            // wpbase_post_thumbnail(); 
            ?>

            <?php //get_template_part('template-yayasan/entry', 'header'); ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'wpbase'),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->

            <?php if (get_edit_post_link()) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Edit <span class="screen-reader-text">%s</span>', 'wpbase'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
        </article><!-- #post-<?php the_ID(); ?> -->

    <?php

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
// get_sidebar();
do_action('wpbase_do_after_content');

get_footer();
