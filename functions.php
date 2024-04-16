<?php
/**
 * KK Writer Theme: Functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KK_Writer_Theme
 */


/**
 * Define the theme parameters and configurations.
 */
require get_template_directory() . '/config_theme.php';

/**
 * Implement Plugin Activations Rules.
 */
require get_template_directory() . '/inc/theme-dependencies.php';

/**
 * Warappers functions fo Polylang.
 */
require get_template_directory() . '/inc/wrappers_polylang.php';



if ( ! function_exists( 'kkw_setup' ) ) {
	function kkw_load_scripts_and_styles()
	{
		// Add bootstrap files.
		wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap-css' );
		wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'bootstrap-js' );

		// Add custom styles.
		wp_register_style( 'kkwritertheme_main_styles', get_template_directory_uri() . '/assets/custom/css/main.css' );
		wp_enqueue_style( 'kkwritertheme_main_styles' );
	}
	add_action( 'wp_enqueue_scripts', 'kkw_load_scripts_and_styles' );
}

if ( ! function_exists( 'kkw_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kkw_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Design Laboratori Italia, use a find and replace
		 * to change 'kk_writer_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kk_writer_theme', get_template_directory() . '/languages' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		// Image size.
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'item-thumb', 280, 280 , true );
			add_image_size( 'featured-post', 200, 248 , true );
			add_image_size( 'small-featured', 196, 96 , true );
			// add_image_size( 'item-gallery', 730, 485 , true );
			// add_image_size( 'item-hero-event', 418, 130 , true );
			// add_image_size( 'item-card-list', 416, 232 , true );
			// add_image_size( 'item-carousel', 592, 334 , true );
			// add_image_size( 'banner', 600, 250 , false );
		}

	}
}
add_action( 'after_setup_theme', 'kkw_setup' );