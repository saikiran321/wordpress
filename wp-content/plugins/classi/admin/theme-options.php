<?php

add_action('init', 'inkthemes_options');
if (!function_exists('inkthemes_options')) {

    function inkthemes_options() {
        // VARIABLES
        $themename = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme();
        $themename = $themename['Name'];
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = cc_get_option('of_options');

        // Background Defaults
        $file_rename = array("on" => "On", "off" => "Off");
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        //Stylesheet Reader
        $alt_stylesheets = array("blue" => "blue","black" => "black","purple" => "purple", "green" => "green", "dark-green" => "dark-green", "orange" => "orange", "red" => "red", "yellow" => "yellow");
        //Listing publish mode
        $post_mode = array('pending' => 'Pending', 'publish' => 'Publish');
        //Lead capture on off
        $lead_option = array('on' => 'On', 'off' => 'Off');
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
        $imagepath = get_template_directory_uri() . '/images/';

        $options = array(array("name" => "General Settings",
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => "Upload your own logo. Optimal Size: 250px Wide by 50px Height",
                "id" => "cc_logo",
                "type" => "upload"),
            array("name" => "Custom Favicon",
                "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
                "id" => "cc_favicon",
                "type" => "upload"),
            array("name" => "Tracking Code",
                "desc" => "Paste your Google Analytics (or other) tracking code here.",
                "id" => "cc_analytics",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Background Image",
                "desc" => "Upload image to change your website background",
                "id" => "cc_bodybg",
                "std" => "",
                "type" => "upload"),
            array("name" => "Post New Ad Button",
                "desc" => "Enter your text for 'Add New Post button'. Note: Maximum 22 character allowed, otherwise the button will be break.",
                "id" => "cc_adnew",
                "std" => "",
                "type" => "text"),
            //Ad setting
            array("name" => "Ad Settings",
                "type" => "heading"),
            array("name" => "Free Ad (Only Available In Premium Version)",
                "desc" => "Set whether you want to put the Free Ad to Instantly publish or pending mode. By default Free ad submission would be in Pending Mode.",
                "id" => "sdfdsfdsfsdf",
                "std" => "",
                "class" => "trialhint",
                "type" => "select",
                "options" => $post_mode),
            array("name" => "Premium Ad (Only Available In Premium Version)",
                "desc" => "Set whether you want to put the Paid Ad to Instantly publish or pending mode. By default Paid ad submission would be in Publish Mode.",
                "id" => "dfdsfdsfd",
                "class" => "trialhint",
                "std" => "",
                "type" => "select",
                "options" => $post_mode),
            array("name" => "Currency Symbol (Only Available In Premium Version)",
                "desc" => "Set your own currency symbol.",
                "id" => "sdfdsfdsfd",
                "std" => "",
                "class" => "trialhint",
                "type" => "text"),
            array("name" => "Lead Capture Form On/Off (Only Available In Premium Version)",
                "desc" => "Check on for enabling lead capture form or check off for desabling it.",
                "id" => "sdfdsfdsfdsf",
                "std" => "on",
                "class" => "trialhint",
                "type" => "radio",
                "options" => $lead_option),
            //Styling Option
            array("name" => "Styling Options",
                "type" => "heading"),
            array("name" => "Theme Stylesheet",
                "desc" => "Choose your theme color skin.",
                "id" => "cc_altstylesheet",
                "std" => "black",
                "type" => "select",
                "options" => $alt_stylesheets),
            array("name" => "Custom CSS",
                "desc" => "Quickly add some custom CSS to your theme by adding it to this block.",
                "id" => "cc_custom_css",
                "std" => "",
                "type" => "textarea"),
            //Social Icons
            array("name" => "Social Icons",
                "type" => "heading"),
            array("name" => "Yahoo",
                "desc" => "Enter your link url for Yahoo.",
                "id" => "cc_yahoo",
                "type" => "text"),
            array("name" => "Blogger",
                "desc" => "Enter your link url for Blogger",
                "id" => "cc_blogger",
                "type" => "text"),
            array("name" => "Facebook",
                "desc" => "Enter your link url for Facebook",
                "id" => "cc_facebook",
                "type" => "text"),
            array("name" => "Twitter",
                "desc" => "Enter your link url for Twitter",
                "id" => "cc_twitter",
                "type" => "text"),
            array("name" => "Rss",
                "desc" => "Enter your link url for RSS",
                "id" => "cc_rss",
                "type" => "text"),
            array("name" => "Youtube",
                "desc" => "Enter your link url for Youtube",
                "id" => "cc_youtube",
                "type" => "text"),
            array("name" => "Google",
                "desc" => "Enter your link url for Google Plus",
                "id" => "cc_plusone",
                "type" => "text"),
            array("name" => "Pinterest",
                "desc" => "Enter your link url for Pinterest",
                "id" => "cc_pinterest",
                "type" => "text"),
            //Footer settings
            array("name" => "Footer Settings",
                "type" => "heading"),
            array("name" => "Footer Text",
                "desc" => "Enter text you want to be displayed on Footer",
                "id" => "cc_footertext",
                "std" => "",
                "type" => "text"),
            //Seo options
            array("name" => "SEO Options",
                "type" => "heading"),
            array("name" => "Meta Keywords (comma separated)",
                "desc" => "Meta keywords provide search engines with additional information about topics that appear on your site. This only applies to your home page. Keyword Limit Maximum 8",
                "id" => "cc_keyword",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Meta Description",
                "desc" => "You should use meta descriptions to provide search engines with additional information about topics that appear on your site. This only applies to your home page.Optimal Length for Search Engines, Roughly 155 Characters",
                "id" => "cc_description",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Meta Author Name",
                "desc" => "You should write the full name of the author here. This only applies to your home page.",
                "id" => "cc_author",
                "std" => "",
                "type" => "textarea")
        );
        cc_update_option('of_template', $options);
        cc_update_option('of_themename', $themename);
        cc_update_option('of_shortname', $shortname);
    }

}
?>