<?php
/**
 * KK Writer Theme: Contents manager.
 *
 * @package KK_Writer_Theme
 */

if ( ! class_exists( 'KKW_WrappedItem' ) ) {
	include_once 'class-kkw-wrappeditem.php';
}

if ( ! class_exists( 'KKW_WrappedImage' ) ) {
	include_once 'class-kkw-wrappedimage.php';
}

if ( ! class_exists( 'KKW_WrappedExcerpt' ) ) {
	include_once 'class-kkw-wrappedexcerpt.php';
}

if ( ! class_exists( 'KKW_WrappedReview' ) ) {
	include_once 'class-kkw-wrappedreview.php';
}

require_once WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'wp-kkwriter-plugin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'search-manager.php';

/**
 * Manage content retrieval and wrapping for theme templates.
 */
class KKW_ContentsManager {

	/**
	 * Return a wrapped site item.
	 * The items returned by this function have a subset of the full object fields
	 * and can be used in all the sections of the HP (carousel, featured items, etc.).
	 *
	 * @param int $post_id Post ID.
	 * @return KKW_WrappedItem
	 */
	public static function get_wrapped_item( $post_id ): KKW_WrappedItem {
		$post    = get_post( $post_id );
		$wrapped = self::wrap_search_result( $post );
		return $wrapped;
	}

	/**
	 * Wrap a post object based on its post type.
	 *
	 * @param WP_Post|null $post Post object.
	 * @return KKW_WrappedItem
	 */
	public static function wrap_search_result( $post ): KKW_WrappedItem {
		if ( $post ) {
			switch ( $post->post_type ) {
				case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
					$item = self::wrap_book( $post );
					break;
				case KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name']:
				case KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']:
				case KKW_POST_TYPES[ ID_PT_REVIEW ]['name']:
				case KKW_DEFAULT_POST:
					$item = self::wrap_post( $post );
					break;
				case KKW_DEFAULT_PAGE:
					$item = self::wrap_page( $post );
					break;
				default:
					$item = new KKW_WrappedItem();
					break;
			}
		} else {
			$item = new KKW_WrappedItem();
		}
		return $item;
	}

	/**
	 * Wrap the featured image metadata for a post.
	 *
	 * @param WP_Post|int $post        Post object or post ID.
	 * @param string      $size_string Requested image size.
	 * @return KKW_WrappedImage
	 */
	public static function wrap_featured_image( $post, $size_string ): KKW_WrappedImage {
		return new KKW_WrappedImage( $post, $size_string );
	}

	/**
	 * Return the icon class associated with a post group.
	 *
	 * @param string $group Group slug.
	 * @return string
	 */
	public static function get_post_icon_by_group( $group ) {
		switch ( $group ) {
			case KKW_EVENT_GROUP['slug']:
				$icon_name = 'fa-calendar-days';
				break;
			case KKW_NEWS_GROUP['slug']:
				$icon_name = 'fa-earth-europe';
				break;
			case KKW_ARTICLE_GROUP['slug']:
					$icon_name = 'fa-feather-pointed';
				break;
			default:
				$icon_name = 'fa-feather-pointed';
		}
		return $icon_name;
	}

	/**
	 * Wrap a book post.
	 *
	 * @param WP_Post $post Post object.
	 * @return KKW_WrappedItem
	 */
	private static function wrap_book( $post ): KKW_WrappedItem {
		$item = new KKW_WrappedItem();
		$book = KKW_SearchManager::get_book( $post->ID );
		if ( $book ) {
			$section      = count( $book['sections'] ) > 0 ? $book['sections'][0] : '';
			$section_slug = sanitize_title( $section );
			// Fill the wrapper.
			$item->id                  = $book['id'];
			$item->title               = $book['title'];
			$item->type                = $book['type'];
			$item->slug                = $book['slug'];
			$item->description         = $book['description'];
			$item->content             = $book['content'];
			$item->post_date           = $post->post_date;
			$item->view_date           = $book['year'];
			$item->main_group          = $section;
			$item->main_group_url      = get_site_url() . '/' . $section_slug;
			$item->price               = $book['price'] ? $book['price'] : '';
			$item->show_price          = $book['show_price'] ? true : false;
			$item->pages               = $book['pages'];
			$item->series              = $book['series'] ? $book['series'] : '';
			$item->format              = $book['format'] ? $book['format'] : '';
			$item->isbn                = $book['isbn'] ? $book['isbn'] : '';
			$item->publisher_page      = $book['publisher_page'] ? $book['publisher_page'] : '';
			$item->publisher_book_page = $book['publisher_book_page'] ? $book['publisher_book_page'] : '';
			$item->presentation_author = $book['presentation_author'] ? $book['presentation_author'] : '';
			$item->publisher           = count( $book['publishers'] ) ? join( ',', $book['publishers'] ) : '';
			$item->author              = count( $book['authors'] ) ? join( ',', $book['authors'] ) : '';
			$item->detail_url          = get_permalink( $post->ID );
		}
		return $item;
	}

