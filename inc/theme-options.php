<?php
/**
 * Theme Options using WordPress Settings API
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'wpbc_add_theme_options_page' );

function wpbc_add_theme_options_page() {
	add_theme_page(
		__( 'Theme Options', 'wpbrigade-challenge' ),
		__( 'Theme Options', 'wpbrigade-challenge' ),
		'manage_options',
		'wpbc-theme-options',
		'wpbc_theme_options_page_html'
	);
}

add_action( 'admin_init', 'wpbc_register_settings' );

function wpbc_register_settings() {
	register_setting( 'wpbc_options_group', 'wpbc_options', 'wpbc_sanitize_options' );

	// Notification Bar Section
	add_settings_section(
		'wpbc_notification_section',
		__( 'Top Notification Bar', 'wpbrigade-challenge' ),
		'wpbc_notification_section_callback',
		'wpbc-theme-options'
	);

	add_settings_field(
		'notification_enabled',
		__( 'Enable Notification Bar', 'wpbrigade-challenge' ),
		'wpbc_checkbox_field',
		'wpbc-theme-options',
		'wpbc_notification_section',
		array( 'field' => 'notification_enabled' )
	);

	add_settings_field(
		'notification_text',
		__( 'Notification Text', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_notification_section',
		array(
			'field'       => 'notification_text',
			'placeholder' => 'LIVE RACE STREAM FROM GATOR NATIONALS IN SARASOTA, FL',
			'default'     => 'LIVE RACE STREAM FROM GATOR NATIONALS IN SARASOTA, FL',
		)
	);

	add_settings_field(
		'notification_link_text',
		__( 'Link Text', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_notification_section',
		array(
			'field'       => 'notification_link_text',
			'placeholder' => 'WATCH NOW',
			'default'     => 'WATCH NOW',
		)
	);

	add_settings_field(
		'notification_link_url',
		__( 'Link URL', 'wpbrigade-challenge' ),
		'wpbc_url_field',
		'wpbc-theme-options',
		'wpbc_notification_section',
		array(
			'field'   => 'notification_link_url',
			'default' => '#',
		)
	);

	// Hero Section
	add_settings_section(
		'wpbc_hero_section',
		__( 'Hero Slider & Video Management', 'wpbrigade-challenge' ),
		'wpbc_hero_section_callback',
		'wpbc-theme-options'
	);

	add_settings_field(
		'hero_slides',
		__( 'Hero Slider Slides (+/- Repeater)', 'wpbrigade-challenge' ),
		'wpbc_hero_slides_repeater_field',
		'wpbc-theme-options',
		'wpbc_hero_section'
	);

	add_settings_field(
		'hero_video_url',
		__( 'Default Hero Video URL (YouTube / Vimeo)', 'wpbrigade-challenge' ),
		'wpbc_url_field',
		'wpbc-theme-options',
		'wpbc_hero_section',
		array(
			'field'   => 'hero_video_url',
			'default' => 'https://youtu.be/dajLlFfc3P4?si=OAca-EA0WxEFy3M-',
		)
	);

	// Tabs Content Section
	add_settings_section(
		'wpbc_tabs_section',
		__( 'Tabbed Content Section (Match Info / Results / Schedule)', 'wpbrigade-challenge' ),
		'wpbc_tabs_section_callback',
		'wpbc-theme-options'
	);

	add_settings_field(
		'tab_match_info',
		__( 'Match Info Content', 'wpbrigade-challenge' ),
		'wpbc_textarea_field',
		'wpbc-theme-options',
		'wpbc_tabs_section',
		array( 'field' => 'tab_match_info' )
	);

	add_settings_field(
		'tab_match_results',
		__( 'Match Results Content', 'wpbrigade-challenge' ),
		'wpbc_textarea_field',
		'wpbc-theme-options',
		'wpbc_tabs_section',
		array( 'field' => 'tab_match_results' )
	);

	add_settings_field(
		'tab_match_schedule',
		__( 'Match Schedule Content', 'wpbrigade-challenge' ),
		'wpbc_textarea_field',
		'wpbc-theme-options',
		'wpbc_tabs_section',
		array( 'field' => 'tab_match_schedule' )
	);

	// Social & External Section
	add_settings_section(
		'wpbc_social_section',
		__( 'Social Media & Feeds', 'wpbrigade-challenge' ),
		'wpbc_social_section_callback',
		'wpbc-theme-options'
	);

	add_settings_field(
		'twitter_username',
		__( 'Twitter/X Username (@hiddenpearls)', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_social_section',
		array(
			'field'       => 'twitter_username',
			'placeholder' => 'hiddenpearls',
			'default'     => 'hiddenpearls',
		)
	);

	add_settings_field(
		'facebook_page_url',
		__( 'Facebook Page URL', 'wpbrigade-challenge' ),
		'wpbc_url_field',
		'wpbc-theme-options',
		'wpbc_social_section',
		array(
			'field'       => 'facebook_page_url',
			'placeholder' => 'https://www.facebook.com/adidas',
			'default'     => 'https://www.facebook.com/adidas',
		)
	);

	add_settings_field(
		'facebook_page_title',
		__( 'Facebook Page Title', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_social_section',
		array(
			'field'       => 'facebook_page_title',
			'placeholder' => 'Sports Psd',
			'default'     => 'Sports Psd',
		)
	);

	add_settings_field(
		'gravity_form_id',
		__( 'Gravity Forms Newsletter Form ID (Optional)', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_social_section',
		array(
			'field'       => 'gravity_form_id',
			'placeholder' => 'e.g. 1 (Leave empty to use native AJAX form)',
		)
	);

	// Widgets Settings Section
	add_settings_section(
		'wpbc_widgets_section',
		__( 'Widget Settings (Weather & Clock)', 'wpbrigade-challenge' ),
		'__return_null',
		'wpbc-theme-options'
	);

	add_settings_field(
		'weather_city',
		__( 'Weather City', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_widgets_section',
		array(
			'field'       => 'weather_city',
			'placeholder' => 'San Francisco',
			'default'     => 'San Francisco',
		)
	);

	add_settings_field(
		'weather_temp',
		__( 'Weather Default Temperature (e.g. 23°)', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_widgets_section',
		array(
			'field'       => 'weather_temp',
			'placeholder' => '23°',
			'default'     => '23°',
		)
	);

	add_settings_field(
		'datetime_city',
		__( 'Date & Time City Name', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_widgets_section',
		array(
			'field'       => 'datetime_city',
			'placeholder' => 'San Francisco',
			'default'     => 'San Francisco',
		)
	);

	add_settings_field(
		'datetime_timezone',
		__( 'Timezone (e.g. America/Los_Angeles or UTC+0)', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_widgets_section',
		array(
			'field'       => 'datetime_timezone',
			'placeholder' => 'America/Los_Angeles',
			'default'     => 'America/Los_Angeles',
		)
	);

	// Footer Section
	add_settings_section(
		'wpbc_footer_section',
		__( 'Footer & Disclaimer', 'wpbrigade-challenge' ),
		'wpbc_footer_section_callback',
		'wpbc-theme-options'
	);

	add_settings_field(
		'footer_disclaimer',
		__( 'Footer Disclaimer Text', 'wpbrigade-challenge' ),
		'wpbc_textarea_field',
		'wpbc-theme-options',
		'wpbc_footer_section',
		array(
			'field'   => 'footer_disclaimer',
			'default' => 'Disclaimer: Pende gōnat kogörade att dor. Gödig vivir tedöna, sprits ett pan. Nev dāhet diare refar. Pseudov hemlikt tisa; alomedjgt defas. Doli osat nivisk ynade. Tera pon jornyt negt astrogathet.',
		)
	);

	add_settings_field(
		'footer_copyright',
		__( 'Copyright Text (Year is dynamic)', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_footer_section',
		array(
			'field'       => 'footer_copyright',
			'placeholder' => 'All rights reserved.',
			'default'     => 'All rights reserved.',
		)
	);

	add_settings_field(
		'footer_designer',
		__( 'Designer Credit', 'wpbrigade-challenge' ),
		'wpbc_text_field',
		'wpbc-theme-options',
		'wpbc_footer_section',
		array(
			'field'       => 'footer_designer',
			'placeholder' => 'WPBrigade',
			'default'     => 'WPBrigade',
		)
	);

	add_settings_field(
		'terms_url',
		__( 'Terms & Conditions URL', 'wpbrigade-challenge' ),
		'wpbc_url_field',
		'wpbc-theme-options',
		'wpbc_footer_section',
		array(
			'field'   => 'terms_url',
			'default' => '#',
		)
	);

	add_settings_field(
		'privacy_url',
		__( 'Privacy Policy URL', 'wpbrigade-challenge' ),
		'wpbc_url_field',
		'wpbc-theme-options',
		'wpbc_footer_section',
		array(
			'field'   => 'privacy_url',
			'default' => '#',
		)
	);
}

function wpbc_hero_section_callback() {
	echo '<p>' . esc_html__( 'Manage the homepage Hero Slider slides using the repeater below. Add or remove slides, upload images using the WordPress media library, and provide optional video links.', 'wpbrigade-challenge' ) . '</p>';
}

function wpbc_notification_section_callback() {
	echo '<p>' . esc_html__( 'Configure the top announcement banner displayed at the very top of the website.', 'wpbrigade-challenge' ) . '</p>';
}

function wpbc_tabs_section_callback() {
	echo '<p>' . esc_html__( 'Manage the content for the 3 tabs on the homepage (Match Info, Match Results, Match Schedule). HTML allowed.', 'wpbrigade-challenge' ) . '</p>';
}

function wpbc_social_section_callback() {
	echo '<p>' . esc_html__( 'Settings for Twitter / X and Facebook feeds on the homepage.', 'wpbrigade-challenge' ) . '</p>';
}

function wpbc_footer_section_callback() {
	echo '<p>' . esc_html__( 'Settings for the footer disclaimer, copyright, and policy links.', 'wpbrigade-challenge' ) . '</p>';
}

function wpbc_get_option( $key, $default = '' ) {
	$options = get_option( 'wpbc_options', array() );
	if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
		return $options[ $key ];
	}
	return $default;
}

function wpbc_checkbox_field( $args ) {
	$field   = $args['field'];
	$options = get_option( 'wpbc_options', array() );
	$value   = isset( $options[ $field ] ) ? $options[ $field ] : '1'; // Default enabled
	printf(
		'<label><input type="checkbox" id="%1$s" name="wpbc_options[%1$s]" value="1" %2$s /> %3$s</label>',
		esc_attr( $field ),
		checked( $value, '1', false ),
		esc_html__( 'Display on frontend', 'wpbrigade-challenge' )
	);
}

function wpbc_text_field( $args ) {
	$field       = $args['field'];
	$default     = isset( $args['default'] ) ? $args['default'] : '';
	$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
	$value       = wpbc_get_option( $field, $default );
	printf(
		'<input type="text" id="%1$s" name="wpbc_options[%1$s]" value="%2$s" class="regular-text" placeholder="%3$s" />',
		esc_attr( $field ),
		esc_attr( $value ),
		esc_attr( $placeholder )
	);
}

function wpbc_url_field( $args ) {
	$field   = $args['field'];
	$default = isset( $args['default'] ) ? $args['default'] : '';
	$value   = wpbc_get_option( $field, $default );
	printf(
		'<input type="url" id="%1$s" name="wpbc_options[%1$s]" value="%2$s" class="regular-text" />',
		esc_attr( $field ),
		esc_url( $value )
	);
}

function wpbc_textarea_field( $args ) {
	$field   = $args['field'];
	$default = isset( $args['default'] ) ? $args['default'] : '';
	$value   = wpbc_get_option( $field, $default );
	printf(
		'<textarea id="%1$s" name="wpbc_options[%1$s]" rows="6" cols="70" class="large-text">%2$s</textarea>',
		esc_attr( $field ),
		esc_textarea( $value )
	);
}

function wpbc_hero_slides_repeater_field() {
	$slides = wpbc_get_option( 'hero_slides', array() );

	if ( empty( $slides ) || ! is_array( $slides ) ) {
		$default_video = wpbc_get_option( 'hero_video_url', 'https://youtu.be/dajLlFfc3P4?si=OAca-EA0WxEFy3M-' );
		$slides = array(
			array(
				'title'     => 'GET READY FOR NEW ADIDAS BANDS',
				'content'   => 'Adidas tracks all begin with a starting gate and end with a finish line, but everything in between varies from track to track. Because no two tracks are alike, this action sport keeps you on your toes wherever you are racing.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-1.jpg',
				'video_url' => $default_video,
			),
			array(
				'title'     => 'EXPLORE THE ULTIMATE SPORTS PERFORMANCE',
				'content'   => 'Pushing the limits of athletic innovation. Discover apparel, shoes, and gear engineered for maximum endurance and velocity.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-2.jpg',
				'video_url' => $default_video,
			),
			array(
				'title'     => 'CHAMPIONS CHOOSE PRECISION & POWER',
				'content'   => 'Engineered with elite athletes across the globe, providing next-generation support and grip for competitive sports.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-3.jpg',
				'video_url' => '',
			),
		);
	}
	?>
	<div class="wpbc-repeater-wrap" id="wpbc-slides-repeater">
		<div class="wpbc-repeater-items" id="wpbc-slides-list">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<div class="wpbc-repeater-item" data-index="<?php echo esc_attr( $index ); ?>">
					<div class="wpbc-repeater-header">
						<span class="wpbc-slide-number">
							<span class="dashicons dashicons-format-image"></span>
							<strong class="slide-label"><?php printf( esc_html__( 'Slide #%d', 'wpbrigade-challenge' ), $index + 1 ); ?></strong>
						</span>
						<button type="button" class="button wpbc-remove-slide-btn" title="<?php esc_attr_e( 'Remove this slide', 'wpbrigade-challenge' ); ?>">
							<span class="dashicons dashicons-trash"></span> <?php esc_html_e( 'Remove Slide', 'wpbrigade-challenge' ); ?>
						</button>
					</div>

					<div class="wpbc-repeater-body">
						<div class="wpbc-field-group wpbc-media-group">
							<label><strong><?php esc_html_e( '1. Slide Image (WordPress Media)', 'wpbrigade-challenge' ); ?></strong></label>
							<div class="wpbc-media-uploader-box">
								<div class="wpbc-media-preview">
									<img src="<?php echo esc_url( ! empty( $slide['image'] ) ? $slide['image'] : '' ); ?>" alt="" class="wpbc-slide-img-preview" style="<?php echo empty( $slide['image'] ) ? 'display:none;' : 'max-width:180px;height:auto;display:block;margin-bottom:8px;border-radius:4px;border:1px solid #ddd;'; ?>" />
								</div>
								<input type="hidden" class="wpbc-slide-img-url" name="wpbc_options[hero_slides][<?php echo esc_attr( $index ); ?>][image]" value="<?php echo esc_url( ! empty( $slide['image'] ) ? $slide['image'] : '' ); ?>" />
								<div class="wpbc-media-btns">
									<button type="button" class="button button-secondary wpbc-select-media-btn">
										<span class="dashicons dashicons-upload"></span> <?php esc_html_e( 'Select / Upload Image', 'wpbrigade-challenge' ); ?>
									</button>
									<button type="button" class="button button-link-delete wpbc-remove-media-btn" style="<?php echo empty( $slide['image'] ) ? 'display:none;' : ''; ?>">
										<?php esc_html_e( 'Clear Image', 'wpbrigade-challenge' ); ?>
									</button>
								</div>
							</div>
						</div>

						<div class="wpbc-field-group">
							<label><strong><?php esc_html_e( '2. Slide Title', 'wpbrigade-challenge' ); ?></strong></label>
							<input type="text" class="regular-text wpbc-slide-title-input" name="wpbc_options[hero_slides][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( ! empty( $slide['title'] ) ? $slide['title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Enter slide heading', 'wpbrigade-challenge' ); ?>" style="width:100%;max-width:600px;" />
						</div>

						<div class="wpbc-field-group">
							<label><strong><?php esc_html_e( '3. Slide Content / Textarea', 'wpbrigade-challenge' ); ?></strong></label>
							<textarea class="large-text wpbc-slide-content-input" rows="3" name="wpbc_options[hero_slides][<?php echo esc_attr( $index ); ?>][content]" placeholder="<?php esc_attr_e( 'Enter slide descriptive text', 'wpbrigade-challenge' ); ?>" style="width:100%;max-width:600px;"><?php echo esc_textarea( ! empty( $slide['content'] ) ? $slide['content'] : '' ); ?></textarea>
						</div>

						<div class="wpbc-field-group">
							<label><strong><?php esc_html_e( '4. Video Link (YouTube / Vimeo)', 'wpbrigade-challenge' ); ?></strong></label>
							<input type="url" class="regular-text wpbc-slide-video-input" name="wpbc_options[hero_slides][<?php echo esc_attr( $index ); ?>][video_url]" value="<?php echo esc_url( ! empty( $slide['video_url'] ) ? $slide['video_url'] : '' ); ?>" placeholder="https://youtu.be/... (Leave empty to hide video icon)" style="width:100%;max-width:600px;" />
							<p class="description"><?php esc_html_e( 'A video play button will appear on this slide if a valid video link is entered.', 'wpbrigade-challenge' ); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="wpbc-repeater-footer" style="margin-top:15px;">
			<button type="button" class="button button-primary wpbc-add-slide-btn" id="wpbc-add-slide-btn">
				<span class="dashicons dashicons-plus-alt2"></span> <?php esc_html_e( 'Add New Slide (+)', 'wpbrigade-challenge' ); ?>
			</button>
		</div>

		<!-- Hidden template for cloning via JS -->
		<script type="text/template" id="wpbc-slide-template">
			<div class="wpbc-repeater-item" data-index="{{INDEX}}">
				<div class="wpbc-repeater-header">
					<span class="wpbc-slide-number">
						<span class="dashicons dashicons-format-image"></span>
						<strong class="slide-label"><?php echo esc_html__( 'Slide #', 'wpbrigade-challenge' ); ?>{{SLIDE_NUM}}</strong>
					</span>
					<button type="button" class="button wpbc-remove-slide-btn" title="<?php esc_attr_e( 'Remove this slide', 'wpbrigade-challenge' ); ?>">
						<span class="dashicons dashicons-trash"></span> <?php esc_html_e( 'Remove Slide', 'wpbrigade-challenge' ); ?>
					</button>
				</div>
				<div class="wpbc-repeater-body">
					<div class="wpbc-field-group wpbc-media-group">
						<label><strong><?php esc_html_e( '1. Slide Image (WordPress Media)', 'wpbrigade-challenge' ); ?></strong></label>
						<div class="wpbc-media-uploader-box">
							<div class="wpbc-media-preview">
								<img src="" alt="" class="wpbc-slide-img-preview" style="display:none;max-width:180px;height:auto;margin-bottom:8px;border-radius:4px;border:1px solid #ddd;" />
							</div>
							<input type="hidden" class="wpbc-slide-img-url" name="wpbc_options[hero_slides][{{INDEX}}][image]" value="" />
							<div class="wpbc-media-btns">
								<button type="button" class="button button-secondary wpbc-select-media-btn">
									<span class="dashicons dashicons-upload"></span> <?php esc_html_e( 'Select / Upload Image', 'wpbrigade-challenge' ); ?>
								</button>
								<button type="button" class="button button-link-delete wpbc-remove-media-btn" style="display:none;">
									<?php esc_html_e( 'Clear Image', 'wpbrigade-challenge' ); ?>
								</button>
							</div>
						</div>
					</div>

					<div class="wpbc-field-group">
						<label><strong><?php esc_html_e( '2. Slide Title', 'wpbrigade-challenge' ); ?></strong></label>
						<input type="text" class="regular-text wpbc-slide-title-input" name="wpbc_options[hero_slides][{{INDEX}}][title]" value="" placeholder="<?php esc_attr_e( 'Enter slide heading', 'wpbrigade-challenge' ); ?>" style="width:100%;max-width:600px;" />
					</div>

					<div class="wpbc-field-group">
						<label><strong><?php esc_html_e( '3. Slide Content / Textarea', 'wpbrigade-challenge' ); ?></strong></label>
						<textarea class="large-text wpbc-slide-content-input" rows="3" name="wpbc_options[hero_slides][{{INDEX}}][content]" placeholder="<?php esc_attr_e( 'Enter slide descriptive text', 'wpbrigade-challenge' ); ?>" style="width:100%;max-width:600px;"></textarea>
					</div>

					<div class="wpbc-field-group">
						<label><strong><?php esc_html_e( '4. Video Link (YouTube / Vimeo)', 'wpbrigade-challenge' ); ?></strong></label>
						<input type="url" class="regular-text wpbc-slide-video-input" name="wpbc_options[hero_slides][{{INDEX}}][video_url]" value="" placeholder="https://youtu.be/... (Leave empty to hide video icon)" style="width:100%;max-width:600px;" />
						<p class="description"><?php esc_html_e( 'A video play button will appear on this slide if a valid video link is entered.', 'wpbrigade-challenge' ); ?></p>
					</div>
				</div>
			</div>
		</script>
	</div>
	<?php
}

function wpbc_sanitize_options( $input ) {
	$sanitized = array();

	$text_fields = array(
		'notification_text',
		'notification_link_text',
		'twitter_username',
		'facebook_page_title',
		'gravity_form_id',
		'weather_city',
		'weather_temp',
		'datetime_city',
		'datetime_timezone',
		'footer_copyright',
		'footer_designer',
	);

	$url_fields = array(
		'notification_link_url',
		'hero_video_url',
		'facebook_page_url',
		'terms_url',
		'privacy_url',
	);

	$textarea_fields = array(
		'tab_match_info',
		'tab_match_results',
		'tab_match_schedule',
		'footer_disclaimer',
	);

	$checkbox_fields = array( 'notification_enabled' );

	foreach ( $text_fields as $field ) {
		$sanitized[ $field ] = isset( $input[ $field ] ) ? sanitize_text_field( $input[ $field ] ) : '';
	}

	foreach ( $url_fields as $field ) {
		$sanitized[ $field ] = isset( $input[ $field ] ) ? esc_url_raw( $input[ $field ] ) : '';
	}

	foreach ( $textarea_fields as $field ) {
		$sanitized[ $field ] = isset( $input[ $field ] ) ? wp_kses_post( $input[ $field ] ) : '';
	}

	foreach ( $checkbox_fields as $field ) {
		$sanitized[ $field ] = isset( $input[ $field ] ) && '1' === $input[ $field ] ? '1' : '0';
	}

	// Sanitize Hero Slides Repeater
	if ( isset( $input['hero_slides'] ) && is_array( $input['hero_slides'] ) ) {
		$sanitized['hero_slides'] = array();
		foreach ( $input['hero_slides'] as $slide ) {
			$title   = isset( $slide['title'] ) ? sanitize_text_field( $slide['title'] ) : '';
			$image   = isset( $slide['image'] ) ? esc_url_raw( $slide['image'] ) : '';
			$content = isset( $slide['content'] ) ? sanitize_textarea_field( $slide['content'] ) : '';
			$video   = isset( $slide['video_url'] ) ? esc_url_raw( $slide['video_url'] ) : '';

			if ( ! empty( $title ) || ! empty( $image ) || ! empty( $content ) ) {
				$sanitized['hero_slides'][] = array(
					'title'     => $title,
					'image'     => $image,
					'content'   => $content,
					'video_url' => $video,
				);
			}
		}
	} else {
		$sanitized['hero_slides'] = array();
	}

	return $sanitized;
}

function wpbc_theme_options_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap wpbc-options-wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p><?php esc_html_e( 'Configure your classic theme settings below to customize homepage sections and dynamic widgets.', 'wpbrigade-challenge' ); ?></p>

		<?php settings_errors(); ?>

		<form action="options.php" method="post">
			<?php
			settings_fields( 'wpbc_options_group' );
			do_settings_sections( 'wpbc-theme-options' );
			submit_button( __( 'Save All Changes', 'wpbrigade-challenge' ) );
			?>
		</form>
	</div>
	<?php
}

