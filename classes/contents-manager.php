<?php

/**
 * KK Writer Theme: Activation Manager definition.
 *
 * @package KK_Writer_Theme
 */

 require_once( WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'wp-kkwriter-plugin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'search-manager.php' );



class KKW_WrappedImage{
	public int $id;
	public string $src;
	public string $alt;
	public string $size_string;

	public function __construct( $post_wrapper, $size_string ) {
		$this->id   = get_post_thumbnail_id( $post_wrapper->id );
		$img_array  = wp_get_attachment_image_src( $this->id, $size_string );
		$this->src  = $img_array ? $img_array[0] : '';
		$this->alt  = get_post_meta( $this->id, '_wp_attachment_image_alt', true );
		if ( ! $this->alt ) {
			switch ( $post_wrapper->type ) {
				case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
					$alt_dec   = $post_wrapper->author . ' - ' . $post_wrapper->title;
					//$this->alt = $alt_desc;
					break;
				default:
					$this->alt  = $this->alt ? $this->alt : $post_wrapper->title;
					break;
			}
		}
	}
}

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
	public string $publisher;
	public string $author;
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
		$this->publisher      = $parameters['publisher'];
		$this->author         = $parameters['author'];
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
		$post    = get_post( $post_id );
		$wrapped = self::wrap_search_result ($post );
		return $wrapped;
	}

	public static function wrap_search_result( $post ): KKW_WrappedItem {
		switch ( $post->post_type ) {
			case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
				$item = KKW_ContentsManager::wrap_book( $post );
					break;
			case KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name']:
			case KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']:
			case KKW_POST_TYPES[ ID_PT_REVIEW ]['name']:
			case KKW_DEFAULT_PAGE:
			case KKW_DEFAULT_POST:
				$item = KKW_ContentsManager::wrap_post( $post );
					break;
		}
		$wrapped_item = new KKW_WrappedItem( $item );
		return $wrapped_item;
	}

	public static function wrap_image( $post, $size_string ): KKW_WrappedImage {
		return new KKW_WrappedImage( $post, $size_string );
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
			$item['publisher']      = count( $book['publishers'] ) ? join( ',', $book['publishers'] ) : '';
			$item['author']         = count( $book['authors'] ) ? join( ',', $book['authors'] ) : '';
			$item['detail_url']     = get_permalink( $post->ID );
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
		$item['publisher']      = '';
		$item['author']         = '';
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

	/**
	 * Returns the post type that can be searched.
	 * 
	 * @return array
	 */
	public static function get_ct_filters() {
		$ct = array(
			'article'                                 => 'Articles',
			'event'                                   => 'Events',
			'news'                                    => 'News',
			// KKW_DEFAULT_PAGE                          => 'Pages',
			KKW_POST_TYPES[ ID_PT_BOOK ]['name']      =>  KKW_POST_TYPES[ ID_PT_BOOK ]['plural_label'],
			KKW_POST_TYPES[ ID_PT_REVIEW ]['name']    =>  KKW_POST_TYPES[ ID_PT_REVIEW ]['plural_label'],
			KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']   =>  KKW_POST_TYPES[ ID_PT_EXCERPT ]['plural_label'],
			KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'] =>  KKW_POST_TYPES[ ID_PT_INTERVIEW ]['plural_label'],
		);
		return $ct;
	}

	public static function get_ct_filter_keys() {
		$items = self::get_ct_filters();
		return array_keys( $items );
	}

	public static function search_contents( $selected_contents, $search_string, $pagesize ) {
		global $wpdb;
		$groups = array();
		// EVENTS.
		$key = array_search( 'event', $selected_contents );
		if ( $key !== false ) {
			array_push( $groups, 'event' );
			unset( $selected_contents[$key] );
		}
		// NEWS.
		$key = array_search( 'news', $selected_contents );
		if ( $key !== false ) {
			array_push( $groups, 'news' );
			unset( $selected_contents[$key] );
		}
		// ARTICLES
		$key = array_search( 'article', $selected_contents );
		if ( $key !== false ) {
			array_push( $groups, 'article' );
			unset( $selected_contents[$key] );
		}

		$text_like = '%' . $wpdb->esc_like( $search_string ) . '%';
		$sql = "
			SELECT DISTINCT p.ID
			FROM {$wpdb->posts} AS p
			LEFT JOIN {$wpdb->postmeta} AS pm ON (p.ID = pm.post_id)
			LEFT JOIN {$wpdb->term_relationships} AS tr  ON (p.id=tr.object_id)
			LEFT JOIN {$wpdb->term_taxonomy} AS tt ON (tt.term_taxonomy_id=tr.term_taxonomy_id)
			WHERE
				(p.post_title LIKE %s OR p.post_content LIKE %s)
				AND p.post_status = 'publish'
				AND tt.taxonomy='language'
				AND tt.description LIKE '%\"it\"%'
		";


		$cond_items = array();
		$cond_1     = null;
		$cond_2 = null;
		if ( count( $selected_contents ) ) {
			$values = implode("', '", $selected_contents  );
			$cond_1 = " ( p.post_type IN ('$values') ) ";
			array_push( $cond_items, $cond_1 );
		} 
		if ( count( $groups ) ) {
			$values = implode("', '", $groups  );
			$cond_2 = " ( p.post_type='post' AND pm.meta_key= 'kkw_group' AND pm.meta_value IN ('$values') ) ";
			array_push( $cond_items, $cond_2 );
		}
		if ( $cond_items > 0 ) {
			$cond_post_type = join( ' OR ', $cond_items );
			$sql = $sql . 'AND ' . $cond_post_type;
		}

		$query_results = $wpdb->get_col( $wpdb->prepare( $sql, $text_like, $text_like ) );

		array_push( $selected_contents, 'post' );
		$parameters = array(
			'paged'          => get_query_var( 'paged', 1 ),
			'posts_per_page' => $pagesize,
			'post_type'      => $selected_contents,
			// 'post_type'      => self::get_ct_filter_keys(),
			'orderby'         => 'post__in',
			's'               => $search_string,
		);

		if ( ! empty( $query_results ) ) {
			$parameters['post__in'] = $query_results;
		} else {
			$parameters['post__in'] = array( 0 ) ;
		}

		$the_query = new WP_Query( $parameters );
		return $the_query;
	}

}
