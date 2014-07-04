<?php
global $post;
    $categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args=array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'showposts'=>3, // Number of related posts that will be shown.
		'caller_get_posts'=>1
	);

	$my_query = new wp_query($args);
	if( $my_query->have_posts() ) {
	    echo '<div id="post-related-inline">' . '<h4>' . __('Related Posts', TEMPLATE_DOMAIN) . '</h4>';
		while ($my_query->have_posts()) {
			$my_query->the_post();
		?>
<div class="feat-cat-meta post-<?php the_ID(); ?>">

<?php echo get_featured_post_image("<div class='post-small-thumb'>", "</div>", 150, 150, "alignleft", "medium", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<div class="feat-cat-right">
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php _e('Posted on', TEMPLATE_DOMAIN); ?> <?php the_time('d F Y') ?></small>
<p><?php get_the_featured_excerpt($excerpt_length=35); ?>  </p>
</div>

</div>
 <?php
  }
  wp_reset_query();
echo '</div>';
}
}
?>
