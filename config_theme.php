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

// Define template active sting.
define( 'KKW_TEXT_TEMPLATE_ACTIVE_IT', ' [template attivo]' );
define( 'KKW_TEXT_TEMPLATE_ACTIVE_EN', ' [template active]' );

// Pagina che si edita da backend.
define( 'KKW_STATIC_PAGE_CAT', 'static_page' );
// Pagina costruita automaticamente con form, mappe, ecc.
define( 'KKW_CUSTOM_PAGE_CAT', 'custom_page' );
// Pagina che contiene la lista dei post di un certo tipo (archivio).
define( 'KKW_ARCHIVE_PAGE_CAT', 'archive_page' );

// Define ROLES and PERMISSIONS.
define( 'KKW_SUPER_EDITOR_ROLE_SLUG', 'kkw_super_editor' );
define( 'KKW_SUPER_EDITOR_ROLE_NAME', 'Super Editor' );
define( 'KKW_EDIT_CONFIG_PERMISSION', 'kkw_edit_site_configuration' );

// Post Types for PolyLang: defined in wp-kkwriter-plugin.
define(
	'KKW_POST_TYPES_TO_TRANSLATE',
	array(
		KKW_DEFAULT_POST,
		KKW_DEFAULT_PAGE,
		KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
		KKW_POST_TYPES[ ID_PT_REVIEW ]['name'],
		KKW_POST_TYPES[ ID_PT_EXCERPT ]['name'],
		KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name'],
		KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'],
	)
);

// Taxonomies for Polylang: defined in wp-kkwriter-plugin.
define(
	'KKW_TAXONOMIES_TO_TRANSLATE',
	array(
		KKW_SECTION_TAXONOMY,
		KKW_COLLECTION_TAXONOMY,
		KKW_AUTHOR_TAXONOMY,
		KKW_PUBLISHER_TAXONOMY,
	)
);

// Sections of the site.
define(
	'KKW_SITE_SECTIONS',
	array(
		array(
			'en' => 'Poetry',
			'it' => 'Poesia',
		),
		array(
			'en' => 'Essays',
			'it' => 'Saggistica',
		),
		array(
			'en' => 'Fiction',
			'it' => 'Narrativa',
		),
	)
);

define( 'SLUG_SEARCH_SITE_EN', 'search' );

define(
	'KKW_SITE_STATIC_PAGES',
	array(
		array(
			'content_slug_it'    => 'privacy-it',
			'content_slug_en'    => 'privacy',
			'content_title_it'   => 'Privacy policy',
			'content_title_en'   => 'Privacy policy',
			'content_it'         => 'La nostra Privacy Policy...',
			'content_en'         => 'Our Privacy Policy...',
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => '',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'accessibilita',
			'content_slug_en'    => 'accessibility',
			'content_title_it'   => 'Accessibilità',
			'content_title_en'   => 'Accessibility',
			'content_it'         => 'La dichiarazione di accessibilità...',
			'content_en'         => 'The accessibility declaration...',
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => '',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'crediti',
			'content_slug_en'    => 'credits',
			'content_title_it'   => 'Crediti',
			'content_title_en'   => 'Credits',
			'content_it'         => 'I crediti...',
			'content_en'         => 'The credits...',
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => '',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'biografia',
			'content_slug_en'    => 'biography',
			'content_title_it'   => 'Biografia',
			'content_title_en'   => 'Biography',
			'content_it'         => 'La biografia...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'The biography...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => '',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'mappa-sito',
			'content_slug_en'    => 'site-map',
			'content_title_it'   => 'Mappa del sito',
			'content_title_en'   => 'Site map',
			'content_it'         => 'La mappa del sito...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'The map of the site...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => 'page-templates/sitemap.php',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'contatti',
			'content_slug_en'    => 'contacts',
			'content_title_it'   => 'Contatti',
			'content_title_en'   => 'Contacts',
			'content_it'         => 'I nostri contatti...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'Our contacts...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => 'page-templates/contacts.php',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'newsletter-it',
			'content_slug_en'    => 'newsletter',
			'content_title_it'   => 'Newsletter',
			'content_title_en'   => 'Newsletter',
			'content_it'         => 'Registrati alla newsletter...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'Register to the newsletter...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => 'page-templates/newsletter.php',
			'content_type'       => 'page',
			'content_parent'     => null,
			'content_category'   => KKW_CUSTOM_PAGE_CAT,
		),
		array(
			'content_slug_it'    => 'ricerca',
			'content_slug_en'    => SLUG_SEARCH_SITE_EN,
			'content_title_it'   => 'Ricerca',
			'content_title_en'   => 'Search',
			'content_it'         => 'Ricerca cose nel sito ...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'Search things in the site...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => 'page-templates/search.php',
			'content_type'       => 'page',
			'content_parent'     => null,
		),
		array(
			'content_slug_it'    => 'articoli',
			'content_slug_en'    => 'blog',
			'content_title_it'   => 'Blog',
			'content_title_en'   => 'Blog',
			'content_it'         => 'Il blog ...' . KKW_TEXT_TEMPLATE_ACTIVE_IT,
			'content_en'         => 'The blog...' . KKW_TEXT_TEMPLATE_ACTIVE_EN,
			'content_status'     => 'publish',
			'content_author'     => 1,
			'content_template'   => 'page-templates/blog.php',
			'content_type'       => 'page',
			'content_parent'     => null,
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


// Graphic configurations
define( 'KKW_FEATURED_TEXT_MAX_SIZE', 256 );
define( 'KKW_FEATURED_IMG_WIDTH', 200 );
define( 'KKW_FEATURED_IMG_HEIGHT', 248 );
define( 'KKW_SMALL_FEATURED_TEXT_MAX_SIZE', 126 );
define( 'KKW_SMALL_FEATURED_IMG_WIDTH', 196 );
define( 'KKW_SMALL_FEATURED_IMG_HEIGHT', 96 );
define( 'KKW_BLOG_SECTION_TEXT_MAX_SIZE', 256 );
define( 'KKW_BLOG_SECTION_IMG_WIDTH', 354 );
define( 'KKW_BLOG_SECTION_IMG_HEIGHT', 122 );