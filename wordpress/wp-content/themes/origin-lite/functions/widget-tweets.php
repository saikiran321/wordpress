<?php

/*
Plugin Name: Twitter Tweets Widget
Description: A widget to display your tweets
Version: 1.0
Author: Tom Kenny
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ks_tweets_widgets' );

// Register widget
function ks_tweets_widgets() {
	register_widget( 'ks_tweets_widget' );
}

// Widget class
class ks_tweets_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function ks_tweets_widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'ks_tweets_widget',
		'description' => __('Display your Tweets.', 'kickstart')
	);

	// Widget control settings
	$control_ops = array(
		'id_base' => 'ks_tweets_widget'
	);

	// Create the widget
	$this->WP_Widget( 'ks_tweets_widget', __('Tweets', 'kickstart'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$twittername = $instance['twittername'];
	$tweetNumber = $instance['tweetNumber'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display Flickr Photos
	 ?>
		
	<div class="tweets_wrapper group">
	
		<div id="tweet"></div>
		
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/twitter-1.12.2.js"></script>
		<script type="text/javascript">
		getTwitters('tweet', { 
			id: '<?php echo $twittername ?>', 
			count: <?php echo $tweetNumber ?>, 
			enableLinks: true, 
			ignoreReplies: true, 
			clearContents: true,
			template: '"%text%" <a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a>'
		});
		</script>
		
		<p><a href="http://twitter.com/<?php echo $twittername ?>">Follow on Twitter</a></p>

	
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
	$instance['twittername'] = strip_tags( $new_instance['twittername'] );
	$instance['tweetNumber'] = strip_tags( $new_instance['tweetNumber'] );

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Tweets',
		'twittername' => '',
		'tweetNumber' => '5',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Twitter user name -->
	<p>
		<label for="<?php echo $this->get_field_id( 'twittername' ); ?>"><?php _e('Twitter @name:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twittername' ); ?>" name="<?php echo $this->get_field_name( 'twittername' ); ?>" value="<?php echo $instance['twittername']; ?>" />
	</p>
						
	<!-- Number of tweets -->
	<p>
		<label for="<?php echo $this->get_field_id( 'tweetNumber' ); ?>"><?php _e('Number of Tweets:', 'kickstart') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'tweetNumber' ); ?>" name="<?php echo $this->get_field_name( 'tweetNumber' ); ?>" value="<?php echo $instance['tweetNumber']; ?>" />
	</p>	
			
	<?php
	}
}
?>