<?php
/**
 * Helper template functions
 *
 * @package WPBrigade_Challenge
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get Slides for the Hero Slider
 *
 * @return array
 */
function wpbc_get_slides() {
	// 1. First check Theme Options Repeater (Image 4 Requirement)
	$option_slides = wpbc_get_option( 'hero_slides', array() );

	if ( ! empty( $option_slides ) && is_array( $option_slides ) ) {
		$slides = array();
		foreach ( $option_slides as $index => $slide ) {
			if ( empty( $slide['title'] ) && empty( $slide['image'] ) ) {
				continue;
			}
			$slides[] = array(
				'id'        => $index + 1,
				'title'     => ! empty( $slide['title'] ) ? $slide['title'] : '',
				'subtitle'  => '',
				'content'   => ! empty( $slide['content'] ) ? $slide['content'] : '',
				'image'     => ! empty( $slide['image'] ) ? $slide['image'] : WPBC_URI . '/assets/images/hero-slide-1.jpg',
				'video_url' => ! empty( $slide['video_url'] ) ? $slide['video_url'] : '',
			);
		}

		if ( ! empty( $slides ) ) {
			return $slides;
		}
	}

	// 2. Fallback to Slides CPT
	$slides_query = new WP_Query( array(
		'post_type'      => 'wpbc_slide',
		'posts_per_page' => 10,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	) );

	$slides = array();

	if ( $slides_query->have_posts() ) {
		while ( $slides_query->have_posts() ) {
			$slides_query->the_post();
			$post_id   = get_the_ID();
			$image_url = get_the_post_thumbnail_url( $post_id, 'full' );
			if ( ! $image_url ) {
				$image_url = WPBC_URI . '/assets/images/hero-slide-1.jpg';
			}

			$slides[] = array(
				'id'        => $post_id,
				'title'     => get_the_title(),
				'subtitle'  => get_post_meta( $post_id, '_wpbc_slide_subtitle', true ),
				'content'   => get_the_excerpt() ? get_the_excerpt() : get_the_content(),
				'image'     => $image_url,
				'video_url' => get_post_meta( $post_id, '_wpbc_slide_video_url', true ),
			);
		}
		wp_reset_postdata();
	}

	// Default fallback slides if none exist in backend yet
	if ( empty( $slides ) ) {
		$default_video = wpbc_get_option( 'hero_video_url', 'https://youtu.be/dajLlFfc3P4?si=OAca-EA0WxEFy3M-' );

		$slides = array(
			array(
				'id'        => 1,
				'title'     => 'GET READY FOR NEW<br>ADIDAS BANDS',
				'subtitle'  => '',
				'content'   => 'Adidas tracks all begin with a starting gate and end with a finish line, but everything in between varies from track to track. Because no two tracks are alike, this action sport keeps you on your toes wherever you are racing.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-1.jpg',
				'video_url' => $default_video,
			),
			array(
				'id'        => 2,
				'title'     => 'EXPLORE THE ULTIMATE<br>SPORTS PERFORMANCE',
				'subtitle'  => '',
				'content'   => 'Pushing the limits of athletic innovation. Discover apparel, shoes, and gear engineered for maximum endurance and velocity.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-2.jpg',
				'video_url' => $default_video,
			),
			array(
				'id'        => 3,
				'title'     => 'CHAMPIONS CHOOSE<br>PRECISION & POWER',
				'subtitle'  => '',
				'content'   => 'Engineered with elite athletes across the globe, providing next-generation support and grip for competitive sports.',
				'image'     => WPBC_URI . '/assets/images/hero-slide-3.jpg',
				'video_url' => '',
			),
		);
	}

	return $slides;
}

/**
 * Get Sports for the category carousel (10 items)
 *
 * @return array
 */
