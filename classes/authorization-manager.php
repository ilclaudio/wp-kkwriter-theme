<?php
/**
 * Definition of the Authorization Manager.
 *
 * @package @package WP_KK_Writer_Plugin
 */


class KKW_AuthorizationManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	public function setup(){
		// Register custom roles.
		add_action( 'init', array( $this, 'add_super_editor' ) );
	}

	public function add_super_editor(){
		// Get the base role (Editor).
		$base_role = get_role( 'editor' );
		// Check if the role exists.
		if ( $base_role ) {

			// Add a new role based on the Editor role, if not exists.
			$new_role = get_role( KKW_SUPER_EDITOR_ROLE_SLUG );
			if ( ! $new_role ){
				$new_role = add_role( KKW_SUPER_EDITOR_ROLE_SLUG, KKW_SUPER_EDITOR_ROLE_NAME, $base_role->capabilities );
			}

			// Assign the new role the permission to modify the theme and the site's menu (Appearance section of the back-office).
			$new_role->add_cap( 'edit_theme_options' );
			// Assign the permission to modify the configurations of the theme to the new role.
			$new_role->add_cap( KKW_EDIT_CONFIG_PERMISSION );

			// Assign the permission to modify the theme configurations  to the site administrator.
			$admin_role = get_role( 'administrator' );
			if ( $admin_role ){
				$admin_role->add_cap( KKW_EDIT_CONFIG_PERMISSION );
			}
		}
	}

}
