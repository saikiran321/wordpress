<?php
/**
 * Template Name: Full Width (no sidebar)
 * Description: A full width template with no sidebar
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 0.1
 */

get_header(); ?>

		<div id="primary" class="full-width">
			<div id="content" role="main">

				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>