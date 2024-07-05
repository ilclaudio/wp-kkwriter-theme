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

if ( ! class_exists( 'KKW_ThemeActivationManager' ) ) {
	include_once 'theme-activation-manager.php';
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

		// Disable customizer.
		$this->disable_customizer();

		// Setup roles and permissions
		$am = new KKW_AuthorizationManager();
		$am->setup();

		// Setup dei post type personalizzati e delle tassonomie associate.
		// Setup di Polylang.
		$polylang = new KKW_PolylangManager();
		$polylang->setup();

		// Register the menus.
		KKW_ThemeActivationManager::register_menu_locations();

		// Needed to refresh permalinks.
		// Same as: Admin->Settings->Permalinks->Save.
		flush_rewrite_rules();
	}

	private function disable_customizer() {
		add_action( 'admin_menu', array( $this, 'disable_customizer_menu' ) );
	}
	public function disable_customizer_menu() {
		global $submenu;
		if ( isset( $submenu[ 'themes.php' ] ) ) {
			foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
				foreach ( $menu_item as $value ) {
					if ( strpos( $value,'customize' ) !== false) {
							unset( $submenu['themes.php'][ $index ] );
					}
				}
			}
		}
	}

}