function wpbc_get_sports( $limit = 10 ) {
	$sports_query = new WP_Query( array(
		'post_type'      => 'wpbc_sport',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	) );

	$sports = array();

	if ( $sports_query->have_posts() ) {
		while ( $sports_query->have_posts() ) {
			$sports_query->the_post();
			$post_id   = get_the_ID();
			$image_url = get_the_post_thumbnail_url( $post_id, 'wpbc-sport-thumb' );
			if ( ! $image_url ) {
				$image_url = WPBC_URI . '/assets/images/sport-1.jpg';
			}

			$sports[] = array(
				'id'    => $post_id,
				'title' => get_the_title(),
				'image' => $image_url,
				'link'  => get_permalink(),
			);
		}
		wp_reset_postdata();
	}

	// Fallback default items to match design exactly
	if ( empty( $sports ) ) {
		$defaults = array(
			array( 'title' => 'Soccer', 'image' => WPBC_URI . '/assets/images/sport-1.jpg' ),
			array( 'title' => 'Hockey', 'image' => WPBC_URI . '/assets/images/sport-2.jpg' ),
			array( 'title' => 'Volley Ball', 'image' => WPBC_URI . '/assets/images/sport-3.jpg' ),
			array( 'title' => 'Rugby', 'image' => WPBC_URI . '/assets/images/sport-4.jpg' ),
			array( 'title' => 'Tennis', 'image' => WPBC_URI . '/assets/images/sport-5.jpg' ),
			array( 'title' => 'Basketball', 'image' => WPBC_URI . '/assets/images/sport-1.jpg' ),
			array( 'title' => 'Running', 'image' => WPBC_URI . '/assets/images/sport-2.jpg' ),
			array( 'title' => 'Baseball', 'image' => WPBC_URI . '/assets/images/sport-3.jpg' ),
			array( 'title' => 'Cycling', 'image' => WPBC_URI . '/assets/images/sport-4.jpg' ),
			array( 'title' => 'Athletics', 'image' => WPBC_URI . '/assets/images/sport-5.jpg' ),
		);

		foreach ( $defaults as $idx => $d ) {
			$sports[] = array(
				'id'    => $idx + 1,
				'title' => $d['title'],
				'image' => $d['image'],
				'link'  => '#',
			);
		}
	}

	return $sports;
}

/**
 * Get Events for sidebar
 *
 * @param int $limit
 * @param int $page
 * @return array
 */
function wpbc_get_events( $limit = 4, $page = 1 ) {
	$query = new WP_Query( array(
		'post_type'      => 'wpbc_event',
		'posts_per_page' => $limit,
		'paged'          => $page,
		'post_status'    => 'publish',
		'orderby'        => 'meta_value',
		'meta_key'       => '_wpbc_event_start_date',
		'order'          => 'ASC',
	) );

	$events = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id    = get_the_ID();
			$image_url  = get_the_post_thumbnail_url( $post_id, 'wpbc-event-thumb' );
			$start_date = get_post_meta( $post_id, '_wpbc_event_start_date', true );
			$start_time = get_post_meta( $post_id, '_wpbc_event_start_time', true );
			$end_time   = get_post_meta( $post_id, '_wpbc_event_end_time', true );
			$location   = get_post_meta( $post_id, '_wpbc_event_location', true );

			$events[] = array(
				'id'         => $post_id,
				'title'      => get_the_title(),
				'image'      => $image_url ? $image_url : WPBC_URI . '/assets/images/event-1.jpg',
				'start_date' => $start_date ? $start_date : '2022-11-07',
				'start_time' => $start_time ? $start_time : '11:00 PM',
				'end_time'   => $end_time ? $end_time : '12:00 AM',
				'location'   => $location ? $location : 'USA',
				'link'       => get_permalink(),
			);
		}
		wp_reset_postdata();
	}

	if ( empty( $events ) ) {
		$events = array(
			array(
				'id'         => 1,
				'title'      => 'SHOW IN USA',
				'image'      => WPBC_URI . '/assets/images/event-1.jpg',
				'start_date' => '7th Nov, 2022',
				'start_time' => '11:00 PM',
				'end_time'   => '12:00 AM',
				'location'   => 'USA',
				'link'       => '#',
			),
			array(
				'id'         => 2,
				'title'      => 'ADIDAS SHOW IN USA',
				'image'      => WPBC_URI . '/assets/images/event-2.jpg',
				'start_date' => '7th Nov, 2022',
				'start_time' => '11:00 PM',
				'end_time'   => '12:00 AM',
				'location'   => 'USA',
				'link'       => '#',
			),
			array(
				'id'         => 3,
				'title'      => 'ADIDAS SHOW',
				'image'      => WPBC_URI . '/assets/images/event-1.jpg',
				'start_date' => '7th Nov, 2022',
				'start_time' => '11:00 PM',
				'end_time'   => '12:00 AM',
				'location'   => 'USA',
				'link'       => '#',
			),
			array(
				'id'         => 4,
				'title'      => 'ADIDAS IN USA',
				'image'      => WPBC_URI . '/assets/images/event-2.jpg',
				'start_date' => '7th Nov, 2022',
				'start_time' => '11:00 PM',
				'end_time'   => '12:00 AM',
				'location'   => 'USA',
				'link'       => '#',
			),
		);
	}

	return $events;
}

/**
 * Get random sticky post or featured post
 *
 * @return WP_Post|null
 */
