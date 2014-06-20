<?php /* Related posts based on category of currently viewd post */ ?>
<?php $orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 3, // Number of related posts that will be shown.
'caller_get_posts'=>1
);

$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
echo '<div id="related-posts"><h3 class="page-title">Related Posts</h3><ul>';
while( $my_query->have_posts() ) {
$my_query->the_post();?>

	<li class="group">
		<article class="group">
	
			<div class="info">
		    	<h3 class="entry-title"><a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		    	
		    	<ul class="post-details">
		    		<li><?php the_time('M j, Y') ?></li>
		    		<li class="comments-link"><?php comments_number(); ?></li>
		    	</ul>
		    </div>
		    	
		    <a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php if(has_post_thumbnail()) :?>
		    	<?php the_post_thumbnail('ks-thumb'); ?>
		   		<?php else :?>
			    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" />
		    	<?php endif;?>
			</a>
			
		</article>
	</li>
<?php }
echo '</ul></div>';
}
}
$post = $orig_post;
wp_reset_query(); ?>