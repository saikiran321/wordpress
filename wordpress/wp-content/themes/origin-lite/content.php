<?php
/**
 * @package WordPress
 * @subpackage kickstart
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
	<header class="entry-header info">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<ul class="post-details">
			<?php if ( 'post' == get_post_type() ) : ?>
    		<li><?php kickstart_posted_on(); ?></li>
    		<?php endif; ?>
    		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
    		<li class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kickstart' ), __( '1 Comment', 'kickstart' ), __( '% Comments', 'kickstart' ) ); ?></li>
    		<?php endif; ?>
		</ul>

	</header><!-- .entry-header -->

	<div class="entry-content group">
		<?php if(has_post_thumbnail()) :?>
	    <div class="thumbnail">
	    	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	    		<?php the_post_thumbnail('ks-thumb'); ?>
	    	</a>
	    </div>
	    <?php else :?>
	    <div class="thumbnail">
		    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">	
		    	<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" />
		    </a>
		</div>
	    <?php endif;?>
	    <div class="info">
			<div class="excerpt"><?php the_excerpt(); ?></div>
			<p class="continue-link"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>">Continue reading &rarr;</a></p>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
