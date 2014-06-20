<?php

/*-----------------------------------------------------------------------------------

Plugin Name: Popular Posts
Description: Popular posts ordered by number of comments
Version: 1.0
Author: Tom Kenny

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ks_popular_widgets' );

// Register widget
function ks_popular_widgets() {
	register_widget( 'ks_popular_Widget' );
}

// Widget class
class ks_popular_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ks_popular_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'ks_popular_widget',
		'description' => __('Popular posts ordered by number of comments.', 'kickstart')
	);

	// Widget control settings
	$control_ops = array(
		'id_base' => 'ks_popular_widget'
	);

	// Create the widget
	$this->WP_Widget( 'ks_popular_widget', __('Popular Posts', 'kickstart'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$postcount = $instance['postcount'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	echo "<ul>\n";

	// Display popular Photos
	 ?>


	<?php query_posts('orderby=comment_count&posts_per_page=' . $postcount . ''); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<li class="cat-post-item">
	
		<article class="group">
		
			<div class="info">
				<h3 class="entry-title"><a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<ul class="post-details">
		    		<li><?php kickstart_posted_on(); ?></li>
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
	
	<?php endwhile; ?>
	<?php else : ?>
	<p>Sorry, no posts were found.</p>
	<?php endif; ?>
	
	<?php

	echo "</ul>\n";

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['postcount'] = strip_tags( $new_instance['postcount'] );

	// No need to strip tags
	$instance['type'] = $new_instance['type'];
	$instance['display'] = $new_instance['display'];

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Popular Posts',
		'postcount' => '3',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Post count input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Post Count', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
	</p>

	
	<?php
	}
}
?>