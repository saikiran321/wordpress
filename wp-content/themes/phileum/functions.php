<?php
////////////////////////////////////////////////////////////////////////////////
// Global Define
////////////////////////////////////////////////////////////////////////////////
define('TEMPLATE_DOMAIN', 'phileum'); // do not change this, its for translation and options string
define('REMOVE_UNWATED_ADD', 'yes');

////////////////////////////////////////////////////////////////////////////////
// Add Language Support
////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain( TEMPLATE_DOMAIN, get_template_directory() . '/languages' );

////////////////////////////////////////////////////////////////////////////////zz
// Additional Theme Support
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 250, true );
add_image_size( 'featured-small-thumbnail', 300, 300, true );
add_image_size( 'featured-large-thumbnail', 960, 400, true );
add_image_size( 'featured-slider-img', 1600, 400, true );
// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );
add_editor_style();


if( REMOVE_UNWATED_ADD != 'yes' ) {

$custom_background_support = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $custom_background_support );

}


// Add support for custom headers.
$custom_header_support = array(
// The default header text color.
		'default-text-color' => '',
        'default-image' => get_template_directory_uri() . '/images/header.jpg',
        'header-text'  => false,
		// The height and width of our custom header.
		'width' => 1920,
		'height' => 350,
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
	   'random-default'	=> false,
		// Callback for styling the header.
		'wp-head-callback' => '',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => '',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $custom_header_support );


if ( ! isset( $content_width ) ) $content_width = 550;
}

if ( function_exists( 'register_nav_menus' ) ) {
add_theme_support( 'menus' );
register_nav_menus( array(
'primary' => __( 'Primary Menu', TEMPLATE_DOMAIN ),
'footer' => __( 'Footer Menu', TEMPLATE_DOMAIN ),
));
function revert_wp_menu_page($args) {
global $bp;
$pages_args = array(
		'depth'      => 0,
		'echo'       => false,
		'exclude'    => '',
		'title_li'   => ''
	);
$menu = wp_page_menu( $pages_args );
$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '<ul class="sf-menu">', '</ul>' ), $menu );
echo $menu;
 ?>
<?php }

if ( !function_exists( 'wp_dtheme_page_menu_args' ) ) :
function wp_dtheme_page_menu_args( $args ) {
$args['show_home'] = true; return $args; }
add_filter( 'wp_page_menu_args', 'wp_dtheme_page_menu_args' );
endif;

}


///////////////////////////////////////////////////////////////////////////////
// Load Theme Styles and Javascripts
///////////////////////////////////////////////////////////////////////////////
/*---------------------------load styles--------------------------------------*/
if ( ! function_exists( 'theme_load_styles' ) ) :
function theme_load_styles() {
global $theme_version,$is_IE;

wp_enqueue_style( 'superfish', get_template_directory_uri(). '/lib/scripts/superfish-menu/css/superfish.css', array(), $theme_version );

wp_enqueue_style( 'tabber', get_template_directory_uri() . '/lib/scripts/tabber/tabber.css', array(), $theme_version );

if( is_singular() ):
wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/lib/scripts/fancybox/jquery.fancybox-1.3.4.css', array(), $theme_version );
endif;

if ( ( is_home() || is_page_template('template-blog.php') ) && get_theme_option('slider_on') == 'Enable'  ) {
wp_enqueue_style( 'glider-css', get_template_directory_uri(). '/lib/scripts/glider/glider.css', array(), $theme_version );
 }

/*load font awesome */
wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/scripts/fontawesome/css/font-awesome.css', array(), $theme_version );

if($is_IE):
wp_enqueue_style( 'font-awesome-ie7', get_template_directory_uri() . '/lib/scripts/fontawesome/css/font-awesome-ie7.css', array(), $theme_version );
endif;

/* load custom style */
if( file_exists( get_template_directory() . '/lib/styles/custom.css' ) ):
wp_enqueue_style( 'custom', get_template_directory_uri() . '/lib/styles/custom.css', array(), $theme_version );
endif;
?>

<style type='text/css' media='all'>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.eot');
  src: url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.eot?#iefix') format('eot'), url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.woff') format('woff'), url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.ttf') format('truetype'), url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.otf') format('opentype'), url('<?php echo get_template_directory_uri(); ?>/lib/scripts/fontawesome/font/fontawesome-webfont.svg#FontAwesome') format('svg');
  font-weight: normal;
  font-style: normal;
}
</style>

<?php
}
endif;
add_action( 'wp_enqueue_scripts', 'theme_load_styles' );

/*---------------------------load js scripts--------------------------------------*/
if ( ! function_exists( 'theme_load_scripts' ) ) :
function theme_load_scripts() {
global $theme_version;
//wp_enqueue_script("jquery");
wp_enqueue_script('hoverIntent');
//wp_enqueue_script('jquery-ui-core');

wp_enqueue_script('modernizr', get_template_directory_uri() . '/lib/scripts/modernizr/modernizr.js', array("jquery"),$theme_version );

wp_enqueue_script( 'tabber', get_template_directory_uri() . '/lib/scripts/tabber/tabber.js', array('jquery'), $theme_version );

wp_enqueue_script('superfish-js', get_template_directory_uri() . '/lib/scripts/superfish-menu/js/superfish.js', array( 'jquery' ), $theme_version );
wp_enqueue_script('supersub-js', get_template_directory_uri() . '/lib/scripts/superfish-menu/js/supersubs.js', array( 'jquery' ), $theme_version );

wp_enqueue_script('jquery-mousewheel', get_template_directory_uri() . '/lib/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js', array("jquery"), $theme_version );
wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/lib/scripts/fancybox/jquery.fancybox-1.3.4.pack.js', array("jquery"), $theme_version );


if ( ( is_home() || is_page_template('template-blog.php') ) && get_theme_option('slider_on') == 'Enable' ) {
wp_enqueue_script('mootools-js', get_template_directory_uri(). '/lib/scripts/glider/mootools.v1.11.js', array('jquery'), $theme_version );
wp_enqueue_script('jd-gallery2-js', get_template_directory_uri(). '/lib/scripts/glider/jd.gallery.v2.js', array('jquery'), $theme_version );
wp_enqueue_script('jd-gallery-set-js', get_template_directory_uri(). '/lib/scripts/glider/jd.gallery.set.js', array('jquery'), $theme_version );
wp_enqueue_script('jd-gallery-transitions-js', get_template_directory_uri(). '/lib/scripts/glider/jd.gallery.transitions.js', array('jquery'), $theme_version );
}


if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php }
endif;
add_action( 'wp_enqueue_scripts', 'theme_load_scripts' );



////////////////////////////////////////////////////////////////////////////////
// Add Theme Custom Functions
////////////////////////////////////////////////////////////////////////////////
include( get_template_directory() . '/lib/functions/theme-functions.php' );
include( get_template_directory() . '/lib/functions/option-functions.php' );
include( get_template_directory() . '/lib/functions/widget-functions.php' );
//include( get_template_directory() . '/lib/functions/custom-functions.php' );
//include( get_template_directory() . '/lib/functions/hook-functions.php' );
?>