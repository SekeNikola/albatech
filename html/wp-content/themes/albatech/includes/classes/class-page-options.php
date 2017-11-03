<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * @package  Fusion
 * @author   Binh Pham Thanh <binhpham@linethemes.com>
 */
class Fusion_PageOptions extends Fusion_Base
{
	protected function __construct() {
		add_action( 'admin_init', array( $this, 'register' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	public function admin_enqueue_scripts( $hook ) {
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) && current_post_type_is( 'page' ) ) {
			wp_enqueue_script( 'theme-page-options' );
		}
	}

	/**
	 * Register page options controls
	 * 
	 * @return  void
	 */
	public function register() {
		global $wp_registered_sidebars;

		$patterns = predefined_background_patterns();
		$options  = array();
		$sidebars = array();

		// Retrieve all registered sidebars
		foreach( $wp_registered_sidebars as $params )
			$sidebars[$params['id']] = $params['name'];

		/**
		 * General
		 */
		$options['layout_heading'] = array(
			'type' => 'heading',
			'section' => 'all',
			'title' => esc_html__( 'Sidebar Position', 'fusion' ),
			'description' => esc_html__( 'Select the position of sidebar that you wish to display.', 'fusion' )
		);

		$options['sidebar_layout'] = array(
			'type' => 'dropdown',
			'section' => 'all',
			'default' => 'default',
			'choices' => array(
				'default' => esc_html__( 'Default Option', 'fusion' ),
				'no-sidebar'   => esc_html__( 'No Sidebar', 'fusion' ),
				'sidebar-left'  => esc_html__( 'Left Sidebar', 'fusion' ),
				'sidebar-right'  => esc_html__( 'Right Sidebar', 'fusion' ),
			)
		);

		$options['sidebar_default'] = array(
			'type'    => 'dropdown-sidebars',
			'label'   => esc_html__( 'Custom Sidebar', 'fusion' ),
			'section' => 'all',
			'default' => op_option( 'sidebar_default' )
		);
		
		/**
		 * Page Title
		 */
		$options['pagetitle_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'Page Title', 'fusion' ),
			'description' => esc_html__( 'In this section you can turn on/off or modify style for the Page Title.', 'fusion' )
		);

		$options['enable_custom_page_header'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Enable Custom Page Title', 'fusion' ),
			'section' => 'all',
			'default' => false
		);

		$options['pagetitle_enabled'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Display Title Bar On This Page', 'fusion' ),
			'section' => 'all',
			'default' => op_option( 'pagetitle_enabled' )
		);

		$options['pagetitle_background'] = array(
			'type'     => 'background',
			'label'    => esc_html__( 'Page Header Background', 'fusion' ),
			'section'  => 'all',
			'patterns' => $patterns,
			'default'  => op_option( 'pagetitle_background' )
		);

		/**
		 * Breadcrumbs
		 */
		$options['breadcrumb_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'Breadcrumbs', 'fusion' ),
			'description' => esc_html__( 'In this section you can turn on/off or modify style for the Breadcrumbs.', 'fusion' )
		);

		$options['breadcrumb_enabled'] = array(
			'type' => 'dropdown',
			'section' => 'all',
			'default' => 'default',
			'choices' => array(
				'default' => esc_html__( 'Default Option', 'fusion' ),
				'enable'   => esc_html__( 'Enabled', 'fusion' ),
				'disable'  => esc_html__( 'Disabled', 'fusion' ),
			)
		);

		/**
		 * Header
		 */
		$options['topbar_heading'] = array(
			'type' => 'heading',
			'section' => 'all',
			'title' => esc_html__( 'Top Bar', 'fusion' ),
			'description' => esc_html__( 'Turn on/off the top bar and change it styles.', 'fusion' )
		);

		$options['topbar_enabled'] = array(
			'type' => 'dropdown',
			'section' => 'all',
			'default' => 'default',
			'choices' => array(
				'default' => esc_html__( 'Default Option', 'fusion' ),
				'enable'   => esc_html__( 'Enabled', 'fusion' ),
				'disable'  => esc_html__( 'Disabled', 'fusion' ),
			)
		);

		$options['navigator_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'Navigator', 'fusion' ),
			'description' => esc_html__( 'Just select your menu that you wish assign it to the location on the theme.', 'fusion' )
		);

		// Navigator
		$menus     = wp_get_nav_menus();
		$locations = get_registered_nav_menus();

		if ( $menus ) {
			$choices = array( 'default' => esc_html__( 'Default Option', 'fusion' ) );
			foreach ( $menus as $menu ) {
				$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
			}

			$asigned_locations = op_option( 'nav_menu_locations' );

			foreach ( $locations as $location => $description ) {
				$menu_setting_id = "nav_menu_locations[{$location}]";

				$options["menu_location_{$location}"] = array(
					'label'   => $description,
					'section' => 'all',
					'type'    => 'dropdown',
					'choices' => $choices,
					'default' => 'default'
				);
			}
		}

		$options['onepage_nav_script'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Load One Page Navigator Script', 'fusion' ),
			'section' => 'all',
			'default' => false
		);

		new \OptionsPlus\Metabox\Properties( 'page-options', array(
			'label'       => esc_html__( 'Page Options', 'fusion' ),
			'post_types'  => 'page',
			'context'     => 'normal',
			'priority'    => 'high',
			'storage_key' => '_page_options',
			'show_tabs'   => false,
			'sections'    => array(
				'all'     => array( 'title' => esc_html__( 'General', 'fusion' ) )
			),
			'options'     => $options
		) );
	}
}
