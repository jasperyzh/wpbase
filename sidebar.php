<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wpbase
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="wrap">

		<?php do_action('wpbase_before_sidebar_content'); ?>

		<?php dynamic_sidebar('sidebar-1'); ?>

		<?php do_action('wpbase_after_sidebar_content'); ?>
	</div>
</aside><!-- #secondary -->
