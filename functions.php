<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'fl_head', 'FLChildTheme::stylesheet' );

// enable Shortcodes in Widgets:
add_filter( 'widget_text', 'do_shortcode' );

// get_stylesheet_directory()

add_shortcode( 'speisekarte', function ( $atts ) {
	$atts   = shortcode_atts( [ 'tpl' => '' ], $atts );
	$template = $atts['tpl'];
	if (empty($template)) {
		return '';
	}
	ob_start();
	include FL_CHILD_THEME_DIR.'/speisekarte/speisekarte_'.$template.'.php';
	$content = ob_get_clean();
	return $content;
} );
