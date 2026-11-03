<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main error-404-main">
	<div class="wpbc-container">
		<div class="error-404-wrapper">
			<div class="error-badge">404</div>
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wpbrigade-challenge' ); ?></h1>
			<p class="error-description"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching for what you need?', 'wpbrigade-challenge' ); ?></p>
			<div class="error-search-box">
				<form role="search" method="get" class="search-form-sidebar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="search-field-sidebar" placeholder="<?php esc_attr_e( 'Enter keyword', 'wpbrigade-challenge' ); ?>" value="" name="s" required />
					<button type="submit" class="search-submit-sidebar"><?php esc_html_e( 'SEARCH', 'wpbrigade-challenge' ); ?></button>
				</form>
			</div>
			<div class="error-return-home">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wpbc-read-more-btn"><?php esc_html_e( 'RETURN TO HOME PAGE', 'wpbrigade-challenge' ); ?></a>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();

