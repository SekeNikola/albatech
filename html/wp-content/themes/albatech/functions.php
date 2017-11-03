<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;





if ( ! function_exists( 'fusion_import_translation' ) ) {
	/**
	 * Load the translation files into the theme textdomain
	 * 
	 * @return  void
	 */
	function fusion_import_translation() {
		load_theme_textdomain( 'fusion', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'fusion_import_translation', 5 );


if ( ! function_exists( 'fusion_requirement_check' ) ):
	add_action( 'after_switch_theme', 'fusion_requirement_check', 10, 2 );

	/**
	 * Check the theme requirements
	 */
	function fusion_requirement_check( $name, $theme ) {
	    if ( version_compare( PHP_VERSION, '5.3', '<' ) ):
			add_action( 'admin_notices', 'fusion_requirement_notice' );

			function fusion_requirement_notice() {
				printf( '<div class="error"><p>%s</p></div>',
					__( 'Sorry! Your server does not meet the minimum requirements, please upgrade PHP version to 5.3 or higher', 'hnk' ) );
			}

			// Switch back to previous theme
			switch_theme( $theme->stylesheet );
		endif;
	}
endif;



if ( version_compare( PHP_VERSION, '5.3', '>=' ) ):
	// Classes
	require_once get_template_directory() . '/includes/vendor/plugin-activation.php';
	require_once get_template_directory() . '/includes/vendor/options-plus.php';

	// Functions
	require_once get_template_directory() . '/includes/plugins.php';
	require_once get_template_directory() . '/includes/assets.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/functions/helpers.php';
	require_once get_template_directory() . '/includes/functions/template.php';
	require_once get_template_directory() . '/includes/functions/visual-composer.php';
	require_once get_template_directory() . '/includes/functions/structure.php';
	require_once get_template_directory() . '/includes/functions/options-override.php';

	require_once get_template_directory() . '/includes/autoload.php';

	// Register class mapping
	Fusion_AutoLoad::map( 'Fusion_', get_template_directory() . '/includes/classes/' );
	Fusion_AutoLoad::map_class( 'Fusion', get_template_directory() . '/includes/classes/class-theme.php' );
	Fusion_AutoLoad::register();

	// Initialize the theme
	Fusion::instance();
	Fusion_Admin::instance();
endif;

function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );