<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();
?>
<div class="content-inner">
	<div class="heading-404">
		<img src="<?php echo esc_attr( trailingslashit( get_template_directory_uri() ) ) ?>assets/img/404.png" alt="404" />
	</div>
	<div class="content-404">
		<h3><?php esc_html_e( 'Nešto nije u redu!', 'fusion' ) ?></h3>
		<p><?php esc_html_e( 'Stranica koju tražite ne postoji na serveru. Pokušajte sa drugim frazama za pretragu...', 'fusion' ); ?></p>

		<?php get_search_form(); ?>

	</div>
</div>
<!-- /.content-inner -->
