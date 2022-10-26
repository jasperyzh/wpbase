<?php
$featured_img_url = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : UPLOAD_DIR_YAYASAN . "/yayasan-thumbnail-default.jpg"

?>
<div class="card card__post border-0 rounded-0 text-bg-primary h-100 shadow">
    <img src="<?= $featured_img_url ?>" class="" alt="<?= get_the_title() ?>" style=" aspect-ratio: 4/3; object-fit: cover; width: 100%;">
    <div class="card-body">

        <?php if (isset($args['category_name'])) : ?>
            <p class="text-uppercase m-0"><small><?= $args['category_name'] ?></small></p>
        <?php endif; ?>

        <h5 class="card-title h6"><?= $args['title'] ?></h5>


        <?php if (isset($args['excerpt'])) : ?>
            <p class="card-text"><?= $args['excerpt'] ?></p>
        <?php endif; ?>

        <a href="<?= (isset($args['link']) ? $args['link'] : get_site_url()) ?>" class="stretched-link"></a>

    </div>
    <div class="card-footer bg-primary border-0">
        <p class="mb-1"><small><?= $args['date'] ?></small></p>
    </div>
</div>