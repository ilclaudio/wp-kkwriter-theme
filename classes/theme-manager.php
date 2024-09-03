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
	include_once 'theme-lang-manager.php';
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

		// Set the permalink mode.
		$this->configure_permalink();

		// Set the robots meta tag.
		$this->configure_custom_robots();

		// Create ICS feed.
		$this->create_ics_feed();

		// Disable XMLRPC.
		$this->disable_xmlrpc();

		// Security configurations.
		$this->enable_security_configurations();

		// Setup roles and permissions.
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
	
	private function configure_custom_robots() {
		add_filter( 'wp_robots', array( $this, 'get_robots_head' ) );
	}

	public function get_robots_head(){
		$robots['index'] = true;
		$robots['follow'] = true;
		$robots['max-image-preview'] = 'large';
		$robots['max-snippet'] = '-1';
		$robots['max-video-preview'] = '-1';
		return $robots;
	}

	private function create_ics_feed(){
		// This adds a feed http://example.com/?feed=ics.
		add_feed( 'ics', array( $this, 'download_ics_file_by_id' ) );
	}

	public function download_ics_file_by_id(){
		$eid = filter_input( INPUT_GET, 'eid', FILTER_VALIDATE_INT );
		KKW_ContentsManager::download_ics_file_by_id( $eid );
		exit(0);
	}

	private function disable_xmlrpc() {
		if ( kkw_get_option( 'xmlrpc_api_enabled', 'kkw_opt_advanced_settings' ) === 'false' ) {
			add_filter('xmlrpc_enabled', '__return_false');
		}
	}

	private function enable_security_configurations() {
		add_filter( 'the_generator', '__return_null' );
		// Hook per nascondere sovrascrivere il messaggio di errore in fase di login.
		add_filter( 'login_errors', function( $message ){
				return __( 'Invalid username or password', 'kk_writer_theme' );
			}
		);
	}

}
