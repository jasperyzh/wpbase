<?php

add_shortcode('get_template_part', 'get_get_template_part');
add_shortcode('get_cards', 'wpbase_shortcode_get_cards');
add_shortcode('get_latest_posts', 'wpbase_shortcode_get_latest_posts');


/**
 * shortcode-add-template-parts
 */
function get_get_template_part($atts)
{
    $atts = shortcode_atts([
        'slug' => '',
        'name' => '',
        'args' => ''
    ], $atts, 'get_template_part');

    ob_start();
    get_template_part($atts['slug'], $atts['name'], $atts['args']);

    return ob_get_clean();
}

// shortcode to pull post as card
/**
 * 1. add this file to functions.php
 *      require get_template_directory() . '/wpbase-shortcode_post_card.php';
 * 
 * 2. under page_editor, add_shortcode
 *      [get_post_as_card posts_per_page="" category_name=""]
 * 
 *  // require bootstrap4_grid
 *  // require bootstrap4_card
 */
function wpbase_shortcode_get_cards($atts)
{
    extract(
        shortcode_atts([
            'posts_per_page' => 3,
            'category_name' => "",
            'post_type' => 'products',
            'orderby' => 'menu_order title',
            'order' => 'ASC',

        ], $atts, 'get_template_part')
    );

    ob_start();

    $query = new WP_Query([
        'post_status' => "published",
        'posts_per_page' => $posts_per_page,
        'category_name' => $category_name,
        'post_type' => $post_type,
        'orderby' => $orderby,
        'order' => $order,
    ]);
    if ($query->have_posts()) : ?>
        <div class="container">
            <div class="row row-cols-3">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();

                    $featured_img_url = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : "https://via.placeholder.com/256x256?text=placeholder"
                ?>
                    <div class="col mb-3">
                        <div class="card h-100">
                            <img src="<?= $featured_img_url ?>" class="card-img-top" alt="<?= get_the_title() ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= get_the_title() ?></h5>
                                <p class="card-text"><?= get_the_excerpt() ?></p>
                                <a href="<?= get_permalink() ?>" class="btn btn-primary stretched-link"></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
<?php endif;

    wp_reset_postdata();

    return ob_get_clean();
}



/**
 * shortcode-latest posts
 */
function wpbase_shortcode_get_latest_posts($atts)
{
    $atts = shortcode_atts([
        'category_name' => '',
    ], $atts, 'get_latest_posts');

    $query = new WP_Query([
        'post_status' => "published",
        'posts_per_page' => 5,
        'category_name' => $atts['category_name'],
    ]);
    ob_start();

    if ($query->have_posts()) :
        echo '<article>';
        while ($query->have_posts()) :
            $query->the_post();

            echo get_the_date();
            echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' .
                '<h4>' . get_the_title() . '</h4>' . '
            </a>';

        endwhile;
        echo '</article>';
    endif;

    wp_reset_postdata();
    return ob_get_clean();
}
