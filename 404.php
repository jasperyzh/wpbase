<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wpbase
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title display-1"><?php esc_html_e('404', 'wpbase'); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p class="mb-0 display-4">Sorry!</p>
			<p class="lead"><?php esc_html_e('The Page You\'re Looking For Was Not Found', 'wpbase'); ?></p>

			<?php
			// get_search_form();

			// the_widget( 'WP_Widget_Recent_Posts' );
			?>

			<!-- <div class="widget widget_categories">
						<h2 class="widget-title"><?php //esc_html_e( 'Most Used Categories', 'wpbase' ); 
													?></h2>
						<ul>
							<?php
							/* wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							); */
							?>
						</ul>
					</div> -->
			<!-- .widget -->

			<?php
			/* translators: %1$s: smiley */
			// $wpbase_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'wpbase' ), convert_smilies( ':)' ) ) . '</p>';
			// the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$wpbase_archive_content" );

			// the_widget( 'WP_Widget_Tag_Cloud' );
			?>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