	/**
	 * Wrap a standard post.
	 *
	 * @param WP_Post $post Post object.
	 * @return KKW_WrappedItem
	 */
	private static function wrap_post( $post ): KKW_WrappedItem {
		$item              = new KKW_WrappedItem();
		$meta_tags         = get_post_meta( $post->ID );
		$has_meta          = count( $meta_tags ) > 0;
		$group             = $has_meta && array_key_exists( 'kkw_group', $meta_tags ) && $meta_tags['kkw_group'][0] ?
			$meta_tags['kkw_group'][0] : '';
		$short_description = $has_meta && array_key_exists( 'kkw_short_description', $meta_tags ) && $meta_tags['kkw_short_description'][0] ?
			$meta_tags['kkw_short_description'][0] : '';
			$view_date     = self::extract_date_string( $meta_tags, $post );
		$query_string      = http_build_query( array( 'selected_contents' => array( $group ) ) );
		$group_page        = __( 'blog', 'kk_writer_theme' );
		// Fill the item array.
		$item->id             = $post->ID;
		$item->title          = $post->post_title;
		$item->type           = $post->post_type;
		$item->slug           = $post->post_name;
		$item->description    = $short_description;
		$item->content        = $post->content;
		$item->post_date      = $post->post_date;
		$item->view_date      = $view_date;
		$item->main_group     = $group;
		$item->main_group_pl  = self::get_plural_group_by_slug( $group );
		$item->main_group_url = get_site_url() . '/' . $group_page . '?' . $query_string;
		$item->detail_url     = get_permalink( $post->ID );
		return $item;
	}

	/**
	 * Wrap a page.
	 *
	 * @param WP_Post $post Post object.
	 * @return KKW_WrappedItem
	 */
	private static function wrap_page( $post ): KKW_WrappedItem {
		$item          = new KKW_WrappedItem();
		$meta_tags     = get_post_meta( $post->ID );
		$desc          = '';
			$view_date = self::extract_date_string( $meta_tags, $post );
		// Fill the wrapper.
		$item->id          = $post->ID;
		$item->title       = $post->post_title;
		$item->type        = $post->post_type;
		$item->slug        = $post->post_name;
		$item->description = $desc;
		$item->content     = $post->content;
		$item->post_date   = $post->post_date;
		$item->view_date   = $view_date;
		$item->detail_url  = get_permalink( $post->ID );
		return $item;
	}

	/**
	 * Extract a scalar value from post meta array.
	 *
	 * @param array  $meta_tags Meta tags map.
	 * @param string $key       Meta key.
	 * @return string
	 */
	public static function extract_meta_tag( $meta_tags, $key ) {
		$value = '';
		if ( array_key_exists( $key, $meta_tags ) ) {
			$value = $meta_tags[ $key ][0];
		}
		return $value;
	}

