<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
 
 ?>
 
<style>
	#section-logo_uploader .controls { display: none; }
	#footer { position: static !important; }
	body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0 !important; }
</style>

<div style="border-bottom: 1px solid #50b8de; background: #50b8de;">
	<a href="http://inspectelement.com/wordpress-themes/origin-responsive-magazineblog-wordpress-theme/">
		<img style="margin-top: 35px; max-width: 100%; height: auto;" src="http://inspectelement.com/theme/origin/wp-content/themes/origin/images/upgrade.jpg" />
	</a>
</div>

<?php

function optionsframework_options() {	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
		
	/*
	UPGRADE!
	-------------------------------------------------------------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Upgrade!",
						"type" => "heading");
							
	$options[] = array( "name" => "UPGRADE",
						"desc" => "Thank you for downloading the free version of Origin. Please upgrade to get full access to all Theme Options for this theme.",
						"id" => "logo_uploader",
						"type" => "text");
						
		return $options;
}