function wpbc_get_featured_sticky_post() {
	$sticky = get_option( 'sticky_posts' );

	if ( ! empty( $sticky ) ) {
		$args = array(
			'post__in'            => $sticky,
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => 1,
			'orderby'             => 'rand',
		);
	} else {
		$args = array(
			'posts_per_page' => 1,
			'orderby'        => 'rand',
		);
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		$post = $query->posts[0];
		wp_reset_postdata();
		return $post;
	}

	return null;
}

/**
 * Get 3 Latest Posts
 *
 * @return WP_Query
 */
function wpbc_get_latest_posts_query( $count = 3 ) {
	return new WP_Query( array(
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => 1,
		'orderby'             => 'date',
		'order'               => 'DESC',
	) );
}

/**
 * Extract YouTube / Vimeo embed URL
 *
 * @param string $url
 * @return string
 */
function wpbc_get_embed_url( $url ) {
	if ( empty( $url ) ) {
		return '';
	}

	if ( preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches ) ) {
		return 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&rel=0&modestbranding=1';
	}

	if ( preg_match( '/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches ) ) {
		return 'https://player.vimeo.com/video/' . $matches[1] . '?autoplay=1';
	}

	return esc_url( $url );
}

/**
 * Get WordPress Categories and Subcategories Hierarchy
 *
 * @return array
 */
function wpbc_get_categories_hierarchy() {
	$parents = get_categories( array(
		'parent'     => 0,
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );

	$tree = array();

	if ( ! empty( $parents ) ) {
		foreach ( $parents as $parent ) {
			$children = get_categories( array(
				'parent'     => $parent->term_id,
				'hide_empty' => false,
				'orderby'    => 'name',
				'order'      => 'ASC',
			) );

			$child_list = array();
			if ( ! empty( $children ) ) {
				foreach ( $children as $child ) {
					$child_list[] = array(
						'id'    => $child->term_id,
						'name'  => $child->name,
						'count' => $child->count,
						'url'   => get_category_link( $child->term_id ),
					);
				}
			}

			$tree[] = array(
				'id'       => $parent->term_id,
				'name'     => $parent->name,
				'count'    => $parent->count,
				'url'      => get_category_link( $parent->term_id ),
				'children' => $child_list,
			);
		}
	}

	// Fallback to match Figma design if database only has default Uncategorized
	if ( empty( $tree ) || ( 1 === count( $tree ) && 'uncategorized' === strtolower( $tree[0]['name'] ) && empty( $tree[0]['children'] ) ) ) {
		$fallback = array(
			array(
				'id'       => 'f1',
				'name'     => __( 'Sports Shoes', 'wpbrigade-challenge' ),
				'url'      => home_url( '/?s=Sports+Shoes' ),
				'children' => array(
					array( 'id' => 'fc1', 'name' => __( 'Running Shoes', 'wpbrigade-challenge' ), 'url' => home_url( '/?s=Running+Shoes' ) ),
					array( 'id' => 'fc2', 'name' => __( 'Football Boots', 'wpbrigade-challenge' ), 'url' => home_url( '/?s=Football+Boots' ) ),
					array( 'id' => 'fc3', 'name' => __( 'Sneakers', 'wpbrigade-challenge' ), 'url' => home_url( '/?s=Sneakers' ) ),
				),
			),
			array(
				'id'       => 'f2',
				'name'     => __( 'Sports Garments', 'wpbrigade-challenge' ),
				'url'      => home_url( '/?s=Sports+Garments' ),
				'children' => array(
					array( 'id' => 'fc4', 'name' => __( 'Jerseys', 'wpbrigade-challenge' ), 'url' => home_url( '/?s=Jerseys' ) ),
					array( 'id' => 'fc5', 'name' => __( 'Tracksuits', 'wpbrigade-challenge' ), 'url' => home_url( '/?s=Tracksuits' ) ),
				),
			),
			array(
				'id'       => 'f3',
				'name'     => __( 'Sports Deals', 'wpbrigade-challenge' ),
				'url'      => home_url( '/?s=Sports+Deals' ),
				'children' => array(),
			),
			array(
				'id'       => 'f4',
				'name'     => __( 'Leather Garments', 'wpbrigade-challenge' ),
				'url'      => home_url( '/?s=Leather+Garments' ),
				'children' => array(),
			),
			array(
				'id'       => 'f5',
				'name'     => __( 'Accessories', 'wpbrigade-challenge' ),
				'url'      => home_url( '/?s=Accessories' ),
				'children' => array(),
			),
		);

		if ( ! empty( $tree ) ) {
			return array_merge( $tree, $fallback );
		}
		return $fallback;
	}

	return $tree;
}

