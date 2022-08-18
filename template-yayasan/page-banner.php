<?php

global $wp_query;
$page_id = get_the_ID();

if ($page_id) {
    $img_src = get_post_meta($page_id, '_page_banner', true);
    if (empty($img_src)) {

        // hardcoded
        $img_src = 'https://via.placeholder.com/512x512?text=placeholder';
    }
}
?>

<section class="page_banner">
    <img class="" src="<?= $img_src ?>" alt="">
</section>