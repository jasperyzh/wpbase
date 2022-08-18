<?php if (!get_post_meta(get_the_ID(), '_page_hide_title', true)) : ?>

    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

<?php endif; ?>