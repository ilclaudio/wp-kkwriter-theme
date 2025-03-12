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
 * Activation Hooks.
 */
require get_template_directory() . '/activation.php';

/**
 * Implement Plugin Activations Rules.
 */
require get_template_directory() . '/inc/theme-dependencies.php';


/**
 * Import the utils functions.
 */
require get_template_directory() . '/inc/utils.php';

/**
 * Import the Contents Manager.
 */
if ( ! class_exists( 'KKW_ContentsManager' ) ) {
	require get_template_directory() . '/classes/contents-manager.php';
}

/**
 * Import the Navigation Manager.
 */
if ( ! class_exists( 'KKW_NavigationManager' ) ) {
	require get_template_directory() . '/classes/navigation-manager.php';
}

/**
 * Import the Theme Activator Manager.
 */
if ( ! class_exists( 'KKW_ThemeActivationManager' ) ) {
	include_once KKW_THEMA_PATH . '/classes/theme-activation-manager.php';
}

/**
 * Import the Options Manager.
 */
if ( ! class_exists( 'KKW_ThemeOptionsManager' ) ) {
	include_once KKW_THEMA_PATH . '/classes/options-manager.php';
}


if ( ! function_exists( 'kkw_load_scripts_and_styles' ) ) {
	function kkw_load_scripts_and_styles()
	{
		// Import Popper JS library files used by bootstrap.
		wp_register_script( 'popper-js', get_template_directory_uri() . '/assets/bootstrap/js/popper.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'popper-js' );

		// Import Bootstrap files (CSS & JS).
		wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/assets/custom/css/custom-bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap-css' );
		wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery', 'popper-js' ), '', true );
		wp_enqueue_script( 'bootstrap-js' );

		// Import FontAwesome fonts.
		wp_register_style( 'fontawesome-css', get_template_directory_uri() . '/assets/fontawesome/css/fontawesome.min.css' );
		wp_enqueue_style( 'fontawesome-css' );
		wp_register_style( 'fontawesome-brands-css', get_template_directory_uri() . '/assets/fontawesome/css/brands.min.css' );
		wp_enqueue_style( 'fontawesome-brands-css' );
		wp_register_style( 'fontawesome-solid-css', get_template_directory_uri() . '/assets/fontawesome/css/solid.min.css' );
		wp_enqueue_style( 'fontawesome-solid-css' );

		// Import Lightbox stuff
		wp_register_style( 'lightbox-css', get_template_directory_uri() . '/assets/lightbox/css/lightbox.min.css' );
		wp_enqueue_style( 'lightbox-css' );
		wp_register_script( 'lightbox-js', get_template_directory_uri() . '/assets/lightbox/js/lightbox.min.js', array( 'jquery'), '', true );
		wp_enqueue_script( 'lightbox-js' );

		// Import CUSTOM styles.
		wp_register_style( 'kkwritertheme_main_styles', get_template_directory_uri() . '/assets/custom/css/main.css' );
		wp_enqueue_style( 'kkwritertheme_main_styles' );

		// Import CUSTOM fonts.
		wp_register_style( 'fonts-css', get_template_directory_uri() . '/assets/custom/css/fonts.css' );
		wp_enqueue_style( 'fonts-css' );

		// Import CUSTOM javascript.
		wp_register_script( 'kkw-js', get_template_directory_uri() . '/assets/custom/js/main.js', array( 'jquery', 'bootstrap-js', 'popper-js' ), '', true );
		wp_enqueue_script( 'kkw-js' );
	}
	add_action( 'wp_enqueue_scripts', 'kkw_load_scripts_and_styles' );
}

if ( ! function_exists( 'kkw_enqueue_admin_custom_css' ) ) {
	function kkw_enqueue_admin_custom_css(){
		wp_register_style( 'kkwritertheme_admin_styles', get_template_directory_uri() . '/assets/custom/css/admin.css' );
		wp_enqueue_style( 'kkwritertheme_admin_styles' );
	}
	add_action( 'admin_enqueue_scripts', 'kkw_enqueue_admin_custom_css' );
}

/* Tabs defined in single-kkw_book */
if ( ! function_exists( 'kkw_enqueue_js_variables' ) ) {
	function kkw_enqueue_js_variables() {
		// Define the variable that must be passed to javascript.
		$wp_menu_tabs = array( '#nav-info', '#nav-reviews', '#nav-excerpts', '#nav-tracks', );
		// Pass the variable using wp_localize_script.
		wp_localize_script( 'kkw-js', 'wpMenuTabs', $wp_menu_tabs );
	} 
	add_action( 'wp_enqueue_scripts', 'kkw_enqueue_js_variables' );
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
			add_image_size( 'item-thumb', KKW_THUMBNAIL_IMG_WIDTH, KKW_THUMBNAIL_IMG_HEIGHT , true );
			add_image_size( 'item-search', KKW_SEARCH_RESULTS_IMG_WIDTH, KKW_SEARCH_RESULTS_IMG_HEIGHT , true );
			add_image_size( 'featured-post', KKW_FEATURED_IMG_WIDTH, KKW_FEATURED_IMG_HEIGHT , true );
			add_image_size( 'small-featured', KKW_SMALL_FEATURED_IMG_WIDTH, KKW_SMALL_FEATURED_IMG_HEIGHT , true );
			add_image_size( 'blog-section', KKW_BLOG_SECTION_IMG_WIDTH, KKW_BLOG_SECTION_IMG_HEIGHT , true );
		}

	}
	add_action( 'after_setup_theme', 'kkw_setup' );
}



// @TODO: Move here all the above the configurations in an "object oriented" way.

////// SETUP THE THEME //////
if ( ! class_exists( 'KKW_ThemeManager' ) ) {
	include_once 'classes/theme-manager.php';
	global $theme_manager;
	$theme_manager = new KKW_ThemeManager();
	$theme_manager->theme_setup();
}
