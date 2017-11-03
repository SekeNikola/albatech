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
class Fusion_Admin extends Fusion_Base
{
	public function __construct() {
		if ( is_admin() ) {
			Fusion_PostOptions::instance();
			Fusion_PageOptions::instance();

			/**
			 * Initialize theme advanced settings
			 */
			Fusion_Advanced::instance();

			/**
			 * Initialize sample data installer
			 */
			Fusion_SampleData::instance();
		}
	}
}
