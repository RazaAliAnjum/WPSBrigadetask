<?php
/**
 * Custom Theme Widgets
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Weather Widget
 */
class WPBC_Weather_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'wpbc_weather_widget',
			__( 'WPBC Weather Widget', 'wpbrigade-challenge' ),
			array( 'description' => __( 'Displays current weather and forecast.', 'wpbrigade-challenge' ) )
		);
	}

	public function widget( $args, $instance ) {
		$city = ! empty( $instance['city'] ) ? $instance['city'] : wpbc_get_option( 'weather_city', 'San Francisco' );
		$temp = ! empty( $instance['temp'] ) ? $instance['temp'] : wpbc_get_option( 'weather_temp', '23°' );

		echo $args['before_widget'];
		?>
		<div class="wpbc-weather-widget">
			<div class="wpbc-widget-header">
				<h3 class="widget-title"><?php echo esc_html( ! empty( $instance['title'] ) ? $instance['title'] : __( 'Weather', 'wpbrigade-challenge' ) ); ?></h3>
			</div>
			<div class="weather-card">
				<div class="weather-main-row">
					<div class="weather-sun-icon">
						<svg width="48" height="48" viewBox="0 0 24 24" fill="#fdb813">
							<circle cx="12" cy="12" r="5" />
							<path stroke="#fdb813" stroke-width="2" stroke-linecap="round" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
						</svg>
					</div>
					<div class="weather-city-time">
						<span class="weather-day-time"><span class="weather-day">Thu 11:22</span> <span class="weather-time-val">19:30</span></span>
						<span class="weather-city-name"><?php echo esc_html( $city ); ?></span>
					</div>
				</div>
				<div class="weather-temp-row">
					<span class="weather-temp-huge"><?php echo esc_html( $temp ); ?></span>
					<div class="weather-forecast-days">
						<div class="forecast-col">
							<span class="f-day">TUE</span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="#a0c4ff"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
							<span class="f-temp">20-28°</span>
							<span class="f-stat">Clear</span>
						</div>
						<div class="forecast-col">
							<span class="f-day">WED</span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="#e2eafc"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
							<span class="f-temp">22/15°</span>
							<span class="f-stat">Rain</span>
						</div>
						<div class="forecast-col">
							<span class="f-day">THU</span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="#edf2fb"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>
							<span class="f-temp">24/18°</span>
							<span class="f-stat">Cloudy</span>
						</div>
						<div class="forecast-col">
							<span class="f-day">FRI</span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="#fdb813"><circle cx="12" cy="12" r="5"/><path stroke="#fdb813" stroke-width="2" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
							<span class="f-temp">26/16°</span>
							<span class="f-stat">Sunny</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Weather', 'wpbrigade-challenge' );
		$city  = ! empty( $instance['city'] ) ? $instance['city'] : '';
		$temp  = ! empty( $instance['temp'] ) ? $instance['temp'] : '23°';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>"><?php esc_html_e( 'City:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'city' ) ); ?>" type="text" value="<?php echo esc_attr( $city ); ?>" placeholder="San Francisco">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'temp' ) ); ?>"><?php esc_html_e( 'Temperature:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'temp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'temp' ) ); ?>" type="text" value="<?php echo esc_attr( $temp ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['city']  = ( ! empty( $new_instance['city'] ) ) ? sanitize_text_field( $new_instance['city'] ) : '';
		$instance['temp']  = ( ! empty( $new_instance['temp'] ) ) ? sanitize_text_field( $new_instance['temp'] ) : '';
		return $instance;
	}
}

/**
 * Date & Time Widget (Configurable from backend, dynamic JS live clock)
 */
