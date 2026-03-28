<?php
/**
 * KK Writer Theme: Wrapped item model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent normalized content data used by templates.
 */
class KKW_WrappedItem {
	/**
	 * Post ID.
	 *
	 * @var int
	 */
	public int $id = 0;

	/**
	 * Content type slug.
	 *
	 * @var string
	 */
	public string $type = '';
	/**
	 * Content slug.
	 *
	 * @var string
	 */
	public string $slug = '';
	/**
	 * Content status.
	 *
	 * @var string
	 */
	public string $status = '';
	/**
	 * Content title.
	 *
	 * @var string
	 */
	public string $title = '';
	/**
	 * Full content body.
	 *
	 * @var string
	 */
	public string $content = '';
	/**
	 * Short description.
	 *
	 * @var string
	 */
	public string $description = '';
	/**
	 * Original post date.
	 *
	 * @var string
	 */
	public string $post_date = '';
	/**
	 * Human-readable display date.
	 *
	 * @var string
	 */
	public string $view_date = '';
	/**
	 * Main content group slug.
	 *
	 * @var string
	 */
	public string $main_group = '';
	/**
	 * Main content group label (plural).
	 *
	 * @var string
	 */
	public string $main_group_pl = '';
	/**
	 * Main content group URL.
	 *
	 * @var string
	 */
	public string $main_group_url = '';
	/**
	 * Detail page URL.
	 *
	 * @var string
	 */
	public string $detail_url = '';
	/**
	 * Publisher list.
	 *
	 * @var string
	 */
	public string $publisher = '';
	/**
	 * Author list.
	 *
	 * @var string
	 */
	public string $author = '';
	/**
	 * Whether the price must be shown.
	 *
	 * @var bool
	 */
	public bool $show_price = false;
	/**
	 * Price value.
	 *
	 * @var string
	 */
	public string $price = '';
	/**
	 * Number of pages.
	 *
	 * @var string
	 */
	public string $pages = '';
	/**
	 * Book format.
	 *
	 * @var string
	 */
	public string $format = '';
	/**
	 * ISBN code.
	 *
	 * @var string
	 */
	public string $isbn = '';
	/**
	 * Series name.
	 *
	 * @var string
	 */
	public string $series = '';
	/**
	 * Publisher main page URL.
	 *
	 * @var string
	 */
	public string $publisher_page = '';
	/**
	 * Publisher page URL for the current book.
	 *
	 * @var string
	 */
	public string $publisher_book_page = '';
	/**
	 * External shop URL.
	 *
	 * @var string
	 */
	public string $shop_page = '';
	/**
	 * Presentation author.
	 *
	 * @var string
	 */
	public string $presentation_author = '';
}
