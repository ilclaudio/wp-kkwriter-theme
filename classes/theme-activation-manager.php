<?php
/**
 * KK Writer Theme: Activation Manager definition.
 *
 * @package KK_Writer_Theme
 */

require_once 'polylang-manager.php';
require_once KKW_THEMA_PATH . '/config_menu.php';

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
		// If the page doesn't already exist, create it.
		if ( ! $new_page_id ) {
			$new_page_id = wp_insert_post( $new_page );
			update_post_meta( $new_page_id, '_wp_page_template', $template );
		}
		// Assign the $lang language to the page.
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
			// Create en taxonomy.
			$termitem = get_term_by( 'slug', $term['en'], $taxonomy );
			if ( $termitem ) {
				$term_en = $termitem->term_id;
			} else {
				$termobject = wp_insert_term( $term['en'], $taxonomy );
				$term_en    = $termobject['term_id'];
			}
			KKW_PolylangManager::set_term_language( $term_en, 'en' );
			// Create it taxonomy.
			$termitem = get_term_by( 'slug', $term['it'], $taxonomy );
			if ( $termitem ) {
				$term_it = $termitem->term_id;
			} else {
				$termobject = wp_insert_term( $term['it'], $taxonomy );
				$term_it    = $termobject['term_id'];
			}
			KKW_PolylangManager::set_term_language( $term_it, 'it' );

			// Associate it and en translations.
			$related_taxonomies = array(
				'it' => $term_it,
				'en' => $term_en,
			);
			KKW_PolylangManager::save_term_translations( $related_taxonomies );
		}
	}


	private function create_menu() {
		// $languages = KKW_PolylangManager::get_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );
		$this->create_the_menus( 'en' );
		// $this->create_the_menus( 'it' );
	}
	private function create_the_menus( $lang ) {
		$menu = KKW_MAIN_MENU_EN;
		// if ( $lang == 'en' ) {
		// 	$menu = KKW_MAIN_MENU_EN;
		// } else {
		// 	$menu = KKW_MAIN_MENU_IT;
		// }
		$this->build_the_menu( $menu, $lang );
	}

	private function build_the_menu( $menu, $lang ) {
		error_log( '@@@ build_the_menu @@@' );
		$menu_name     = $menu['name'];
		$menu_items    = $menu['items'];
		$menu_location = $menu['location'];
		$menu_object   = wp_get_nav_menu_object( $menu_name );
		// $menu_suffix   = $lang;
		// $menu_lang     = $lang;
		// $menu_location = $menu_location . '___' . $menu_suffix;

		if ( $menu_object ) {
			// Do nothing if the menu exists.
			$menu_id = $menu_object->term_id;
			$menu    = get_term_by( 'id', $menu_id, 'nav_menu' );
		} else {
			$menu_id  = wp_create_nav_menu( $menu_name );
			$menu     = get_term_by( 'id', $menu_id, 'nav_menu' );
			foreach ( $menu_items as $menu_item ) {
				if ( ( ! isset( $menu_item['link'] ) ) || ( '' === $menu_item['link'] ) ) {
					// Link a pagine o post.
					$result = kkw_get_content( $menu_item['slug'], $menu_item['content_type'] );
					if ( $result ) {
						$menu_item_id = $result->ID;
						wp_update_nav_menu_item(
							$menu->term_id,
							0,
							array(
								'menu-item-title'     => $menu_item['title'],
								'menu-item-object-id' => $menu_item_id,
								'menu-item-object'    => $menu_item['content_type'],
								'menu-item-status'    => $menu_item['status'],
								'menu-item-type'      => $menu_item['post_type'],
								'menu-item-url'       => $menu_item['link'],
							)
						);
					}
				} else {
					// Link esterni.
					wp_update_nav_menu_item(
						$menu->term_id,
						0,
						array(
							'menu-item-title'     => $menu_item['title'],
							'menu-item-status'    => $menu_item['status'],
							'menu-item-url'       => $menu_item['link'],
						)
					);
				}
			}
			$locations_primary_arr                   = get_theme_mod( 'nav_menu_locations' );
			$locations_primary_arr[ $menu_location ] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations_primary_arr );
			update_option( 'menu_check', true );
		}
	}

	/**
	 * This theme uses wp_nav_menu().
	 * Menu location definitions: wp-admin/nav-menus.php?action=locations.
	 *
	 * @return void
	 */
	public static function register_menu_locations() {
		error_log( '@@@ HERE WE REGISTER THE MENU POSITIONS @@@' );
		register_nav_menus(
			array(
				KKW_MAIN_MENU_EN['location'] => KKW_MAIN_MENU_EN['name'],
				'primary-footer-location'    => 'Primary Footer',
				'secondary-footer-location'  => 'Secondary Footer',
			)
		);
	}

}
