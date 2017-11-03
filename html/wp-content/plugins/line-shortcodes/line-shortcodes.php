<?php
/**
 * WARNING: This file is part of the plugin. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Plugin Name: Shortcodes by LineThemes
 * Plugin URI:  http://linethemes.com/
 * Author:      LineThemes
 * Version:     1.0.0
 * Author URI: http://linethemes.com/
 */
defined( 'ABSPATH' ) or die();


add_action( 'init', function() {
	wp_register_script( 'line-shortcode-3rd', plugin_dir_url( __FILE__ ) . 'js/shortcodes-3rd.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'line-shortcode', plugin_dir_url( __FILE__ ) . 'js/shortcodes.js', array( 'line-shortcode-3rd' ), '1.0.0', true );

	wp_register_script( 'line-shortcode-maps-api', '//maps.google.com/maps/api/js?sensor=false&v=3.7', array(), false, true );
	wp_register_script( 'line-shortcode-maps', plugin_dir_url( __FILE__ ) . 'js/maps.js', array( 'line-shortcode-maps-api' ), '1.0.0', true );
} );


/**
 * Auto load all includable files
 */
foreach ( glob( plugin_dir_path( __FILE__ ) . '/includes/*.php' ) as $file ) {
	$filename = basename( $file );
	$tagname  = str_replace( '-', '_', pathinfo( $file, PATHINFO_FILENAME ) );

	add_shortcode( $tagname, function( $atts, $content = '' ) use( $file, $filename ) {
		wp_enqueue_script( 'line-shortcode' );

		ob_start();

		include ( $template = locate_template( 'templates/shortcodes/' . $filename ) )
			? $template : $file;

		return ob_get_clean();
	} );
}

add_action( 'plugins_loaded', function() {
	require_once __DIR__ . '/line-shortcodes-extras.php';

	if ( function_exists( 'vc_map' ) ) {
		require_once __DIR__ . '/line-shortcodes-map.php';
	}
} );

