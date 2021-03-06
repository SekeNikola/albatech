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
 * This class will be present the advanced settings page
 * that will allow user compose custom styles & scripts
 */
class Fusion_Advanced extends Fusion_Base
{
	/**
	 * The options container
	 * 
	 * @var  \OptionsPlus\Options\Container
	 */
	private $container;

	/**
	 * Class constructor
	 */
	protected function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_save_advanced_settings', array( $this, 'save' ) );

		$this->container = new \OptionsPlus\Options\Container( array(
			'show_tabs' => false,
			'sections' => array(
				'all' => array( 'title' => esc_html__( 'Custom CSS', 'fusion' ) )
			),
			'controls' => array(
				'custom_css_heading' => array(
					'type'        => 'heading',
					'title'       => esc_html__( 'Custom CSS', 'fusion' ),
					'section'     => 'all'
				),

				'custom_css' => array(
					'type'    => 'code',
					'mode'    => 'css',
					'section' => 'all'
				),

				'custom_js_heading' => array(
					'type'        => 'heading',
					'title'       => esc_html__( 'Custom Javascript', 'fusion' ),
					'section'     => 'all'
				),

				'custom_js' => array(
					'type'    => 'code',
					'mode'    => 'javascript',
					'section' => 'all'
				)
			)
		) );
	}

	/**
	 * Register admin menu
	 * 
	 * @return  void
	 */
	public function admin_menu() {
		add_theme_page( esc_html__( 'Advanced Settings', 'fusion' ),
						__( 'Advanced', 'fusion' ),
						'edit_theme_options', 'advanced-settings', array( $this, 'admin_page' ) );
	}

	/**
	 * Render the admin page
	 * 
	 * @return  void
	 */
	public function admin_page() {
		$this->container->bind( array(
				'custom_css' => op_option( 'custom_css' ),
				'custom_js'  => op_option( 'custom_js' )
			) );
		?>

			<div class="wrap">
				<div id="advanced-settings">
					<h2><?php esc_html_e( 'Advanced Theme Settings', 'fusion' ) ?></h2>
					<?php $this->notices() ?>

					<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ) ?>?action=save_advanced_settings">
						<?php $this->container->render( array( 'output' => true ) ) ?>

						<p class="form-actions">
							<button type="submit" id="save-options" class="button button-primary"><?php esc_html_e( 'Save Settings', 'fusion' ) ?></button>
						</p>
					</form>
				</div>
			</div>

		<?php
	}

	/**
	 * Enqueue script for sample data installation page
	 * 
	 * @return  void
	 */
	public function enqueue( $page ) {
		if ( $page == 'appearance_page_advanced-settings' ) {
			$this->container->enqueue();

			wp_enqueue_style( 'theme-settings' );
		}
	}

	/**
	 * Save form data
	 * 
	 * @return  void
	 */
	public function save() {
		$redirect_location = admin_url( 'themes.php' ) . '?page=advanced-settings';

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['op-options'] ) ) {
			foreach ( $_POST['op-options'] as $name => $value )
				set_theme_mod( $name, stripslashes_deep( $value ) );

			$redirect_location.= '&message=1';
		}

		wp_redirect( $redirect_location );
		exit;
	}

	/**
	 * Display message after save custom style and script
	 * 
	 * @return  void
	 */
	public function notices() {
		if ( isset( $_REQUEST['message'] ) && $_REQUEST['message'] ) {
			?>

				<div class="updated">
					<p><?php esc_html_e( 'Updated!', 'fusion' ); ?></p>
				</div>

			<?php
		}
	}
}
