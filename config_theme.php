<?php

/**
 * KK Writer Theme: Theme configuration constants.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KK_Writer_Theme
 */

// Multilanguage options.
define( 'KKW_IT_SLUG', 'it' );
define( 'KKW_EN_SLUG', 'en' );
define( 'KKW_DEFAULT_LANGUAGE', KKW_IT_SLUG );
define( 'KKW_ENG_SUFFIX_LANGUAGE', '_eng' );
define( 'KKW_THEMA_PATH', plugin_dir_path( __FILE__ ) );
define( 'KKW_THEMA_URL', get_template_directory_uri() );
define( 'KKW_DEFAULT_DATE_FORMAT' , 'd/m/Y' );

// Define ROLES and PERMISSIONS.
define( 'KKW_SUPER_EDITOR_ROLE_SLUG', 'kkw_super_editor' );
define( 'KKW_SUPER_EDITOR_ROLE_NAME', 'Super Editor' );
define( 'KKW_EDIT_CONFIG_PERMISSION', 'kkw_edit_site_configuration' );

define(
	'SUGGESTED_PLUGINS',
	array(
		array(
			'name'     => 'Polylang - Multilanguage support',
			'slug'     => 'polylang',
			'required' => true,
		),
		// array(
		// 	'name'     => 'Really Simple CAPTCHA',
		// 	'slug'     => 'really-simple-captcha',
		// 	'required' => true,
		// ),
		// array(
		// 	'name'     => 'CookieYes - GDPR Cookie Consent',
		// 	'slug'     => 'cookie-law-info',
		// 	'required' => true,
		// ),
		// array(
		// 	'name'     => 'WP Mail SMTP',
		// 	'slug'     => 'wp-mail-smtp',
		// 	'required' => true,
		// ),
	)
);
