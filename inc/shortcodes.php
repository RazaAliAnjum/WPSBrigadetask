<?php
/**
 * Custom shortcodes for the theme.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Shortcode to output a formatted HTML link.
 *
 * Usage: [wpb-link url="https://..." title="Anchor Text"]
 *
 * @param array $atts Shortcode attributes.
 * @return string Rendered link HTML.
 */
function wpbc_link_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'url'   => '#',
		'title' => '',
	), $atts, 'wpb-link' );

	return sprintf(
		'<a href="%s">%s</a>',
		esc_url( $atts['url'] ),
		esc_html( $atts['title'] )
	);
}
add_shortcode( 'wpb-link', 'wpbc_link_shortcode' );

