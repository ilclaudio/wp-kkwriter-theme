<?php
/**
 * KK Writer Theme: Theme menu configuration constants.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KK_Writer_Theme
 */

// Sections of the site.
define(
	'KKW_POETRY_SECTION',
	array(
		'slug'    => 'poetry',
		'title'   => 'Poetry',
		'en'      => 'Poetry',
		'it'      => 'Poesia',
		'title_x' => 'Poetry',
	)
);
define(
	'KKW_ESSAYS_SECTION',
	array(
		'slug'    => 'essays',
		'title'   => 'Essays',
		'en'      => 'Essays',
		'it'      => 'Saggi',
		'title_x' => 'Essays',
	)
);
define(
	'KKW_FICTION_SECTION',
	array(
		'slug'    => 'fiction',
		'title'   => 'Fiction',
		'en'      => 'Fiction',
		'it'      => 'Narrativa',
		'title_x' => 'Fiction',
	)
);

define(
	'KKW_SITE_SECTIONS',
	array(
		KKW_POETRY_SECTION,
		KKW_ESSAYS_SECTION,
		KKW_FICTION_SECTION,
	)
);

// Groups of the blog post.
define(
	'KKW_ARTICLE_GROUP',
	array(
		'slug'       => 'article',
		'title'      => 'Article',
		'title-pl'   => 'Articles',
		'slug-x'     => 'article',
		'title-x'    => 'Article',
		'title-pl-x' => 'Articles',
	)
);
define(
	'KKW_EVENT_GROUP',
	array(
		'slug'       => 'event',
		'title'      => 'Event',
		'title-pl'   => 'Events',
		'slug-x'     => 'event',
		'title-x'    => 'Event',
		'title-pl-x' => 'Events',
	)
);
define(
	'KKW_NEWS_GROUP',
	array(
		'slug'       => 'news',
		'title'      => 'News',
		'title-pl'   => 'News',
		'slug-x'     => 'news',
		'title-x'    => 'News',
		'title-pl-x' => 'News',
	)
);
define(
	'KKW_POST_GROUPS',
	array(
		KKW_ARTICLE_GROUP,
		KKW_EVENT_GROUP,
		KKW_NEWS_GROUP,
	)
);

define(
	'KKW_MAIN_MENU_NAME',
	'Main Menu',
);
define(
	'KKW_MAIN_MENU_NAME_X',
	'Main Menu',
);
define(
	'KKW_MAIN_MENU_LOCATION',
	'main-menu-location',
);


define(
	'KKW_PRIMARY_FOOTER_MENU_NAME',
	'Primary Footer Menu',
);
define(
	'KKW_PRIMARY_FOOTER_MENU_NAME_X',
	'Primary Footer Menu',
);
define(
	'KKW_PRIMARY_FOOTER_MENU_LOCATION',
	'primary-footer-location',
);

define(
	'KKW_SECONDARY_FOOTER_MENU_NAME',
	'Secondary Footer Menu',
);
define(
	'KKW_SECONDARY_FOOTER_MENU_NAME_X',
	'Secondary Footer Menu',
);
define(
	'KKW_SECONDARY_FOOTER_MENU_LOCATION',
	'secondary-footer-location',
);


define(
	'KKW_MAIN_MENU_EN',
	array(
		'name'     => KKW_MAIN_MENU_NAME,
		'location' => KKW_MAIN_MENU_LOCATION,
		'items'    => array(
			array(
				'slug'         => 'home',
				'title'        => 'Home',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => get_home_url(),
			),
			array(
				'slug'         => 'biography',
				'title'        => 'Biography',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'poetry',
				'title'        => 'Poetry',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'essays',
				'title'        => 'Essays',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'fiction',
				'title'        => 'Fiction',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'blog',
				'title'        => 'Blog',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'contacts',
				'title'        => 'Contacts',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
		),
	),
);

define(
	'KKW_PRIMARY_FOOTER_MENU_EN',
	array(
		'name'     => KKW_PRIMARY_FOOTER_MENU_NAME,
		'location' => KKW_PRIMARY_FOOTER_MENU_LOCATION,
		'items'    => array(
			array(
				'slug'         => SLUG_SEARCH_SITE_EN,
				'title'        => 'Site search',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'biography',
				'title'        => 'Biography',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'blog',
				'title'        => 'Blog',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'contacts',
				'title'        => 'Contacts',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
		),
	),
);

define(
	'KKW_SECONDARY_FOOTER_MENU_EN',
	array(
		'name'     => KKW_SECONDARY_FOOTER_MENU_NAME,
		'location' => KKW_SECONDARY_FOOTER_MENU_LOCATION,
		'items'    => array(
			array(
				'slug'         => 'site-map',
				'title'        => 'Sitemap',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'privacy',
				'title'        => 'Privacy',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'cookies-policy',
				'title'        => 'Cookies Policy',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => 'credits',
				'title'        => 'Credits',
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'link'         => '',
			),
			array(
				'slug'         => '',
				'title'        => 'Example',
				'content_type' => '',
				'post_type'    => '',
				'status'       => 'publish',
				'link'         => 'https://developers.italia.it/it/software/sns_pi-scuolanormalesuperiore-design-laboratori-wordpress-theme',
			),
		),
	),
);

/**
 *  This feature is used so that translation plugins like Loco Translate
 *  can automatically extract these tags from the theme to translate.
 *
 *  @TODO: Check if it is possible to remove these duplications.
 */
if ( ! function_exists( 'kkw_translate_data' ) ) {
	/**
	 * Return translatable activation labels for static and archive pages.
	 *
	 * @return array<string, string>
	 */
	function kkw_translate_data() {
		// Standard pages.
		return array(
			'Biography'      => __( 'Biography', 'kk_writer_theme' ),
			'Poetry'         => __( 'Poetry', 'kk_writer_theme' ),
			'Essays'         => __( 'Essays', 'kk_writer_theme' ),
			'Blog'           => __( 'Blog', 'kk_writer_theme' ),
			'Contacts'       => __( 'Contacts', 'kk_writer_theme' ),
			'Credits'        => __( 'Credits', 'kk_writer_theme' ),
			'Site search'    => __( 'Site search', 'kk_writer_theme' ),
			'Sitemap'        => __( 'Sitemap', 'kk_writer_theme' ),
			'Privacy'        => __( 'Privacy', 'kk_writer_theme' ),
			'Cookies Policy' => __( 'Cookies Policy', 'kk_writer_theme' ),
			'Example'        => __( 'Example', 'kk_writer_theme' ),
			'News'           => __( 'News', 'kk_writer_theme' ),
			'Events'         => __( 'Events', 'kk_writer_theme' ),
			'Fiction'        => __( 'Fiction', 'kk_writer_theme' ),
		);
	}
}
