<?php

/* ------------------------------------------------------------------------------------------------------------------------
 * Shortcodes
 */

/* Shortcodes for buttons */
add_shortcode('button', 'button');

function button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'color'   => '',
		'action'   => '',
    ), $atts));
	
   return '<a class="button '.$color.' '.$action.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
}

/* Shortcodes for two columns */
add_shortcode('half', 'ks_half');

function ks_half( $atts, $content = null ) {
   return '<div class="half">' . do_shortcode($content) . '</div>';
}

/* Shortcode for the last column to make sure we can guarentee no margin on the right had side */
add_shortcode('half_end', 'ks_half_end');

function ks_half_end( $atts, $content = null ) {
   return '<div class="half column-end">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

/* Shortcodes for three columns */
add_shortcode('one_third', 'ks_one_third');

function ks_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}

/* Shortcode for the last column to make sure we can guarentee no margin on the right had side */
add_shortcode('one_third_end', 'ks_one_third_end');

function ks_one_third_end( $atts, $content = null ) {
   return '<div class="one_third column-end">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

/* Shortcodes for four columns */
add_shortcode('one_quarter', 'ks_one_quarter');

function ks_one_quarter( $atts, $content = null ) {
   return '<div class="one_quarter">' . do_shortcode($content) . '</div>';
}

/* Shortcode for the last column to make sure we can guarentee no margin on the right had side */
add_shortcode('one_quarter_end', 'ks_one_quarter_end');

function ks_one_quarter_end( $atts, $content = null ) {
   return '<div class="one_quarter column-end">' . do_shortcode($content) . '</div><div class="clear"></div>';
}