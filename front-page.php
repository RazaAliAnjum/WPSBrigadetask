<?php
/**
 * The template for displaying the custom homepage
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

get_header();

$slides       = wpbc_get_slides();
$sports       = wpbc_get_sports( 10 );
$events       = wpbc_get_events( 4, 1 );
$sticky_post  = wpbc_get_featured_sticky_post();
$latest_posts = wpbc_get_latest_posts_query( 3 );

// Tabs content from Theme Options
$tab_info     = wpbc_get_option( 'tab_match_info', 'Welcome to the official 2026 Adidas National Track Championship. All racing tracks feature standardized starting gates, digital precision timing, and regulation track obstacles. Registered athletes must complete equipment inspection at least two hours prior to heat qualifiers. Follow your favorite sports teams, view lap records, and access live track statistics throughout each tournament round.' );
$tab_results  = wpbc_get_option( 'tab_match_results', 'Official results for the recent championship rounds have been validated by race officials. Top qualifying contenders have advanced to the national finals. Detailed sector times, finish placements, and athlete telemetry are available for each discipline including soccer, hockey, volleyball, and track racing.' );
$tab_schedule = wpbc_get_option( 'tab_match_schedule', 'Match schedule and upcoming fixtures will be published here. Follow the latest tournament timetables and track events across all participating clubs and regions.' );

// Social feed settings
$twitter_user = wpbc_get_option( 'twitter_username', 'hiddenpearls' );
$fb_page_url  = wpbc_get_option( 'facebook_page_url', 'https://www.facebook.com/adidas' );
$fb_title     = wpbc_get_option( 'facebook_page_title', 'Sports Psd' );
?>

<main id="primary" class="site-main front-page-main">

	<!-- ============================================================== -->
	<!-- SECTION 1: HERO SLIDER (Configurable via Slides CPT / Options) -->
	<!-- ============================================================== -->
	<section class="wpbc-hero-slider-section" aria-label="<?php esc_attr_e( 'Hero Slider', 'wpbrigade-challenge' ); ?>">
		<div class="hero-slider-wrapper" id="wpbc-hero-slider">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<div class="hero-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" data-slide-index="<?php echo esc_attr( $index ); ?>">
					<div class="slide-bg-image" style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');"></div>
					<div class="slide-overlay"></div>
					<div class="wpbc-container slide-content-container">
						<div class="slide-text-box">
							<h2 class="slide-title"><?php echo wp_kses_post( $slide['title'] ); ?></h2>
							<div class="slide-description">
								<p><?php echo esc_html( $slide['content'] ); ?></p>
							</div>
						</div>

						<?php if ( ! empty( $slide['video_url'] ) ) : ?>
							<!-- Video play button triggers popup modal (Image 4 & 5) -->
							<div class="slide-video-trigger-wrap">
								<button type="button" class="slide-video-play-btn" data-video-url="<?php echo esc_url( wpbc_get_embed_url( $slide['video_url'] ) ); ?>" aria-label="<?php esc_attr_e( 'Play Video', 'wpbrigade-challenge' ); ?>">
									<span class="play-icon-triangle"></span>
								</button>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>

			<!-- Slider Navigation Arrows -->
			<button type="button" class="slider-arrow slider-prev" id="wpbc-hero-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'wpbrigade-challenge' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
			</button>
			<button type="button" class="slider-arrow slider-next" id="wpbc-hero-next" aria-label="<?php esc_attr_e( 'Next Slide', 'wpbrigade-challenge' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
			</button>

			<!-- Slider Dots -->
			<div class="slider-dots" id="wpbc-hero-dots">
				<?php foreach ( $slides as $index => $slide ) : ?>
					<button type="button" class="dot <?php echo 0 === $index ? 'is-active' : ''; ?>" data-slide-to="<?php echo esc_attr( $index ); ?>" aria-label="<?php printf( esc_attr__( 'Slide %d', 'wpbrigade-challenge' ), $index + 1 ); ?>"></button>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============================================================== -->
	<!-- SECTION 2: SPORTS CATEGORY CAROUSEL (10 Posts CPT)            -->
	<!-- ============================================================== -->
	<section class="wpbc-sports-carousel-section" aria-label="<?php esc_attr_e( 'Sports Categories', 'wpbrigade-challenge' ); ?>">
		<div class="wpbc-container">
			<div class="sports-carousel-container">
				<button type="button" class="carousel-arrow carousel-prev" id="wpbc-sport-prev" aria-label="<?php esc_attr_e( 'Previous Sports', 'wpbrigade-challenge' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
				</button>

				<div class="sports-track-wrapper" id="wpbc-sports-track">
					<div class="sports-track">
						<?php foreach ( $sports as $sport ) : ?>
							<div class="sport-item-card">
								<div class="sport-thumb-wrap">
									<img src="<?php echo esc_url( $sport['image'] ); ?>" alt="<?php echo esc_attr( $sport['title'] ); ?>" loading="lazy" />
								</div>
								<h3 class="sport-title">
									<a href="<?php echo esc_url( $sport['link'] ); ?>"><?php echo esc_html( $sport['title'] ); ?></a>
								</h3>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<button type="button" class="carousel-arrow carousel-next" id="wpbc-sport-next" aria-label="<?php esc_attr_e( 'Next Sports', 'wpbrigade-challenge' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</button>
			</div>

			<div class="carousel-indicators" id="wpbc-sport-dots">
				<span class="indicator is-active"></span>
				<span class="indicator"></span>
				<span class="indicator"></span>
			</div>
		</div>
	</section>

	<!-- ============================================================== -->
	<!-- SECTION 3: MAIN TWO-COLUMN CONTENT AREA                        -->
	<!-- ============================================================== -->
	<div class="wpbc-main-layout-section">
		<div class="wpbc-container">
			<div class="homepage-two-col-grid">

				<!-- LEFT PRIMARY CONTENT COLUMN -->
				<div class="homepage-primary-content">

					<!-- SUBSECTION: FEATURED BANNERS (Image 2 & Image 6 - Random Sticky Post) -->
					<div class="featured-banners-section">
						<?php
						$sticky_post = wpbc_get_featured_sticky_post();
						if ( $sticky_post ) :
							$sticky_thumb = get_the_post_thumbnail_url( $sticky_post->ID, 'wpbc-featured' );
							if ( ! $sticky_thumb ) {
								$sticky_thumb = WPBC_URI . '/assets/images/post-7.jpg';
							}
							$sticky_title   = get_the_title( $sticky_post->ID );
							$sticky_excerpt = has_excerpt( $sticky_post->ID ) ? get_the_excerpt( $sticky_post->ID ) : wp_trim_words( $sticky_post->post_content, 18, '...' );
							$sticky_link    = get_permalink( $sticky_post->ID );
						else :
							$sticky_thumb   = WPBC_URI . '/assets/images/post-7.jpg';
							$sticky_title   = __( '2019 NATIONAL CHAMPIONS CROWNED AT REEBOK', 'wpbrigade-challenge' );
							$sticky_excerpt = __( 'Membership has its perks. Joining ADIDAS means you can race at your local tracks.', 'wpbrigade-challenge' );
							$sticky_link    = '#';
						endif;
						?>
						<div class="featured-post-card featured-card-1">
							<div class="featured-card-inner">
								<div class="featured-card-media">
									<img src="<?php echo esc_url( $sticky_thumb ); ?>" alt="<?php echo esc_attr( $sticky_title ); ?>" />
								</div>
								<div class="featured-card-content">
									<h3 class="featured-title"><a href="<?php echo esc_url( $sticky_link ); ?>"><?php echo esc_html( $sticky_title ); ?></a></h3>
									<p class="featured-excerpt"><?php echo esc_html( $sticky_excerpt ); ?></p>
								</div>
							</div>
						</div>

						<div class="featured-post-card featured-card-2">
							<div class="featured-card-inner">
								<div class="featured-card-media">
									<img src="<?php echo esc_url( WPBC_URI . '/assets/images/featured-bg.jpg' ); ?>" alt="<?php echo esc_attr( $sticky_title ); ?>" />
								</div>
								<div class="featured-card-content">
									<h3 class="featured-title"><a href="<?php echo esc_url( $sticky_link ); ?>"><?php echo esc_html( $sticky_title ); ?></a></h3>
									<p class="featured-excerpt"><?php echo esc_html( $sticky_excerpt ); ?></p>
								</div>
							</div>
						</div>
					</div>

					<!-- SUBSECTION: 3 LATEST POSTS -->
					<div class="latest-posts-section">
						<div class="latest-posts-grid">
							<?php
							if ( $latest_posts->have_posts() ) :
								$card_count = 0;
								while ( $latest_posts->have_posts() ) :
									$latest_posts->the_post();
									$card_count++;
									$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'wpbc-post-card' );
									if ( ! $thumb_url ) {
										$thumb_url = WPBC_URI . '/assets/images/post-' . ( ( $card_count % 3 ) + 1 ) . '.jpg';
									}
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'wpbc-post-card' ); ?>>
										<div class="post-card-thumb">
											<a href="<?php the_permalink(); ?>">
												<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" />
											</a>
										</div>
										<div class="post-card-body">
											<h4 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											<div class="post-card-excerpt">
												<?php the_excerpt(); ?>
											</div>
											<div class="post-card-footer">
												<a href="<?php the_permalink(); ?>" class="wpbc-read-more-btn"><?php esc_html_e( 'READ MORE', 'wpbrigade-challenge' ); ?></a>
											</div>
										</div>
									</article>
									<?php
								endwhile;
								wp_reset_postdata();
							else :
								// Fallback 3 posts matching design image
								for ( $i = 1; $i <= 3; $i++ ) :
									?>
									<article class="wpbc-post-card">
										<div class="post-card-thumb">
											<a href="#">
												<img src="<?php echo esc_url( WPBC_URI . '/assets/images/post-' . $i . '.jpg' ); ?>" alt="National Champions" />
											</a>
										</div>
										<div class="post-card-body">
											<h4 class="post-card-title"><a href="#"><?php esc_html_e( '2019 NATIONAL CHAMPIONS CROWNED AT REEBOK', 'wpbrigade-challenge' ); ?></a></h4>
											<div class="post-card-excerpt">
												<p><?php esc_html_e( 'Membership has its perks. Joining ADIDAS means you can race at your local tracks.', 'wpbrigade-challenge' ); ?></p>
											</div>
											<div class="post-card-footer">
												<a href="#" class="wpbc-read-more-btn"><?php esc_html_e( 'READ MORE', 'wpbrigade-challenge' ); ?></a>
											</div>
										</div>
									</article>
									<?php
								endfor;
							endif;
							?>
						</div>
					</div>

					<!-- SUBSECTION: SOCIAL FEEDS (Twitter & Facebook Page) -->
					<div class="social-feeds-row">
						<!-- Twitter Feed Column -->
						<div class="social-col twitter-col">
							<h3 class="social-block-title"><?php esc_html_e( 'Lates Tweets', 'wpbrigade-challenge' ); ?></h3>
							<div class="twitter-feed-card">
								<div class="tweet-item">
									<p><?php esc_html_e( 'Get ready for the national qualifiers! Registration is officially open for all local track categories. Don\'t miss your spot at the starting gate.', 'wpbrigade-challenge' ); ?></p>
								</div>
								<div class="tweet-item">
									<p><?php printf( esc_html__( 'Check out the new Adidas high-performance gear engineered for unmatched endurance. Track athletes, view details on our site: %s.', 'wpbrigade-challenge' ), '<a href="https://twitter.com/' . esc_attr( $twitter_user ) . '" target="_blank" rel="noopener">@' . esc_html( $twitter_user ) . '</a>' ); ?></p>
								</div>
								<div class="tweet-item">
									<p><?php esc_html_e( 'Live race stream coverage from Gator Nationals in Sarasota starts this Friday at 11:00 PM. Tune in and watch champions compete!', 'wpbrigade-challenge' ); ?></p>
								</div>
							</div>
						</div>

						<!-- Facebook Page Column -->
						<div class="social-col facebook-col">
							<h3 class="social-block-title"><?php esc_html_e( 'Facebook Page', 'wpbrigade-challenge' ); ?></h3>
							<div class="facebook-page-card">
								<div class="fb-card-header">
									<div class="fb-avatar">
										<img src="<?php echo esc_url( WPBC_URI . '/assets/images/sport-1.jpg' ); ?>" alt="<?php echo esc_attr( $fb_title ); ?>" />
									</div>
									<div class="fb-info">
										<h4 class="fb-title"><a href="<?php echo esc_url( $fb_page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $fb_title ); ?></a></h4>
										<a href="<?php echo esc_url( $fb_page_url ); ?>" target="_blank" rel="noopener" class="fb-like-btn">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
											<?php esc_html_e( 'Like', 'wpbrigade-challenge' ); ?>
										</a>
									</div>
								</div>
								<div class="fb-likes-count">
									<span><?php esc_html_e( '5412 People likes', 'wpbrigade-challenge' ); ?> <a href="<?php echo esc_url( $fb_page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $fb_title ); ?></a></span>
								</div>
								<div class="fb-faces-grid">
									<?php for ( $f = 1; $f <= 10; $f++ ) : ?>
										<div class="fb-face-cell"></div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
					</div>

					<!-- SUBSECTION: TABBED CONTENT (Match Info / Results / Schedule) -->
					<div class="match-tabs-section">
						<div class="tabs-nav-bar" role="tablist">
							<button type="button" class="tab-btn is-active" role="tab" aria-selected="true" data-tab-target="#tab-info">
								<?php esc_html_e( 'Match Info', 'wpbrigade-challenge' ); ?>
							</button>
							<button type="button" class="tab-btn" role="tab" aria-selected="false" data-tab-target="#tab-results">
								<?php esc_html_e( 'Match Results', 'wpbrigade-challenge' ); ?>
							</button>
							<button type="button" class="tab-btn" role="tab" aria-selected="false" data-tab-target="#tab-schedule">
								<?php esc_html_e( 'Match Schedule', 'wpbrigade-challenge' ); ?>
							</button>
						</div>

						<div class="tabs-content-panels">
							<div class="tab-pane is-active" id="tab-info" role="tabpanel">
								<div class="tab-pane-inner">
									<?php echo wp_kses_post( wpautop( $tab_info ) ); ?>
								</div>
							</div>
							<div class="tab-pane" id="tab-results" role="tabpanel" style="display:none;">
								<div class="tab-pane-inner">
									<?php echo wp_kses_post( wpautop( $tab_results ) ); ?>
								</div>
							</div>
							<div class="tab-pane" id="tab-schedule" role="tabpanel" style="display:none;">
								<div class="tab-pane-inner">
									<?php echo wp_kses_post( wpautop( $tab_schedule ) ); ?>
								</div>
							</div>
						</div>
					</div>

					<!-- SUBSECTION: ACCORDION LIST (From Tablet & Mobile layout) -->
					<div class="wpbc-accordions-section">
						<div class="accordion-item is-open">
							<button type="button" class="accordion-header" aria-expanded="true">
								<span class="acc-title"><?php esc_html_e( 'How do I register for the upcoming Adidas track racing championship?', 'wpbrigade-challenge' ); ?></span>
								<span class="acc-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
							</button>
							<div class="accordion-content">
								<p><?php esc_html_e( 'Registration is open online to all verified club athletes and independent racers. Select your category from the sports directory, complete the safety waiver, and submit your qualification times before the deadline.', 'wpbrigade-challenge' ); ?></p>
							</div>
						</div>

						<div class="accordion-item">
							<button type="button" class="accordion-header" aria-expanded="false">
								<span class="acc-title"><?php esc_html_e( 'What equipment and athletic gear are required for official trials?', 'wpbrigade-challenge' ); ?></span>
								<span class="acc-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
							</button>
							<div class="accordion-content" style="display:none;">
								<p><?php esc_html_e( 'All participants must wear regulation Adidas apparel or approved safety gear including certified helmets, track boots, and protective pads compliant with international sporting regulations.', 'wpbrigade-challenge' ); ?></p>
							</div>
						</div>

						<div class="accordion-item">
							<button type="button" class="accordion-header" aria-expanded="false">
								<span class="acc-title"><?php esc_html_e( 'Where can I view live match results, scores, and timetables?', 'wpbrigade-challenge' ); ?></span>
								<span class="acc-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
							</button>
							<div class="accordion-content" style="display:none;">
								<p><?php esc_html_e( 'Live heat scores, sector lap times, and race schedules are updated in real-time under the Match Info section and across our official event broadcast streams.', 'wpbrigade-challenge' ); ?></p>
							</div>
						</div>

						<div class="accordion-item">
							<button type="button" class="accordion-header" aria-expanded="false">
								<span class="acc-title"><?php esc_html_e( 'How can I join the Adidas Membership program to unlock local tracks?', 'wpbrigade-challenge' ); ?></span>
								<span class="acc-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
							</button>
							<div class="accordion-content" style="display:none;">
								<p><?php esc_html_e( 'Joining Adidas Membership unlocks priority track access, exclusive equipment discounts, training workshops, and invitations to premier racing tournaments worldwide.', 'wpbrigade-challenge' ); ?></p>
							</div>
						</div>

						<div class="accordion-item">
							<button type="button" class="accordion-header" aria-expanded="false">
								<span class="acc-title"><?php esc_html_e( 'What safety guidelines are enforced across all participating circuits?', 'wpbrigade-challenge' ); ?></span>
								<span class="acc-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
							</button>
							<div class="accordion-content" style="display:none;">
								<p><?php esc_html_e( 'All racing circuits enforce strict gate procedures, certified medical staff on-site, barrier shock inspections, and electronic flagging systems to guarantee rider and athlete safety.', 'wpbrigade-challenge' ); ?></p>
							</div>
						</div>
					</div>

				</div><!-- .homepage-primary-content -->

				<!-- RIGHT SIDEBAR COLUMN -->
				<aside class="homepage-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'wpbrigade-challenge' ); ?>">

					<!-- 1. Search Box Widget -->
					<div class="sidebar-widget widget_search">
						<div class="wpbc-widget-header">
							<h3 class="widget-title"><?php esc_html_e( 'Search', 'wpbrigade-challenge' ); ?></h3>
						</div>
						<div class="sidebar-search-card">
							<form role="search" method="get" class="search-form-sidebar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="search-field-sidebar" placeholder="<?php esc_attr_e( 'Enter keyword', 'wpbrigade-challenge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
								<button type="submit" class="search-submit-sidebar"><?php esc_html_e( 'SEARCH', 'wpbrigade-challenge' ); ?></button>
							</form>
						</div>
					</div>

					<!-- 2. Events CPT Widget with AJAX Pagination -->
					<div class="sidebar-widget wpbc-events-widget" id="wpbc-events-container">
						<div class="wpbc-widget-header">
							<h3 class="widget-title"><?php esc_html_e( 'EVENTS', 'wpbrigade-challenge' ); ?></h3>
						</div>
						<div class="events-list-wrapper" id="wpbc-events-list">
							<?php foreach ( $events as $idx => $event ) : ?>
								<div class="event-row-item">
									<div class="event-number-badge"><?php echo esc_html( $idx + 1 ); ?></div>
									<div class="event-thumb">
										<img src="<?php echo esc_url( $event['image'] ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?>" />
									</div>
									<div class="event-meta-info">
										<h4 class="event-item-title"><a href="<?php echo esc_url( $event['link'] ); ?>"><?php echo esc_html( $event['title'] ); ?></a></h4>
										<span class="event-item-date"><?php echo esc_html( $event['start_date'] ); ?></span>
										<span class="event-item-time"><?php echo esc_html( $event['start_time'] . ' - ' . $event['end_time'] ); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="events-widget-footer">
							<div class="events-ajax-pagination">
								<button type="button" class="events-nav-btn prev" id="wpbc-events-prev" aria-label="<?php esc_attr_e( 'Previous events', 'wpbrigade-challenge' ); ?>" disabled>
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="15 18 9 12 15 6"></polyline></svg>
								</button>
								<button type="button" class="events-nav-btn next" id="wpbc-events-next" aria-label="<?php esc_attr_e( 'Next events', 'wpbrigade-challenge' ); ?>">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"></polyline></svg>
								</button>
							</div>
							<a href="<?php echo esc_url( get_post_type_archive_link( 'wpbc_event' ) ? get_post_type_archive_link( 'wpbc_event' ) : '#' ); ?>" class="more-events-link"><?php esc_html_e( 'More Events', 'wpbrigade-challenge' ); ?></a>
						</div>
					</div>

					<!-- 3. Categories with Clickable Sub-categories (Dynamic WP Taxonomy) -->
					<div class="sidebar-widget wpbc-categories-widget">
						<div class="wpbc-widget-header">
							<h3 class="widget-title"><?php esc_html_e( 'Categories', 'wpbrigade-challenge' ); ?></h3>
						</div>
						<div class="categories-list-wrapper">
							<ul class="wpbc-cat-accordion">
								<?php
								$cat_hierarchy = wpbc_get_categories_hierarchy();
								foreach ( $cat_hierarchy as $cat_item ) :
									$has_subs = ! empty( $cat_item['children'] );
									?>
									<li class="cat-item <?php echo $has_subs ? 'has-children' : ''; ?>">
										<div class="cat-parent-row">
											<button type="button" class="cat-chevron-btn" <?php echo $has_subs ? '' : 'disabled'; ?> aria-expanded="false" aria-label="<?php printf( esc_attr__( 'Toggle %s subcategories', 'wpbrigade-challenge' ), esc_attr( $cat_item['name'] ) ); ?>">
												<span class="chevron">&#8250;</span>
											</button>
											<a href="<?php echo esc_url( $cat_item['url'] ); ?>" class="cat-link">
												<?php echo esc_html( $cat_item['name'] ); ?>
											</a>
										</div>
										<?php if ( $has_subs ) : ?>
											<ul class="cat-children-list">
												<?php foreach ( $cat_item['children'] as $sub_cat ) : ?>
													<li class="cat-child-item">
														<a href="<?php echo esc_url( $sub_cat['url'] ); ?>" class="cat-child-link">
															<?php echo esc_html( $sub_cat['name'] ); ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>

					<!-- 3b. Categories Tag Cloud Widget (Image 6 & Desktop) -->
					<div class="sidebar-widget wpbc-categories-tags-widget">
						<div class="wpbc-widget-header">
							<h3 class="widget-title"><?php esc_html_e( 'Categories', 'wpbrigade-challenge' ); ?></h3>
						</div>
						<div class="categories-tags-cloud">
							<?php
							foreach ( $cat_hierarchy as $tag_cat ) :
								?>
								<a href="<?php echo esc_url( $tag_cat['url'] ); ?>" class="cat-pill"><?php echo esc_html( $tag_cat['name'] ); ?></a>
								<?php
								if ( ! empty( $tag_cat['children'] ) ) :
									foreach ( $tag_cat['children'] as $tag_sub ) :
										?>
										<a href="<?php echo esc_url( $tag_sub['url'] ); ?>" class="cat-pill"><?php echo esc_html( $tag_sub['name'] ); ?></a>
										<?php
									endforeach;
								endif;
							endforeach;
							?>
						</div>
					</div>

					<!-- 4. Weather Widget -->
					<?php the_widget( 'WPBC_Weather_Widget' ); ?>

					<!-- 5. Date & Time Widget (Live Clock) -->
					<?php the_widget( 'WPBC_DateTime_Widget' ); ?>

					<!-- 6. Newsletter Widget -->
					<?php the_widget( 'WPBC_Newsletter_Widget' ); ?>

				</aside><!-- .homepage-sidebar -->

			</div><!-- .homepage-two-col-grid -->
		</div><!-- .wpbc-container -->
	</div><!-- .wpbc-main-layout-section -->

	<!-- ============================================================== -->
	<!-- SECTION 4: GET IN TOUCH WITH US CONTACT FORM                   -->
	<!-- (Featured in Tablet/Mobile views & Video popup reference)      -->
	<!-- ============================================================== -->
	<section class="wpbc-contact-section" aria-label="<?php esc_attr_e( 'Contact Form', 'wpbrigade-challenge' ); ?>">
		<div class="wpbc-container">
			<div class="contact-section-inner">
				<h2 class="contact-section-title"><?php esc_html_e( 'GET IN TOUCH WITH US', 'wpbrigade-challenge' ); ?></h2>

				<form class="wpbc-contact-form" action="#" method="post">
					<div class="form-row-2col">
						<div class="form-group">
							<label for="contact-name"><?php esc_html_e( 'NAME', 'wpbrigade-challenge' ); ?></label>
							<input type="text" id="contact-name" name="contact_name" placeholder="<?php esc_attr_e( 'Enter name', 'wpbrigade-challenge' ); ?>" required />
						</div>
						<div class="form-group">
							<label for="contact-email"><?php esc_html_e( 'EMAIL', 'wpbrigade-challenge' ); ?></label>
							<input type="email" id="contact-email" name="contact_email" placeholder="<?php esc_attr_e( 'Enter email', 'wpbrigade-challenge' ); ?>" required />
						</div>
					</div>

					<div class="form-row-2col">
						<div class="form-group">
							<label for="contact-country"><?php esc_html_e( 'COUNTRY', 'wpbrigade-challenge' ); ?></label>
							<div class="custom-select-wrap">
								<select id="contact-country" name="contact_country">
									<option value="USA">USA</option>
									<option value="UK">UK</option>
									<option value="Pakistan">Pakistan</option>
									<option value="UAE">United Arab Emirates</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="South Korea">South Korea</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="contact-state"><?php esc_html_e( 'STATE', 'wpbrigade-challenge' ); ?></label>
							<input type="text" id="contact-state" name="contact_state" placeholder="USA" />
						</div>
					</div>

					<div class="form-group gender-group">
						<label class="gender-label"><?php esc_html_e( 'GENDER', 'wpbrigade-challenge' ); ?></label>
						<div class="radio-options">
							<label class="radio-label">
								<input type="radio" name="contact_gender" value="male" checked />
								<span class="custom-radio"></span>
								<?php esc_html_e( 'Male', 'wpbrigade-challenge' ); ?>
							</label>
							<label class="radio-label">
								<input type="radio" name="contact_gender" value="female" />
								<span class="custom-radio"></span>
								<?php esc_html_e( 'Female', 'wpbrigade-challenge' ); ?>
							</label>
							<label class="radio-label">
								<input type="radio" name="contact_gender" value="other" />
								<span class="custom-radio"></span>
								<?php esc_html_e( 'Other', 'wpbrigade-challenge' ); ?>
							</label>
						</div>
					</div>

					<div class="form-group">
						<label for="contact-message"><?php esc_html_e( 'MESSAGE', 'wpbrigade-challenge' ); ?></label>
						<textarea id="contact-message" name="contact_message" rows="5" placeholder="<?php esc_attr_e( 'Message', 'wpbrigade-challenge' ); ?>" required></textarea>
					</div>

					<div class="form-submit-row">
						<button type="submit" class="contact-submit-btn"><?php esc_html_e( 'SUBMIT', 'wpbrigade-challenge' ); ?></button>
					</div>
				</form>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

