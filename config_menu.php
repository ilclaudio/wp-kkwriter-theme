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
		'title_x' => __ ( 'Poetry', 'kk_writer_theme' ),
	)
);
define(
	'KKW_ESSAYS_SECTION',
	array(
		'slug'    => 'essays',
		'title'   => 'Essays',
		'title_x' => __ ( 'Essays', 'kk_writer_theme' ),
	)
);
define(
	'KKW_FICTION_SECTION',
	array(
		'slug'    => 'fiction',
		'title'   => 'Fiction',
		'title_x' => __ ( 'Fiction', 'kk_writer_theme' ),
	)
);

define(
	'KKW_SITE_SECTIONS',
	array(
		KKW_POETRY_SECTION,
		KKW_POETRY_SECTION,
		KKW_FICTION_SECTION
	)
);

// Groups of the blog post.
define(
	'KKW_ARTICLE_GROUP',
	array(
		'slug'       => 'article',
		'title'      => 'Article',
		'title-pl'   => 'Articles',
		'slug-x'     => __ ( 'article', 'kk_writer_theme' ),
		'title-x'    => __ ( 'Article', 'kk_writer_theme' ),
		'title-pl-x' => __ ( 'Articles', 'kk_writer_theme' ),
	)
);
define(
	'KKW_EVENT_GROUP',
	array(
		'slug'       => 'event',
		'title'      => 'Event',
		'title-pl'   => 'Events',
		'slug-x'     => __ ( 'event', 'kk_writer_theme' ),
		'title-x'    => __ ( 'Event', 'kk_writer_theme' ),
		'title-pl-x' => __ ( 'Events', 'kk_writer_theme' ),
	)
);
define(
	'KKW_NEWS_GROUP',
	array(
		'slug'       => 'news',
		'title'      => 'News',
		'title-pl'   => 'News',
		'slug-x'     => __ ( 'news', 'kk_writer_theme' ),
		'title-x'    => __ ( 'News', 'kk_writer_theme' ),
		'title-pl-x' => __ ( 'News', 'kk_writer_theme' ),
	)
);
define( 'KKW_POST_GROUPS',
	array(
		KKW_ARTICLE_GROUP,
		KKW_EVENT_GROUP,
		KKW_NEWS_GROUP
	)
);

define(
	'KKW_MAIN_MENU_NAME',
	'Main Menu',
);
define(
	'KKW_MAIN_MENU_NAME_X',
	__( 'Main Menu', 'kk_writer_theme' ),
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
	__( 'Primary Footer Menu', 'kk_writer_theme' ),
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
	__( 'Secondary Footer Menu', 'kk_writer_theme' ),
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