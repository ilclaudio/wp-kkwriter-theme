<?php
/**
 * Hooks to add activation link nad functions.
 *
 * @package KK_Writer_Theme
 */


/**
 * Creation of the link to load default theme data: Reload default theme data.
 * WP->Appearance->Reload theme data.
 *
 * @return void
 */
function kkw_add_update_theme_page() {
	add_theme_page(
		esc_html__( 'Reload theme data', 'kk_writer_theme'),
		esc_html__( 'Reload theme data', 'kk_writer_theme'),
		'edit_theme_options',
		'reload-data-theme-options',
		'kkw_reload_theme_default_data'
	);
}
add_action( 'admin_menu', 'kkw_add_update_theme_page' );


/**
 * Page with the button to reload default data.
 * WP->Appearance->Reload theme data.
 *
 * @return void
 */
function kkw_reload_theme_default_data() {
	$is_reload  = false;
	$result_ok  = false;
	if ( isset( $_GET['action'] ) && $_GET['action'] === 'reload' ){
		// kkw_create_pages_on_theme_activation();
		$activator = new KKW_ThemeActivationManager();
		$result_ok = $activator->initialize_theme();
		$is_reload = true;
	}

	echo "<div id='kkw_reload_theme_data'>";
	echo '<h1>' . esc_html__( 'Reload default data', 'kk_writer_theme' ) . '</h1>';
	echo '<div id="kkw_reload_theme_data_body">';
	echo '<div id="kkw_reload_theme_data_button"><a href="themes.php?page=reload-data-theme-options&action=reload" class="button button-primary">' .
		esc_html__( 'Reloads theme activation data (menus, pages, taxonomies, etc.)', 'kk_writer_theme' ) . '</a></div>';

	if ( $is_reload && $result_ok ) {
		echo '<div id="kkw_admin_result_reload"><em>' . esc_html__( 'Data reloaded successfully', 'kk_writer_theme') . '</em></div>';
	}
	if ( $is_reload && ! $result_ok ) {
		echo '<div id="kkw_admin_result_reload"><em>' . esc_html__( 'Error reloading data', 'kk_writer_theme') . '</em></div>';
	}
	echo '</div>';
	echo '</div>';
}
