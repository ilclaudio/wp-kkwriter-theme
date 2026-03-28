<?php
/**
 * KK Writer Theme: Authorization manager.
 *
 * @package KK_Writer_Theme
 */

/**
 * Manage custom roles and authorization capabilities.
 */
class KKW_AuthorizationManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Register authorization hooks.
	 *
	 * @return void
	 */
	public function setup() {
		// Register custom roles.
		add_action( 'init', array( $this, 'add_super_editor' ) );
	}

	/**
	 * Add the custom super editor role and capabilities.
	 *
	 * @return void
	 */
	public function add_super_editor() {
		// Get the base role (Editor).
		$kkw_base_role = get_role( 'editor' );
		if ( ! $kkw_base_role ) {
			return;
		}

		// Add a new role based on the Editor role, if not exists.
		$kkw_new_role = get_role( KKW_SUPER_EDITOR_ROLE_SLUG );
		if ( ! $kkw_new_role ) {
			$kkw_new_role = add_role( KKW_SUPER_EDITOR_ROLE_SLUG, KKW_SUPER_EDITOR_ROLE_NAME, $kkw_base_role->capabilities );
		}

		if ( $kkw_new_role ) {
			// Allow the role to modify menus and theme options.
			$kkw_new_role->add_cap( 'edit_theme_options' );
			// Assign the permission to modify the configurations of the theme to the new role.
			$kkw_new_role->add_cap( KKW_EDIT_CONFIG_PERMISSION );
		}

		// Assign the permission to modify the theme configurations to the site administrator.
		$kkw_admin_role = get_role( 'administrator' );
		if ( $kkw_admin_role ) {
			$kkw_admin_role->add_cap( KKW_EDIT_CONFIG_PERMISSION );
		}
	}
}
