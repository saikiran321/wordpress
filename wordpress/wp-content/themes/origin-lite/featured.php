<?php
/**
 * @package WordPress
 * @subpackage kickstart
 */
?>

<div id="featured">
	<div class="flexslider">
		<ul class="slides">
	
				<?php 
		    	$query = new WP_Query();
		    	$query->query('post_type=featured&showposts=5');
		    	$post_count = $query->post_count;
		    	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
		    	?>
		    	
		    	<?php $featuredurl = get_post_meta(get_the_ID(), 'featured_url', TRUE); ?>
		    	
		        <li>
		        	<a href="<?php echo $featuredurl; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">          
						<?php if(has_post_thumbnail()) :?>
						<?php the_post_thumbnail('ks-featured'); ?>
						<?php else :?>
						<?php endif;?>
						<div class="flex-caption">
							<?php the_title(); ?>
							<?php the_excerpt(); ?>
						</div>
					</a>
					
		        </li>
		        
		        <?php endwhile; wp_reset_query(); endif; ?>
		</ul>
	</div>
	<div class="flexslider-controls"></div>
</div>