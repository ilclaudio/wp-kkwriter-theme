<?php
/**
 * KK Writer Theme: Tree item model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent an item in the site tree.
 */
class KKW_TreeItem {
	/**
	 * Item label.
	 *
	 * @var string
	 */
	public string $name;

	/**
	 * Item slug.
	 *
	 * @var string
	 */
	public string $slug;

	/**
	 * Item URL.
	 *
	 * @var string
	 */
	public string $link;

	/**
	 * Whether this item points to an external URL.
	 *
	 * @var bool
	 */
	public bool $external;

	/**
	 * Child items keyed by slug.
	 *
	 * @var array<string, KKW_TreeItem>
	 */
	public array $children;

	/**
	 * Build a tree item.
	 *
	 * @param string                      $name     Item label.
	 * @param string                      $slug     Item slug.
	 * @param string                      $link     Item URL.
	 * @param bool                        $external Whether item is external.
	 * @param array<string, KKW_TreeItem> $children Child items.
	 */
	public function __construct( $name, $slug, $link, $external = false, $children = array() ) {
		$this->name     = $name;
		$this->slug     = $slug;
		$this->link     = $link;
		$this->external = $external;
		$this->children = $children;
	}
}
