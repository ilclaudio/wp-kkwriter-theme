<?php
/**
 * Definition of the Theme Manager.
 *
 * @package KK_Writer_Theme
 */

if ( ! class_exists( 'KKW_AuthorizationManager' ) ) {
	include_once 'authorization-manager.php';
}

if ( ! class_exists( 'KKW_PolylangManager' ) ) {
	include_once 'polylang-manager.php';
}

/**
 * The manager that configures the theme.
 */
class KKW_ThemeManager {

	/**
	 * The static instance of the LabManager.
	 *
	 * @var object
	 */
	protected static $instance = null;


	/**
	 * Used to install and configure the theme.
	 *
	 * @return void
	 */
	public function theme_setup() {

		// Setup roles and permissions
		$am = new KKW_AuthorizationManager();
		$am->setup();

		// Setup dei post type personalizzati e delle tassonomie associate.
		// Setup di Polylang.
		$polylang = new KKW_PolylangManager();
		$polylang->setup();

		// Needed to refresh permalinks.
		// Same as: Admin->Settings->Permalinks->Save.
		flush_rewrite_rules();
	}
}
