<?php
/**
 * The header for our theme
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wpbrigade-challenge' ); ?></a>

	<?php
	// Top Notification Bar (Managed via Theme Options)
	$notif_enabled = wpbc_get_option( 'notification_enabled', '1' );
	$notif_text    = wpbc_get_option( 'notification_text', 'LIVE RACE STREAM FROM GATOR NATIONALS IN SARASOTA, FL' );
	$notif_link_t  = wpbc_get_option( 'notification_link_text', 'WATCH NOW' );
	$notif_link_u  = wpbc_get_option( 'notification_link_url', '#' );

	if ( '1' === $notif_enabled && ! empty( $notif_text ) ) :
	?>
	<div id="wpbc-top-notification" class="wpbc-top-bar">
		<div class="wpbc-container notif-inner">
			<div class="notif-content">
				<span class="notif-message"><?php echo esc_html( $notif_text ); ?></span>
				<?php if ( ! empty( $notif_link_t ) ) : ?>
					<span class="notif-divider">/</span>
					<a href="<?php echo esc_url( $notif_link_u ); ?>" class="notif-link"><?php echo esc_html( $notif_link_t ); ?></a>
				<?php endif; ?>
			</div>
			<button type="button" class="notif-close" id="wpbc-notif-close" aria-label="<?php esc_attr_e( 'Close notification', 'wpbrigade-challenge' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		</div>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<!-- Secondary Utility Nav & Header Top Bar -->
		<div class="header-top-bar">
			<div class="wpbc-container header-top-inner">
				<div class="site-branding">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
							<span class="brand-adidas-logo">
								<svg class="adidas-trefoil-svg" width="68" height="46" viewBox="0 0 100 68" fill="currentColor">
									<path d="M47.2 65.5C40 60 30 52 24 38c-3.6-8.5-4-19 3-26.5 6-6.5 16-5.5 22 2 1.4-1.9 3-3.6 4.8-5C50.2 3.6 43 .2 35 0 22-.3 10 7.8 5 19.5c-5.4 12.6-3 28 6.5 38.3 8.2 9 20 12.6 31.7 9.8 1.4-.4 2.7-.9 4-2.1z" />
									<path d="M52.8 65.5C60 60 70 52 76 38c3.6-8.5 4-19-3-26.5-6-6.5-16-5.5-22 2-1.4-1.9-3-3.6-4.8-5 3.6-4.9 10.8-8.3 18.8-8.5 13-.3 25 7.8 30 19.5 5.4 12.6 3 28-6.5 38.3-8.2 9-20 12.6-31.7 9.8-1.4-.4-2.7-.9-4-2.1z" />
									<path d="M50 8.5c-4.4 7-6 16.5-4.8 24.5 1.2 8.3 5 15.6 10.6 21.8 1.4 1.5 2.8 2.9 4.2 4.2-1.4 1.3-2.8 2.7-4.2 4.2-5.6-6.2-9.4-13.5-10.6-21.8-1.2-8 .4-17.5 4.8-24.5 2-3.2 4.8-6 8-8.4-5.4 1.5-8 5-8 8.4z" />
								</svg>
								<span class="brand-name">adidas</span>
							</span>
						</a>
					<?php endif; ?>
				</div>

				<div class="header-top-right">
					<nav class="secondary-navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'wpbrigade-challenge' ); ?>">
						<?php
						if ( has_nav_menu( 'secondary' ) ) {
							wp_nav_menu( array(
								'theme_location' => 'secondary',
								'menu_class'     => 'secondary-menu',
								'container'      => false,
								'depth'          => 1,
							) );
						} else {
							// Fallback matching design
							echo '<ul class="secondary-menu">';
							echo '<li><a href="#">' . esc_html__( 'MEMBERSHIP', 'wpbrigade-challenge' ) . '</a></li>';
							echo '<li><a href="#">' . esc_html__( 'ACCOUNT', 'wpbrigade-challenge' ) . '</a></li>';
							echo '</ul>';
						}
						?>
					</nav>

					<!-- Mobile Hamburger Toggle (Right Aligned in Mobile Header) -->
					<button class="mobile-menu-toggle" id="wpbc-mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'wpbrigade-challenge' ); ?>">
						<span class="hamburger-bar"></span>
						<span class="hamburger-bar"></span>
						<span class="hamburger-bar"></span>
					</button>
				</div>
			</div>
		</div>

		<!-- Mobile Fixed Sub-bar: 50/50 Split Membership & Account (Image 6 & 7) -->
		<div class="mobile-secondary-split-bar">
			<a href="#" class="split-tab membership-tab"><?php esc_html_e( 'MEMBERSHIP', 'wpbrigade-challenge' ); ?></a>
			<a href="#" class="split-tab account-tab"><?php esc_html_e( 'ACCOUNT', 'wpbrigade-challenge' ); ?></a>
		</div>

		<!-- Main Primary Navigation Bar for Desktop -->
		<div class="header-main-nav-bar">
			<div class="wpbc-container header-nav-inner">
				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'wpbrigade-challenge' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'primary-menu-list',
							'container'      => false,
							'walker'         => new WPBC_Walker_Nav_Menu(),
							'depth'          => 3,
						) );
					} else {
						// Full 3-level fallback menu matching Image 2 & 3
						?>
						<ul id="primary-menu" class="primary-menu-list">
							<li class="menu-item current-menu-item menu-item-has-children depth-0">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'OUR TRACKS', 'wpbrigade-challenge' ); ?></a>
								<ul class="sub-menu dropdown-level-1">
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Long Shorts', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Handle Grips', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Stickers', 'wpbrigade-challenge' ); ?></a></li>
								</ul>
							</li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'FIND EVENTS', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item menu-item-has-children depth-0">
								<a href="#"><?php esc_html_e( 'TRACK MAP', 'wpbrigade-challenge' ); ?></a>
								<ul class="sub-menu dropdown-level-1">
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Level Two', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Level Two', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item menu-item-has-children depth-1">
										<a href="#"><?php esc_html_e( 'Level Two', 'wpbrigade-challenge' ); ?><span class="submenu-arrow"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg></span></a>
										<ul class="sub-menu dropdown-level-2">
											<li class="menu-item"><a href="#"><?php esc_html_e( 'Level Three', 'wpbrigade-challenge' ); ?></a></li>
											<li class="menu-item"><a href="#"><?php esc_html_e( 'Level Three', 'wpbrigade-challenge' ); ?></a></li>
											<li class="menu-item"><a href="#"><?php esc_html_e( 'Level Three', 'wpbrigade-challenge' ); ?></a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'SHOP', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'ABOUT US', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'CONTACT US', 'wpbrigade-challenge' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</nav>

				<div class="header-search-wrap">
					<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" class="header-search-field" placeholder="<?php esc_attr_e( 'SEARCH', 'wpbrigade-challenge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="header-search-submit" aria-label="<?php esc_attr_e( 'Submit search', 'wpbrigade-challenge' ); ?>">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
						</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Mobile Navigation Panel (Expanded State - Image 7) -->
		<div id="wpbc-mobile-nav-panel" class="mobile-nav-panel" style="display: none;">
			<div class="mobile-nav-panel-inner">
				<div class="mobile-panel-search">
					<form role="search" method="get" class="mobile-search-form-bar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" class="mobile-search-input" placeholder="<?php esc_attr_e( 'SEARCH', 'wpbrigade-challenge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="mobile-search-btn" aria-label="<?php esc_attr_e( 'Search', 'wpbrigade-challenge' ); ?>">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
						</button>
					</form>
				</div>

				<nav class="mobile-panel-nav" aria-label="<?php esc_attr_e( 'Mobile Menu', 'wpbrigade-challenge' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'mobile-menu-vertical',
							'container'      => false,
							'walker'         => new WPBC_Walker_Nav_Menu(),
							'depth'          => 3,
						) );
					} else {
						// Full 3-level fallback menu matching Image 7
						?>
						<ul class="mobile-menu-vertical">
							<li class="menu-item menu-item-has-children depth-0 is-expanded">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="menu-link-badge"><?php esc_html_e( 'OUR TRACKS', 'wpbrigade-challenge' ); ?></a>
								<ul class="sub-menu dropdown-level-1">
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Long Shorts', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Handle Grips', 'wpbrigade-challenge' ); ?></a></li>
									<li class="menu-item"><a href="#"><?php esc_html_e( 'Stickers', 'wpbrigade-challenge' ); ?></a></li>
								</ul>
							</li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'FIND EVENTS', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'TRACK MAP', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'SHOP', 'wpbrigade-challenge' ); ?></a></li>
							<li class="menu-item"><a href="#"><?php esc_html_e( 'ABOUT US', 'wpbrigade-challenge' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</nav>
			</div>
		</div>
	</header>

	<!-- Optional Sub-header Banner (e.g. for Home Page title and Reebok partner logo) -->
	<?php if ( is_front_page() ) : ?>
	<div class="sub-header-banner">
		<div class="wpbc-container sub-header-inner">
			<h1 class="page-title-banner"><?php esc_html_e( 'HOME PAGE', 'wpbrigade-challenge' ); ?></h1>
			<div class="partnership-logo">
				<span class="partner-label"><?php esc_html_e( 'PARTNERED BY', 'wpbrigade-challenge' ); ?></span>
				<img src="<?php echo esc_url( WPBC_URI . '/assets/images/reebok-logo.jpg' ); ?>" alt="<?php esc_attr_e( 'Reebok', 'wpbrigade-challenge' ); ?>" class="reebok-logo-img" />
			</div>
		</div>
	</div>
	<?php endif; ?>

