<?php
/**
 * KK Writer Theme: The analytics code of the site.
 *
 * @package KK_Writer_Theme
 */

global $post;

$analytics_text = kkw_get_option( 'analytics_code', 'kkw_opt_advanced_settings' );
echo $analytics_text;