	/**
	 * Build localized date string for list/detail rendering.
	 *
	 * @param array   $meta_tags Meta tags map.
	 * @param WP_Post $post      Post object.
	 * @param string  $type      Event date type: start or end.
	 * @return string
	 */
	public static function extract_date_string( $meta_tags, $post, $type = 'start' ) {
		$view_date = '';
		if ( array_key_exists( 'kkw_group', $meta_tags ) &&
				KKW_EVENT_GROUP['slug'] === $meta_tags['kkw_group'][0] ) {
			// It is an event with a start event date.
			if ( array_key_exists( 'kkw_' . $type . '_date', $meta_tags ) ) {
					$date_time = DateTime::createFromFormat( 'd-m-Y', $meta_tags[ 'kkw_' . $type . '_date' ][0] );
					$timestamp = $date_time->getTimestamp();
				$view_date     = date_i18n( 'l j F Y', $timestamp );
			} else {
				$view_date = '';
			}
			if ( array_key_exists( 'kkw_' . $type . '_hour', $meta_tags ) ) {
				$view_date = $view_date . ' ' . __( 'at', 'kk_writer_theme' ) . ' ' . $meta_tags[ 'kkw_' . $type . '_hour' ][0];
			}
		} else {
			// It is not an event.
				$data_unix = get_post_time( 'U', false, $post->ID, true );
				$view_date = date_i18n( 'j F Y', $data_unix );
		}
		return $view_date;
	}

	/**
	 * Build calendar-ready date and time string for ICS generation.
	 *
	 * @param array  $meta_tags Meta tags map.
	 * @param string $type      Event date type: start or end.
	 * @return string
	 */
	public static function extract_calendar_date_string( $meta_tags, $type = 'start' ) {
		$view_date = '';
		if ( array_key_exists( 'kkw_group', $meta_tags ) && KKW_EVENT_GROUP['slug'] === $meta_tags['kkw_group'][0] ) {
			// It is an event with a start event date.
			if ( array_key_exists( 'kkw_' . $type . '_date', $meta_tags ) ) {
					$date_time = DateTime::createFromFormat( 'd-m-Y', $meta_tags[ 'kkw_' . $type . '_date' ][0] );
					$timestamp = $date_time->getTimestamp();
				$view_date     = date_i18n( 'Y-m-d', $timestamp );
			} else {
				$view_date = '';
			}
			if ( array_key_exists( 'kkw_' . $type . '_hour', $meta_tags ) ) {
				$view_date = $view_date . ' ' . $meta_tags[ 'kkw_' . $type . '_hour' ][0];
			}
		}
		return $view_date;
	}

	/**
	 * Retrieves the content to show in the Home Page Carousel.
	 *
	 * @return array
	 */
	public static function get_home_carousel_contents(): array {
		$contents         = array();
		$carousel_auto_on = kkw_get_option( 'home_carousel_auto_on', 'kkw_opt_hp_layout' );
		if ( 'true' === $carousel_auto_on ) {
			// Get contents with the flag 'show_in_carousel' set.
			$opt_content_ids = self::search_carousel_ids();
		} else {
			// Get the contents selected ion the backoffice.
			$opt_content_ids = kkw_get_option( 'carousel_content', 'kkw_opt_hp_layout' );
		}
		$num_contents = count( $opt_content_ids );
		$content_ids  = $num_contents > 0 ? $opt_content_ids : array();
		foreach ( $content_ids as $id ) {
			$item = self::get_wrapped_item( $id );
			array_push( $contents, $item );
		}
		return $contents;
	}

