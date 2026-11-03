<?php
/**
 * Register Custom Post Types: Slides, Sports, and Events.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers custom post types for the theme.
 */
function wpbc_register_post_types() {
	register_post_type( 'wpbc_slide', array(
		'labels' => array(
			'name'               => __( 'Slides', 'wpbrigade-challenge' ),
			'singular_name'      => __( 'Slide', 'wpbrigade-challenge' ),
			'add_new'            => __( 'Add Slide', 'wpbrigade-challenge' ),
			'add_new_item'       => __( 'Add New Slide', 'wpbrigade-challenge' ),
			'edit_item'          => __( 'Edit Slide', 'wpbrigade-challenge' ),
			'all_items'          => __( 'All Slides', 'wpbrigade-challenge' ),
			'search_items'       => __( 'Search Slides', 'wpbrigade-challenge' ),
			'not_found'          => __( 'No slides found', 'wpbrigade-challenge' ),
			'not_found_in_trash' => __( 'No slides found in Trash', 'wpbrigade-challenge' ),
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-images-alt2',
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => false,
	) );

	register_post_type( 'wpbc_sport', array(
		'labels' => array(
			'name'               => __( 'Sports', 'wpbrigade-challenge' ),
			'singular_name'      => __( 'Sport', 'wpbrigade-challenge' ),
			'add_new'            => __( 'Add Sport', 'wpbrigade-challenge' ),
			'add_new_item'       => __( 'Add New Sport', 'wpbrigade-challenge' ),
			'edit_item'          => __( 'Edit Sport', 'wpbrigade-challenge' ),
			'all_items'          => __( 'All Sports', 'wpbrigade-challenge' ),
			'search_items'       => __( 'Search Sports', 'wpbrigade-challenge' ),
			'not_found'          => __( 'No sports found', 'wpbrigade-challenge' ),
			'not_found_in_trash' => __( 'No sports found in Trash', 'wpbrigade-challenge' ),
		),
		'public'        => true,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-awards',
		'menu_position' => 6,
		'supports'      => array( 'title', 'thumbnail' ),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'sports' ),
	) );

	register_post_type( 'wpbc_event', array(
		'labels' => array(
			'name'               => __( 'Events', 'wpbrigade-challenge' ),
			'singular_name'      => __( 'Event', 'wpbrigade-challenge' ),
			'add_new'            => __( 'Add Event', 'wpbrigade-challenge' ),
			'add_new_item'       => __( 'Add New Event', 'wpbrigade-challenge' ),
			'edit_item'          => __( 'Edit Event', 'wpbrigade-challenge' ),
			'all_items'          => __( 'All Events', 'wpbrigade-challenge' ),
			'search_items'       => __( 'Search Events', 'wpbrigade-challenge' ),
			'not_found'          => __( 'No events found', 'wpbrigade-challenge' ),
			'not_found_in_trash' => __( 'No events found in Trash', 'wpbrigade-challenge' ),
		),
		'public'        => true,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-calendar-alt',
		'menu_position' => 7,
		'supports'      => array( 'title', 'thumbnail' ),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'events' ),
	) );
}
add_action( 'init', 'wpbc_register_post_types' );

