<?php
/**
 * Custom Search Form template
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;
?>
<form role="search" method="get" class="search-form-sidebar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field-sidebar" placeholder="<?php esc_attr_e( 'Enter keyword', 'wpbrigade-challenge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
	<button type="submit" class="search-submit-sidebar"><?php esc_html_e( 'SEARCH', 'wpbrigade-challenge' ); ?></button>
</form>

