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