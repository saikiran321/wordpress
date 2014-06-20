<?php

/*

Plugin Name: Social Widget
Description: A widget to display your social networks
Version: 1.0
Author: Tom Kenny

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ks_social_widgets' );

// Register widget
function ks_social_widgets() {
	register_widget( 'ks_social_widget' );
}

// Widget class
class ks_social_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ks_social_widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'ks_social_widget',
		'description' => __('A widget to display your social networks.', 'kickstart')
	);

	// Widget control settings
	$control_ops = array(
		'id_base' => 'ks_social_widget'
	);

	// Create the widget
	$this->WP_Widget( 'ks_social_widget', __('Social', 'kickstart'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$twitterID = $instance['twitterID'];
	$facebookID = $instance['facebookID'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display Flickr Photos
	 ?>
		
	<div class="social_wrapper group">
	
		<?php if ($twitterID) { ?>
		<div class="social_block social_twitter">

			<a href="https://twitter.com/<?php echo $twitterID ?>" class="twitter-follow-button">Follow @<?php echo $twitterID ?></a>
<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>

		</div>
		<?php } ?>	
		
		<?php if ($facebookID) { ?>
		<div class="social_block social_facebook">
			<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $facebookID ?>&amp;width=700&amp;height=185&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=false" style="overflow:hidden; width:700px; height:200px;"></iframe>
		</div>
		<?php } ?>	
	
	</div>
	
	<?php

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
	$instance['facebookID'] = strip_tags( $new_instance['facebookID'] );

	// No need to strip tags
	$instance['twitterID'] = $new_instance['twitterID'];

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Flickr Photos',
		'twitterID' => '',
		'facebookID' => ''
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Twitter @name: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'twitterID' ); ?>"><?php _e('Twitter @name:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitterID' ); ?>" name="<?php echo $this->get_field_name( 'twitterID' ); ?>" value="<?php echo $instance['twitterID']; ?>" />
	</p>
						
	<!-- Facebook Page -->
	<p>
		<label for="<?php echo $this->get_field_id( 'facebookID' ); ?>"><?php _e('Facebook Page URL:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebookID' ); ?>" name="<?php echo $this->get_field_name( 'facebookID' ); ?>" value="<?php echo $instance['facebookID']; ?>" />
	</p>	
			
	<?php
	}
}
?>