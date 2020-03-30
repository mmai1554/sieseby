<?php
/**
 * Define Constants
 */
define( 'CHILD_THEME_MAINETCARE_THEME_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-theme-css' ), CHILD_THEME_MAINETCARE_THEME_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
// enable Shortcodes in Widgets:
add_filter( 'widget_text', 'do_shortcode' );


add_shortcode( 'speisekarte', function ( $atts ) {
	$atts   = shortcode_atts( [ 'tpl' => '' ], $atts );
	$template = $atts['tpl'];
	if (empty($template)) {
		return '';
	}
	ob_start();
	include get_stylesheet_directory_uri().'/speisekarte/speisekarte_'.$template.'.php';
	$content = ob_get_clean();
	return $content;
} );

// Load Recaptcha Script only on Page with Id
// ID = 338 -> Zimmer Reservieren
add_action( 'wp_enqueue_scripts', function () {
	$load_scripts = false;
	if ( is_singular() ) {
		$post = get_post();
		if ( in_array($post->ID , [338, 1648]) ) {
			$load_scripts = true;
		}
	}
	if ( ! $load_scripts ) {
		wp_dequeue_script( 'contact-form-7' );
		wp_dequeue_script( 'google-recaptcha' );
		wp_dequeue_style( 'contact-form-7' );
	}
}, 99 );
