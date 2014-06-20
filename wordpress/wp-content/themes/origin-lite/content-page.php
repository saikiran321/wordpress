<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="articlecontent">
		<header class="entry-header">
	
			<h1 class="main-entry-title"><?php the_title(); ?></h1>
				
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kickstart' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
		<?php comments_template( '', true ); ?>
	
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
