<?php
/**
 * KK Writer Theme: Activation Manager definition.
 *
 * @package KK_Writer_Theme
 */

require_once 'polylang-manager.php';

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

		// Create the static pages of the site.
		$this->create_static_pages();
	
		// Create the menu.
		$this->create_menu();

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
 * @TODO: to be generalized to handle all languages.
 *
 * @return void
 */
	private function create_default_sections() {
		$taxonomy = KKW_SECTION_TAXONOMY;
		$terms    = KKW_SITE_SECTIONS;
		$this->build_taxonomies( $taxonomy, $terms );
	}

	/**
	 * Create a page for each section and each language.
	 *
	 * @return void
	 */
	private function create_section_pages() {
		error_log( '@@@ create_section_pages @@@' );
		// $languages    = KKW_PolylangManager::get_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );
		$sections = KKW_SITE_SECTIONS;
		foreach ( $sections as $section ) {
			$slug     = sanitize_title( $section['en'] );
			$template = 'page-templates/' . $slug . '.php';

			// Create the EN page.
			// Store the above data in an array.
			$new_page = array(
				'post_type'    => 'page',
				'post_name'    => $slug,
				'post_title'   => $section['en'],
				'post_content' => '',
				'post_status'  => 'publish',
				// 'post_author'  => 1,
				'post_parent'  => 0,
			);
			$new_page_en_id = $this->create_page( 
				$new_page, 
				$template,
				'en'
			);

			// Create the IT page.
			// Store the above data in an array.
			$slug     = sanitize_title( $section['it'] );
			$new_page = array(
				'post_type'    => 'page',
				'post_name'    => $slug,
				'post_title'   => $section['it'],
				'post_content' => '',
				'post_status'  => 'publish',
				// 'post_author'  => 1,
				'post_parent'  => 0,
			);
			$new_page_it_id = $this->create_page(
				$new_page,
				$template,
				'it'
			);


		// Associate it and en translations.
		$related_posts = array(
			'it' => $new_page_it_id,
			'en' => $new_page_en_id,
		);
		KKW_PolylangManager::save_post_translations( $related_posts );
		}
	}


/**
 * Create the static pages.
 * @TODO: to be generalized to handle all languages.
 *
 * @return void
 */
private function create_static_pages() {
	$static_pages = KKW_SITE_STATIC_PAGES;
	// $languages    = KKW_PolylangManager::get_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );

	// Static pages creation.
	foreach ( $static_pages as $page ) {
		// Create the IT page.
		// Store the above data in an array.
		$new_page = array(
			'post_type'    => $page['content_type'],
			'post_name'    => $page['content_slug_it'],
			'post_title'   => $page['content_title_it'],
			'post_content' => $page['content_it'],
			'post_status'  => $page['content_status'],
			'post_author'  => intval( $page['content_author'] ),
			'post_parent'  => 0,
		);
		$new_page_it_id = $this->create_page( 
			$new_page, 
			$page['content_template'],
			'it'
		);

		// Create the EN page.
		// Store the above data in an array.
		$new_page = array(
			'post_type'    => $page['content_type'],
			'post_name'    => $page['content_slug_en'],
			'post_title'   => $page['content_title_en'],
			'post_content' => $page['content_en'],
			'post_status'  => $page['content_status'],
			'post_author'  => intval( $page['content_author'] ),
			'post_parent'  => 0,
		);
		$new_page_en_id = $this->create_page( 
			$new_page, 
			$page['content_template'],
			'en'
		);

		// Associate it and en translations.
		$related_posts = array(
			'it' => $new_page_it_id,
			'en' => $new_page_en_id,
		);
		KKW_PolylangManager::save_post_translations( $related_posts );
		}
	}

	/**
	 * Create a page in the $lang language.
	 *
	 * @param array $new_page
	 * @param string $lang
	 * @return number
	 */
	private function create_page( $new_page, $template, $lang ){
		$page_check  = kkw_get_content( $new_page['post_name'], $new_page['post_type'] );
		$new_page_id = $page_check ? $page_check->ID : 0;
		// If the IT page doesn't already exist, create it.
		if ( ! $new_page_id ) {
			$new_page_id = wp_insert_post( $new_page );
			update_post_meta( $new_page_id, '_wp_page_template', $template );
		}
		// Assign the IT language to the page.
		KKW_PolylangManager::set_post_language( $new_page_id, $lang );
		return $new_page_id;
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
			KKW_PolylangManager::set_term_language( $term_it, 'it' );
			// Create en taxonomy.
			$termitem = get_term_by( 'slug', $term['en'], $taxonomy );
			if ( $termitem ) {
				$term_en = $termitem->term_id;
			} else {
				$termobject = wp_insert_term( $term['en'], $taxonomy );
				$term_en    = $termobject['term_id'];
			}
			KKW_PolylangManager::set_term_language( $term_en, 'en' );
			// Associate it and en translations.
			$related_taxonomies = array(
				'it' => $term_it,
				'en' => $term_en,
			);
			KKW_PolylangManager::save_term_translations( $related_taxonomies );
		}
	}


	private function create_menu(){
		$languages = KKW_PolylangManager::get_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );

	}

}
