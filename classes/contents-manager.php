<?php

/**
 * KK Writer Theme: Activation Manager definition.
 *
 * @package KK_Writer_Theme
 */

 require_once( WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'wp-kkwriter-plugin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'search-manager.php' );

class KKW_WrappedItem {
	public int $id;
	public string $type;

	public string $slug;

	public string $status;
	public string $title;
	public string $short_description;
	public ?DateTime $publication_date;
	public ?DateTime $view_date;
	public string $main_group;
	public string $main_group_url;
	public string $detail_url;
	public array $images;


	public function __construct( $parameters ) {
		$this->id                = $parameters['id'];
		$this->type              = $parameters['type'];
		$this->slug              = $parameters['slug'];
		$this->status            = $parameters['status'];
		$this->title             = $parameters['title'];
		$this->short_description = $parameters['short_description'];
		$this->publication_date  = $parameters['publication_date'];
		$this->view_date         = $parameters['view_date'];
		$this->main_group        = $parameters['main_group'];
		$this->main_group_url    = $parameters['main_group_url'];
		$this->detail_url        = $parameters['detail_url'];
		$this->images            = $parameters['images'];
	}

 }


/**
 * The Activation manager.
 */
class KKW_ContentsManager
{
	/**
	 * Return a wrapped site item.
	 *
	 * @return array.
	 */
	public static function get_wrapped_item( $post_id ): KKW_WrappedItem {
		$post = get_post( $post_id );
		$item = array();
		switch ( $post->post_type ) {
			case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
					$item = KKW_ContentsManager::wrap_book( $post );
					break;
			case KKW_DEFAULT_POST:
				$item = KKW_ContentsManager::wrap_post( $post );
					break;
		}
		$wrapped_item = new KKW_WrappedItem( $item );
		return $wrapped_item;
	}

	private static function get_empty_wrapper(): array {
		return array(
			'id'                => '',
			'title'             => '',
			'type'              => '',
			'slug'              => '',
			'status'            => '',
			'short_description' => '',
			'publication_date'  => null,
			'view_date'         => null,
			'main_group'        => '',
			'main_group_url'    => '',
			'detail_url'        => '',
			'images'            => array(),
		);
	}
	private static function wrap_book( $post ): array {
		$item = KKW_ContentsManager::get_empty_wrapper();
		$book = KKW_SearchManager::get_book( $post->ID );
		if ( $book ) {
			$item['id']                = $post->ID;
			$item['title']             = $post->post_title;
			$item['type']              = $post->post_type;
			// $item['short_description'] = $post->post_type; //
			// $item['publication_date']  = $post->post_date;
			// $item['view_date']         = $post->post_date; //
			// $item['main_group']        = $post->post_date; //
			// $item['main_group_url']    = $post->post_date; //
			// $item['detail_url']        = $post->post_date; //
			// $item['images']            = array(); //
		}
		return $item;
	}

	private static function wrap_post( $post ): array {
		$item = KKW_ContentsManager::get_empty_wrapper();
		$item['id']    =  $post->ID;
		$item['title'] =  $post->post_title;
		return $item;
	}
	
}
