<?php

/**
 * card_get_post
 */
$query = new WP_Query([
    'post_status' => "published",
    'posts_per_page' => 1,
    'category_name' => "press-release",
]);
if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        $featured_img_url = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : UPLOAD_DIR_YAYASAN . "/yayasan/yayasan-thumbnail-default.jpg"
?>
        <div class="card card__get_post shadow">
            <img src="<?= $featured_img_url ?>" class="card-img-top" alt="<?= get_the_title() ?>">
            <div class="card-body">
                <h5 class="card-title"><?= get_the_title() ?></h5>
                <p><?= get_the_date() ?></p>
                <p class="card-text"><?= get_the_excerpt() ?></p>
                <a href="<?= get_permalink() ?>" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
<?php
    endwhile;
endif;

wp_reset_postdata();
?>