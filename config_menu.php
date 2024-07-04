<?php

/**
 * KK Writer Theme: Theme menu configuration constants.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package KK_Writer_Theme
 */

 define(
	'KKW_MAIN_MENU',
	array(
		'name'     => 'Header Main Menu',
		'location' => 'main-menu-location',
		'items'    => array(
			array(
				'slug'         => 'home',
				'title'        => 'Home',
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
