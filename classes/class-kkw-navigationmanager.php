<?php
/**
 * KK Writer Theme: Navigation manager.
 *
 * @package KK_Writer_Theme
 */

if ( ! class_exists( 'KKW_TreeItem' ) ) {
	include_once 'class-kkw-treeitem.php';
}

if ( ! class_exists( 'KKW_BreadItem' ) ) {
	include_once 'class-kkw-breaditem.php';
}

/**
 * Build site navigation models (breadcrumbs and tree).
 */
class KKW_NavigationManager {

	/**
	 * Build breadcrumb path entries for the provided post.
	 *
	 * @param WP_Post|null $post Current post object.
	 * @return array<int, KKW_BreadItem>
	 */
	public static function build_content_path( $post ): array {
		$root         = new KKW_BreadItem( 'Home', get_site_url(), 'breadcrumb-item' );
		$post_wrapper = KKW_ContentsManager::wrap_search_result( $post );
		$steps        = array();
		array_push( $steps, $root );
		if ( $post ) {
			switch ( $post->post_type ) {
				case KKW_DEFAULT_PAGE:
					$post_parent  = $post->post_parent;
					$post_parents = array();
					while ( 0 !== $post_parent ) {
						$post_tmp = get_post( $post_parent );
						if ( ! $post_tmp instanceof WP_Post ) {
							break;
						}
						$post_parents[] = new KKW_BreadItem(
							$post_tmp->post_title,
							get_permalink( $post_tmp->ID ),
							'breadcrumb-item'
						);
						$post_parent    = $post_tmp->post_parent;
					}
					$post_parents = count( $post_parents ) > 1 ? array_reverse( $post_parents ) : $post_parents;
					foreach ( $post_parents as $parent ) {
						array_push(
							$steps,
							$parent,
						);
					}
					array_push(
						$steps,
						new KKW_BreadItem(
							$post->post_title,
							$post->post_url,
							'breadcrumb-item active'
						),
					);
					break;
				case KKW_DEFAULT_POST:
					$group              = __( 'Blog', 'kk_writer_theme' ) . ' - ' . $post_wrapper->main_group;
					array_push(
						$steps,
						$post_parents[] = new KKW_BreadItem(
							$group,
							$post_wrapper->main_group_url,
							'breadcrumb-item'
						),
					);
					array_push(
						$steps,
						$post_parents[] = new KKW_BreadItem(
							$post_wrapper->title,
							'',
							'breadcrumb-item active'
						),
					);
					break;
				case KKW_POST_TYPES[ ID_PT_BOOK ]['name']:
					array_push(
						$steps,
						$post_parents[] = new KKW_BreadItem(
							$post_wrapper->main_group,
							$post_wrapper->main_group_url,
							'breadcrumb-item'
						),
					);
					array_push(
						$steps,
						$post_parents[] = new KKW_BreadItem(
							$post_wrapper->title,
							'',
							'breadcrumb-item active'
						),
					);
					break;
				default:
					// Unknown content type: keep breadcrumb with root only.
					break;
			}
		}
		return $steps;
	}

