<?php
/** ------------------------------------------------------------------------------------------------------------------------
 * kickstart functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 1.0
 */

if ( ! function_exists( 'kickstart_setup' ) ):
/** ------------------------------------------------------------------------------------------------------------------------
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override kickstart_setup() in a child theme, add your own kickstart_setup to your child theme's
 * functions.php file.
 */
function kickstart_setup() {
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kickstart' ),
	) );

	/**
	 * Add support for post thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	add_custom_background();
	
}
endif; // kickstart_setup

/** ------------------------------------------------------------------------------------------------------------------------
 * Tell WordPress to run kickstart_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'kickstart_setup' );

/** ------------------------------------------------------------------------------------------------------------------------
 * Add extra thumbnail support with defined sizes
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_image_size( 'ks-thumb', 218, 205, true );
	add_image_size( 'ks-gallery-thumb', 300, 300, true );
	add_image_size( 'ks-featured', 1120, 460, true );
}

/** ------------------------------------------------------------------------------------------------------------------------
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function kickstart_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kickstart_page_menu_args' );

/** ------------------------------------------------------------------------------------------------------------------------
 * Register widgetized area and update sidebar with default widgets
 */
function kickstart_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'kickstart' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Left Sidebar (3 Column Layout)', 'kickstart' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 1', 'kickstart' ),
		'id' => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 2', 'kickstart' ),
		'id' => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 3', 'kickstart' ),
		'id' => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 4', 'kickstart' ),
		'id' => 'footer-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'init', 'kickstart_widgets_init' );

if ( ! function_exists( 'kickstart_content_nav' ) ):
/** ------------------------------------------------------------------------------------------------------------------------
 * Display navigation to next/previous pages when applicable
 *
 * @since kickstart 1.0
 */
function kickstart_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>" class="group">

	<?php if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'kickstart' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'kickstart' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // kickstart_content_nav

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    //Call action that sets
    add_action('admin_head','ct_option_setup');
    //Do redirect
    header( 'Location: '.admin_url().'themes.php?page=options-framework' ) ;
}

if ( ! function_exists( 'kickstart_comment' ) ) :
/** ------------------------------------------------------------------------------------------------------------------------
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own kickstart_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since kickstart 1.0
 */
function kickstart_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="group">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'kickstart' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s', 'kickstart' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'kickstart' ), ' ' );
					?>
					<div><?php printf( __( '%s <span class="says">says:</span>', 'kickstart' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></div>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'kickstart' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kickstart' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif; // ends check for kickstart_comment()

if ( ! function_exists( 'kickstart_posted_on' ) ) :
/** ------------------------------------------------------------------------------------------------------------------------
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own kickstart_posted_on to override in a child theme
 *
 * @since kickstart 1.0
 */
function kickstart_posted_on() {
	printf( __( '<span class="entry-date">%4$s</span>', 'kickstart' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'kickstart' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

function remove_footer_admin () {
echo 'Of course, you should upgrade this theme <a href="http://inspectelement.com/wordpress-themes/origin-responsive-magazineblog-wordpress-theme/">here</a>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

/** ------------------------------------------------------------------------------------------------------------------------
 * Adds custom classes to the array of body classes.
 *
 * @since kickstart 1.0
 */
function kickstart_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'kickstart_body_classes' );

/** ------------------------------------------------------------------------------------------------------------------------
 * Returns true if a blog has more than 1 category
 *
 * @since kickstart 1.0
 */
function kickstart_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so kickstart_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so kickstart_categorized_blog should return false
		return false;
	}
}

/** ------------------------------------------------------------------------------------------------------------------------
 * Flush out the transients used in kickstart_categorized_blog
 *
 * @since kickstart 1.0
 */
function kickstart_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'kickstart_category_transient_flusher' );
add_action( 'save_post', 'kickstart_category_transient_flusher' );

add_action('init', 'portfolio_register');

/** ------------------------------------------------------------------------------------------------------------------------
 * Custom Post Types
 *
 * @since kickstart 1.0
 */
include("functions/custom-post-types.php");

/* Include custom portfolio post type in the main RSS feed */
function custom_feed_request( $vars ) {
 if (isset($vars['feed']) && !isset($vars['post_type']))
  $vars['post_type'] = array( 'portfolio' );
 return $vars;
}
add_filter( 'request', 'custom_feed_request' );

/** ------------------------------------------------------------------------------------------------------------------------
 * Shortcodes and Widgets
 *
 * @since kickstart 1.0
 */

include("functions/shortcodes.php");
include("functions/widget-category.php");
include("functions/widget-tweets.php");
include("functions/widget-flickr.php");
include("functions/widget-popular.php");
include("functions/widget-social.php");

// add editor the privilege to edit theme

// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );

/** ------------------------------------------------------------------------------------------------------------------------
 * Theme Options
 *
 * @since kickstart 1.0
 */
include("functions/gallery.php");

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>


<?php
}

function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'id' => 'upgrade', // link ID, defaults to a sanitized title value
		'title' => __('Upgrade'), // link title
		'href' => '/wordpress-themes/origin-responsive-magazineblog-wordpress-theme/', // name of file
		'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
