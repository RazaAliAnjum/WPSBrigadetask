<?php
/**
 * Theme setup functions, navigation menus, and sidebar registrations.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function wpbc_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'wpbrigade-challenge' ),
		'secondary' => __( 'Secondary Menu', 'wpbrigade-challenge' ),
		'footer'    => __( 'Footer Menu', 'wpbrigade-challenge' ),
	) );

	add_image_size( 'wpbc-hero', 1920, 1080, true );
	add_image_size( 'wpbc-sport-thumb', 200, 200, true );
	add_image_size( 'wpbc-post-card', 400, 280, true );
	add_image_size( 'wpbc-event-thumb', 80, 80, true );
	add_image_size( 'wpbc-featured', 700, 400, true );
}
add_action( 'after_setup_theme', 'wpbc_theme_setup' );

/**
 * Registers widget areas (sidebars) for the theme.
 */
function wpbc_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Homepage Sidebar', 'wpbrigade-challenge' ),
		'id'            => 'homepage-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 1 - Site Map', 'wpbrigade-challenge' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 2 - Important Links', 'wpbrigade-challenge' ),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpbc_register_sidebars' );

