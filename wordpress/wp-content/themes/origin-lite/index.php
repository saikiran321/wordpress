<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 1.0
 */

get_header(); ?>

		<?php /* Display the featured slider only if there are posts in the featured post type */ ?>
		<?php
    	$query = new WP_Query();
        $query->query('post_type=featured');
        if ($query->have_posts()) :
        ?>

		<?php get_template_part( 'featured' ); ?>
		
		<?php else : ?>
		<?php /* You can place any code in here to display if there aren't any posts in the featured post type */ ?>
		<?php endif; ?>

		<div id="primary">

			<div id="content">
					
			<?php if ( have_posts() ) : ?>
				
				<?php /* Start the Loop and get the selected category from the Homepage theme options main category */ ?>
				<?php 
		    	$query = new WP_Query();
		    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		    	$query->query('order_by=date&paged='.$paged.'');
		    	?>
		    	
				<h1 class="page-title"><?php echo get_cat_name($homecat); ?></h1>				
		    	
				<?php while ($query->have_posts()) : $query->the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'kickstart' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php if(has_post_thumbnail()) :?>
						<p><?php the_post_thumbnail('thumbnail'); ?></p>
						<?php else :?>
						<?php endif;?>

						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kickstart' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>