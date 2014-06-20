<?php

/*
Plugin Name: Latest Magazine Issue
Description: Show the latest magazine issue and 4 custom links.
Version: 1.0
Author: Tom Kenny
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ks_latestissue_widgets' );

// Register widget
function ks_latestissue_widgets() {
	register_widget( 'ks_latestissue_widget' );
}

// Widget class
class ks_latestissue_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ks_latestissue_widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'ks_latestissue_widget',
		'description' => __('Show the latest magazine issue and 4 custom links.', 'kickstart')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'ks_latestissue_widget'
	);

	// Create the widget
	$this->WP_Widget( 'ks_latestissue_widget', __('Latest Issue', 'kickstart'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
	}
	
	// Get array of post info.
	$cat_posts = new WP_Query(
    	"showposts=1&cat=" . $instance["cat"]
	);

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
		<div class="cover">								
			<a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        		<?php if(has_post_thumbnail()) :?>
            	<?php the_post_thumbnail('ks-mag-thumb'); ?>
           		<?php else :?>
            	<?php endif;?>
        	</a>
		</div>
	<?php } ?>
	
		<ul>
		
			<li>
				<?php /* Display the link to the contents of the magazine which is the same link the magazine cover image clicks through to. */ ?>
				<?php while ( $cat_posts->have_posts() )
				{
					$cat_posts->the_post();
				?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Contents</a>
				<?php } ?>
			</li>
			
			<?php if ($instance["link1"]) { ?>
			<li><a href="<?php echo $instance["link1"] ?>" title="<?php echo $instance["link1title"] ?>"><?php echo $instance["link1title"] ?></a></li>
			<?php } ?>
			
			<?php if ($instance["link2"]) { ?>
			<li><a href="<?php echo $instance["link2"] ?>" title="<?php echo $instance["link2title"] ?>"><?php echo $instance["link2title"] ?></a></li>
			<?php } ?>
			
			<?php if ($instance["link3"]) { ?>
			<li><a href="<?php echo $instance["link3"] ?>" title="<?php echo $instance["link3title"] ?>"><?php echo $instance["link3title"] ?></a></li>
			<?php } ?>
			
			<?php if ($instance["link4"]) { ?>
			<li><a href="<?php echo $instance["link4"] ?>" title="<?php echo $instance["link4title"] ?>"><?php echo $instance["link4title"] ?></a></li>
			<?php } ?>
			
		</ul>
	
	<?php
	
	echo "</ul>\n";
	
	echo $after_widget;

	$post = $post_old; // Restore the post object.
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['cat'] = strip_tags( $new_instance['cat'] );
	$instance['link1title'] = strip_tags( $new_instance['link1title'] );
	$instance['link1'] = strip_tags( $new_instance['link1'] );
	$instance['link2title'] = strip_tags( $new_instance['link2title'] );
	$instance['link2'] = strip_tags( $new_instance['link2'] );
	$instance['link3title'] = strip_tags( $new_instance['link3title'] );
	$instance['link3'] = strip_tags( $new_instance['link3'] );
	$instance['link4title'] = strip_tags( $new_instance['link4title'] );
	$instance['link4'] = strip_tags( $new_instance['link4'] );

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Latest Issue',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Catgory Selection -->
	<p>
    	<label>
    		<?php _e( 'Category' ); ?>:
    		<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
    	</label>
    </p>
		
	<!-- First Link Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link1title' ); ?>"><?php _e('Link 1 Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1title' ); ?>" name="<?php echo $this->get_field_name( 'link1title' ); ?>" value="<?php echo $instance['link1title']; ?>" />
	</p>

	<!-- First Link -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Link 1:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
	</p>

	<!-- Second Link Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link2title' ); ?>"><?php _e('Link 2 Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2title' ); ?>" name="<?php echo $this->get_field_name( 'link2title' ); ?>" value="<?php echo $instance['link2title']; ?>" />
	</p>

	<!-- Second Link -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Link 2:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
	</p>

	<!-- Third Link Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link3title' ); ?>"><?php _e('Link 3 Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3title' ); ?>" name="<?php echo $this->get_field_name( 'link3title' ); ?>" value="<?php echo $instance['link3title']; ?>" />
	</p>

	<!-- Third Link -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Link 3:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
	</p>

	<!-- Fourth Link Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link4title' ); ?>"><?php _e('Link 4 Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4title' ); ?>" name="<?php echo $this->get_field_name( 'link4title' ); ?>" value="<?php echo $instance['link4title']; ?>" />
	</p>

	<!-- Fourth Link -->
	<p>
		<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Link 4:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
	</p>

		
	<?php
	}
}
?>