<?php

// http://localhost/yayasan/focus-area/education/
// http://localhost/yayasan/focus-area/community/
// http://localhost/yayasan/focus-area/environment/
add_shortcode('display__signature_programme', 'yayasan_programmes_card');
function yayasan_programmes_card($atts)
{
    $atts = shortcode_atts([
        'tag' => '',
    ], $atts, 'display__signature_programme');
    $query = new \WP_query([
        'post_type' => 'program',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => [
            [
                'taxonomy' => 'program-tag',
                'field' => 'slug',
                'terms' => $atts['tag'],
            ],
        ],
    ]);
    ob_start();
    if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="card card__signature-programme border-primary">
                <div class="card-body">
                    <h4 class="card-title"><?= get_the_title() ?></h4>
                    <p class="card-text"><?= get_the_excerpt() ?></p>
                    <a href="<?= get_the_permalink() ?>" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * focus page - voice of inspiration
 */
add_shortcode('display__voice_of_inspiration', 'shortcode_focus_voice_inspiration');
function shortcode_focus_voice_inspiration($atts)
{
    ob_start();

    // shortcode attribute
    $atts = shortcode_atts(
        array(
            'post_tag' => '',
            'tag' => '',
        ),
        $atts,
        'display__voice_of_inspiration'
    );

    $get_inspiration = new \WP_query(array(
        'post_type' => 'post',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'category_name' => $atts['tag'] . '+voice-of-inspiration',
        'posts_per_page' => -1,
        'tag' => $atts['post_tag'],
    ));

    if ($get_inspiration->have_posts()) :
        echo '<div class="voices">';
        echo '<h2 class="voices__title">Voices of Inspiration</h2>';
        echo '<ul class="voices__list">';
        while ($get_inspiration->have_posts()) :
            $get_inspiration->the_post();
            echo '<li class="voices__item"><a class="voices__link" href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
        endwhile;
        echo '</ul>';
        echo '</div>';
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}

// http://localhost/yayasan/about/
add_shortcode('display__board_of_trustees', 'yayasan_about_boards_trustees');
function yayasan_about_boards_trustees($atts)
{
    $atts = shortcode_atts([
        'people_tag' => 'board-of-trustee',
    ], $atts, 'display__board_of_trustees');
    $query = new \WP_query([
        'post_type' => 'people',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => [[
            'taxonomy' => 'people-tag',
            'field' => 'slug',
            'terms' => $atts['people_tag'],
        ]],
    ]);
    ob_start();
    if ($query->have_posts()) : ?>
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col mb-3">
                        <div class="card card__bot h-100 rounded-0 border-0 text-bg-primary <?= $atts['people_tag'] ?>">
                            <?php the_post_thumbnail('full', [
                                // 'class' => 'card-img-top',
                                'title' => get_the_title(),
                            ]); ?>
                            <div class="card-body">
                                <h5 class="card-title h6"><?= get_the_title() ?></h5>
                                <p class="card-text mb-1"><?= get_post_meta(get_the_ID(), '_people_position', true) ?></p>
                            </div>
                            <div class="card-footer border-0">
                                <a href="<?= get_the_permalink() ?>"><u><small>Click for Biography</small></u></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}


// 221017_muplugins_uncertain if still in use

// about - board of trustees speeches
// add_shortcode('display__trustee_speech',  'shortcode__trustee_speech');
function shortcode__trustee_speech($atts)
{
    // $atts = shortcode_atts(
    //   array(
    //       // 'name'  => '',
    //   ), $atts, 'display__trustee_speech');

    if (!empty($atts['name'])) {
        $director_speech = explode(",", trim($atts['name']));
    }
    $director_speech = new \WP_query(array(
        'post_name__in' => $director_speech,
        'post_type' => 'people',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));
    ob_start();

    if ($director_speech->have_posts()) :
        echo '<section class="trustee-speech container">';
        while ($director_speech->have_posts()) :
            $director_speech->the_post();

            $photo = get_the_post_thumbnail();
            $name = get_the_title();
            $slug = get_post_field('post_name', get_the_ID());
            $content_speech = get_post_meta(get_the_ID(), '_people_speech', true);
            $content_speech_quote = get_post_meta(get_the_ID(), '_people_speech_quote', true);
            $position = get_post_meta(get_the_ID(), '_people_position', true);

        ?>
            <div class="row align-items-center speech">
                <div class="col-12 col-md-4 speech__photo">
                    <?php echo $photo; ?>
                </div>
                <div class="col-12 col-md-8 speech__content">
                    <p class="speech__quote">
                        <?php echo $content_speech_quote; ?>
                    </p>
                    <p class="speech__name">
                        <?php echo $name; ?>
                    </p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $slug; ?>">
                        Read Foreword
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal modal-speech fade" id="<?php echo $slug; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $slug; ?>" aria-hidden="true">
                <div class="modal-dialog modal-speech__dialog" role="document">
                    <div class="modal-content modal-speech__content">
                        <div class="modal-header modal-speech__header">
                            <!-- <h5 class="modal-title" id="<?php echo $name; ?>Label">Modal title</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-speech__content">
                            <div class="modal-speech__photo">
                                <?php echo $photo; ?>
                            </div>
                            <?php echo $content_speech; ?>
                            <h6 class="modal-speech__name">
                                <?php echo $name; ?>
                            </h6>
                            <p class="modal-speech__position">
                                <?php echo $position; ?>
                            </p>
                        </div>
                        <div class="modal-footer modal-speech__footer">
                            <button type="button" class="btn btn-primary btn-primary--invert" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
<?php

        endwhile;

        echo '</section>';

    endif;
    wp_reset_postdata();
    return ob_get_clean();
}
