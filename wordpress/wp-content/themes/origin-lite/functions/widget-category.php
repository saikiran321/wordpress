<?php
/*
Plugin Name: Category Posts Widget
Plugin URI: http://jameslao.com/2011/03/24/category-posts-widget-3-2/
Description: Adds a widget that can display posts from a single category.
Author: James Lao (Modified by Tom Kenny)
Version: 3.3
Author URI: http://jameslao.com/
*/

class CategoryPosts extends WP_Widget {

function CategoryPosts() {
	parent::WP_Widget(false, $name='Category Posts');
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	$sizes = get_option('jlao_cat_post_thumb_sizes');
	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
  }

  $valid_sort_orders = array('date', 'title', 'comment_count', 'rand');
  if ( in_array($instance['sort_by'], $valid_sort_orders) ) {
    $sort_by = $instance['sort_by'];
    $sort_order = (bool) $instance['asc_sort_order'] ? 'ASC' : 'DESC';
  } else {
    // by default, display latest first
    $sort_by = 'date';
    $sort_order = 'DESC';
  }
	
	// Get array of post info.
  $cat_posts = new WP_Query(
    "showposts=" . $instance["num"] . 
    "&cat=" . $instance["cat"] .
    "&orderby=" . $sort_by .
    "&order=" . $sort_order
  );

	// Excerpt length filter
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");
	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	if( $instance["title_link"] )
		echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
	else
		echo $instance["title"];
	echo $after_title;

	// Post list
	echo "<ul>\n";
	
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	?>
		<li class="cat-post-item">
			<article class="group">
			
				<div class="info">
					<h3 class="entry-title"><a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					<ul class="post-details">
			    		<?php if ( $instance['date'] ) : ?>
			    		<li><?php kickstart_posted_on(); ?></li>
			    		<?php endif; ?>
			    		
						<?php if ( $instance['comment_num'] ) : ?>
			    		<li class="comments-link"><?php comments_number(); ?></li>
			    		<?php endif; ?>
					</ul>
				</div>
				
				<a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		    		<?php if(has_post_thumbnail()) :?>
		        	<?php the_post_thumbnail('ks-thumb'); ?>
		       		<?php else :?>
		    	    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" />
		        	<?php endif;?>
		    	</a>
		    	
		    	<?php if ( $instance['excerpt'] ) : ?>
		    	<div class="info">
		    		<?php the_excerpt(); ?>
		    	</div>
				<?php endif; ?>
	
			</article>
		</li>
	<?php
	}
	
	echo "</ul>\n";
	
	echo $after_widget;

	remove_filter('excerpt_length', $new_excerpt_length);
	
	$post = $post_old; // Restore the post object.
}

/**
 * The configuration form.
 */
function form($instance) {
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title', 'kickstart' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php _e( 'Category', 'kickstart' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show', 'kickstart'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
    </p>

    <p>
			<label for="<?php echo $this->get_field_id("sort_by"); ?>">
        <?php _e('Sort by', 'kickstart'); ?>:
        <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
          <option value="date"<?php selected( $instance["sort_by"], "date" ); ?>>Date</option>
          <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>>Title</option>
          <option value="comment_count"<?php selected( $instance["sort_by"], "comment_count" ); ?>>Number of comments</option>
          <option value="rand"<?php selected( $instance["sort_by"], "rand" ); ?>>Random</option>
        </select>
			</label>
    </p>
		
		<p>
			<label for="<?php echo $this->get_field_id("asc_sort_order"); ?>">
        <input type="checkbox" class="checkbox" 
          id="<?php echo $this->get_field_id("asc_sort_order"); ?>" 
          name="<?php echo $this->get_field_name("asc_sort_order"); ?>"
          <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
				<?php _e( 'Reverse sort order (ascending)', 'kickstart' ); ?>
			</label>
    </p>

		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php _e( 'Make widget title link', 'kickstart' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php _e( 'Show post excerpt', 'kickstart' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt_length"); ?>">
				<?php _e( 'Excerpt length (in words):', 'kickstart' ); ?>
			</label>
			<input style="text-align: center;" type="text" id="<?php echo $this->get_field_id("excerpt_length"); ?>" name="<?php echo $this->get_field_name("excerpt_length"); ?>" value="<?php echo $instance["excerpt_length"]; ?>" size="3" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("comment_num"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("comment_num"); ?>" name="<?php echo $this->get_field_name("comment_num"); ?>"<?php checked( (bool) $instance["comment_num"], true ); ?> />
				<?php _e( 'Show number of comments', 'kickstart' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
				<?php _e( 'Show post date', 'kickstart' ); ?>
			</label>
		</p>
		

<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("CategoryPosts");') );

?>
