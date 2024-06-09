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

define( 'SLUG_SEARCH_SITE_EN', 'search-site' );

// Define ROLES and PERMISSIONS.
define( 'KKW_SUPER_EDITOR_ROLE_SLUG', 'kkw_super_editor' );
define( 'KKW_SUPER_EDITOR_ROLE_NAME', 'Super Editor' );
define( 'KKW_EDIT_CONFIG_PERMISSION', 'kkw_edit_site_configuration' );

// Post Types for PolyLang: defined in wp-kkwriter-plugin.
define(
	'KKW_POST_TYPES_TO_TRANSLATE',
	array(
		// ID_PT_SECTION,
		// ID_PT_COLLECTION,
		ID_PT_BOOK,
		ID_PT_REVIEW,
		ID_PT_EXCERPT,
		ID_PT_MULTIMEDIA,
		ID_PT_INTERVIEW,
	)
);

// Taxonomies for Polylang: defined in wp-kkwriter-plugin.
define(
	'KKW_TAXONOMIES_TO_TRANSLATE',
	array(
		KKW_SECTION_TAXONOMY,
		KKW_COLLECTION_TAXONOMY,
		KKW_BLOG_TYPE_TAXONOMY,
		KKW_AUTHOR_TAXONOMY,
		KKW_PUBLISHER_TAXONOMY,
	)
);

// Sections of the site.
define(
	'KKW_SITE_SECTIONS',
	array(
		array(
			'it' => 'Poesia',
			'en' => 'Poetry',
		),
		array(
			'it' => 'Saggistica',
			'en' => 'Essays',
		),
		array(
			'it' => 'Narrativa',
			'en' => 'Fiction',
		),
	)
);

define(
	'SUGGESTED_PLUGINS',
	array(
		array(
			'name'     => 'Polylang - Multilanguage support',
			'slug'     => 'polylang',
			'required' => true,
		),
	)
);