	/**
	 * Search the content types of the site having that must be shown in the carousel.
	 *
	 * @return int[]
	 */
	private static function search_carousel_ids() {
		$args = array(
			'post_type'      => array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			'orderby'        => 'title',
			'order'          => 'ASC',
			'fields'         => 'ids',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'   => 'kkw_show_in_carousel',
					'value' => 'on',
				),
			),
		);
		$query           = new WP_Query( $args );
		$opt_content_ids = $query->posts;
		return $opt_content_ids;
	}

	/**
	 * Return blog posts filtered by selected group slugs.
	 *
	 * @param string[] $selected_contents Selected post groups.
	 * @param string   $sort_field        Sort field.
	 * @param string   $sort_order        Sort order.
	 * @param int      $number            Max number of posts.
	 * @return WP_Query
	 */
	public static function get_blog_posts_query(
		$selected_contents,
		$sort_field = 'date',
		$sort_order = 'DESC',
		$number = -1
	) {
		// Manage query arguments.
		$args = array(
			'post_type'      => 'post',
			'order'          => $sort_order,
			'paged'          => get_query_var( 'paged', 1 ),
			'posts_per_page' => $number,
			'orderby'        => $sort_field,
			'meta_query'     => array(
				array(
					'key'   => 'kkw_group',
					'value' => $selected_contents,
				),
			),
		);
		// Execute the query.
		$the_query = new WP_Query( $args );
		return $the_query;
	}

	/**
	 * Return site posts query for post groups.
	 *
	 * @param string[] $groups     Group slugs.
	 * @param string   $sort_field Sort field.
	 * @param string   $sort_order Sort order.
	 * @param int      $number     Max number of posts.
	 * @return WP_Query
	 */
	public static function get_site_posts_query(
		$groups,
		$sort_field = 'date',
		$sort_order = 'DESC',
		$number = -1
	) {
		$args = array(
			'post_type'      => array( KKW_DEFAULT_POST ),
			'orderby'        => $sort_field,
			'order'          => $sort_order,
			'fields'         => 'ids',
			'post_status'    => 'publish',
			'posts_per_page' => $number,
			'meta_query'     => array(
				array(
					'key'     => 'kkw_group',
					'value'   => $groups,
					'compare' => 'IN',
				),
			),
		);
		$query = new WP_Query( $args );
		return $query;
	}

	/**
	 * Return wrapped site posts for selected groups.
	 *
	 * @param string[] $groups      Group slugs.
	 * @param string   $sort_field  Sort field.
	 * @param string   $sort_order  Sort order.
	 * @param int      $num_results Max number of results.
	 * @return KKW_WrappedItem[]
	 */
	public static function get_site_post_wrappers(
		$groups,
		$sort_field,
		$sort_order,
		$num_results
	) {
		$results     = array();
		$the_query   = self::get_site_posts_query(
			$groups,
			$sort_field,
			$sort_order,
			$num_results
		);
		$content_ids = $the_query->posts;
		if ( $content_ids ) {
			foreach ( $content_ids as $id ) {
				$item = self::get_wrapped_item( $id );
				array_push( $results, $item );
			}
		}
		return $results;
	}

	/**
	 * Return books query for one section.
	 *
	 * @param string|string[] $section     Section slug.
	 * @param string          $sort_field  Sort field.
	 * @param string          $sort_order  Sort order.
	 * @param int             $num_results Max number of results.
	 * @return WP_Query
	 */
	public static function get_section_books_query(
		$section,
		$sort_field = 'title',
		$sort_order = 'ASC',
		$num_results = -1
	) {
		// Manage query arguments.
		$args = array(
			'post_type'      => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
			'order'          => $sort_order,
			'paged'          => get_query_var( 'paged', 1 ),
			'posts_per_page' => $num_results,
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'section',
					'field'    => 'slug',
					'terms'    => $section,
				),
			),
		);
		if ( 'kkw_year' === $sort_field ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'kkw_year';
		} else {
			$args['orderby'] = $sort_field;
		}
		// Execute the query.
		$the_query = new WP_Query( $args );
		return $the_query;
	}

	/**
	 * Return wrapped books for selected sections.
	 *
	 * @param string|string[] $sections    Section slug(s).
	 * @param string          $sort_filed  Sort field.
	 * @param string          $sort_order  Sort order.
	 * @param int             $num_results Max number of results.
	 * @return KKW_WrappedItem[]
	 */
	public static function get_section_books_wrappers(
		$sections,
		$sort_filed,
		$sort_order,
		$num_results
	) {
		$results     = array();
		$the_query   = self::get_section_books_query(
			$sections,
			$sort_filed,
			$sort_order,
			$num_results
		);
		$content_ids = $the_query->posts;
		if ( $content_ids ) {
			foreach ( $content_ids as $id ) {
				$item = self::get_wrapped_item( $id );
				array_push( $results, $item );
			}
		}
		return $results;
	}

	/**
	 * Given an $item menu returns the wrapped item to show in the site menus.
	 *
	 * @param WP_Post $item Menu item object.
	 * @return array<string, bool|int|string>
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
				$wrapped['title']  = self::translate_dynamic_menu_label( $item->title );
				$wrapped['type']   = $item->type;
				$wrapped['active'] = ( 'home' !== $item->post_name ) ? false : is_home();
				break;
			case 'post_type':
			case 'taxonomy':
				$id                = intval( $item->object_id );
				$page_id           = KKW_ThemeLangManager::get_page_by_id( $id );
				$link              = get_permalink( $page_id );
				$wrapped['id']     = intval( $page_id );
				$wrapped['link']   = $link;
				$wrapped['title']  = self::translate_dynamic_menu_label( $item->title );
				$wrapped['type']   = $item->type;
				$wrapped['active'] = ( 'custom' !== $item->type ) && is_page( $page_id );
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

		/**
		 * Translate dynamic menu labels.
		 *
		 * @param string $label Menu label.
		 * @return string
		 */
	private static function translate_dynamic_menu_label( $label ) {
		$label = (string) $label;
		return __( $label, 'kk_writer_theme' );
	}

	/**
	 * Return image metadata used in cards and hero sections.
	 *
	 * @param WP_Post|int $item                    Post object or ID.
	 * @param string      $image_size              Requested image size.
	 * @param string|null $partial_default_img_url Optional default relative image URL.
	 * @return array<string, string>
	 */
	public static function get_image_metadata( $item, $image_size = 'item-carousel', $partial_default_img_url = null ) {
		$result        = array(
			'title'         => '',
			'image_url'     => '',
			'image_alt'     => '',
			'image_title'   => '',
			'image_caption' => '',
		);
		$image_url     = get_the_post_thumbnail_url( $item, $image_size );
		$image_caption = '';
		if ( ! $image_url && $partial_default_img_url ) {
			$image_url = get_template_directory_uri() . $partial_default_img_url;
		}
		$post_title = get_the_title( $item );
		$image_id   = get_post_thumbnail_id( $item->ID );

		if ( 0 === $image_id ) {
			$image_title = $post_title;
			$image_alt   = $post_title;
		} else {
			$image_title   = get_the_title( $image_id );
			$image_title   = $image_title ? $image_title : $post_title;
			$image_alt     = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
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
	 * @return array<string, string>
	 */
	public static function get_custom_contents_filters() {
		$ct = array(
			KKW_ARTICLE_GROUP['slug']            => KKW_ARTICLE_GROUP['title-pl'],
			KKW_EVENT_GROUP['slug']              => KKW_EVENT_GROUP['title-pl'],
			KKW_NEWS_GROUP['slug']               => KKW_NEWS_GROUP['title-pl'],
			KKW_POST_TYPES[ ID_PT_BOOK ]['name'] => KKW_POST_TYPES[ ID_PT_BOOK ]['plural_label'],
		);
		return $ct;
	}

	/**
	 * Return custom content filter keys.
	 *
	 * @return string[]
	 */
	public static function get_custom_contents_filter_keys() {
		$items = self::get_custom_contents_filters();
		return array_keys( $items );
	}

	/**
	 * Return available post groups.
	 *
	 * @return array<string, string>
	 */
	public static function get_post_groups_filters() {
		$pg = array(
			KKW_ARTICLE_GROUP['slug'] => KKW_ARTICLE_GROUP['title-pl'],
			KKW_EVENT_GROUP['slug']   => KKW_EVENT_GROUP['title-pl'],
			KKW_NEWS_GROUP['slug']    => KKW_NEWS_GROUP['title-pl'],
		);
		return $pg;
	}

	/**
	 * Return post group filter keys.
	 *
	 * @return string[]
	 */
	public static function get_post_groups_filter_keys() {
		$items = self::get_post_groups_filters();
		return array_keys( $items );
	}

	/**
	 * Search contents with manual relevance ordering and pagination.
	 *
	 * @param string[] $selected_contents Selected content types and groups.
	 * @param string   $search_string     User search string.
	 * @param int      $pagesize          Results per page.
	 * @return WP_Query
	 */
	public static function search_contents( $selected_contents, $search_string, $pagesize ) {
		global $wpdb;
		$groups = array();
		// EVENTS.
			$key = array_search( KKW_EVENT_GROUP['slug'], $selected_contents, true );
		if ( false !== $key ) {
			array_push( $groups, KKW_EVENT_GROUP['slug'] );
			unset( $selected_contents[ $key ] );
		}
		// NEWS.
			$key = array_search( KKW_NEWS_GROUP['slug'], $selected_contents, true );
		if ( false !== $key ) {
			array_push( $groups, KKW_NEWS_GROUP['slug'] );
			unset( $selected_contents[ $key ] );
		}
			// ARTICLES.
			$key = array_search( KKW_ARTICLE_GROUP['slug'], $selected_contents, true );
		if ( false !== $key ) {
			array_push( $groups, KKW_ARTICLE_GROUP['slug'] );
			unset( $selected_contents[ $key ] );
		}

		$text_like = '%' . $wpdb->esc_like( $search_string ) . '%';
		$sql       = "
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

			$cond_items  = array();
			$sql_params  = array( $text_like, $text_like );
			$post_types  = array_map( 'sanitize_key', $selected_contents );
			$post_groups = array_map( 'sanitize_key', $groups );

		if ( ! empty( $post_types ) ) {
			$post_type_placeholders = implode( ', ', array_fill( 0, count( $post_types ), '%s' ) );
			$cond_items[]           = " ( p.post_type IN ($post_type_placeholders) ) ";
			$sql_params             = array_merge( $sql_params, $post_types );
		}
		if ( ! empty( $post_groups ) ) {
			$group_placeholders = implode( ', ', array_fill( 0, count( $post_groups ), '%s' ) );
			$cond_items[]       = " ( p.post_type = 'post' AND pm.meta_key = 'kkw_group' AND pm.meta_value IN ($group_placeholders) ) ";
			$sql_params         = array_merge( $sql_params, $post_groups );
		}
		if ( ! empty( $cond_items ) ) {
			$cond_post_type = join( ' OR ', $cond_items );
			$sql           .= 'AND (' . $cond_post_type . ')';
		}
		$query_results = $wpdb->get_col( $wpdb->prepare( $sql, $sql_params ) );
		array_push( $selected_contents, 'post' );
		$parameters = array(
			'paged'          => get_query_var( 'paged', 1 ),
			'posts_per_page' => $pagesize,
			'post_type'      => $selected_contents,
			'orderby'        => 'post__in',
			's'              => $search_string,
		);

		if ( ! empty( $query_results ) ) {
			$parameters['post__in'] = $query_results;
		} else {
			$parameters['post__in'] = array( 0 );
		}

		$the_query = new WP_Query( $parameters );
		return $the_query;
	}

	/**
	 * Retrieve book review wrappers by book ID.
	 *
	 * @param int $post_id Book post ID.
	 * @return KKW_WrappedReview[]
	 */
	public static function get_book_reviews( $post_id ) {
		$reviews = array();
		$args    = array(
			'post_type'      => 'kkw_review',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'kkw_book_link',
					'value'   => '"' . $post_id . '"',
					'compare' => 'LIKE',
				),
			),
		);
		$query   = new WP_Query( $args );
		$results = $query->get_posts();
		if ( $results ) {
			foreach ( $results as $pst ) {
				$meta_tags  = get_post_meta( $pst->ID );
				$parameters = array(
					'id'          => $pst->ID,
					'title'       => $pst->post_title,
					'author'      => self::extract_meta_tag( $meta_tags, 'kkw_author' ),
					'order'       => self::extract_meta_tag( $meta_tags, 'kkw_order' ),
					'description' => $pst->post_content,
					'label'       => self::extract_meta_tag( $meta_tags, 'kkw_source_description' ),
				);
				$item       = new KKW_WrappedReview( $parameters );
				array_push( $reviews, $item );
			}
		}
		$reviews = self::order_items( $reviews );
		return $reviews;
	}

	/**
	 * Sort wrapped items by their order property.
	 *
	 * @param array<int, object> $items Items with order property.
	 * @return array<int, object>
	 */
	public static function order_items( $items ) {
		usort(
			$items,
			function ( $a, $b ) {
				return $a->order - $b->order;
			}
		);
		return $items;
	}

	/**
	 * Retrieve book excerpt wrappers by book ID.
	 *
	 * @param int $post_id Book post ID.
	 * @return KKW_WrappedExcerpt[]
	 */
	public static function get_book_excerpts( $post_id ) {
		$reviews = array();
		$args    = array(
			'post_type'      => 'kkw_excerpt',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'kkw_book_link',
					'value'   => '"' . $post_id . '"',
					'compare' => 'LIKE',
				),
			),
		);
		$query   = new WP_Query( $args );
		$results = $query->get_posts();
		if ( $results ) {
			foreach ( $results as $pst ) {
				$meta_tags  = get_post_meta( $pst->ID );
				$parameters = array(
					'id'          => $pst->ID,
					'title'       => $pst->post_title,
					'order'       => self::extract_meta_tag( $meta_tags, 'kkw_order' ),
					'description' => $pst->post_content,
				);
				$item       = new KKW_WrappedExcerpt( $parameters );
				array_push( $reviews, $item );
			}
		}
		$reviews = self::order_items( $reviews );
		return $reviews;
	}

	/**
	 * Retrieve book tracks.
	 *
	 * @param int $post_id Book post ID.
	 * @return array
	 */
	public static function get_book_tracks( $post_id ) {
		unset( $post_id );
		return array();
	}

	/**
	 * Build Open Graph metadata for the current singular page.
	 *
	 * @return array<string, string|int>
	 */
	public static function get_og_data() {
		global $post;
		$og_data   = array(
			'id'           => '',
			'title'        => '',
			'type'         => '',
			'description'  => '',
			'image'        => '',
			'img_width'    => '',
			'img_height'   => '',
			'img_type'     => '',
			'site_url'     => '',
			'url'          => '',
			'domain'       => '',
			'short_name'   => '',
			'site_tagline' => '',
			'site_title'   => '',
			'shared_title' => '',
			'locale'       => '',
		);
		$item_id   = $post && $post->ID ? $post->ID : '';
		$item_type = $item_id && $post->post_type ? $post->post_type : '';
		$types     = array( 'post', 'kkw_book' );
		if ( $item_id && in_array( $item_type, $types, true ) ) {
			$img_id                  = get_post_thumbnail_id( $item_id );
			$img_array               = wp_get_attachment_image_src( $img_id, 'large' );
			$file_path               = $img_id ? get_attached_file( $img_id ) : '';
			$file_info               = $img_id ? wp_check_filetype( $file_path ) : '';
			$img_type                = $img_id ? $file_info['type'] : '';
			$item_title              = $post->post_title ? $post->post_title : '';
			$item_desc               = $post->post_content ? clean_and_truncate_text( $post->post_content, KKW_FEATURED_TEXT_MAX_SIZE ) : '';
			$item_image              = $img_id && count( $img_array ) ? $img_array[0] : '';
			$site_url                = site_url();
			$parsed_url              = wp_parse_url( $site_url );
			$domain                  = $parsed_url['host'];
			$item_url                = get_permalink();
			$short_name              = kkw_get_option( 'site_short_name', 'kkw_opt_options' );
			$site_title              = kkw_get_option( 'site_title', 'kkw_opt_options' );
			$site_tagline            = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
			$og_data['id']           = $item_id;
			$og_data['title']        = $item_title;
			$og_data['type']         = $item_type;
			$og_data['description']  = $item_desc;
			$og_data['image']        = $item_image;
			$og_data['img_width']    = $img_id && count( $img_array ) > 1 ? $img_array[1] : '0';
			$og_data['img_height']   = $img_id && count( $img_array ) > 2 ? $img_array[2] : '0';
			$og_data['img_type']     = $img_type;
			$og_data['site_url']     = $site_url;
			$og_data['domain']       = $domain;
			$og_data['url']          = $item_url;
			$og_data['short_name']   = $short_name;
			$og_data['site_tagline'] = $site_tagline;
			$og_data['site_title']   = $site_title;
			$og_data['shared_title'] = $item_title . ' - ' . $short_name;
			$og_data['lang_locale']  = KKW_ThemeLangManager::get_current_language( 'locale' );
		}
		return $og_data;
	}

	/**
	 * Download event data as ICS file.
	 *
	 * @param int $eid Event post ID.
	 * @return void
	 */
	public static function download_ics_file_by_id( $eid ) {
		$post = get_post( $eid );
		if ( $post ) {
			$post_wrapper = self::wrap_search_result( $post );
			$meta_tags    = get_post_meta( $post_wrapper->id );
			$event_name   = esc_attr( $post_wrapper->title );
			$description  = clean_and_truncate_text( $post_wrapper->description, KKW_FEATURED_TEXT_MAX_SIZE );

			$location       = esc_attr( self::extract_meta_tag( $meta_tags, 'kkw_address' ) );
			$start_time     = self::extract_calendar_date_string( $meta_tags, 'start' );
			$end_time       = self::extract_calendar_date_string( $meta_tags, 'end' );
			$site_url       = site_url();
				$parsed_url = wp_parse_url( $site_url );
			$domain         = $parsed_url['host'];
			$title          = kkw_get_option( 'site_title', 'kkw_opt_options' );
			$prod_id        = __( 'Export from site', 'kk_writer_theme' ) . ': ' . $title;
			// Set the header to download the .ics file.
			header( 'Content-type: text/calendar; charset=utf-8' );
			header( 'Content-Disposition: attachment; filename=evento.ics' );
			// Create the file ICS.
			$ics_content  = "BEGIN:VCALENDAR\n";
			$ics_content .= "VERSION:2.0\n";
			$ics_content .= 'PRODID:-//' . $prod_id . "//NONSGML v1.0//EN\n";
			$ics_content .= "CALSCALE:GREGORIAN\n";
			$ics_content .= "METHOD:PUBLISH\n";
			$ics_content .= "BEGIN:VEVENT\n";
			$ics_content .= 'UID:' . uniqid() . '@' . $domain . "\n";
			$ics_content .= 'DTSTAMP:' . gmdate( 'Ymd\THis\Z' ) . "\n";
			$ics_content .= 'DTSTART:' . gmdate( 'Ymd\THis\Z', strtotime( $start_time ) ) . "\n";
			if ( $end_time ) {
				$ics_content .= 'DTEND:' . gmdate( 'Ymd\THis\Z', strtotime( $end_time ) ) . "\n";
			}
			$ics_content .= 'SUMMARY:' . addslashes( $event_name ) . "\n";
			$ics_content .= 'DESCRIPTION:' . addslashes( $description ) . "\n";
			$ics_content .= 'LOCATION:' . addslashes( $location ) . "\n";
			$ics_content .= "TRANSP:OPAQUE\n";
			$ics_content .= "STATUS:CONFIRMED\n";
			$ics_content .= "END:VEVENT\n";
			$ics_content .= "END:VCALENDAR\n";
			// Print the .ics file content as plain text.
			echo wp_kses( $ics_content, array() );
		} else {
			echo '<h4>' . esc_html__( 'It is not possible to download the .ics file.', 'kk_writer_theme' ) . '</h4>';
		}
		exit;
	}

	/**
	 * Return page quote text.
	 *
	 * @param int $post_id Page post ID.
	 * @return string
	 */
	public static function get_page_quote( $post_id ) {
		$text = get_post_meta( $post_id, 'kkw_quote_text', true );
		return $text;
	}

	/**
	 * Return page epilogue text.
	 *
	 * @param int $post_id Page post ID.
	 * @return string
	 */
	public static function get_page_epilogue( $post_id ) {
		$text = get_post_meta( $post_id, 'kkw_epilogue_text', true );
		return $text;
	}

	/**
	 * Return page prologue text.
	 *
	 * @param int $post_id Page post ID.
	 * @return string
	 */
	public static function get_page_prologue( $post_id ) {
		$text = get_post_meta( $post_id, 'kkw_prologue_text', true );
		return $text;
	}

	/**
	 * Resolve plural group label from its slug.
	 *
	 * @param string $slug Group slug.
	 * @return string
	 */
	public static function get_plural_group_by_slug( $slug ) {
		$groups = KKW_POST_GROUPS;
		$plural = '';
		foreach ( $groups as $grp ) {
			if ( $grp['slug'] === $slug ) {
				return $grp['title-pl'];
			}
		}
		return $plural;
	}
}
