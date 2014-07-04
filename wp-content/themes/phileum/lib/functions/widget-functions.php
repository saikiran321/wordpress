<?php
////////////////////////////////////////////////////////////////////////////////
// Sidebar Widget
////////////////////////////////////////////////////////////////////////////////
function wp_theme_widgets_init() {

    register_sidebar(array(
    'name'=>__('Tabbed Sidebar', TEMPLATE_DOMAIN),
   	'id' => 'tabbed-sidebar',
	'description' => __( 'Sidebar Tabbed widget area', TEMPLATE_DOMAIN ),
	'before_widget' => '<div class="tabbertab"><aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
	));

     register_sidebar(array(
    'name'=>__('Left Sidebar', TEMPLATE_DOMAIN),
    'id' => 'left-sidebar',
	'description' => __( 'Left sidebar widget area', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));


    register_sidebar(array(
    'name'=>__('Right Sidebar', TEMPLATE_DOMAIN),
    'id' => 'right-sidebar',
	'description' => __( 'Right sidebar widget area', TEMPLATE_DOMAIN ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	));

		register_sidebar(array(
		'name'=>__('First Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar( array(
		'name' => __('Second Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Third Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

   	register_sidebar( array(
		'name' => __('Fourth Footer Widget Area', TEMPLATE_DOMAIN),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', TEMPLATE_DOMAIN ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'wp_theme_widgets_init' );

///////////////////////////////////////////////////////////////////////////////////
////custom most commented post widget
///////////////////////////////////////////////////////////////////////////////////
class My_THEME_Most_Commented_Widget extends WP_Widget {
function My_THEME_Most_Commented_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Most Comments', array(
'description' => __('Display your most commented posts.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.
$mc_name = empty($instance['title']) ? __('Most Comments', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);

$mc_number = $instance['number'];
$mc_comment_count = $instance['commentcount'];

$unique_id = $args['widget_id'];

global $wpdb, $post;
$mostcommenteds = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $mc_number");
  echo $before_widget;
  echo $before_title . $mc_name . $after_title;
  echo "<ul class='most-commented'> ";
  foreach ($mostcommenteds as $post) {
    $post_title = htmlspecialchars(stripslashes($post->post_title));
    $comment_total = (int) $post->comment_total;
    echo "<li><a href=\"" . get_permalink() . "\">$post_title</a>";
    if($mc_comment_count == 'yes') {
    echo "<span class='total-com'>&nbsp;($comment_total)</span>";
    }
    echo "</li>";
  }
  echo "</ul> ";
  echo $after_widget;
}
function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$mc_name = $instance['title'];
$mc_number = $instance['number'];
$mc_comment_count = $instance['commentcount'];
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Name for most comment(optional):', TEMPLATE_DOMAIN);?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $mc_name;?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Total to show: ', TEMPLATE_DOMAIN);?>
<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $mc_number;?>" /></label>
</p>

<p>
<label for="<?php echo $this->get_field_id('commentcount'); ?>"><?php _e('Show comments count:', TEMPLATE_DOMAIN); ?></label>
<select id="<?php echo $this->get_field_id('commentcount'); ?>" name="<?php echo $this->get_field_name('commentcount'); ?>">
<option<?php if($mc_comment_count == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentcount'); ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option<?php if($mc_comment_count == 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('commentcount'); ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<?php
}
}
register_widget('My_THEME_Most_Commented_Widget');


///////////////////////////////////////////////////////////////////////////////////
////wordpress and buddypress recent comment widget
///////////////////////////////////////////////////////////////////////////////////
class My_THEME_Recent_Comments_Widget extends WP_Widget {
function My_THEME_Recent_Comments_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Recent Comments', array(
'description' => __('Display your recent comments with user avatar.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.
$rc_name = empty($instance['title']) ? __('Recent Comments', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);

$rc_avatar = $instance['avatar_on'];
$rc_number = $instance['number'];

$unique_id = $args['widget_id'];

global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,45) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT $rc_number";

$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
echo $before_widget;
echo $before_title . $rc_name . $after_title;
echo "<ul class='gravatar_recent_comment'>";
foreach ($comments as $comment) {
$grav_email = $comment->comment_author_email;
$grav_name = $comment->comment_author_name;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&amp;size=32";
?>
<li>
<?php if($rc_avatar == 'yes') {  ?><?php echo get_avatar( $grav_email, '32'); ?><?php } ?>

<div class="gravatar-meta">
<span class="author"><span class="aname"><?php echo strip_tags($comment->comment_author); ?></span> <?php _e('Says:', TEMPLATE_DOMAIN); ?></span>
<span class="comment"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->com_excerpt); ?>...</a></span>
</div>

</li>
<?php
}
echo "</ul> ";
echo $after_widget;
?>
<?php }

function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$rc_name = $instance['title'];
$rc_number = $instance['number'];
$rc_avatar = $instance['avatar_on'];
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Name for recent comment(optional):', TEMPLATE_DOMAIN); ?>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $rc_name; ?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('avatar_on'); ?>"><?php _e('Enable avatar?:', TEMPLATE_DOMAIN); ?></label>
<select id="<?php echo $this->get_field_id('avatar_on'); ?>" name="<?php echo $this->get_field_name('avatar_on'); ?>">
<option<?php if($rc_avatar == 'yes') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="yes"><?php _e('yes', TEMPLATE_DOMAIN); ?></option>
<option<?php if($rc_avatar == 'no') { echo " selected='selected'"; } ?> name="<?php echo $this->get_field_name('avatar_on'); ?>" value="no"><?php _e('no', TEMPLATE_DOMAIN); ?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Total to show:', TEMPLATE_DOMAIN); ?>
<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $rc_number; ?>" /></label></p>

<?php
}
}
register_widget('My_THEME_Recent_Comments_Widget');


///////////////////////////////////////////////////////////////////////////////////
//// Flickr Widget
///////////////////////////////////////////////////////////////////////////////////
class My_THEME_Flickr_Widget extends WP_Widget {
function My_THEME_Flickr_Widget() {
//Constructor
parent::WP_Widget(false, $name = TEMPLATE_DOMAIN . ' | Flickr', array(
'description' => __('Displays your latest Flickr feed.', TEMPLATE_DOMAIN)
));
}
function widget($args, $instance) {
// outputs the content of the widget
extract($args); // Make before_widget, etc available.

$fli_name = empty($instance['title']) ? __('Flickr', TEMPLATE_DOMAIN) : apply_filters('widget_title', $instance['title']);
$fli_id = $instance['id'];
$fli_number = $instance['number'];
$unique_id = $args['widget_id'];

echo $before_widget;
echo $before_title . $fli_name . $after_title; ?>
<ul id="flickr-widget">
<li>
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $fli_number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $fli_id; ?>"></script>
</li>
<li class="flickrmore"><small><a style="font-weight: normal; letter-spacing: normal; font-size: 11px;" href="http://www.flickr.com/photos/<?php echo "$fli_id"; ?>"><?php _e("More in Flickr &raquo;", TEMPLATE_DOMAIN); ?></a></small></li>
</ul>
<?php echo $after_widget; ?>
<?php }


function update($new_instance, $old_instance) {
//update and save the widget
return $new_instance;
}
function form($instance) {
// Get the options into variables, escaping html characters on the way
$fli_name = $instance['title'];
$fli_id = $instance['id'];
$fli_number = $instance['number'];
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php  _e('Flickr Name',TEMPLATE_DOMAIN); ?>:
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $fli_name; ?>" /></label></p>

<p>
<label for="<?php echo $this->get_field_id('id'); ?>"><?php  _e('Flickr ID',TEMPLATE_DOMAIN); ?>(<a target="_blank" href="http://www.idgettr.com">idGettr</a> ex: 52617155@N08):
<input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" class="widefat" value="<?php echo $fli_id; ?>" /></label></p>


<p>
<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:',TEMPLATE_DOMAIN); ?>
<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $fli_number; ?>" /></label></p>

<?php
}
}
register_widget('My_THEME_Flickr_Widget');


function theme_add_widget_style_head() {
print "<style type='text/css' media='screen'>"; ?>
 .gravatar_recent_comment li, .twitterbox li { padding:0px; font-size: 1.025em; line-height:1.5em;  }

.twitterbox span { width:100%; float:left; margin: 6px 0 0; display:block; }
.twitterbox li.followme a, li.flickrmore a { width:auto; float:left; margin: 1em 0 0; padding:0 0 0.2em;border-bottom: 1px dotted #ccc; }
.gravatar_recent_comment span.author { font-weight:bold; }
.gravatar_recent_comment img { width:32px; height:32px; float:left; margin: 0 10px 0 0; }

#flickr-widget .flickr_badge_image { background: transparent none; border: 0px none; float:left; margin: 0 5px 5px; }

#footer #flickr-widget {
width: 100% !important;
display: block;
padding: 0 !important;
}

#flickr-widget li { width:100%;margin:0px !important;padding:0px !important; }

<?php print "</style>";
}
add_action('wp_head','theme_add_widget_style_head');


?>