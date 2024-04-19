<?php

/**
 * KK Writer Theme: Activation Manager definition.
 *
 * @package KK_Writer_Theme
 */

/**
 * The Activation manager.
 */
class KKW_ThemeActivationManager
{

	/**
	 * Initialize the theme.
	 *
	 * @return boolean
	 */
	public function initialize_theme()
	{
		$result = true;
	
		error_log( '@@@ INITIALIZA THEME' );

		// // Verifico se è una prima installazione.
		// $kkw_has_installed = get_option( 'kkw_has_installed' );

		// // Se non è installato Polylang non si può attivare il tema.
		// if ( ! function_exists( 'pll_the_languages' ) ) {
		// 	$msg = 'The plugin Polylang  is missing, please install and activate it: https://wordpress.org/plugins/polylang/';
		// 	return false;
		// }

		// Create the default pages.

		// Create the tipologia-persona entities.

		// Create all the menus of the site.

		// global $wp_rewrite;
		// $wp_rewrite->init(); // important...
		// $wp_rewrite->set_tag_base( 'argomento' );
		// $wp_rewrite->flush_rules();

		// update_option( 'kkw_has_installed', true );
		
		return $result;
	}



}
