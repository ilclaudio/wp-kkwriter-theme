<?php
/**
 * KK Writer Theme: Wrapped review model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent one wrapped review item.
 */
class KKW_WrappedReview {
	/**
	 * Review item ID.
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
	 * Review author.
	 *
	 * @var string
	 */
	public string $author;

	/**
	 * Review title.
	 *
	 * @var string
	 */
	public string $title;

	/**
	 * Review source label.
	 *
	 * @var string
	 */
	public string $label;

	/**
	 * Review description text.
	 *
	 * @var string
	 */
	public string $description;

	/**
	 * Build a wrapped review object.
	 *
	 * @param array<string, mixed> $parameters Review data.
	 */
	public function __construct( $parameters ) {
		$this->id          = intval( $parameters['id'] );
		$this->order       = intval( $parameters['order'] );
		$this->author      = $parameters['author'];
		$this->label       = $parameters['label'];
		$this->title       = $parameters['title'];
		$this->description = $parameters['description'];
	}
}
