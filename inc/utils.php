<?php
/**
 * KKW Writer Theme: Utility functions.
 *
 * @package KK_Writer_Theme
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'kkw_get_option' ) ) {
	/**
	 * Wrapper function around cmb2_get_option.
	 *
	 * @since  0.1.0
	 * @param  string $key        Options array key.
	 * @param  string $option_key CMB2 option group key.
	 * @param  mixed  $default    Optional default value.
	 * @return mixed              Option value.
	 */
	function kkw_get_option( $key, $option_key, $default = false ) { // phpcs:ignore Universal.NamingConventions.NoReservedKeywordParameterNames.defaultFound
		if ( function_exists( 'cmb2_get_option' ) ) {
			// Use cmb2_get_option as it passes through some key filters.
			return cmb2_get_option( $option_key, $key, $default );
		}
		// Fallback to get_option if CMB2 is not loaded yet.
		$opts = get_option( $option_key, $default );
		$val  = $default;
		if ( 'all' === $key ) {
			$val = $opts;
		} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$val = $opts[ $key ];
		}
		return $val;
	}
}

if ( ! function_exists( 'kkw_get_content' ) ) {
	/**
	 * Get a post by slug and content type.
	 *
	 * @param string $slug         Post slug.
	 * @param string $content_type Post type.
	 * @return WP_Post|null        Post object or null if not found.
	 */
	function kkw_get_content( $slug, $content_type ) {
		$args  = array(
			'name'        => $slug,
			'post_type'   => $content_type,
			'post_status' => array( 'publish', 'draft', 'trash', 'pending', 'private' ),
			'numberposts' => 1,
		);
		$posts = get_posts( $args );
		return $posts ? $posts[0] : null;
	}
}

if ( ! function_exists( 'clean_and_truncate_text' ) ) {
	/**
	 * Strip HTML tags and truncate text to a given size.
	 *
	 * @param string $text  Text to clean and truncate.
	 * @param int    $size  Maximum character length.
	 * @param bool   $split If true, split at exact position; otherwise split at last space.
	 * @return string       Cleaned and truncated text.
	 */
	function clean_and_truncate_text( $text, $size = 500, $split = false ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
		// Remove HTML tags.
		$clean_text = wp_strip_all_tags( $text );
		// Truncate to $size.
		if ( strlen( $clean_text ) > $size ) {
			if ( $split ) {
				$truncated_text = substr( $clean_text, 0, $size ) . '...';
			} else {
				$truncated_text = mb_substr( $clean_text, 0, $size );
				$last_space     = mb_strrpos( $truncated_text, ' ' );
				if ( false !== $last_space ) {
					$truncated_text = mb_substr( $truncated_text, 0, $last_space ) . '...';
				}
			}
		} else {
			$truncated_text = $clean_text;
		}
		return $truncated_text;
	}
}
