<?php
/**
 * KKW Writer Theme: Theme plugin dependencies registration.
 *
 * Registers required and suggested plugins via TGM Plugin Activation.
 *
 * @package KK_Writer_Theme
 */

defined( 'ABSPATH' ) || exit;

require_once get_template_directory() . '/inc/vendor/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'kkw_register_required_plugins' );

/**
 * Register the suggested plugins for this theme via TGMPA.
 *
 * Plugin list is defined in SUGGESTED_PLUGINS (config-theme.php).
 * Hooked into `tgmpa_register` (fired on WP `init`, priority 10).
 *
 * @return void
 */
function kkw_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = SUGGESTED_PLUGINS;

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'kk_writer_theme',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'parent_slug'  => 'themes.php',
		// Parent menu slug.
		'capability'   => 'edit_theme_options',
		// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
