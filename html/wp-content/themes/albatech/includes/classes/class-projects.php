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
 * This class will implement support for the plugin Projects
 *
 * @package  Fusion
 * @author   Binh Pham Thanh <binhpham@linethemes.com>
 */
class Fusion_Projects extends Fusion_Feature
{
	/**
	 * Modify the project post type settings
	 * 
	 * @return  void
	 */
	public function post_type_args( $args ) {
		$projects_archive = get_theme_mod( 'projects_archive_page_id', null );
		$projects_archive = is_numeric( $projects_archive ) && get_post( $projects_archive )
			? get_page_uri( $projects_archive ) : true;

		$args['has_archive'] = $projects_archive;
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_permalink_base', nProjects::TYPE_NAME ),
			'with_front' => false
		);

		return $args;
	}

	/**
	 * Modify the projects category settings
	 * 
	 * @param   array  $args  Category taxonomy arguments
	 * @return  array
	 */
	public function taxonomy_category_args( $args ) {
		$theme_options = get_theme_mods();
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_category_permalink_base', 'nproject-category' )
		);

		return $args;
	}

	/**
	 * Modify the projects tag settings
	 * 
	 * @param   array  $args  Tag taxonomy arguments
	 * @return  array
	 */
	public function taxonomy_tag_args( $args ) {
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_tag_permalink_base', 'nproject-tag' )
		);

		return $args;
	}

	/**
	 * Register panel for Projects
	 * 
	 * @param   array  $sections  List of sections
	 * @return  array
	 */
	public function customize_panels( $sections ) {
		$sections[ 'projects' ] = array(
			'title'       => esc_html__( 'Projects', 'fusion' ),
			'description' => '',
			'priority'    => 9
		);

		return $sections;
	}

	/**
	 * Register section for Projects
	 * 
	 * @param   array  $sections  List of sections
	 * @return  array
	 */
	public function customize_sections( $sections ) {
		$sections[ 'projects-general' ] = array(
			'title'       => esc_html__( 'General', 'fusion' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-archive' ] = array(
			'title'       => esc_html__( 'Project Archive', 'fusion' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-single' ] = array(
			'title'       => esc_html__( 'Project Single', 'fusion' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-related' ] = array(
			'title'       => esc_html__( 'Related Projects', 'fusion' ),
			'description' => '',
			'panel'       => 'projects'
		);

		return $sections;
	}

	/**
	 * Register controls for Projects
	 * 
	 * @param   array  $controls  List of controls
	 * @return  array
	 */
	public function customize_controls( $controls ) {
		/**
		 * General section
		 */
		$controls['projects_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Permalink Base', 'fusion' ),
			'section' => 'projects-general',
			'default' => 'nproject'
		);

		$controls['projects_category_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Category Permalink Base', 'fusion' ),
			'section' => 'projects-general',
			'default' => 'nproject-category'
		);

		$controls['projects_tag_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Tag Permalink Base', 'fusion' ),
			'section' => 'projects-general',
			'default' => 'nproject-tag'
		);

		/**
		 * Archive section
		 */
		$controls['projects_archive_sidebar_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'List Sidebar Position', 'fusion' ),
			'section' => 'projects-archive',
			'choices' => array(
				'no-sidebar' => array(
					'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => esc_html__( 'No Sidebar', 'fusion' )
				),
				'sidebar-left' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => esc_html__( 'Sidebar Left', 'fusion' )
				),
				'sidebar-right' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => esc_html__( 'Sidebar Right', 'fusion' )
				)
			),
			'default' => 'sidebar-right'
		);

		$controls['projects_archive_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Project List Sidebar', 'fusion' ),
			'default' => 'sidebar-primary'
		);

		$controls['projects_archive_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'List Layout', 'fusion' ),
			'section' => 'projects-archive',
			'choices' => array(
				'grid' => array(
					'src'     => op_directory_uri() . '/assets/img/blog-grid.png',
					'tooltip' => esc_html__( 'Grid', 'fusion' )
				),
				'masonry' => array(
					'src'     => op_directory_uri() . '/assets/img/blog-masonry.png',
					'tooltip' => esc_html__( 'Masonry Grid', 'fusion' )
				),
				'grid-alt' => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
					'tooltip' => esc_html__( 'Grid Alt', 'fusion' )
				),
				'justified' => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-justify.png',
					'tooltip' => esc_html__( 'Justified Grid', 'fusion' )
				)
			),
			'default' => 'grid'
		);

		$controls['projects_grid_columns'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Grid Columns', 'fusion' ),
			'default' => 3,
			'choices' => array(
				2 => esc_html__( '2 Columns', 'fusion' ),
				3 => esc_html__( '3 Columns', 'fusion' ),
				4 => esc_html__( '4 Columns', 'fusion' ),
				5 => esc_html__( '5 Columns', 'fusion' ),
			)
		);

		$controls['projects_archive_filter'] = array(
			'type'    => 'switcher',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Show Items Filter', 'fusion' ),
			'default' => true
		);

		$controls['projects_archive_pagination_style'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'Pagination Style', 'fusion' ),
			'section' => 'projects-archive',
			'default' => 'numeric',
			'choices' => array(
				'pager' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-pager.png',
					'tooltip' => esc_html__( 'Pager', 'fusion' )
				),
				'numeric' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-numeric.png',
					'tooltip' => esc_html__( 'Numeric', 'fusion' )
				),
				'pager-numeric' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
					'tooltip' => esc_html__( 'Pager & Numeric', 'fusion' )
				),
				'loadmore' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-loadmore.png',
					'tooltip' => esc_html__( 'Ostale novosti', 'fusion' )
				)
			)
		);

		$controls['projects_posts_per_page'] = array(
			'type'     => 'spinner',
			'section'  => 'projects-archive',
			'label'    => esc_html__( 'Posts Per Page', 'fusion' ),
			'default'  => get_option( 'posts_per_page' )
		);

		/**
		 * Project Single
		 */
		$controls['projects_single_sidebar_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'Single Sidebar Position', 'fusion' ),
			'section' => 'projects-single',
			'choices' => array(
				'no-sidebar' => array(
					'src'     => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => esc_html__( 'No Sidebar', 'fusion' )
				),
				'sidebar-left' => array(
					'src'     => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => esc_html__( 'Sidebar Left', 'fusion' )
				),
				'sidebar-right' => array(
					'src'     => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => esc_html__( 'Sidebar Right', 'fusion' )
				)
			),
			'default' => 'sidebar-right'
		);

		$controls['projects_single_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Single Project Sidebar', 'fusion' ),
			'default' => 'sidebar-primary'
		);

		$controls['projects_single_gallery_type'] = array(
			'type'    => 'radio-images',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Gallery Type', 'fusion' ),
			'default' => 'list',
			'choices' => array(
				'list'   => array(
					'src'     => op_directory_uri() . '/assets/img/list.png',
					'tooltip' => esc_html__( 'List', 'fusion' )
				),
				'slider' => array(
					'src'     => op_directory_uri() . '/assets/img/slider.png',
					'tooltip' => esc_html__( 'Slider', 'fusion' )
				),
				'grid'   => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
					'tooltip' => esc_html__( 'Grid', 'fusion' )
				)
			)
		);

		$controls['projects_single_gallery_columns'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Gallery Columns', 'fusion' ),
			'default' => 3,
			'choices' => array(
				2 => esc_html__( '2 Columns', 'fusion' ),
				3 => esc_html__( '3 Columns', 'fusion' ),
				4 => esc_html__( '4 Columns', 'fusion' ),
				5 => esc_html__( '5 Columns', 'fusion' ),
			)
		);

		$controls['projects_single_content_position'] = array(
			'type'    => 'radio-images',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Content Position', 'fusion' ),
			'default' => 'left',
			'choices' => array(
				'left' => array(
					'src'     => op_directory_uri() . '/assets/img/left-content.png',
					'tooltip' => esc_html__( 'Content Left', 'fusion' )
				),
				'right' => array(
					'src'     => op_directory_uri() . '/assets/img/right-content.png',
					'tooltip' => esc_html__( 'Content Right', 'fusion' )
				),
				'fullwidth' => array(
					'src'     => op_directory_uri() . '/assets/img/full-content.png',
					'tooltip' => esc_html__( 'Content Full Width', 'fusion' )
				)
			)
		);

		$controls['projects_single_content_sticky'] = array(
			'type'    => 'switcher',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Enable Sticky Content', 'fusion' ),
			'default' => true
		);

		$controls['projects_single_navigator_enabled'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Show Single Navigator', 'fusion' ),
			'section' => 'projects-single',
			'default' => true
		);

		/**
		 * Project Related
		 */
		$controls['projects_related_box_enabled'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Show Related Projects', 'fusion' ),
			'section' => 'projects-related',
			'default' => true
		);

		$controls['projects_related_title'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Widget Title', 'fusion' ),
			'section' => 'projects-related',
			'default' => esc_html__( 'Related Projects', 'fusion' )
		);

		$controls['projects_related_type'] = array(
			'type' => 'dropdown',
			'section' => 'projects-related',
			'label' => esc_html__( 'Show Related Items Based On', 'fusion' ),
			'default' => 'tag',
			'choices' => array(
				'tag'      => esc_html__( 'Tag', 'fusion' ),
				'category' => esc_html__( 'Category', 'fusion' ),
				'random'   => esc_html__( 'Random', 'fusion' ),
				'recent'   => esc_html__( 'Recent', 'fusion' )
			)
		);

		$controls['projects_related_style'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Related Project Style', 'fusion' ),
			'default' => 'grid',
			'choices' => array(
				'grid'      => esc_html__( 'Grid', 'fusion' ),
				'masonry'   => esc_html__( 'Grid Masonry', 'fusion' ),
				'grid-alt' => esc_html__( 'Grid Alt', 'fusion' )
			)
		);

		$controls['projects_related_columns_count'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Columns Count', 'fusion' ),
			'choices' => array(
				1 => esc_html__( '1 Column', 'fusion' ),
				2 => esc_html__( '2 Columns', 'fusion' ),
				3 => esc_html__( '3 Columns', 'fusion' ),
				4 => esc_html__( '4 Columns', 'fusion' ),
				5 => esc_html__( '5 Columns', 'fusion' )
			),
			'default' => 4
		);
		
		$controls['projects_related_posts_count'] = array(
			'type'    => 'spinner',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Number Of Related Projects', 'fusion' ),
			'min'     => 1,
			'default' => 4
		);

		return $controls;
	}

	/**
	 * Override theme options for Projects
	 * 
	 * @param   array  $options  Theme options
	 * @return  array
	 */
	public function override_options( $options ) {
		if ( ! $this->enabled() || is_admin() ) return $options;

		if ( is_post_type_archive( nProjects::TYPE_NAME ) ||
			 is_tax( nProjects::TYPE_CATEGORY ) ||
			 is_tax( nProjects::TYPE_TAG ) ||
			 is_page_template( 'templates/template-projects.php' ) ) {
			$options['sidebar_layout']  = isset( $options['projects_archive_sidebar_layout'] )
				? $options['projects_archive_sidebar_layout']
				: $options['sidebar_layout'];

			$options['sidebar_default']  = isset( $options['projects_archive_sidebar'] )
				? $options['projects_archive_sidebar']
				: $options['sidebar_default'];

			$options['blog_archive_pagination_style'] = isset( $options['projects_archive_pagination_style'] )
				? $options['projects_archive_pagination_style']
				: $options['blog_archive_pagination_style'];
		}
		elseif ( is_singular( nProjects::TYPE_NAME ) ) {
			$project_settings = get_post_meta( get_the_ID(), '_project_settings', true );
			$project_settings = is_array( $project_settings ) ? $project_settings : array();

			if ( isset( $project_settings['project_settings_enabled'] ) && $project_settings['project_settings_enabled'] == true ) {
				foreach ( $project_settings as $name => $value )
					if ( isset( $options[$name] ) )
						$options[$name] = $value;
			}

			$options['sidebar_layout']  = isset( $options['projects_single_sidebar_layout'] )
				? $options['projects_single_sidebar_layout']
				: $options['sidebar_layout'];

			$options['sidebar_default']  = isset( $options['projects_single_sidebar'] )
				? $options['projects_single_sidebar']
				: $options['sidebar_default'];
		}

		return $options;
	}

	/**
	 * Return the classes for archive wrapper tag
	 * 
	 * @param   array  $classes  The archive classes
	 * @return  array
	 */
	public function archive_class( $classes ) {
		$classes[] = sprintf( 'projects-%s', op_option( 'projects_archive_layout', 'grid' ) );
		$classes[] = op_option( 'projects_archive_filter', true ) ? 'projects-has-filter' : 'projects-no-filter';

		return $classes;
	}

	/**
	 * Return the name that identify thumbnail size
	 * for project listing page
	 * 
	 * @param   string  $size  The thumbnail size name
	 * @return  string
	 */
	public function archive_thumbnail_size( $size ) {
		if ( op_option( 'projects_archive_layout', 'grid' ) == 'masonry' )
			$size = 'portfolio-medium';
		else
			$size = 'portfolio-medium-crop';

		return $size;
	}

	/**
	 * Return the number to limit items can be shown
	 * on the archive page
	 * 
	 * @param   int  $value  The number of items
	 * @return  int
	 */
	public function posts_per_page( $value ) {
		if ( is_post_type_archive( nProjects::TYPE_NAME ) ||
			 is_tax( nProjects::TYPE_CATEGORY ) ||
			 is_tax( nProjects::TYPE_TAG ) ) {

			$value = op_option( 'projects_posts_per_page', 10 );
		}

		return $value;
	}

	/**
	 * Register metabox
	 *
	 * @return  void
	 */
	public function add_metabox() {
		add_meta_box( 'projects-options', esc_html__( 'Project Settings', 'fusion' ),
			array( $this, 'display_metabox' ),
			nProjects::TYPE_NAME, 
			'normal',
			'high'
		);
	}

	/**
	 * Display the metabox that associated with an post
	 * object
	 * 
	 * @param   object  $post  The given post object
	 * @return  void
	 */
	public function display_metabox( $post ) {
		if ( nProjects_Helper::current_post_type() == nProjects::TYPE_NAME ):

			$project_settings = get_post_meta( $post->ID, '_project_settings', true );
			$project_settings = is_array( $project_settings ) ? $project_settings : array();
			
			$project_settings_container= new \OptionsPlus\Options\Container( array(
				'show_tabs' => false,
				'sections'  => array( 'all' => array( 'title', 'all' ) ),
				'controls'  => array(
					'project_settings_enabled' => array(
						'type'    => 'switcher',
						'label'   => esc_html__( 'Enable Custom Settings', 'fusion' ),
						'section' => 'all',
						'default' => false
					),

					'projects_single_gallery_type' => array(
						'type'    => 'radio-images',
						'section' => 'all',
						'label'   => esc_html__( 'Gallery Type', 'fusion' ),
						'default' => op_option( 'projects_single_gallery_type', 'list' ),
						'choices' => array(
							'list'   => array(
								'src'     => op_directory_uri() . '/assets/img/list.png',
								'tooltip' => esc_html__( 'List', 'fusion' )
							),
							'slider' => array(
								'src'     => op_directory_uri() . '/assets/img/slider.png',
								'tooltip' => esc_html__( 'Slider', 'fusion' )
							),
							'grid'   => array(
								'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
								'tooltip' => esc_html__( 'Grid', 'fusion' )
							)
						)
					),

					'projects_single_gallery_columns' => array(
						'type'    => 'dropdown',
						'section' => 'all',
						'label'   => esc_html__( 'Gallery Columns', 'fusion' ),
						'default' => op_option( 'projects_single_gallery_columns', 3 ),
						'choices' => array(
							2 => esc_html__( '2 Columns', 'fusion' ),
							3 => esc_html__( '3 Columns', 'fusion' ),
							4 => esc_html__( '4 Columns', 'fusion' ),
							5 => esc_html__( '5 Columns', 'fusion' ),
						)
					),

					'projects_single_content_position' => array(
						'type'    => 'radio-images',
						'section' => 'all',
						'label'   => esc_html__( 'Content Position', 'fusion' ),
						'default' => op_option( 'projects_single_content_position', 'fullwidth' ),
						'choices' => array(
							'left' => array(
								'src'     => op_directory_uri() . '/assets/img/left-content.png',
								'tooltip' => esc_html__( 'Content Left', 'fusion' )
							),
							'right' => array(
								'src'     => op_directory_uri() . '/assets/img/right-content.png',
								'tooltip' => esc_html__( 'Content Right', 'fusion' )
							),
							'fullwidth' => array(
								'src'     => op_directory_uri() . '/assets/img/full-content.png',
								'tooltip' => esc_html__( 'Content Full Width', 'fusion' )
							)
						)
					),

					'projects_single_content_sticky' => array(
						'type'    => 'switcher',
						'section' => 'all',
						'label'   => esc_html__( 'Enable Sticky Content', 'fusion' ),
						'default' => true
					)
				)
			) );

			$project_settings_container->bind( $project_settings );
			$project_settings_container->render();
		endif;
	}

	/**
	 * Save the settings for individual project
	 *
	 * @param   int  $post_id  The post ID
	 * @return  void
	 */
	public function save_project_settings( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || nProjects_Helper::current_post_type() != nProjects::TYPE_NAME )
			return;

		if ( isset( $_REQUEST ) && isset( $_REQUEST['op-options'] ) ) {
			$data = stripslashes_deep( $_REQUEST['op-options'] );
			$data['project_settings_enabled']       = isset( $data['project_settings_enabled'] );
			$data['projects_single_content_sticky'] = isset( $data['projects_single_content_sticky'] );

			update_post_meta( $post_id, '_project_settings', $data );
		}
	}

	/**
	 * Enqueue assets for the administrator panel
	 * 
	 * @return  void
	 */
	public function admin_enqueue_scripts( $hook ) {
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
			wp_enqueue_script( 'theme-project-settings' );
		}
	}

	/**
	 * Return the template location of the shortcode
	 * 
	 * @return  string
	 */
	public function shortcode_template() {
		return 'templates/shortcodes/projects.php';
	}

	/**
	 * Return an array that definition parameters
	 * for shortcode on Visual Composer
	 * 
	 * @param   array  $params  Shortcode parameters
	 * @return  array
	 */
	public function shortcode_parameters( $params ) {
		// General tab
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget Title', 'fusion' ),
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'fusion' ),
			'param_name'  => 'widget_title'
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Categories', 'fusion' ),
			'description' => esc_html__( 'If you want to narrow output, enter category slugs here. Note: Only listed categories will be included.', 'fusion' ),
			'param_name'  => 'categories'
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Tags', 'fusion' ),
			'description' => esc_html__( 'If you want to narrow output, enter tag slugs here. Note: Only listed tags will be included.', 'fusion' ),
			'param_name'  => 'tags'
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Display Mode', 'fusion' ),
			'param_name' => 'mode',
			'std'        => 3,
			'value'      => array(
				__( 'Grid Classic', 'fusion' )   => 'grid',
				__( 'Grid Masonry', 'fusion' )   => 'masonry',
				__( 'Grid Alt', 'fusion' ) => 'grid-alt',
				__( 'Carousel', 'fusion' )       => 'carousel'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Columns', 'fusion' ),
			'description' => esc_html__( 'The number of columns will be shown', 'fusion' ),
			'param_name'  => 'columns',
			'std'         => 3,
			'value'       => array(
				__( '1 Column', 'fusion' )  => 1,
				__( '2 Columns', 'fusion' ) => 2,
				__( '3 Columns', 'fusion' ) => 3,
				__( '4 Columns', 'fusion' ) => 4,
				__( '5 Columns', 'fusion' ) => 5,
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show Items Filter', 'fusion' ),
			'param_name' => 'filter',
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' )  => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Filter By', 'fusion' ),
			'param_name' => 'filter_by',
			'std'        => 'category',
			'value'      => array(
				__( 'Categories', 'fusion' ) => 'category',
				__( 'Tags', 'fusion' )       => 'tag'
			)
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Limit', 'fusion' ),
			'description' => esc_html__( 'The number of posts will be shown', 'fusion' ),
			'param_name'  => 'limit',
			'value'       => 9
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Offset', 'fusion' ),
			'description' => esc_html__( 'The number of posts to pass over', 'fusion' ),
			'param_name'  => 'offset',
			'value'       => 0
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Thumbnail Size', 'fusion' ),
			'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'fusion' ),
			'param_name'  => 'thumbnail_size'
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order By', 'fusion' ),
			'description' => esc_html__( 'Select how to sort retrieved posts.', 'fusion' ),
			'param_name'  => 'order',
			'std'         => 'date',
			'value'       => array(
				__( 'Date', 'fusion' )          => 'date',
				__( 'ID', 'fusion' )            => 'ID',
				__( 'Author', 'fusion' )        => 'author',
				__( 'Title', 'fusion' )         => 'title',
				__( 'Modified', 'fusion' )      => 'modified',
				__( 'Random', 'fusion' )        => 'rand',
				__( 'Comment count', 'fusion' ) => 'comment_count',
				__( 'Menu order', 'fusion' )    => 'menu_order'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order Direction', 'fusion' ),
			'description' => esc_html__( 'Designates the ascending or descending order.', 'fusion' ),
			'param_name'  => 'direction',
			'std'         => 'DESC',
			'value'       => array(
				__( 'Ascending', 'fusion' )          => 'ASC',
				__( 'Descending', 'fusion' )            => 'DESC'
			)
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'fusion' ),
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'fusion' ),
			'param_name'  => 'class'
		);

		// Carousel Options
		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Autoplay?', 'fusion' ),
			'param_name' => 'autoplay',
			'group'      => esc_html__( 'Carousel Options', 'fusion' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Stop On Hover?', 'fusion' ),
			'description' => esc_html__( 'Rewind speed in milliseconds', 'fusion' ),
			'param_name'  => 'hover_stop',
			'group'       => esc_html__( 'Carousel Options', 'fusion' ),
			'std'         => 'yes',
			'value'       => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Slider Controls', 'fusion' ),
			'param_name'  => 'controls',
			'group'       => esc_html__( 'Carousel Options', 'fusion' ),
			'std'         => 'navigation,rewind-navigation,pagination,pagination-numbers',
			'value'       => array(
				__( 'Navigation', 'fusion' )         => 'navigation',
				__( 'Rewind Navigation', 'fusion' )  => 'rewind-navigation',
				__( 'Pagination', 'fusion' )         => 'pagination',
				__( 'Pagination Numbers', 'fusion' ) => 'pagination-numbers'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Scroll Per Page?', 'fusion' ),
			'param_name' => 'scroll_page',
			'group'       => esc_html__( 'Carousel Options', 'fusion' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Allow Mouse Drag?', 'fusion' ),
			'param_name' => 'mouse_drag',
			'group'      => esc_html__( 'Carousel Options', 'fusion' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Allow Touch Drag?', 'fusion' ),
			'param_name' => 'touch_drag',
			'group'      => esc_html__( 'Carousel Options', 'fusion' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		// Speed
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Autoplay Speed', 'fusion' ),
			'description' => esc_html__( 'Autoplay speed in milliseconds', 'fusion' ),
			'param_name'  => 'autoplay_speed',
			'group'       => esc_html__( 'Speed', 'fusion' ),
			'value'       => 5000
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Slide Speed', 'fusion' ),
			'description' => esc_html__( 'Slide speed in milliseconds', 'fusion' ),
			'param_name'  => 'slide_speed',
			'group' => esc_html__( 'Speed', 'fusion' ),
			'value'       => 200
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Pagination Speed', 'fusion' ),
			'description' => esc_html__( 'Pagination speed in milliseconds', 'fusion' ),
			'param_name'  => 'pagination_speed',
			'group' => esc_html__( 'Speed', 'fusion' ),
			'value'       => 200
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Rewind Speed', 'fusion' ),
			'description' => esc_html__( 'Rewind speed in milliseconds', 'fusion' ),
			'param_name'  => 'rewind_speed',
			'group' => esc_html__( 'Speed', 'fusion' ),
			'value'       => 200
		);

		// Responsive
		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable Responsive?', 'fusion' ),
			'param_name' => 'responsive',
			'group'      => esc_html__( 'Responsive', 'fusion' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'fusion' ) => 'yes',
				__( 'No', 'fusion' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Items On Tablet', 'fusion' ),
			'description' => esc_html__( 'The maximum amount of items displayed at a time on tablet device', 'fusion' ),
			'param_name'  => 'tablet_items',
			'group'       => esc_html__( 'Responsive', 'fusion' ),
			'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
			'std'         => 2
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Items On Mobile', 'fusion' ),
			'description' => esc_html__( 'The maximum amount of items displayed at a time on mobile device', 'fusion' ),
			'param_name'  => 'mobile_items',
			'group'       => esc_html__( 'Responsive', 'fusion' ),
			'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
			'std'         => 1
		);

		$params[] = array(
			'type' => 'css_editor',
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'fusion' )
		);
		return $params;
	}

	/**
	 * Setting up the projects support
	 * 
	 * @return  void
	 */
	protected function setup() {
		/**
		 * Add template for projects shortcode
		 */
		add_filter( 'nprojects/shortcode_template', array( $this, 'shortcode_template' ) );

		add_filter( 'nprojects/shortcode_parameters', array( $this, 'shortcode_parameters' ) );

		/**
		 * Change project post type settings
		 */
		add_filter( 'nprojects/post_type_args', array( $this, 'post_type_args' ) );

		/**
		 * Change project category settings
		 */
		add_filter( 'nprojects/taxonomy_category_args', array( $this, 'taxonomy_category_args' ) );

		/**
		 * Change project tag settings
		 */
		add_filter( 'nprojects/taxonomy_tag_args', array( $this, 'taxonomy_tag_args' ) );

		/**
		 * Override the theme options
		 */
		add_filter( 'op/prepare_options', array( $this, 'override_options' ) );

		/**
		 * Register filter to adding specific classes for projects archive
		 */
		add_filter( 'projects/archive-class', array( $this, 'archive_class' ) );

		/**
		 * Return the thumbnail size name
		 */
		add_filter( 'projects/archive-thumbnail-size', array( $this, 'archive_thumbnail_size' ) );

		/**
		 * Pagination option
		 */
		add_filter( 'option_posts_per_page', array( $this, 'posts_per_page' ) );

		/**
		 * Register theme customize panels
		 */
		add_action( 'theme/customize-panels', array( $this, 'customize_panels' ) );

		/**
		 * Register theme customize sections
		 */
		add_action( 'theme/customize-sections', array( $this, 'customize_sections' ) );

		/**
		 * Register theme customize controls
		 */
		add_action( 'theme/customize-controls', array( $this, 'customize_controls' ) );

		/**
		 * Register project metabox
		 */
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );

		/**
		 * Register action for save project settings
		 */
		add_action( 'save_post', array( $this, 'save_project_settings' ) );

		/**
		 * Register action to enqueue admin assets
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Return the flag that allow to initialize
	 * this feature
	 * 
	 * @return  boolean
	 */
	protected function enabled() {
		return class_exists( 'nProjects' );
	}
}
