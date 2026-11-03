<?php
/**
 * The template for displaying the footer
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

$terms_url    = wpbc_get_option( 'terms_url', '#' );
$privacy_url  = wpbc_get_option( 'privacy_url', '#' );
$designer     = wpbc_get_option( 'footer_designer', 'WPBrigade' );
$copyright    = wpbc_get_option( 'footer_copyright', 'All rights reserved.' );
$disclaimer   = wpbc_get_option( 'footer_disclaimer', 'Disclaimer: All trademarks, logos, and athletic brand names are the property of their respective owners. Official race streams, event timetables, and athletic gear information are provided for informational and competitive sports training purposes.' );
?>

	<footer id="colophon" class="site-footer">
		<div class="wpbc-container footer-main-inner">
			<div class="footer-grid">
				<!-- Footer Column 1: Site Map -->
				<div class="footer-col footer-col-sitemap">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php else : ?>
						<h3 class="footer-title"><?php esc_html_e( 'Site Map', 'wpbrigade-challenge' ); ?></h3>
						<ul class="footer-menu-list">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="chevron">&#8250;</span> <?php esc_html_e( 'Home', 'wpbrigade-challenge' ); ?></a></li>
							<li><a href="#"><span class="chevron">&#8250;</span> <?php esc_html_e( 'Our Tracks', 'wpbrigade-challenge' ); ?></a></li>
							<li><a href="#"><span class="chevron">&#8250;</span> <?php esc_html_e( 'Find Events', 'wpbrigade-challenge' ); ?></a></li>
							<li><a href="#"><span class="chevron">&#8250;</span> <?php esc_html_e( 'Track Map', 'wpbrigade-challenge' ); ?></a></li>
							<li><a href="#"><span class="chevron">&#8250;</span> <?php esc_html_e( 'About Us', 'wpbrigade-challenge' ); ?></a></li>
							<li><a href="#"><span class="chevron">&#8250;</span> <?php esc_html_e( 'Contact Us', 'wpbrigade-challenge' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>

				<!-- Footer Column 2: Important Links -->
				<div class="footer-col footer-col-links">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php else : ?>
						<h3 class="footer-title"><?php esc_html_e( 'Important Links', 'wpbrigade-challenge' ); ?></h3>
						<ul class="footer-menu-list">
							<li><a href="https://logicpress.pro" target="_blank" rel="noopener"><span class="chevron">&#8250;</span> www.logicpress.pro</a></li>
							<li><a href="https://wpbrigade.com" target="_blank" rel="noopener"><span class="chevron">&#8250;</span> www.wpbrigade.com</a></li>
							<li><a href="https://simplesocialbuttons.com" target="_blank" rel="noopener"><span class="chevron">&#8250;</span> www.simplesocialbuttons.com</a></li>
							<li><a href="https://wordpress.org" target="_blank" rel="noopener"><span class="chevron">&#8250;</span> www.wordpress.org</a></li>
							<li><a href="https://analytify.io" target="_blank" rel="noopener"><span class="chevron">&#8250;</span> www.analytify.io</a></li>
						</ul>
					<?php endif; ?>
				</div>

				<!-- Footer Column 3: Brand & Copyright -->
				<div class="footer-col footer-col-brand">
					<div class="footer-brand-logo">
						<span class="adidas-wordmark">adidas</span>
					</div>
					<div class="footer-legal">
						<p class="copyright-line">
							<?php
							/* Dynamic Year strictly enforced as required */
							printf(
								esc_html__( 'Copyrights © %1$s. %2$s', 'wpbrigade-challenge' ),
								esc_html( wp_date( 'Y' ) ),
								esc_html( $copyright )
							);
							?>
						</p>
						<p class="terms-privacy-links">
							<?php
							/* Rendered via wpb-link shortcode as required by Image 4 annotation */
							echo do_shortcode( sprintf(
								'[wpb-link url="%s" title="%s"] | [wpb-link url="%s" title="%s"]',
								esc_url( $terms_url ),
								esc_html__( 'Terms & Conditions', 'wpbrigade-challenge' ),
								esc_url( $privacy_url ),
								esc_html__( 'Privacy Policy', 'wpbrigade-challenge' )
							) );
							?>
						</p>
						<p class="designer-credit">
							<?php
							printf(
								esc_html__( 'Designed by: %s', 'wpbrigade-challenge' ),
								'<a href="https://wpbrigade.com" target="_blank" rel="noopener">' . esc_html( $designer ) . '</a>'
							);
							?>
						</p>
					</div>
				</div>
			</div>

			<!-- Mobile Dedicated Footer View (Image 6) -->
			<div class="mobile-footer-view">
				<nav class="mobile-footer-nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'wpbrigade-challenge' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'OUR TRACKS', 'wpbrigade-challenge' ); ?></a>
					<span class="sep">/</span>
					<a href="#"><?php esc_html_e( 'FIND EVENTS', 'wpbrigade-challenge' ); ?></a>
					<span class="sep">/</span>
					<a href="#"><?php esc_html_e( 'TRACK MAP', 'wpbrigade-challenge' ); ?></a>
					<span class="sep">/</span>
					<a href="#"><?php esc_html_e( 'SHOP', 'wpbrigade-challenge' ); ?></a>
					<span class="sep">/</span>
					<a href="#"><?php esc_html_e( 'ABOUT US', 'wpbrigade-challenge' ); ?></a>
				</nav>

				<div class="mobile-footer-social">
					<a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
					</a>
					<a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Twitter">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
					</a>
					<a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
					<a href="https://linkedin.com" target="_blank" rel="noopener" aria-label="LinkedIn">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
				</div>

				<div class="mobile-footer-copyright">
					<?php
					printf(
						esc_html__( '© Copyright %1$s adidas', 'wpbrigade-challenge' ),
						esc_html( wp_date( 'Y' ) )
					);
					?>
				</div>
			</div>
		</div>

		<!-- Footer Bottom Disclaimer Bar (Managed via Theme Options) -->
		<?php if ( ! empty( $disclaimer ) ) : ?>
		<div class="footer-disclaimer-bar">
			<div class="wpbc-container">
				<p class="disclaimer-text"><?php echo esc_html( $disclaimer ); ?></p>
			</div>
		</div>
		<?php endif; ?>
	</footer>

	<!-- Video Modal Popup (Matching Image 5) -->
	<div id="wpbc-video-modal" class="wpbc-modal-overlay" role="dialog" aria-modal="true" aria-hidden="true" style="display:none;">
		<div class="video-modal-dialog">
			<button type="button" class="video-modal-close" id="wpbc-video-close" aria-label="<?php esc_attr_e( 'Close video', 'wpbrigade-challenge' ); ?>">&times;</button>
			<div class="video-modal-body">
				<div class="video-iframe-container" id="wpbc-video-container">
					<!-- YouTube or Vimeo iframe inserted dynamically -->
				</div>
			</div>
		</div>
	</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>

