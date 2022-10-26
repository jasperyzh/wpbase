<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpbase
 */

add_filter('get_the_archive_title_prefix', function () {
	return "";
});


get_header();

do_action('wpbase_do_before_content');

?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</header><!-- .page-header -->

		<div class="container-fluid">
			<div class="row row-cols-1 row-cols-lg-3">
				<?php

				/* Start the Loop */
				while (have_posts()) :
					the_post();

					/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
					// get_template_part( 'template-parts/content', get_post_type() );
					// get_template_part('template-parts/content', 'card');
					// get_template_part('template-parts/card', 'post');

				?>
					<div class="col mb-3">
						<?php
						get_template_part('template-parts/card', 'post', [
							"category_name" => $atts['category_name'],
							"title" => get_the_title(),
							"date" => get_the_date(),
							// "excerpt" => get_the_excerpt(),
							"link" => get_permalink()
						]);
						?>
					</div>
				<?php
				endwhile;
				?>
			</div>
		</div>
	<?php
		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
// get_sidebar();

do_action('wpbase_do_after_content');

get_footer();
