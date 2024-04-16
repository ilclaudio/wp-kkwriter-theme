<?php
/**
 * Wrapper functions for POLYLANG.
 * 
 * The plugin used to translate post types and taxonomies is Polylang.
 * In the code instead of using the Polylang funcyions (e.g. "pll_current_language" )
 * please use the corresponding wrapped functions (e.g. "kkw_current_language" ).
 * 
 * This command verifies if the second language is enabled:
 * 
 * 	$selettore_visibile = kkw_get_option( 'selettore_lingua_visible', 'setup' );
 * 
 */


if ( ! function_exists( 'kkw_current_language' ) ) {
	/**
	 * Retrieves the default language of the site.
	 *
	 * @param string $type
	 * @return string
	 */
	function kkw_current_language( $type = 'slug' ) {
		$cl = pll_current_language( $type );
		return $cl ? $cl : KKW_DEFAULT_LANGUAGE;
	}
}

// if ( ! function_exists( 'kkw_languages_list' ) ) {
// 	/**
// 	 * Retrieves the list of the languages supported by the site.
// 	 *
// 	 * @param [type] $args
// 	 * @return void
// 	 */
// 	function kkw_languages_list( $args ) {
// 		return pll_languages_list( $args );
// 	}
// }

// if ( ! function_exists( 'kkw_set_term_language' ) ) {
// 	/**
// 	 * Sets the language of a taxonomy term.
// 	 *
// 	 * @param [type] $term
// 	 * @param [type] $lang
// 	 * @return void
// 	 */
// 	function kkw_set_term_language( $term, $lang ) {
// 		return pll_set_term_language( $term, $lang );
// 	}
// }

// if ( ! function_exists( 'kkw_save_term_translations' ) ) {
// 	/**
// 	 * Defines a term as translation of another.
// 	 *
// 	 * @param [type] $related_taxonomies
// 	 * @return void
// 	 */
// 	function kkw_save_term_translations( $related_taxonomies ) {
// 		return pll_save_term_translations( $related_taxonomies );
// 	}
// }

// if ( ! function_exists( 'kkw_set_post_language' ) ) {
// 	/**
// 	 * Sets the language of a post.
// 	 *
// 	 * @param [type] $post
// 	 * @param [type] $lang
// 	 * @return void
// 	 */
// 	function kkw_set_post_language( $post, $lang ) {
// 		return pll_set_post_language( $post, $lang );
// 	}
// }

// if ( ! function_exists( 'kkw_save_post_translations' ) ) {
// 	/**
// 	 * Defines a post as the translation of another.
// 	 *
// 	 * @param [type] $related_posts
// 	 * @return void
// 	 */
// 	function kkw_save_post_translations( $related_posts ) {
// 		return pll_save_post_translations( $related_posts );
// 	}
// }

// if ( ! function_exists( 'kkw_get_post_translations' ) ) {
// 	/**
// 	 * Retrieves the translations of a post in all the site languages, if present.
// 	 *
// 	 * @param [type] $related_posts
// 	 * @return void
// 	 */
// 	function kkw_get_post_translations( $related_posts ) {
// 		return pll_get_post_translations( $related_posts );
// 	}
// }

// if ( ! function_exists( 'kkw_homepage_url' ) ) {
// 	function kkw_homepage_url() {
// 		$site_url         = get_site_url();
// 		$current_language = kkw_current_language( 'slug' );
// 		$default_language = pll_default_language( 'slug' );
// 		if ( $current_language != $default_language ) {
// 			return $site_url . '/' . $current_language;
// 		} else {
// 			return $site_url;
// 		}
// 	}
// }

// if ( ! function_exists( 'kkw_get_page_selectors' ) ) {
// 	/**
// 	 * Returns the list of the elements of the selector based on the page language.
// 	 * If the page has not a translation there isn't the selector.
// 	 */
// 	function kkw_get_page_selectors() {
// 		global $post;
// 		$selectors = array();

// 		$site_url         = get_site_url();
// 		$traduzioni       = kkw_get_post_translations( $post->ID );
// 		$languages_list   = kkw_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );
// 		$default_language = pll_default_language( 'slug' );
// 		$current_language = kkw_current_language( 'slug' );

// 		// The home page is the same in all languages.
// 		if ( is_home() ) {

// 			foreach( $languages_list as $lang_slug ) {
// 				if ( $lang_slug != $default_language ) {
// 					$url = $site_url . '/' . $lang_slug;
// 				} else {
// 					$url =  $site_url;
// 				}
// 				array_push(
// 					$selectors,
// 					array(
// 						'slug' => $lang_slug,
// 						'url'  => $url,
// 					)
// 				);
// 			}
// 			return $selectors;

// 		} else {

// 			$selectors = array(
// 				array(
// 					'slug' => $current_language,
// 					'url'  => get_permalink( $post ),
// 				),
// 			);
// 			foreach( $languages_list as $lang_slug ) {
// 				if ( (  $lang_slug !== $current_language ) && array_key_exists(  $lang_slug , $traduzioni ) ){
// 					array_push(
// 						$selectors,
// 						array(
// 							'slug' => $lang_slug,
// 							'url'  => get_permalink( $traduzioni[ $lang_slug ] ),
// 						)
// 					);
// 				}
// 			}
// 			return $selectors;

// 		}

// 	}
// }

// if ( ! function_exists( 'kkw_get_configuration_field_by_lang' ) ) {
// 	function kkw_get_configuration_field_by_lang( $field_name, $field_type ) {
// 		$field_name_new = ( kkw_current_language() === KKW_IT_SLUG ) ? $field_name : $field_name . KKW_ENG_SUFFIX_LANGUAGE;
// 		$field_value    = kkw_get_option( $field_name_new, $field_type );
// 		if ( ! $field_value ) {
// 			$default_language = pll_default_language( 'slug' );
// 			$field_name_new   = ( KKW_IT_SLUG === $default_language ) ? $field_name : $field_name . KKW_ENG_SUFFIX_LANGUAGE;
// 		}

// 		return kkw_get_option( $field_name_new, $field_type );
// 	}
// }

// if ( ! function_exists( 'kkw_get_all_menus_by_lang' ) ) {
// 	function kkw_get_all_menus_by_lang( $lang ) {
// 		$options        = get_option( 'polylang' );
// 		$menu_locations = $options['nav_menus']['design-laboratori-wordpress-theme'];

// 		$items = array();
// 		$ids   = array();
// 		foreach ( $menu_locations as $name => $menulangs ) {
// 			foreach ( $menulangs as $ml_lang => $ml_id ) {
// 				if ( ! in_array( $ml_id, $ids ) ) {
// 					if ( isset( $items[ $ml_lang ] ) ) {
// 						array_push( $items[$ml_lang], array( $name => $ml_id ) );
// 						array_push( $ids, $ml_id );
// 					} else {
// 						$items[$ml_lang] = array();
// 						array_push( $items[ $ml_lang ], array( $name => $ml_id ) );
// 						array_push( $ids, $ml_id );
// 					}
// 				}
// 			}
// 		}
// 		return $items[ $lang ];
// 	}
// }
