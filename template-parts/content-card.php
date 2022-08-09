<?php

/**
 * content-card
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <?php wpbase_post_thumbnail(); ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                    <?php if ('post' === get_post_type()) : ?>
                        <div class="entry-meta">
                            <?php wpbase_posted_on(); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_excerpt(); ?>
                </div>
                <div class="card-footer">
                    <?php wpbase_entry_footer(); ?>
                </div>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->