<?php
/**
 * KK Writer Theme: Wrapped image model.
 *
 * @package KK_Writer_Theme
 */

/**
 * Represent image metadata for a wrapped content item.
 */
class KKW_WrappedImage {
	/**
	 * Attachment ID.
	 *
	 * @var int
	 */
	public int $id;

	/**
	 * Image URL.
	 *
	 * @var string
	 */
	public string $src;

	/**
	 * Image alternative text.
	 *
	 * @var string
	 */
	public string $alt;

	/**
	 * Requested image size identifier.
	 *
	 * @var string
	 */
	public string $size_string;

	/**
	 * Build wrapped image metadata.
	 *
	 * @param KKW_WrappedItem|object $post_wrapper Wrapped post object.
	 * @param string                 $size_string  WordPress image size slug.
	 */
	public function __construct( $post_wrapper, $size_string ) {
		$this->id  = get_post_thumbnail_id( $post_wrapper->id );
		$img_array = wp_get_attachment_image_src( $this->id, $size_string );
		$this->src = $img_array ? $img_array[0] : '';
		$this->alt = get_post_meta( $this->id, '_wp_attachment_image_alt', true );
		if ( ! $this->alt ) {
			switch ( $post_wrapper->type ) {
				case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
					$this->alt = $post_wrapper->author . ' - ' . $post_wrapper->title;
					break;
				default:
					$this->alt = $post_wrapper->title;
					break;
			}
		}
	}
}
