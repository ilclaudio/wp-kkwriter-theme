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
	public string $description;
	public string $post_date;
	public string $view_date;
	public string $main_group;
	public string $main_group_url;
	public string $detail_url;
	public array $images;


	public function __construct( $parameters ) {
		$this->id             = $parameters['id'];
		$this->type           = $parameters['type'];
		$this->slug           = $parameters['slug'];
		$this->status         = $parameters['status'];
		$this->title          = $parameters['title'];
		$this->description    = $parameters['description'];
		$this->post_date      = $parameters['post_date'];
		$this->view_date      = $parameters['view_date'];
		$this->main_group     = $parameters['main_group'];
		$this->main_group_url = $parameters['main_group_url'];
		$this->detail_url     = $parameters['detail_url'];
		$this->images         = $parameters['images'];
	}

 }


/**
 * The Activation manager.
 */
class KKW_ContentsManager
{
	/**
	 * Return a wrapped site item.
	 * The items returned by this function have a subset of the full object fields
	 * and can be used in all the sections of the HP (carousel, featured items, etc.).
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
			'description'       => '',
			'post_date'         => '',
			'view_date'         => '',
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
			$section = count( $book['sections'] ) > 0 ? $book['sections'][0] : '';

			$item['id']             = $book['id'];
			$item['title']          = $book['title'];
			$item['type']           = $book['type'];
			$item['description']    = $book['description'];
			$item['post_date']      = $post->post_date;
			$item['view_date']      = $book['year'];
			$item['main_group']     = $section;
			$item['main_group_url'] = '';
			$item['detail_url']     = $post->guid;
			$item['images']         = array();
		}
		return $item;
	}

	private static function wrap_post( $post ): array {
		$item = KKW_ContentsManager::get_empty_wrapper();
		$item['id']             = $post->ID;
		$item['title']          = $post->post_title;
		$item['type']           = $post->post_type;
		$item['description']    = $post->post_excerpt;
		$item['post_date']      = $post->post_date ;
		$item['view_date']      = $post->post_date;
		$item['main_group']     = '';
		$item['main_group_url'] = '';
		$item['detail_url']     = $post->guid;
		$item['images']         = array();
		return $item;




	}
	
}
