<!DOCTYPE html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php get_template_part ( '/lib/options/options-var' ); ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php do_action( 'bp_head' ) ?>

<!-- STYLESHEET INIT -->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<?php if( function_exists('theme_custom_google_font')) { echo theme_custom_google_font(); } ?>

<?php if( get_theme_option('body_font') == 'Choose a font' || get_theme_option('body_font') == '') { ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<?php } ?>


<!-- favicon.ico location -->
<?php
global $shortname, $option_upload_path, $option_upload_url;
if( file_exists( $option_upload_path . '/' . $shortname . '_fav_icon.jpg' ) ) { ?>
<link rel="icon" href="<?php echo $option_upload_url . '/' . $shortname . '_fav_icon.jpg'; ?>" type="images/x-icon" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if gte IE 9]>
<style type="text/css">
#main-navigation,.post-meta,a.button,input[type='button'], input[type='submit'],h1.post-title,.wp-pagenavi a,#sidebar .item-options,.iegradient,h3.widget-title,.footer-bottom,.sf-menu .current_page_item a, .sf-menu .current_menu_item a, .sf-menu .current-menu-item a,.sf-menu .current_page_item a:hover, .sf-menu .current_menu_item a:hover, .sf-menu .current-menu-item a:hover {filter: none !important;}
</style>
<![endif]-->


<?php wp_head(); ?>

<script type="text/javascript">
//<![CDATA[
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
//]]>
</script>

<?php if ( ( is_home() || is_page_template('template-blog.php') ) && get_theme_option('slider_on') == 'Enable' ) { ?>
<!-- Hook up the Slider -->
<script type="text/javascript">
function startGallery() {
var myGallery = new gallery($('myGallery'), {
timed: true,
showArrows: true,
showCarousel: false,
embedLinks: true
});
document.gallery = myGallery;
}
window.onDomReady(startGallery);
</script>
<?php } ?>


<script type="text/javascript">
jQuery.noConflict();
var $sf = jQuery;
    $sf(document).ready(function(){
        $sf("ul.sf-menu").supersubs({
            minWidth:    15,   // minimum width of sub-menus in em units
            maxWidth:    20,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
        }).superfish();  // call supersubs first, then superfish, so that subs are
                         // not display:none when measuring. Call before initialising
                         // containing tabs for same reason.
    });
</script>


<script type="text/javascript">
jQuery.noConflict();
var $fc = jQuery;
$fc(document).ready(function() {
$fc("a[rel=gallery_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
});
</script>


<script type="text/javascript">
jQuery.noConflict();
var $ebox = jQuery;
$ebox(document).ready(function() {
$ebox('#right-sidebar #wp-calendar').wrap('<div class="extra-block">');
$ebox('#right-sidebar .widget_categories select').wrap('<div class="extra-block">');
$ebox('#right-sidebar .widget_archive select').wrap('<div class="extra-block">');
});
</script>

<?php print "<style type='text/css' media='all'>"; ?>
<?php get_template_part ( '/lib/options/options-css' ); ?>

<?php if( get_theme_option('social_on') == 'Yes'): ?>
<?php endif; ?>

<?php if( !has_nav_menu('primary') ) : ?>
#main-navigation {}
.sf-menu li:hover ul,.sf-menu li.sfHover ul {top:3em;}
<?php endif; ?>

<?php print "</style>"; ?>

</head>

<body <?php body_class(); ?> id="custom">

<?php if( get_theme_option('social_on') == 'Yes') { ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

<?php do_action( 'bp_before_wrapper' ) ?>

<div id="wrapper">

<div id="wrapper-main">

<?php do_action( 'bp_before_header' ) ?>
<!-- HEADER START -->
<header class="iegradient" id="header" role="banner">
<div class="innerwrap">
<div class="header-inner">
<div id="siteinfo">
<?php
global $shortname, $option_upload_path, $option_upload_url;
if( file_exists( $option_upload_path . '/' . $shortname . '_header_logo.jpg' ) ) { ?>
<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $option_upload_url . '/' . $shortname . '_header_logo.jpg'; ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } else { ?>
<?php if( get_theme_option('custom_header_title') ): ?>
<h1 class="custom-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo stripcslashes( get_theme_option('custom_header_title') ); ?></a></h1><p id="site-description"><?php echo stripcslashes( get_theme_option('custom_header_text') ); ?></p>
<?php else: ?>
<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><p id="site-description"><?php bloginfo( 'description' ); ?></p>
<?php endif; ?>
<?php } ?>
</div><!-- SITEINFO END -->
<?php $header_banner = get_theme_option('header_embed'); if($header_banner != '') : ?>
<!-- TOPBANNER -->
<div id="topbanner">
<?php echo get_theme_option('header_embed'); ?>
</div>
<!-- TOPBANNER END -->
<?php endif; ?>
</div><!-- end header-inner -->
</div>
</header>
<!-- HEADER END -->

<?php do_action( 'bp_after_header' ) ?>

<?php do_action( 'bp_before_nav' ) ?>
<!-- NAVIGATION START -->
<nav class="iegradient" id="main-navigation" role="navigation">
<div class="innerwrap">
<?php if ( function_exists( 'wp_nav_menu' ) ) {  ?>
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'sf-menu', 'fallback_cb' => 'revert_wp_menu_page','walker' => new Custom_Description_Walker )); ?>
<?php } ?>
<div id="mobile-nav">
<?php get_mobile_navigation( $type='top', $nav_name="primary" ); ?>
</div>
</div>
</nav>
<!-- NAVIGATION END -->
<?php do_action( 'bp_after_nav' ) ?>

<?php if ( get_theme_option('slider_on') == 'Enable' ) { ?>
<?php get_template_part( 'lib/sliders/gallery-slider' ); ?>
<?php } else { ?>
<?php if( get_header_image() ): ?>
<div class="innerwrap-custom-header">
<div id="custom-img-header"><img src="<?php echo header_image(); ?>" alt="" /></div>
</div>
<?php endif; ?>
<?php } ?>

<div id="bodywrap" class="innerwrap">
<div id="bodycontent">

<?php do_action( 'bp_before_container' ) ?>

<!-- CONTAINER START -->
<section id="container">

<div class="container-wrap">