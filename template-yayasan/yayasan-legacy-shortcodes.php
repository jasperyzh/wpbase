<?php

// http://localhost/yayasan/focus-area/
add_shortcode('display__focus_area_overview', 'shortcode_focus_area_overview');
function shortcode_focus_area_overview($atts)
{
    ob_start();
?>
    <div class="container py-5 text-center">
        <div class="row">
            <div class="col-12 col-md-4">
                <a href="<?= get_site_url() ?>/focus-area/education">
                    <img src="<?php echo UPLOAD_DIR_YAYASAN . '/images/icon/touch-1.png'; ?>">
                </a>
                <p>The Sentuhan Ilmu series of programmes aims to improve education outcomes and better the opportunities
                    for underprivileged students.
                </p>
                <a href="<?= get_site_url() ?>/focus-area/education" class="btn btn-primary btn--margin">Learn
                    More</a>
            </div>
            <div class="col-12 col-md-4">
                <a href="<?= get_site_url() ?>/focus-area/community">
                    <img src="<?php echo UPLOAD_DIR_YAYASAN . '/images/icon/touch-2.png'; ?>">
                </a>
                <p>PETRONAS has worked with single mothers, rural entrepreneurs and others from marginalised communities
                    across Malaysia.
                </p>
                <a href="<?= get_site_url() ?>/focus-area/community" class="btn btn-primary btn--margin">Learn
                    More</a>
            </div>
            <div class="col-12 col-md-4">
                <a href="<?= get_site_url() ?>/focus-area/environment">
                    <img src="<?php echo UPLOAD_DIR_YAYASAN . '/images/icon/touch-3.png'; ?>">
                </a>
                <p>Home to the world’s oldest rainforest and rich marine life, Malaysia has an opportunity to showcase how
                    sustainability can be balanced with progress.
                </p>
                <a href="<?= get_site_url() ?>/focus-area/environment" class="btn btn-primary btn--margin">Learn
                    More</a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

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
        <div class="container-fluid">
            <div class="row">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="card border-primary mb-3">
                        <div class="card-body text-primary">
                            <h5 class="card-title"><?= get_the_title() ?></h5>
                            <p class="card-text"><?= get_the_excerpt() ?></p>
                            <a href="<?= get_the_permalink() ?>" class="btn btn-primary btn-sm">Read More</a>
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

/**
 * focus page - voice of inspiration
 */
// add_shortcode('display__voice_of_inspiration', 'shortcode_focus_voice_inspiration');
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



// http://localhost/yayasan/donations/
add_shortcode('display__donation_faq', 'yayasan_donations_faq');
function yayasan_donations_faq()
{
    ob_start();

    $donation_faq = get_post_meta(get_the_ID(), '_donation_faq', true);

    echo '<div class="donation__faq-accordion" id="accordionExample">';
    $counter = 0;
    foreach ((array) $donation_faq as $key => $entry) {
        $counter++;
        $question = $answer = '';
        if (isset($entry['question'])) {
            $question = esc_html($entry['question']);
        }
        if (isset($entry['answer'])) {
            $answer = esc_html($entry['answer']);
        }
    ?>
        <div class="card">
            <div class="card-header" id="faq-<?php echo $counter; ?>">
                <h5 class="mb-0">
                    <button class="btn btn-link <?php echo ($counter <= 1) ? 'collapsed' : ''; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>" aria-expanded="<?php echo ($counter <= 1) ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $counter; ?>">
                        <?php echo $question; ?>
                    </button>
                    <button class="accordion__ux" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>" aria-expanded="<?php echo ($counter <= 1) ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $counter; ?>">
                    </button>
                </h5>
            </div>
            <div id="collapse-<?php echo $counter; ?>" class="collapse <?php echo ($counter <= 1) ? 'show' : ''; ?>" aria-labelledby="faq-<?php echo $counter; ?>" data-parent="#accordionExample">
                <div class="card-body">
                    <?php echo $answer; ?>
                </div>
            </div>
        </div>
    <?php
    }
    echo '</div>'; // accordion end

    return ob_get_clean();
}

// http://localhost/yayasan/donations/
add_shortcode('display__apply_now', 'shortcode_apply_now');
function shortcode_apply_now($atts)
{
    ob_start();
    ?>
    <div class="card text-bg-primary mb-4 text-center">
        <div class="card-body text-light">
            <h3 class="text-light">Ready to Apply?</h3>
            <p>Please complete your application online and submit all supporting and relevant documents to us.</p>
            <p>
                <a href="https://yayasanpetronas.sponsor.com/" class="btn btn-outline-light ">Apply Now</a>
            </p>
            <p>We will contact you within 2 weeks if your application for donation is approved.</p>
            <p>If you have further enquiries, see if the FAQs address your questions. If not, feel free to <a class="text-light" href="<?= get_site_url() ?>/contact"><u>connect with us</u></a>.</p>
        </div>
    </div>
<?php
    /* 
bm_copy
<h3 class="apply-now__title">Bersedia untuk memohon?</h3>
<p>Sila lengkapkan permohonan secara dalam talian dan sertakan dokumen sokongan yang berkaitan.</p>
<a target="_blank" href="https://yayasanpetronas.sponsor.com/" class="apply-now__btn btn btn-primary btn-primary--invert">MOHON
    SEKARANG</a>
<p>Anda akan dihubungi dalam tempoh dua minggu jika permohonan anda diluluskan.</p>
<p>Untuk maklumat lanjut, sila rujuk bahagian soalan lazim. Jika anda mempunyai soalan
    lanjut, <a href="<?php echo get_site_url(); ?>/contact">sila hubungi kami</a>.</p>
*/
    return ob_get_clean();
}

// display__guiding_principles
add_shortcode('display__guiding_principles', 'yayasan_about_guiding_principles');
function yayasan_about_guiding_principles()
{
    ob_start();
?>
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="card border-light mb-3">
                <div class="card-body text-primary">
                    <h5 class="card-title">Value Creation</h5>
                    <p class="card-text">The Foundation aims for initiatives that create value for all parties involved, e.g., society, stakeholders, partners, NGOs and other collaborators.</p>
                </div>
            </div>
            <div class="card border-light mb-3">
                <div class="card-body text-primary">
                    <h5 class="card-title">Sustainable Impact</h5>
                    <p class="card-text">The Foundation focuses on initiatives that have the potential to solve issues which may require long term intervention for on-going improvement.</p>
                </div>
            </div>
            <div class="card border-light mb-3">
                <div class="card-body text-primary">
                    <h5 class="card-title">Innovative Solution</h5>
                    <p class="card-text">The Foundation aims to deliver innovative solutions to address issues concerning education, community well-being and development, and the environment.</p>
                </div>
            </div>
            <div class="card border-light mb-3">
                <div class="card-body text-primary">
                    <h5 class="card-title">Effective Partnerships and collaboration</h5>
                    <p class="card-text">The Foundation places importance on collaborating with stakeholders to offer impactful solutions which address areas of need.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
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

                    <!-- <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                    <div class="col">
                        <div class="card h-100 text-bg-primary mb-3">
                            <?php the_post_thumbnail('full', [
                                'class' => 'card-img-top',
                                'title' => get_the_title(),
                            ]); ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= get_the_title() ?></h5>
                                <p class="card-text"><?= get_post_meta(get_the_ID(), '_people_position', true) ?></p>
                                <a href="<?= get_the_permalink() ?>"><small>Click for Biography</small></a>
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