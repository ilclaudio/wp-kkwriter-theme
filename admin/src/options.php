<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */

 if ( ! class_exists( 'KKW_ThemeOptionsManager' ) ) {
	include_once KKW_THEMA_PATH . '/classes/options-manager.php';
}

function kkw_register_main_options_metabox()
{
	$prefix      = 'kkw_';
	$tab_group   = 'kkw_options';
	// $parent_slug = 'kkw_options';
	$capability  = 'manage_options';

	$opt_manager = new KKW_ThemeOptionsManager();
	// 1 - Registers options page "Base options".
	$opt_manager->add_opt_base_option( $prefix, 'kkw_opt_options', $tab_group, $capability );
	// 2 - Registers options page "Home Messages".
	$opt_manager->add_opt_home_messages( $prefix, 'kkw_opt_hp_messages', $tab_group, $capability );
	// 3 - Registers options page "Home Page Layout".
	$opt_manager->add_opt_hp_layout( $prefix, 'kkw_opt_hp_layout', $tab_group, $capability );
	// 4 - Registers options page "Site Contacts".
	$opt_manager->add_opt_site_contacts( $prefix, 'kkw_opt_site_contacts', $tab_group, $capability );
	// 5 - Registers options page "Social media".
	$opt_manager->add_opt_social_media( $prefix, 'kkw_opt_social_media', $tab_group, $capability );
	// 6 - Registers options page "Advanced settings".
	$opt_manager->add_opt_advanced_settings( $prefix, 'kkw_opt_advanced_settings', $tab_group, $capability );
}
add_action( 'cmb2_admin_init', 'kkw_register_main_options_metabox' );

function kkw_options_assets()
{
		$current_screen = get_current_screen();
		if(strpos($current_screen->id, 'configurazione_page_') !== false || $current_screen->id === 'toplevel_page_kkw_options') {
				wp_enqueue_style( 'kkw_options_dialog', get_stylesheet_directory_uri() . '/admin/css/jquery-ui.css' );
				wp_enqueue_script( 'kkw_options_dialog', get_stylesheet_directory_uri() . '/admin/js/options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), '1.0', true );
		}
}
add_action( 'admin_enqueue_scripts', 'kkw_options_assets' );
