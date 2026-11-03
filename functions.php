<?php
/**
 * WPBrigade Challenge Theme Functions
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

define( 'WPBC_VERSION', '1.0.3' );
define( 'WPBC_DIR', get_template_directory() );
define( 'WPBC_URI', get_template_directory_uri() );

require_once WPBC_DIR . '/inc/theme-setup.php';
require_once WPBC_DIR . '/inc/enqueue-assets.php';
require_once WPBC_DIR . '/inc/custom-post-types.php';
require_once WPBC_DIR . '/inc/custom-meta-boxes.php';
require_once WPBC_DIR . '/inc/theme-options.php';
require_once WPBC_DIR . '/inc/widgets.php';
require_once WPBC_DIR . '/inc/template-functions.php';
require_once WPBC_DIR . '/inc/template-tags.php';
require_once WPBC_DIR . '/inc/shortcodes.php';
require_once WPBC_DIR . '/inc/ajax-handlers.php';
