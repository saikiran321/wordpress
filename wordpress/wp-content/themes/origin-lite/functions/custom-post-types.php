<?php
/* ------------------------------------------------------------------------------------------------------------------------
 * Custom Post Types
 */

/* Portfolio Post Type (Disabled in this theme as it is not used) */
add_action('init', 'portfolio_register');

function portfolio_register() {
 
	$labels = array(
		'name' => _x('Portfolio', 'post type general name', 'kickstart'),
		'singular_name' => _x('Portfolio Item', 'post type singular name', 'kickstart'),
		'add_new' => _x('Add New', 'portfolio item', 'kickstart'),
		'add_new_item' => __('Add New Portfolio Item', 'kickstart'),
		'edit_item' => __('Edit Portfolio Item', 'kickstart'),
		'new_item' => __('New Portfolio Item', 'kickstart'),
		'view_item' => __('View Portfolio Item', 'kickstart'),
		'search_items' => __('Search Portfolio', 'kickstart'),
		'not_found' =>  __('Nothing found', 'kickstart'),
		'not_found_in_trash' => __('Nothing found in Trash', 'kickstart'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/portfolio.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	/* register_post_type( 'portfolio' , $args ); */
	/* Rewrite rules to clear problems related to permalinks */
	flush_rewrite_rules();
}

/* Create a taxonomy (called Skills) for the portfolio custom post type (eg. Web Design, Print Design, HTML, CSS, etc.)
Great tutorial here: http://thinkvitamin.com/code/create-your-first-wordpress-custom-post-type/ ----- */
register_taxonomy("skills", array("portfolio"), array("hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));

add_action("admin_init", "admin_init");
add_action('save_post', 'save_url');

function admin_init(){
    add_meta_box("portfolioDetails-meta", "Details", "portfolio_meta_options", "portfolio", "side", "low");
	add_meta_box("featuredDetails-meta", "Details", "featured_meta_options", "featured", "side", "low");
}

function portfolio_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $url = $custom["url"][0];
?>
<label>Link:</label> <input name="url" value="<?php echo $url; ?>" />
<?php
}

function featured_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $featured_url = $custom["featured_url"][0];
?>
<label>Link:</label> <input name="featured_url" value="<?php echo $featured_url; ?>" />
<?php
}

function save_url(){
	global $post;
	update_post_meta($post->ID, "url", $_POST["url"]);
	update_post_meta($post->ID, "featured_url", $_POST["featured_url"]);
}

/* What to display in the columns for when viewing the list of all posts in the portfolio custom post type in the admin */
add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Portfolio Title",
    "description" => "Description",
    "url" => "Link",
    "skills" => "Skills",
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "url":
      $custom = get_post_custom();
      echo $custom["url"][0];
      break;
    case "skills":
      echo get_the_term_list($post->ID, 'skills', '', ', ','');
      break;
  }
}

/* Featured custom post type */
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'featured',
		array(
			'labels' => array(
				'name' => __( 'Featured', 'kickstart' ),
				'singular_name' => __( 'Featured Item', 'kickstart' )
			),
			'public' => true,
			'has_archive' => true,
			'exclude_from_search' => true,
			'supports' => array('title','editor','excerpt','thumbnail'),
			'rewrite' => array('slug' => 'featured')
		)
	);
	flush_rewrite_rules();
}
?>