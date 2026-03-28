<?php
/**
 * KKW Writer Theme analytics snippet template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_analytics_text = kkw_get_option( 'analytics_code', 'kkw_opt_advanced_settings' );

if ( is_string( $kkw_analytics_text ) && '' !== trim( $kkw_analytics_text ) ) {
	$kkw_analytics_allowed_tags = array(
		'script'   => array(
			'src'            => true,
			'async'          => true,
			'defer'          => true,
			'type'           => true,
			'id'             => true,
			'crossorigin'    => true,
			'integrity'      => true,
			'referrerpolicy' => true,
			'nonce'          => true,
		),
		'noscript' => array(),
		'iframe'   => array(
			'src'            => true,
			'height'         => true,
			'width'          => true,
			'style'          => true,
			'loading'        => true,
			'referrerpolicy' => true,
			'title'          => true,
		),
		'img'      => array(
			'src'            => true,
			'height'         => true,
			'width'          => true,
			'alt'            => true,
			'style'          => true,
			'referrerpolicy' => true,
		),
	);
	echo wp_kses( $kkw_analytics_text, $kkw_analytics_allowed_tags );
}
