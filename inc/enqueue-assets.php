<?php
/**
 * Enqueue scripts and styles for frontend and WordPress admin.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles on the front end.
 */
function wpbc_enqueue_assets() {
	// Google Fonts for sharp athletic typography (Oswald + Montserrat)
	wp_enqueue_style(
		'wpbc-google-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Oswald:wght@500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'wpbc-theme-style',
		get_stylesheet_uri(),
		array(),
		WPBC_VERSION
	);

	wp_enqueue_style(
		'wpbc-main',
		WPBC_URI . '/assets/css/main.css',
		array(),
		WPBC_VERSION
	);

	wp_enqueue_style(
		'wpbc-responsive',
		WPBC_URI . '/assets/css/responsive.css',
		array( 'wpbc-main' ),
		WPBC_VERSION
	);

	wp_enqueue_script(
		'wpbc-theme',
		WPBC_URI . '/assets/js/theme.js',
		array(),
		WPBC_VERSION,
		true
	);

	wp_localize_script( 'wpbc-theme', 'wpbcData', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'wpbc_ajax_nonce' ),
		'homeUrl' => home_url( '/' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'wpbc_enqueue_assets' );

/**
 * Enqueue media uploader and styles on the Theme Options admin page.
 *
 * @param string $hook The current admin page.
 */
function wpbc_admin_assets( $hook ) {
	if ( 'appearance_page_wpbc-theme-options' !== $hook ) {
		return;
	}

	wp_enqueue_media();

	wp_enqueue_style(
		'wpbc-admin',
		WPBC_URI . '/assets/css/admin.css',
		array(),
		WPBC_VERSION
	);

	wp_enqueue_script(
		'wpbc-admin',
		WPBC_URI . '/assets/js/admin.js',
		array( 'jquery' ),
		WPBC_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'wpbc_admin_assets' );

