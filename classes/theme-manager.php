<?php
/**
 * Definition of the Theme Manager.
 *
 * @package KK_Writer_Theme
 */

if ( ! class_exists( 'KKW_AuthorizationManager' ) ) {
	include_once 'authorization-manager.php';
}

if ( ! class_exists( 'KKW_ThemeLangManager' ) ) {
	include_once 'multi-lang-manager.php';
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
		$this->configure_customizer();

		// Set the permalink mode;
		$this->configure_permalink();

		// Setup roles and permissions
		$am = new KKW_AuthorizationManager();
		$am->setup();

		// Setup custom post types and associated taxonomies.
		// Multi language setup (Polylang).
		$multi_lang = new KKW_ThemeLangManager();
		$multi_lang->setup();

		// Register the menus.
		KKW_ThemeActivationManager::register_menu_locations();

		// Needed to refresh permalinks.
		// Same as: Admin->Settings->Permalinks->Save.
		flush_rewrite_rules();
	}

	private function configure_customizer() {
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

	private function configure_permalink() {
		add_action( 'after_setup_theme', array( $this, 'set_permalink_mode' ) );
	}

	public function set_permalink_mode(){
		$permalink_structure = '/%postname%/';
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure($permalink_structure);
		$wp_rewrite->flush_rules();
	}

}
