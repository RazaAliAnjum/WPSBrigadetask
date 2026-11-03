<?php
/**
 * The template for displaying search results pages
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main search-results-main">
	<div class="wpbc-container">
		<header class="page-entry-header">
			<h1 class="page-title">
				<?php
				printf(
					esc_html__( 'Search Results for: %s', 'wpbrigade-challenge' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>

		<div class="homepage-two-col-grid">
			<div class="homepage-primary-content">
				<?php
				if ( have_posts() ) :
					echo '<div class="posts-archive-grid">';
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'wpbc-post-card archive-post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-card-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'wpbc-post-card' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="post-card-body">
								<h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="post-meta-line">
									<?php wpbc_posted_on(); ?> | <?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?>
								</div>
								<div class="post-card-excerpt">
									<?php the_excerpt(); ?>
								</div>
								<div class="post-card-footer">
									<a href="<?php the_permalink(); ?>" class="wpbc-read-more-btn"><?php esc_html_e( 'VIEW RESULT', 'wpbrigade-challenge' ); ?></a>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					echo '</div>';

					the_posts_pagination();
				else :
					?>
					<div class="no-results-box search-no-results">
						<h2><?php esc_html_e( 'Nothing Found', 'wpbrigade-challenge' ); ?></h2>
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wpbrigade-challenge' ); ?></p>
						<div class="search-page-form-wrap">
							<?php get_search_form(); ?>
						</div>
					</div>
					<?php
				endif;
				?>
			</div>

			<aside class="homepage-sidebar">
				<div class="sidebar-widget widget_search">
					<div class="wpbc-widget-header"><h3 class="widget-title"><?php esc_html_e( 'New Search', 'wpbrigade-challenge' ); ?></h3></div>
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

