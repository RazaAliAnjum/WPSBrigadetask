<?php
/**
 * Register and save custom meta boxes for Slides and Events.
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers custom meta boxes.
 */
function wpbc_register_meta_boxes() {
	add_meta_box(
		'wpbc_slide_options',
		__( 'Slide Options', 'wpbrigade-challenge' ),
		'wpbc_slide_options_callback',
		'wpbc_slide',
		'normal',
		'high'
	);

	add_meta_box(
		'wpbc_event_details',
		__( 'Event Details', 'wpbrigade-challenge' ),
		'wpbc_event_details_callback',
		'wpbc_event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wpbc_register_meta_boxes' );

/**
 * Renders slide options meta box fields.
 *
 * @param WP_Post $post Current post object.
 */
function wpbc_slide_options_callback( $post ) {
	wp_nonce_field( 'wpbc_slide_nonce_action', 'wpbc_slide_nonce' );

	$video_url = get_post_meta( $post->ID, '_wpbc_slide_video_url', true );
	$subtitle  = get_post_meta( $post->ID, '_wpbc_slide_subtitle', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="wpbc_slide_subtitle"><?php esc_html_e( 'Subtitle', 'wpbrigade-challenge' ); ?></label></th>
			<td>
				<input type="text" id="wpbc_slide_subtitle" name="wpbc_slide_subtitle"
					value="<?php echo esc_attr( $subtitle ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="wpbc_slide_video_url"><?php esc_html_e( 'Video URL', 'wpbrigade-challenge' ); ?></label></th>
			<td>
				<input type="url" id="wpbc_slide_video_url" name="wpbc_slide_video_url"
					value="<?php echo esc_url( $video_url ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'YouTube or Vimeo URL. Leave empty to hide play button.', 'wpbrigade-challenge' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Renders event details meta box fields.
 *
 * @param WP_Post $post Current post object.
 */
function wpbc_event_details_callback( $post ) {
	wp_nonce_field( 'wpbc_event_nonce_action', 'wpbc_event_nonce' );

	$start_date = get_post_meta( $post->ID, '_wpbc_event_start_date', true );
	$start_time = get_post_meta( $post->ID, '_wpbc_event_start_time', true );
	$end_date   = get_post_meta( $post->ID, '_wpbc_event_end_date', true );
	$end_time   = get_post_meta( $post->ID, '_wpbc_event_end_time', true );
	$location   = get_post_meta( $post->ID, '_wpbc_event_location', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="wpbc_event_start_date"><?php esc_html_e( 'Start Date', 'wpbrigade-challenge' ); ?></label></th>
			<td>
				<input type="date" id="wpbc_event_start_date" name="wpbc_event_start_date"
					value="<?php echo esc_attr( $start_date ); ?>" />
				<input type="time" id="wpbc_event_start_time" name="wpbc_event_start_time"
					value="<?php echo esc_attr( $start_time ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="wpbc_event_end_date"><?php esc_html_e( 'End Date', 'wpbrigade-challenge' ); ?></label></th>
			<td>
				<input type="date" id="wpbc_event_end_date" name="wpbc_event_end_date"
					value="<?php echo esc_attr( $end_date ); ?>" />
				<input type="time" id="wpbc_event_end_time" name="wpbc_event_end_time"
					value="<?php echo esc_attr( $end_time ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="wpbc_event_location"><?php esc_html_e( 'Location', 'wpbrigade-challenge' ); ?></label></th>
			<td>
				<input type="text" id="wpbc_event_location" name="wpbc_event_location"
					value="<?php echo esc_attr( $location ); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Saves custom slide meta fields.
 *
 * @param int $post_id Post ID.
 */
function wpbc_save_slide_meta( $post_id ) {
	if ( ! isset( $_POST['wpbc_slide_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wpbc_slide_nonce'] ) ), 'wpbc_slide_nonce_action' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['wpbc_slide_video_url'] ) ) {
		update_post_meta( $post_id, '_wpbc_slide_video_url', esc_url_raw( wp_unslash( $_POST['wpbc_slide_video_url'] ) ) );
	}
	if ( isset( $_POST['wpbc_slide_subtitle'] ) ) {
		update_post_meta( $post_id, '_wpbc_slide_subtitle', sanitize_text_field( wp_unslash( $_POST['wpbc_slide_subtitle'] ) ) );
	}
}
add_action( 'save_post_wpbc_slide', 'wpbc_save_slide_meta' );

/**
 * Saves custom event meta fields.
 *
 * @param int $post_id Post ID.
 */
function wpbc_save_event_meta( $post_id ) {
	if ( ! isset( $_POST['wpbc_event_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wpbc_event_nonce'] ) ), 'wpbc_event_nonce_action' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'wpbc_event_start_date' => '_wpbc_event_start_date',
		'wpbc_event_start_time' => '_wpbc_event_start_time',
		'wpbc_event_end_date'   => '_wpbc_event_end_date',
		'wpbc_event_end_time'   => '_wpbc_event_end_time',
		'wpbc_event_location'   => '_wpbc_event_location',
	);

	foreach ( $fields as $field => $meta_key ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
}
add_action( 'save_post_wpbc_event', 'wpbc_save_event_meta' );

