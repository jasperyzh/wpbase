<?php

global $wp_query;
$page_id = get_the_ID();

if ($page_id) {

    // check_for_acf_banner
    $img_src = get_field('page_banner', $page_id);

    // check_for_legacy_cmb2
    if (empty($img_src)) {
        $img_src = get_post_meta($page_id, '_page_banner', true);
    }

    // default
    if (empty($img_src)) {
        $upload_dir = wp_upload_dir();
        $img_src = $upload_dir['baseurl'] . '/yayasan/page_banner_default.jpg';
    }
}
?>
<section class="page_banner">
    <img class="img-fluid" src="<?= $img_src ?>">
</section>