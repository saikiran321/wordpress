<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 1.0
 */
?><?php //Retrieve Theme Options Data
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6">
<![endif]-->
<!--[if IE 7]>
<html id="ie7">
<![endif]-->
<!--[if IE 8]>
<html id="ie8">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'kickstart' ), max( $paged, $page ) );

	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/colour1.css" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lte IE 8]>
        <style>
        	header { position: relative; z-index: 250; }
        </style>
	<![endif]-->
	
	<!-- Include javascript file to make IE8 and below recognise HTML5 tags so they can be styled with CSS -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fitvids.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/view.min.js?auto"></script> 		
	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
				touchSwipe: true,
				controlsContainer: ".flexslider-controls",
				animationDuration: 350
			});
		});
	</script>
	
</head>

<body <?php body_class(); ?>>

	<header class="container group columns-two">
		<hgroup>
			<h1 id="site-title" class="plain-text">
    			<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		
		<div id="header_other">
		
			<!-- Social network links which can be set in the theme options -->
			<div id="social" class="group">
				<p class="group">
					<a class="rss" href="#">Subscribe via RSS</a>
					<a class="vimeo" href="#">View our Vimeo vidoes</a>
					<a class="youtube" href="#">View our YouTube videos</a>
					<a class="flickr" href="#">View Flickr photos</a>
					<a class="googleplus" href="#">Add on Google+</a>
					<a class="facebook" href="#">Like on Facebook</a>
					<a class="twitter" href="#">Follow on Twitter</a>
				</p>
			</div>
			
		</div>

		<nav id="access" class="group">
			<?php /* Whatever is set at the primart menu in Appearance > Menus in the WordPress admin will be the main site nav  */ ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #access -->
	</header><!-- #branding -->

	<div id="main" class="group container columns-two">
	
	
	