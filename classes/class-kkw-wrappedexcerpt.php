<?php
/**
 * KK Writer Theme: Wrapped excerpt model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent one wrapped excerpt item.
 */
class KKW_WrappedExcerpt {
	/**
	 * Excerpt item ID.
	 *
	 * @var int
	 */
	public int $id;

	/**
	 * Sort order.
	 *
	 * @var int
	 */
	public int $order;

	/**
	 * Excerpt title.
	 *
	 * @var string
	 */
	public string $title;

	/**
	 * Excerpt description text.
	 *
	 * @var string
	 */
	public string $description;

	/**
	 * Build a wrapped excerpt object.
	 *
	 * @param array<string, mixed> $parameters Excerpt data.
	 */
	public function __construct( $parameters ) {
		$this->id          = intval( $parameters['id'] );
		$this->order       = intval( $parameters['order'] );
		$this->title       = $parameters['title'];
		$this->description = $parameters['description'];
	}
}