class WPBC_DateTime_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'wpbc_datetime_widget',
			__( 'WPBC Date & Time Widget', 'wpbrigade-challenge' ),
			array( 'description' => __( 'Displays real-time live date and time for configured city.', 'wpbrigade-challenge' ) )
		);
	}

	public function widget( $args, $instance ) {
		$city     = ! empty( $instance['city'] ) ? $instance['city'] : wpbc_get_option( 'datetime_city', 'San Francisco' );
		$timezone = wpbc_get_option( 'datetime_timezone', 'America/Los_Angeles' );

		echo $args['before_widget'];
		?>
		<div class="wpbc-datetime-widget" data-timezone="<?php echo esc_attr( $timezone ); ?>">
			<div class="wpbc-widget-header">
				<h3 class="widget-title"><?php echo esc_html( ! empty( $instance['title'] ) ? $instance['title'] : __( 'Date & Time', 'wpbrigade-challenge' ) ); ?></h3>
			</div>
			<div class="datetime-card">
				<div class="datetime-date-line">
					<?php echo esc_html( wp_date( 'l, d F, Y' ) ); ?>
				</div>
				<div class="datetime-time-digital" id="wpbc-live-clock">
					<?php echo esc_html( wp_date( 'H:i:s' ) ); ?>
				</div>
				<?php if ( ! empty( $city ) ) : ?>
					<div class="datetime-city-line"><?php echo esc_html( $city ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Date & Time', 'wpbrigade-challenge' );
		$city  = ! empty( $instance['city'] ) ? $instance['city'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>"><?php esc_html_e( 'City:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'city' ) ); ?>" type="text" value="<?php echo esc_attr( $city ); ?>" placeholder="San Francisco">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['city']  = ( ! empty( $new_instance['city'] ) ) ? sanitize_text_field( $new_instance['city'] ) : '';
		return $instance;
	}
}

/**
 * Newsletter Widget
 */
class WPBC_Newsletter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'wpbc_newsletter_widget',
			__( 'WPBC Newsletter Widget', 'wpbrigade-challenge' ),
			array( 'description' => __( 'Newsletter email subscription box with submit button.', 'wpbrigade-challenge' ) )
		);
	}

	public function widget( $args, $instance ) {
		$gf_id = ! empty( $instance['gf_id'] ) ? absint( $instance['gf_id'] ) : absint( wpbc_get_option( 'gravity_form_id', 0 ) );

		echo $args['before_widget'];
		?>
		<div class="wpbc-newsletter-widget">
			<div class="wpbc-widget-header">
				<h3 class="widget-title"><?php echo esc_html( ! empty( $instance['title'] ) ? $instance['title'] : __( 'Newsletter', 'wpbrigade-challenge' ) ); ?></h3>
			</div>
			<div class="newsletter-card">
				<?php
				if ( $gf_id > 0 && ( class_exists( 'GFForms' ) || shortcode_exists( 'gravityform' ) ) ) :
					echo do_shortcode( '[gravityform id="' . $gf_id . '" title="false" description="false" ajax="true"]' );
				else :
				?>
				<form class="wpbc-newsletter-form" method="post" action="#">
					<div class="newsletter-input-group">
						<input type="email" name="newsletter_email" class="newsletter-email-input" placeholder="<?php esc_attr_e( 'Enter Email', 'wpbrigade-challenge' ); ?>" required />
						<button type="submit" class="newsletter-inline-submit" aria-label="<?php esc_attr_e( 'Search/Submit', 'wpbrigade-challenge' ); ?>">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
						</button>
					</div>
					<button type="submit" class="newsletter-btn-block"><?php esc_html_e( 'Submit', 'wpbrigade-challenge' ); ?></button>
					<div class="newsletter-response" style="display:none;"></div>
				</form>
				<?php endif; ?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Newsletter', 'wpbrigade-challenge' );
		$gf_id = ! empty( $instance['gf_id'] ) ? $instance['gf_id'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gf_id' ) ); ?>"><?php esc_html_e( 'Gravity Form ID (Optional):', 'wpbrigade-challenge' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gf_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gf_id' ) ); ?>" type="number" min="0" value="<?php echo esc_attr( $gf_id ); ?>" placeholder="e.g. 1">
			<span class="description"><?php esc_html_e( 'Leave empty to use the built-in AJAX newsletter subscription form.', 'wpbrigade-challenge' ); ?></span>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['gf_id'] = ( ! empty( $new_instance['gf_id'] ) ) ? absint( $new_instance['gf_id'] ) : 0;
		return $instance;
	}
}

/**
 * Register all custom widgets
 */
add_action( 'widgets_init', 'wpbc_register_custom_widgets' );

function wpbc_register_custom_widgets() {
	register_widget( 'WPBC_Weather_Widget' );
	register_widget( 'WPBC_DateTime_Widget' );
	register_widget( 'WPBC_Newsletter_Widget' );
}

