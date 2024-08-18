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
					$this->alt   = $post_wrapper->author . ' - ' . $post_wrapper->title;
					break;
				default:
					$this->alt  = $this->alt ? $this->alt : $post_wrapper->title;
					break;
			}
		}
	}
}
class KKW_WrappedExcerpt {
	public int $id;
	public int $order;
	public string $title;
	public string $description;

	public function __construct( $parameters ) {
		$this->id          = intval( $parameters['id'] );
		$this->order       = intval ( $parameters['order'] );
		$this->title       = $parameters['title'];
		$this->description = $parameters['description'];
	}
}

class KKW_WrappedReview {
	public int $id;
	public int $order;
	public string $author;
	public string $title;
	public string $label;
	public string $description;

	public function __construct( $parameters ) {
		$this->id          = intval( $parameters['id'] );
		$this->order       = intval ( $parameters['order'] );
		$this->author      = $parameters['author'];
		$this->label       = $parameters['label'];
		$this->title       = $parameters['title'];
		$this->description = $parameters['description'];
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
	public string $price;
	public string $pages;
	public string $isbn;


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
		$this->pages          = $parameters['pages'];
		$this->isbn           = $parameters['isbn'];
		$this->price          = $parameters['price'];
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
			case KKW_DEFAULT_POST:
				$item = KKW_ContentsManager::wrap_post( $post );
				break;
			case KKW_DEFAULT_PAGE:
				$item = KKW_ContentsManager::wrap_page( $post );
				break;
			default:
				$item = null;
				break;
		}
		$wrapped_item = new KKW_WrappedItem( $item );
		return $wrapped_item;
	}

	public static function wrap_featured_image( $post, $size_string ): KKW_WrappedImage {
		return new KKW_WrappedImage( $post, $size_string );
	}
	
	public static function get_post_icon_by_group( $group ){
		switch( $group ){
			case 'event':
				$icon_name = 'fa-calendar-days';
				break;
			case 'news':
				$icon_name = 'fa-earth-europe';
				break;
			default:
				$icon_name = 'fa-feather-pointed';
			}
		return $icon_name;
	}

	private static function get_empty_wrapper(): array {
		return array(
			'id'                => '',
			'title'             => '',
			'type'              => '',
			'slug'              => '',
			'status'            => '',
			'pages'             => '',
			'isbn'              => '',
			'price'             => '',
			'description'       => '',
			'post_date'         => '',
			'view_date'         => '',
			'main_group'        => '',
			'main_group_url'    => '',
			'detail_url'        => '',
			'publisher'         => '',
			'author'            => '',
		);
	}
	private static function wrap_book( $post ): array {
		$item = KKW_ContentsManager::get_empty_wrapper();
		$book = KKW_SearchManager::get_book( $post->ID );
		if ( $book ) {
			$section      = count( $book['sections'] ) > 0 ? $book['sections'][0] : '';
			$section_slug = sanitize_title( $section );
			// Fill the item array.
			$item['id']             = $book['id'];
			$item['title']          = $book['title'];
			$item['type']           = $book['type'];
			$item['description']    = $book['description'];
			$item['post_date']      = $post->post_date;
			$item['view_date']      = $book['year'];
			$item['main_group']     = $section;
			$item['main_group_url'] = get_site_url() . '/' . $section_slug;
			$item['price']          = $book['price'] ? $book['pages'] . '€' : '';
			$item['pages']          = $book['pages'];
			$item['isbn']           = $book['isbn'];
			$item['publisher']      = count( $book['publishers'] ) ? join( ',', $book['publishers'] ) : '';
			$item['author']         = count( $book['authors'] ) ? join( ',', $book['authors'] ) : '';
			$item['detail_url']     = get_permalink( $post->ID );
		}
		return $item;
	}

	private static function wrap_post( $post ): array {
		$item      = KKW_ContentsManager::get_empty_wrapper();
		$meta_tags = get_post_meta( $post->ID );
		$has_meta  = count( $meta_tags ) > 0;
		$group     = $has_meta && array_key_exists( 'kkw_group', $meta_tags ) && $meta_tags['kkw_group'][0] ?
			$meta_tags['kkw_group'][0] : '';
		$short_description      = $has_meta && array_key_exists( 'kkw_short_description', $meta_tags ) && $meta_tags['kkw_short_description'][0] ?
			$meta_tags['kkw_short_description'][0] : '';
		$view_date    = self::extractDateString( $meta_tags, $post );
		$query_string = http_build_query( array( 'selected_contents' => array( $group ) ) );
		$group_page   = __( 'blog', 'kk_writer_theme' );
		// Fill the item array.
		$item['id']             = $post->ID;
		$item['title']          = $post->post_title;
		$item['type']           = $post->post_type;
		$item['description']    = $short_description;
		$item['post_date']      = $post->post_date ;
		$item['view_date']      = $view_date;
		$item['main_group']     = ucfirst( $group );
		$item['main_group_url'] = get_site_url() . '/' . $group_page . '?' . $query_string;
		$item['publisher']      = '';
		$item['author']         = '';
		$item['pages']          = '';
		$item['isbn']           = '';
		$item['price']          = '';
		$item['detail_url']     = get_permalink( $post->ID) ;
		return $item;
	}

	private static function wrap_page( $post ): array {
		$item      = KKW_ContentsManager::get_empty_wrapper();
		$meta_tags = get_post_meta( $post->ID );
		$desc      = '';
		$view_date    = self::extractDateString( $meta_tags, $post );
		// Fill the item array.
		$item['id']             = $post->ID;
		$item['title']          = $post->post_title;
		$item['type']           = $post->post_type;
		$item['slug']           = $post->post_name;
		$item['description']    = $desc;
		$item['post_date']      = $post->post_date ;
		$item['view_date']      = $view_date;
		$item['detail_url']     = get_permalink( $post->ID) ;
		return $item;
	}

	public static function extract_meta_tag( $meta_tags, $key ) {
		$value = '';
		if ( array_key_exists( $key, $meta_tags ) ) {
			$value = $meta_tags[$key][0];
		}
		return $value;
	}

	public static function extractDateString( $meta_tags, $post, $type='start' ){
		$view_date = '';
		if ( array_key_exists('kkw_post_type', $meta_tags) && $meta_tags['kkw_post_type'][0]  === 'event') {
			// It is an event with a start event date.
			if ( array_key_exists( 'kkw_'. $type . '_date', $meta_tags ) ) {
				$dateTime  = DateTime::createFromFormat( 'd-m-Y', $meta_tags['kkw_'. $type . '_date'][0] );
				$timestamp = $dateTime->getTimestamp();
				$view_date = date_i18n( 'l j F Y', $timestamp );
			} else {
				$view_date = '';
			}
			if ( array_key_exists( 'kkw_'. $type . '_hour', $meta_tags ) ) {
				$view_date = $view_date . ' ' . __( 'at' , 'kk_writer_theme' ) . ' ' . $meta_tags['kkw_'. $type . '_hour'][0];
			}
		} else {
			// It is not an event.
			$dataUnix = get_post_time( 'U', false, $post->ID, true );
			$view_date = date_i18n( 'j F Y', $dataUnix );
		}
		return $view_date;
	}

	public static function extractCalendarDateString( $meta_tags, $post, $type='start' ){
		$view_date = '';
		if ( array_key_exists('kkw_post_type', $meta_tags) ) {
			// It is an event with a start event date.
			if ( array_key_exists( 'kkw_'. $type . '_date', $meta_tags ) ) {
				$dateTime  = DateTime::createFromFormat( 'd-m-Y', $meta_tags['kkw_'. $type . '_date'][0] );
				$timestamp = $dateTime->getTimestamp();
				$view_date = date_i18n( 'Y-m-d', $timestamp );
			} else {
				$view_date = '';
			}
			if ( array_key_exists( 'kkw_'. $type . '_hour', $meta_tags ) ) {
				$view_date = $view_date . ' ' . $meta_tags['kkw_'. $type . '_hour'][0];
			}
		}
		return $view_date;
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
				$page_id           = KKW_MultiLangManager::get_page_by_id( $id );
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
	public static function get_custom_contents_filters() {
		$ct = array(
			'article'                                 => __( 'Articles', 'kk_writer_theme' ),
			'event'                                   => __( 'Events', 'kk_writer_theme' ),
			'news'                                    => __( 'News', 'kk_writer_theme' ),
			// KKW_DEFAULT_PAGE                          => 'Pages',
			KKW_POST_TYPES[ ID_PT_BOOK ]['name']      =>  __( KKW_POST_TYPES[ ID_PT_BOOK ]['plural_label'], 'kk_writer_theme' ),
			KKW_POST_TYPES[ ID_PT_REVIEW ]['name']    =>  __( KKW_POST_TYPES[ ID_PT_REVIEW ]['plural_label'], 'kk_writer_theme' ),
			KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']   =>  __( KKW_POST_TYPES[ ID_PT_EXCERPT ]['plural_label'], 'kk_writer_theme' ),
			KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'] =>  __( KKW_POST_TYPES[ ID_PT_INTERVIEW ]['plural_label'], 'kk_writer_theme' ),
		);
		return $ct;
	}

	public static function get_custom_contents_filter_keys() {
		$items = self::get_custom_contents_filters();
		return array_keys( $items );
	}
	public static function get_post_groups_filters() {
		$pg = array(
			'article' => __( 'Articles', 'kk_writer_theme' ),
			'event'   => __( 'Events', 'kk_writer_theme' ),
			'news'    => __( 'News', 'kk_writer_theme' ),
		);
		return $pg;
	}

	public static function get_post_groups_filter_keys() {
		$items = self::get_post_groups_filters();
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
		$cond_2     = null;
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

	public static function get_book_reviews( $post_id ) {
		$reviews = array();
		$args = array(
			'post_type'  => 'kkw_review',
			'meta_query' => array(
				array(
					'key'     => 'kkw_book_link',
					'value'   => '"' . $post_id . '"',
					'compare' => 'LIKE'
				)
			)
		);
		$query   = new WP_Query( $args );
		$results = $query->get_posts();
		if ( $results ) {
			foreach ( $results as $pst ) {
				$meta_tags = get_post_meta( $pst->ID );
				$parameters = array(
					'id'          => $pst->ID,
					'title'       => $pst->post_title,
					'author'      => KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_author' ),
					'order'       => KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_order' ),
					'description' => $pst->post_content,
					'label'       => KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_source_description' ),
				);
				$item  = new KKW_WrappedReview( $parameters );
				array_push( $reviews, $item );
			}
		}
		$reviews = self::order_items( $reviews );
		return $reviews;
	}

	public static function order_items( $items ){
		usort($items,
			function($a, $b) {
				return $a->order - $b->order;
			}
		);
		return $items;
	}

	public static function get_book_excerpts( $post_id ) {
		$reviews = array();
		$args = array(
			'post_type'  => 'kkw_excerpt',
			'meta_query' => array(
				array(
					'key'     => 'kkw_book_link',
					'value'   => '"' . $post_id . '"',
					'compare' => 'LIKE'
				)
			)
		);
		$query   = new WP_Query( $args );
		$results = $query->get_posts();
		if ( $results ) {
			foreach ( $results as $pst ) {
				$meta_tags = get_post_meta( $pst->ID );
				$parameters = array(
					'id'          => $pst->ID,
					'title'       => $pst->post_title,
					'order'       => KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_order' ),
					'description' => $pst->post_content,
				);
				$item  = new KKW_WrappedExcerpt( $parameters );
				array_push( $reviews, $item );
			}
		}
		$reviews = self::order_items( $reviews );
		return $reviews;
	}

	public static function get_book_tracks( $post_id ){
		return array();
	}

	public static function get_og_data() {
		global $post;
		$og_data = array(
			'id'          => '',
			'title'       => '',
			'description' => '',
			'image'       => '',
			'url'         => '',
			'domain'      => '',
		);
		$item_id   = $post && $post->ID ? $post->ID : '';
		$item_type = $item_id && $post->post_type ? $post->post_type : '';
		$types     = [ 'post', 'kkw_book' ];
		if ( $item_id && in_array( $item_type, $types ) ) {
			$img_id     = get_post_thumbnail_id( $item_id );
			$img_array  = wp_get_attachment_image_src( $img_id, 'featured-post' );
			$item_title = $post->post_title ? $post->post_title : '';
			$item_desc  = $post->post_content ? clean_and_truncate_text( $post->post_content, KKW_FEATURED_TEXT_MAX_SIZE ) : '';
			$item_image = $img_id && count( $img_array ) ? $img_array[0] : '';
			$domain     = site_url();
			$item_url   = get_permalink();
			$og_data['id']          = $item_id;
			$og_data['title']       = $item_title;
			$og_data['type']        = $item_type;
			$og_data['description'] = $item_desc;
			// $og_data['image']       = urlencode( $item_image );
			$og_data['image']       =  $item_image;
			$og_data['domain']       =  $domain;
			$og_data['url']          =  $item_url;
		}
		return $og_data;
	}

	public static function download_ics_file_by_id( $eid ) {
		$post = get_post( $eid );
		if ( $post ) {
			$post_wrapper = KKW_ContentsManager::wrap_search_result( $post );
			$meta_tags    = get_post_meta( $post_wrapper->id );
			$event_name   = esc_attr( $post_wrapper->title );
			$description  = clean_and_truncate_text( $post_wrapper->description, KKW_FEATURED_TEXT_MAX_SIZE );;
			$location     = esc_attr( KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_address' ) );
			$start_time   = KKW_ContentsManager::extractCalendarDateString( $meta_tags, $post, 'start' );
			$end_time     = KKW_ContentsManager::extractCalendarDateString( $meta_tags, $post, 'end');

			// "2024-08-15 12:00:00";


			// Set the header to download the .ics file.
			header('Content-type: text/calendar; charset=utf-8');
			header('Content-Disposition: attachment; filename=evento.ics');
			// Create the file ICS.
			$ics_content = "BEGIN:VCALENDAR\n";
			$ics_content .= "VERSION:2.0\n";
			$ics_content .= "PRODID:-//Your Organization//NONSGML v1.0//EN\n";
			$ics_content .= "BEGIN:VEVENT\n";
			$ics_content .= "UID:" . uniqid() . "@yourdomain.com\n";
			$ics_content .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\n";
			$ics_content .= "DTSTART:" . gmdate('Ymd\THis\Z', strtotime($start_time)) . "\n";
			$ics_content .= "DTEND:" . gmdate('Ymd\THis\Z', strtotime($end_time)) . "\n";
			$ics_content .= "SUMMARY:" . addslashes($event_name) . "\n";
			$ics_content .= "DESCRIPTION:" . addslashes($description) . "\n";
			$ics_content .= "LOCATION:" . addslashes($location) . "\n";
			$ics_content .= "END:VEVENT\n";
			$ics_content .= "END:VCALENDAR\n";
			// Print the file file .ics.
			echo $ics_content;
		} else {
			echo '<h4>' . __( 'It is not possible to download the .ics file.', 'kk_writer_theme' ) . '</h4>'; 
		}
		exit;
	}

}
