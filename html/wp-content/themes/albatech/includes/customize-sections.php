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
 * Return an array that declaration theme customize sections
 */
return array(
	'general'            => array( 'title' => esc_html__( 'General', 'fusion' ) ),
	'header'             => array( 'title' => esc_html__( 'Header', 'fusion' ) ),
	'footer'             => array( 'title' => esc_html__( 'Footer', 'fusion' ) ),
	'layout'             => array( 'title' => esc_html__( 'Layout & Styles', 'fusion' ) ),
	'typography'         => array( 'title' => esc_html__( 'Typography', 'fusion' ) ),
	'blog'               => array( 'title' => esc_html__( 'Blog', 'fusion' ) ),
	'under-construction' => array(
		'title'    => esc_html__( 'Under Construction', 'fusion' ),
		'priority' => 99
	)
);
