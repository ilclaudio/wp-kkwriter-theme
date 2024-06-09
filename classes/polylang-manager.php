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

}
