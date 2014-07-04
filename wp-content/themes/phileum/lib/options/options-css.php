<?php
/* options css */
?>



<?php
if( get_theme_option('body_font') == 'Choose a font' || get_theme_option('body_font') == '') { ?>
body {
font-family: 'Open Sans', sans-serif;
font-weight:400;
}
<?php } else { ?>
body { font-family: <?php echo get_theme_option('body_font'); ?> !important; }
<?php } ?>


<?php
if( get_theme_option('headline_font') == 'Choose a font' || get_theme_option('headline_font') == '') { ?>
h1,h2,h3,h4,h5,h6,.header-title,#main-navigation, #featured #featured-title, #cf .tinput, #wp-calendar caption,.flex-caption h1,#portfolio-filter li,.nivo-caption a.read-more,.form-submit #submit,.fbottom,ol.commentlist li div.comment-post-meta, .home-post span.post-category a,ul.tabbernav li a {
font-family: 'Open Sans', sans-serif;
font-weight:600;
}
<?php } else { ?>
h1,h2,h3,h4,h5,h6,.header-title,#main-navigation, #featured #featured-title, #cf .tinput, #wp-calendar caption,.flex-caption h1,#portfolio-filter li,.nivo-caption a.read-more,.form-submit #submit,.fbottom,ol.commentlist li div.comment-post-meta, .home-post span.post-category a,ul.tabbernav li a {
font-family:  <?php echo get_theme_option('headline_font'); ?> !important; }
<?php } ?>


<?php
if( get_theme_option('navigation_font') == 'Choose a font' || get_theme_option('navigation_font') == '') { ?>
#main-navigation, .sf-menu li a {
font-family: 'Open Sans', sans-serif;
font-weight:600 !important;
}
<?php } else { ?>
#main-navigation, .sf-menu li a { font-family:  <?php echo get_theme_option('navigation_font'); ?> !important; }
<?php } ?>