	/**
	 * Build the complete site navigation tree.
	 *
	 * @return array<string, KKW_TreeItem>
	 */
	public static function get_site_tree() {
		$pt       = array(); // Page Tree.
		$site_url = get_site_url();

		// 1 - Home Page.
		$home                    = new KKW_TreeItem(
			KKW_HOMEPAGE_NAME,
			KKW_HOMEPAGE_SLUG,
			$site_url
		);
		$pt[ KKW_HOMEPAGE_SLUG ] = $home;

		// 2 - Network Page.
		$network_url = kkw_get_option( 'site_network_url', 'kkw_opt_options' );
		if ( $network_url ) {
			$network_name = kkw_get_option( 'site_network_name', 'kkw_opt_options' );
			$network_name = $network_name ? $network_name : KKW_NETWORK_NAME;
			$network      = new KKW_TreeItem(
				$network_name,
				KKW_NETWORK_SLUG,
				$network_url,
				true
			);
			$pt[ KKW_HOMEPAGE_SLUG ]->children[ KKW_NETWORK_SLUG ] = $network;
		}

		// The list of the defined menus.
		$menus = wp_get_nav_menus();

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				// Add each menu to the site map.
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
				$menu_el    = new KKW_TreeItem(
					$menu->name,
					$menu->slug,
					''
				);
				$pt[ KKW_HOMEPAGE_SLUG ]->children[ $menu->slug ] = $menu_el;

				if ( ! empty( $menu_items ) ) {
					// The list of the items of this menu.
					foreach ( $menu_items as $menu_item ) {
						// Add each menu item to the site map.
						$page_el = self::get_tree_item( $menu_item );
						if ( $page_el ) {
							$pt[ KKW_HOMEPAGE_SLUG ]->children[ $menu->slug ]->children[ $page_el->slug ] = $page_el;
						}
					}
				}
			}
		}

		return $pt;
	}

	/**
	 * Build one tree item from a WordPress menu item.
	 *
	 * @param WP_Post|object $menu_item Menu item object.
	 * @return KKW_TreeItem|null
	 */
	private static function get_tree_item( $menu_item ) {
		$tree_item = null;
		if ( $menu_item
			&& ( 'home' !== $menu_item->post_name )
			&& ( 'post_type' === $menu_item->type )
		) {
			$object_id = $menu_item ? intval( $menu_item->object_id ) : 0;
			$object_id = KKW_ThemeLangManager::get_page_by_id( $object_id );
			if ( $object_id ) {
				$wrapper = KKW_ContentsManager::get_wrapped_item( $object_id );
				if ( $wrapper ) {
					$tree_item = new KKW_TreeItem(
						$wrapper->title,
						$wrapper->slug,
						$wrapper->detail_url
					);
				}
				// Add children if it is the Blog page.
				$is_blog_template = ( 'page-templates/blog.php' === get_page_template_slug( $object_id ) );
				$is_blog_slug     = ( 'blog' === sanitize_title( (string) $menu_item->post_name ) );
				if ( $is_blog_template || $is_blog_slug ) {
					// Search post group children.
					$groups   = self::get_post_group_slugs();
					$children = KKW_ContentsManager::get_site_post_wrappers(
						$groups,
						'title',
						'ASC',
						-1
					);
					foreach ( $children as $c ) {
						$blog_item                       = new KKW_TreeItem(
							$c->title,
							$c->slug,
							$c->detail_url
						);
						$tree_item->children[ $c->slug ] = $blog_item;
					}
				}
				// Add children if it is a BOOK section.
				$section = self::get_site_section_slug( $menu_item->title );
				if ( $section ) {
					// Search section children.
					$children = KKW_ContentsManager::get_section_books_wrappers(
						$section,
						'title',
						'ASC',
						-1
					);
					foreach ( $children as $c ) {
						$section_item                    = new KKW_TreeItem(
							$c->title,
							$c->slug,
							$c->detail_url
						);
						$tree_item->children[ $c->slug ] = $section_item;
					}
				}
			}
		}
		return $tree_item;
	}

	/**
	 * Return all the slugs of the site sections.
	 *
	 * @return array<int, string>
	 */
	public static function get_site_section_slugs() {
		$values = array();
		foreach ( KKW_SITE_SECTIONS as $section ) {
			if ( isset( $section['slug'] ) ) {
				$values[] = sanitize_title( $section['slug'] );
			}
		}
		return $values;
	}

	/**
	 * Return all the title of the site sections.
	 *
	 * @return array<int, string>
	 */
	public static function get_site_section_title() {
		$values = array();
		foreach ( KKW_SITE_SECTIONS as $section ) {
			if ( isset( $section['title'] ) ) {
				$values[] = sanitize_title( $section['title'] );
			}
		}
		return $values;
	}

	/**
	 * Return all the slugs of the post groups.
	 *
	 * @return array<int, string>
	 */
	public static function get_post_group_slugs() {
		$values = array();
		foreach ( KKW_POST_GROUPS as $section ) {
			if ( isset( $section['slug'] ) ) {
				$values[] = sanitize_title( $section['slug'] );
			}
		}
		return $values;
	}

	/**
	 * Resolve a section slug from any translated menu label.
	 *
	 * @param string $menu_label Menu item label.
	 * @return string
	 */
	private static function get_site_section_slug( $menu_label ) {
		$menu_label = sanitize_title( $menu_label );
		foreach ( KKW_SITE_SECTIONS as $section ) {
			$slug = isset( $section['slug'] ) ? sanitize_title( $section['slug'] ) : '';
			if ( ! $slug ) {
				continue;
			}

			$candidate_keys = array( 'slug', 'title', 'title_x', 'it', 'en' );
			foreach ( $candidate_keys as $key ) {
				if ( isset( $section[ $key ] ) && sanitize_title( $section[ $key ] ) === $menu_label ) {
					return $slug;
				}
			}
		}

		return '';
	}
}
