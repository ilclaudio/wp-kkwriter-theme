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

		// Check if is the first installation.
		$kkw_has_installed = get_option( 'kkw_has_installed' );

		// Check the dependencies: without Polylang you can't activate the theme.
		if ( ! function_exists( 'pll_the_languages' ) ) {
			$msg = 'The plugin Polylang  is missing, please install and activate it: https://wordpress.org/plugins/polylang/';
			return false;
		}

		// Create the sections of the site.
		$this->create_default_sections();
		// Create a page for each section.
		$this->create_section_pages();
	
		// global $wp_rewrite;
		// $wp_rewrite->init(); // important...
		// $wp_rewrite->set_tag_base( 'argomento' );
		// $wp_rewrite->flush_rules();

		// Set installation executed.
		update_option( 'kkw_has_installed', true );
		
		return $result;
	}

/**
 * Create default sections (if not already exist).
 *
 * @return void
 */
	private function create_default_sections() {
		$taxonomy = KKW_SECTION_TAXONOMY;
		$terms    = KKW_SITE_SECTIONS;
		$this->build_taxonomies( $taxonomy, $terms );
	}

	private function create_section_pages() {
		error_log( '@@@ create_section_pages @@@' );
	}

	/**
	 * Build the taxonomies: create a taxonomy if not exists.
	 *
	 * @return void
	 */
	private function build_taxonomies( $taxonomy, $terms ) {
		foreach ( $terms as $term ) {
			// Create it taxonomy.
			$termitem = get_term_by( 'slug', $term['it'], $taxonomy );
			if ( $termitem ) {
				$term_it = $termitem->term_id;
			} else {
				$termobject = wp_insert_term( $term['it'], $taxonomy );
				$term_it    = $termobject['term_id'];
			}
			kkw_set_term_language( $term_it, 'it' );
			// Create en taxonomy.
			$termitem = get_term_by( 'slug', $term['en'], $taxonomy );
			if ( $termitem ) {
				$term_en = $termitem->term_id;
			} else {
				$termobject = wp_insert_term( $term['en'], $taxonomy );
				$term_en    = $termobject['term_id'];
			}
			kkw_set_term_language( $term_en, 'en' );
			// Associate it and en translations.
			$related_taxonomies = array(
				'it' => $term_it,
				'en' => $term_en,
			);
			kkw_save_term_translations( $related_taxonomies );
		}
	}

}
