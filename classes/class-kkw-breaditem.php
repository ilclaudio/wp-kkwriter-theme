<?php
/**
 * KK Writer Theme: Breadcrumb item model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent one breadcrumb item.
 */
class KKW_BreadItem {
	/**
	 * Visible breadcrumb label.
	 *
	 * @var string
	 */
	public string $label;

	/**
	 * Target URL.
	 *
	 * @var string
	 */
	public string $url;

	/**
	 * CSS class string.
	 *
	 * @var string
	 */
	public string $class;

	/**
	 * Build a breadcrumb item.
	 *
	 * @param string $label      Label.
	 * @param string $url        URL.
	 * @param string $item_class CSS classes.
	 */
	public function __construct( $label, $url, $item_class ) {
		$this->label = $label;
		$this->url   = $url;
		$this->class = $item_class;
	}
}
