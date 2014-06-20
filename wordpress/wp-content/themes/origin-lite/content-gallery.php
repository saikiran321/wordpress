<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<p><?php kickstart_posted_on(); ?></p>
	</header><!-- .entry-header -->

	<div class="entry-content group">
		<?php if ( post_password_required() ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kickstart' ), 'after' => '</div>' ) ); ?>
			<p><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>">Continue reading &rarr;</a></p>

			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</figure><!-- .gallery-thumb -->

				<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'kickstart' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						number_format_i18n( $total_images )
					); ?></em></p>
			<?php endif; ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kickstart' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'kickstart' ) );
				if ( $categories_list && kickstart_categorized_blog() ) :
			?>
			<p class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'kickstart' ), $categories_list ); ?>
			</p>
			<?php endif; // End if categories ?>
			
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'kickstart' ) );
				if ( $tags_list ) :
			?>
			<p class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'kickstart' ), $tags_list ); ?>
			</p>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		
		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<p class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kickstart' ), __( '1 Comment', 'kickstart' ), __( '% Comments', 'kickstart' ) ); ?></p>
		<?php endif; ?>
		
		<p><?php edit_post_link( __( 'Edit', 'kickstart' ), '<span class="edit-link">', '</span>' ); ?></p>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
