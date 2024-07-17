<?php

/**
 * KK Writer Theme: Theme menu configuration constants.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package KK_Writer_Theme
 */

 define(
	'KKW_MAIN_MENU_NAME',
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
	'KKW_PRIMARY_FOOTER_MENU_LOCATION',
	'primary-footer-location',
);

define(
	'KKW_SECONDARY_FOOTER_MENU_NAME',
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
				'title'        => 'Site Search',
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