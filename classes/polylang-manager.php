<?php
/**
 * Definition of the Polylang Manager.
 *
 * @package KK_Writer_Theme
 */

/**
 * The manager that setups People post types.
 */
class KKW_PolylangManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Course post type.
	 *
	 * @return void
	 */
	public function setup() {

		add_filter( 'pll_get_post_types', array( $this, 'add_cpt_to_pll' ), 10, 2 );

		add_filter( 'pll_get_taxonomies', array( $this, 'add_tax_to_pll' ), 10, 2 );
	}

	/**
	 * All the post types that must be managed by Polylang.
	 *
	 * @return void
	 */
	public function add_cpt_to_pll() {
		return KKW_POST_TYPES_TO_TRANSLATE;
	}

	/**
	 *  all the taxonomies that must be managed by Polylang.
	 *
	 * @return void
	 */
	public function add_tax_to_pll() {
		return KKW_TAXONOMIES_TO_TRANSLATE;
	}

	/**
	* Sets the language of a taxonomy term.
	*
	* @param [type] $term
	* @param [type] $lang
	* @return void
	*/
	public static function set_term_language( $term, $lang ) {
	 return pll_set_term_language( $term, $lang );
 }

	/**
	 * Defines a term as translation of another.
	 *
	 * @param [type] $related_taxonomies
	 * @return void
	 */
	public static function save_term_translations( $related_taxonomies ) {
		return pll_save_term_translations( $related_taxonomies );
	}

	/**
	 * Retrieves the default language of the site.
	 *
	 * @param string $type
	 * @return string
	 */
	public static function get_current_language( $type = 'slug' ) {
		$cl = pll_current_language( $type );
		return $cl ? $cl : KKW_DEFAULT_LANGUAGE;
	}

	/**
	 * Retrieves the list of the languages supported by the site.
	 *
	 * @param [type] $args
	 * @return void
	 */
	public static function get_languages_list( $args ): array {
		return pll_languages_list( $args );
	}

	/**
	 * Retrieves the list of the languages supported by the site.
	 *
	 * @param [type] $args
	 * @return void
	 */
	public static function the_languages() {
		pll_the_languages( array( 'dropdown' => 1 ) );
	}

	/**
	* Retrieves the ID of the page in the current language.
	*
	* @param string $slug
	* @return void
	*/
	public static function get_page_by_slug( $slug ) {
		$page        = get_page_by_path( $slug );
		$page_id     = 0;
		$current_lang = pll_current_language();
		if ( $page ) {
			$page_id      = pll_get_post( $page->ID , $current_lang );
		}
		return $page_id;
	}

/**
	* Retrieves the ID of the page in the current language.
	*
	* @param string $id
	* @return void
	*/
	public static function get_page_by_id( $id ) {
		$id           = intval( $id );
		$page_id      = 0;
		$current_lang = pll_current_language();
		$page_id      = pll_get_post( $id , $current_lang );
		return $page_id;
	}

	/**
	 * Sets the language of a post.
	 *
	 * @param [type] $post
	 * @param [type] $lang
	 * @return void
	 */
	public static function set_post_language( $post, $lang ) {
		return pll_set_post_language( $post, $lang );
	}

	/**
	 * Defines a post as the translation of another.
	 *
	 * @param [type] $related_posts
	 * @return void
	 */
	public static function save_post_translations( $related_posts ) {
		return pll_save_post_translations( $related_posts );
	}

	/**
	 * Retrieves the translations of a post in all the site languages, if present.
	 *
	 * @param [type] $related_posts
	 * @return void
	 */
	public static function get_post_translations( $related_posts ) {
		return pll_get_post_translations( $related_posts );
	}

	public static function kkw_homepage_url() {
		$site_url         = get_site_url();
		$current_language = self::get_current_language( 'slug' );
		$default_language = pll_default_language( 'slug' );
		if ( $current_language != $default_language ) {
			return $site_url . '/' . $current_language;
		} else {
			return $site_url;
		}
	}

}
