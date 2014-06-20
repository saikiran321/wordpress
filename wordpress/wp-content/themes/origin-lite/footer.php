<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="container group columns-two">
		<div class="column">
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
		</div>
		<div class="column">
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
		</div>
		<div class="column">
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
		</div>
		<div class="column end">
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 4') ) ?>
		</div>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>
	
	<script>
		// fitvid.js support - http://fitvidsjs.com/
		$(".container").fitVids();
	</script>


</body>
</html>