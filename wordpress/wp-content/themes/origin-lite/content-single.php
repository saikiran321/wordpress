<?php
/**
 * @package WordPress
 * @subpackage kickstart
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<h1 class="page-title"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h1>
	
		<?php $post_tags = wp_get_post_tags($post->ID);
    	if(!empty($post_tags)) { 
    		$tag_list = get_the_tag_list( '', ' ' ); ?>
    		<div id="tags">
	    		<h2>Tagged as:</h2>
    			<p><?php echo $tag_list; ?></p>
    		</div>
    	<?php } ?>

	<div class="articlecontent">
		<header class="entry-header">
			<h1 class="main-entry-title"><?php the_title(); ?></h1>
	
			<ul class="post-details">
	    		<li class="author"><?php the_author(); ?></li>
				<?php if ( 'post' == get_post_type() ) : ?>
	    		<li><?php kickstart_posted_on(); ?></li>
	    		<?php endif; ?>
	    		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
	    		<li class="comments-link"><?php comments_popup_link( __( 'No Comments', 'kickstart' ), __( '1 Comment', 'kickstart' ), __( '% Comments', 'kickstart' ) ); ?></li>
	    		<?php endif; ?>
			</ul>
	
		</header><!-- .entry-header -->
	
		<div class="entry-content group">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kickstart' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
		<footer class="entry-meta">
			<p><?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'kickstart' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', ', ' );
				
				if ( ! kickstart_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'Tagged: %2$s.', 'kickstart' );
					} else {
					}
					
				} else {
					
				} // end check for categories on this blog
				
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
			?></p>
	
			<?php edit_post_link( __( 'Edit', 'kickstart' ), '<p class="edit-link">', '</p>' ); ?>
	
			<?php get_template_part( 'social-share' ); ?>
		
		</footer><!-- .entry-meta -->
		
    	<?php get_template_part( 'related-posts' ); ?>
		
		<?php comments_template( '', true ); ?>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
