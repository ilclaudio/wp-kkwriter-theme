<?php
/**
 * KKW Writer Theme analytics snippet template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_analytics_text = kkw_get_option( 'analytics_code', 'kkw_opt_advanced_settings' );

if ( is_string( $kkw_analytics_text ) && '' !== trim( $kkw_analytics_text ) ) {
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Trusted admin-provided analytics snippet.
	echo $kkw_analytics_text;
}
