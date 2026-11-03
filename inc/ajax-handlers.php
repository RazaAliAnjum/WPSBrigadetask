<?php
/**
 * AJAX handlers for events pagination and newsletter subscription.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles AJAX pagination for events widget.
 */
function wpbc_load_events_handler() {
	check_ajax_referer( 'wpbc_ajax_nonce', 'nonce' );

	$page     = isset( $_POST['page'] ) ? absint( wp_unslash( $_POST['page'] ) ) : 1;
	$per_page = 4;

	$events = new WP_Query( array(
		'post_type'      => 'wpbc_event',
		'posts_per_page' => $per_page,
		'paged'          => $page,
		'orderby'        => 'meta_value',
		'meta_key'       => '_wpbc_event_start_date',
		'order'          => 'ASC',
	) );

	$output = '';

	if ( $events->have_posts() ) {
		$counter = ( $page - 1 ) * $per_page;
		while ( $events->have_posts() ) {
			$events->the_post();
			$counter++;
			$start_date = get_post_meta( get_the_ID(), '_wpbc_event_start_date', true );
			$start_time = get_post_meta( get_the_ID(), '_wpbc_event_start_time', true );
			$end_time   = get_post_meta( get_the_ID(), '_wpbc_event_end_time', true );
			$location   = get_post_meta( get_the_ID(), '_wpbc_event_location', true );
			$thumb      = get_the_post_thumbnail( get_the_ID(), 'wpbc-event-thumb' );

			$output .= '<div class="event-item">';
			$output .= '<span class="event-number">' . esc_html( $counter ) . '</span>';
			if ( $thumb ) {
				$output .= '<div class="event-thumb">' . $thumb . '</div>';
			}
			$output .= '<div class="event-info">';
			$output .= '<h4 class="event-title">' . esc_html( get_the_title() ) . '</h4>';
			if ( $start_date ) {
				$output .= '<span class="event-date">' . esc_html( wp_date( 'D, d M Y', strtotime( $start_date ) ) ) . '</span>';
			}
			if ( $start_time || $end_time ) {
				$time_str = '';
				if ( $start_time ) {
					$time_str .= esc_html( wp_date( 'g:i A', strtotime( $start_time ) ) );
				}
				if ( $end_time ) {
					$time_str .= ' - ' . esc_html( wp_date( 'g:i A', strtotime( $end_time ) ) );
				}
				$output .= '<span class="event-time">' . $time_str . '</span>';
			}
			if ( $location ) {
				$output .= '<span class="event-location">' . esc_html( $location ) . '</span>';
			}
			$output .= '</div></div>';
		}
		wp_reset_postdata();
	}

	wp_send_json_success( array(
		'html'      => $output,
		'max_pages' => $events->max_num_pages,
		'current'   => $page,
	) );
}
add_action( 'wp_ajax_wpbc_load_events', 'wpbc_load_events_handler' );
add_action( 'wp_ajax_nopriv_wpbc_load_events', 'wpbc_load_events_handler' );

/**
 * Handles AJAX newsletter subscriptions.
 */
function wpbc_newsletter_subscribe_handler() {
	check_ajax_referer( 'wpbc_ajax_nonce', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'wpbrigade-challenge' ) ) );
	}

	$subscribers = get_option( 'wpbc_newsletter_subscribers', array() );
	if ( in_array( $email, $subscribers, true ) ) {
		wp_send_json_error( array( 'message' => __( 'This email is already subscribed.', 'wpbrigade-challenge' ) ) );
	}

	$subscribers[] = $email;
	update_option( 'wpbc_newsletter_subscribers', $subscribers );

	wp_send_json_success( array( 'message' => __( 'Thank you for subscribing!', 'wpbrigade-challenge' ) ) );
}
add_action( 'wp_ajax_wpbc_newsletter_subscribe', 'wpbc_newsletter_subscribe_handler' );
add_action( 'wp_ajax_nopriv_wpbc_newsletter_subscribe', 'wpbc_newsletter_subscribe_handler' );

