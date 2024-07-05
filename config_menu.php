<?php

/**
 * KK Writer Theme: Theme menu configuration constants.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package KK_Writer_Theme
 */

 define(
	'KKW_MAIN_MENU_EN',
	array(
		'name'     => 'Main Menu',
		'location' => 'main-menu-location',
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

// define(
// 	'KKW_MAIN_MENU_IT',
// 	array(
// 		'name'     => 'Menu Principale',
// 		'location' => 'main-menu-location',
// 		'items'    => array(
// 			array(
// 				'slug'         => 'home',
// 				'title'        => 'Home',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => get_home_url(),
// 			),
// 			array(
// 				'slug'         => 'biografia',
// 				'title'        => 'Biography',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 			array(
// 				'slug'         => 'poesia',
// 				'title'        => 'Poesia',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 			array(
// 				'slug'         => 'saggi',
// 				'title'        => 'Saggi',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 			array(
// 				'slug'         => 'narrativa',
// 				'title'        => 'Narrativa',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 			array(
// 				'slug'         => 'blog',
// 				'title'        => 'Blog',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 			array(
// 				'slug'         => 'contatti',
// 				'title'        => 'Contatti',
// 				'content_type' => 'page',
// 				'post_type'    => 'post_type',
// 				'status'       => 'publish',
// 				'link'         => '',
// 			),
// 		),
// 	),
// );
