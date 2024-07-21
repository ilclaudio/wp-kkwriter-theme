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
			case KKW_DEFAULT_PAGE:
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
			$item['detail_url']     = get_permalink( $post->ID );
			$item['images']         = array();
		}
		return $item;
	}

	private static function wrap_post( $post ): array {
		$item      = KKW_ContentsManager::get_empty_wrapper();
		$prefix    = 'kkw_';
		$meta_tags = get_post_meta( $post->ID );
		$has_meta  = count( $meta_tags ) > 0;
		$group     = $has_meta && array_key_exists( $prefix . 'group', $meta_tags ) && $meta_tags[$prefix . 'group'][0] ?
			$meta_tags[$prefix . 'group'][0] : '';
		$short_description      = $has_meta && array_key_exists( $prefix . 'short_description', $meta_tags ) && $meta_tags[$prefix . 'short_description'][0] ?
			$meta_tags[$prefix . 'short_description'][0] : '';
		$item['id']             = $post->ID;
		$item['title']          = $post->post_title;
		$item['type']           = $post->post_type;
		$item['description']    = $short_description;
		$item['post_date']      = $post->post_date ;
		$item['view_date']      = $post->post_date;
		$item['main_group']     = $group;
		$item['main_group_url'] = '';
		$item['detail_url']     = get_permalink( $post->ID) ;
		$item['images']         = array();
		return $item;
	}
	
	/**
	 * Retrieves the content to show in the Home Page Carousel.
	 * @return array
	 */
	public static function get_home_carousel_contents(): array {
		$contents = array();
		$carousel_auto_on = kkw_get_option( 'home_carousel_auto_on', 'kkw_opt_hp_layout' );
		if ( $carousel_auto_on === 'true' ) {
			// Get contents with the flag 'show_in_carousel' set.
			$opt_content_ids = self::search_carousel_ids();
		} else {
			// Get the contents selected ion the backoffice.
			$opt_content_ids = kkw_get_option( 'carousel_content', 'kkw_opt_hp_layout' );
		}
		$num_contents = count( $opt_content_ids );
		$content_ids  = $num_contents > 0 ? $opt_content_ids : array();
		foreach ( $content_ids as $id ){
			$item = self::get_wrapped_item( $id );
 			array_push( $contents, $item );
		}
		return $contents;
	}

	/**
	 * Search the content types of the site having that must be shown in the carousel. 
	 * @return array
	 */
	private static function search_carousel_ids() {
		$args= array(
				'post_type'      => array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
				// @TODO: 'post_type'      => array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'], KKW_DEFAULT_POST ),
				'orderby'        => 'title',
				'order'          => 'ASC',
				'fields'         => 'ids',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
							'key'     => 'kkw_show_in_carousel',
							'value'   => 'on',
					),
				),
			);
		$query = new WP_Query( $args );
		$opt_content_ids = $query->posts;
		return $opt_content_ids;
	}

	public static function get_latest_posts( $group='article', $number = 1 ) {
		$results = array();
		$args= array(
			'post_type'      => array( KKW_DEFAULT_POST ),
			'orderby'        => 'date',
			'order'          => 'DESC',
			'fields'         => 'ids',
			'posts_per_page' => $number,
			'meta_query' => array(
				array(
						'key'     => 'kkw_group',
						'value'   => $group,
				),
			),
		);
		$query       = new WP_Query( $args );
		$content_ids = $query->posts;
		foreach ( $content_ids as $id ){
			$item = self::get_wrapped_item( $id );
			array_push( $results, $item );
		}
		return $results;
	}

	/**
	* Given an $item menu returns the wrapped item to show in the site menus.
	* @param mixed $item
	* @return array
	*/
	public static function get_wrapped_menu_item( $item ) {
		$wrapped = array(
			'id'     => 0,
			'link'   => '',
			'title'  => '',
			'active' => false,
		);
		switch ( $item->type ) {
			case 'custom':
				$wrapped['id']     = 0;
				$wrapped['link']   = esc_url( $item->url );
				$wrapped['title']  = __( $item->title, 'kk_writer_theme' );
				$wrapped['type']   = $item->type;
				$wrapped['active'] = ( $item->post_name !== 'home' ) ? false : is_home();
				break;
			case 'post_type':
			case 'taxonomy':
				$id                = intval( $item->object_id );
				$page_id           = KKW_PolylangManager::get_page_by_id( $id );
				$link              = get_permalink( $page_id );
				$wrapped['id']     = intval( $page_id );
				$wrapped['link']   = $link;
				$wrapped['title']  = __( $item->title, 'kk_writer_theme' );
				$wrapped['type']   = $item->type;
				$wrapped['active'] = ( $item->type !== 'custom' ) && is_page( $page_id );
				break;
			default:
				$wrapped['id']     = 0;
				$wrapped['link']   = '';
				$wrapped['title']  = '';
				$wrapped['type']   = $item->type;
				$wrapped['active'] = false;
				break;
		}
		return $wrapped;
	}


	public static function get_image_metadata( $item, $image_size = "item-carousel", $partial_default_img_url = null ) {
		$result = array(
			'title'         => '',
			'image_url'     => '',
			'image_alt'     => '',
			'image_title'   => '',
			'image_caption' => '',
		);
		$image_url = get_the_post_thumbnail_url( $item, $image_size );
		$image_caption = '';
		if ( ! $image_url && $partial_default_img_url ) {
			$image_url = get_template_directory_uri() . $partial_default_img_url;
		}
		$post_title  = get_the_title( $item );
		$image_id    = get_post_thumbnail_id( $item->ID );

		if( $image_id === 0 ) {
			$image_title = $post_title;
			$image_alt   = $post_title;
		}
		else {
			$image_title   = get_the_title( $image_id );
			$image_title   = $image_title ? $image_title : $post_title;
			$image_alt     = get_post_meta( $image_id, '_wp_attachment_image_alt', TRUE );
			$image_alt     = $image_alt ? $image_alt : $image_title;
			$image_caption = wp_get_attachment_caption( $image_id );
		}

		// Prepare the result.
		$result['title']         = $post_title;
		$result['image_url']     = $image_url;
		$result['image_alt']     = $image_alt;
		$result['image_title']   = $image_title;
		$result['image_caption'] = $image_caption;
		return $result;
	}

}
