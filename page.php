<?php
/**
 * The template for displaying all pages
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main default-page-main">
	<div class="wpbc-container">
		<div class="homepage-two-col-grid">
			<div class="homepage-primary-content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article-content' ); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="page-featured-img">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>
						<?php endif; ?>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<aside class="homepage-sidebar">
				<div class="sidebar-widget widget_search">
					<div class="wpbc-widget-header"><h3 class="widget-title"><?php esc_html_e( 'Search', 'wpbrigade-challenge' ); ?></h3></div>
					<div class="sidebar-search-card">
						<form role="search" method="get" class="search-form-sidebar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" class="search-field-sidebar" placeholder="<?php esc_attr_e( 'Enter keyword', 'wpbrigade-challenge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
							<button type="submit" class="search-submit-sidebar"><?php esc_html_e( 'SEARCH', 'wpbrigade-challenge' ); ?></button>
						</form>
					</div>
				</div>
				<?php the_widget( 'WPBC_Weather_Widget' ); ?>
				<?php the_widget( 'WPBC_DateTime_Widget' ); ?>
			</aside>
		</div>
	</div>
</main>

<?php
get_footer();

