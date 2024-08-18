<?php
/**
 * KK Writer Theme: Navigation Manager definition.
 *
 * @package KK_Writer_Theme
 */


 class KKW_TreeItem {
	public string $name;
	public string $slug;
	public string $link;
	public bool   $external;
	public array  $children;

	public function __construct( $name, $slug, $link, $external=false, $children=array() ) {
		$this->name     = $name;
		$this->slug     = $slug;
		$this->link     = $link;
		$this->external = $external;
		$this->children = $children;
	}
 }



class KKW_BreadItem {
	public string $label;
	public string $url;
	public string $class;

	public function __construct( $label, $url, $class ) {
		$this->label = $label;
		$this->url   = $url;
		$this->class = $class;
	}
}

 class KKW_NavigationManager {

	public static function build_content_path( $post ): array {
		$root         = new KKW_BreadItem( 'Home',  get_site_url(), 'breadcrumb-item' );
		$post_wrapper = KKW_ContentsManager::wrap_search_result( $post );
		// $meta_tags    = get_post_meta( $post_wrapper->id );
		$steps = array();
		array_push( $steps, $root );
		if ( $post ) {
			switch ( $post->post_type ) {
				case KKW_DEFAULT_PAGE:
					$post_parent = $post->post_parent;
					$post_parents = array();
					while ( $post_parent !== 0 ) {
						$post_tmp       = get_post( $post_parent );
						$post_parents[] = new KKW_BreadItem(
							$post_tmp->post_title,
							get_permalink( $post_tmp->ID ),
							'breadcrumb-item'
						);
						$post_parent = $post_tmp->post_parent;
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
					$group = __( 'Blog', 'kk_writer_theme' ) .
						' - ' . __( $post_wrapper->main_group, 'kk_writer_theme' );
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
					echo 'tipo contenuto sconosciuto';
					break;
				}
		}
		return $steps;
	}

	public static function get_site_tree() {
		$pt = array(); // Page Tree.
		$site_url = get_site_url();
		
		// 1 - Home Page.
		$home     =  new KKW_TreeItem(
			KKW_HOMEPAGE_NAME,
			KKW_HOMEPAGE_SLUG,
			$site_url
		);
		$pt[KKW_HOMEPAGE_SLUG] = $home;

		// 2 - Network Page.
		$network_url  = kkw_get_option( 'site_network_url', 'kkw_opt_options' );
		if ( $network_url ) {
			$network_name = kkw_get_option( 'site_network_name', 'kkw_opt_options' );
			$network_name =  $network_name ? $network_name : KKW_NETWORK_NAME;
			$network      =  new KKW_TreeItem(
				$network_name,
				KKW_NETWORK_SLUG,
				$network_url,
				true
			);
			$pt[KKW_HOMEPAGE_SLUG]->children[KKW_NETWORK_SLUG] = $network;
		}

		// The list of the defined menus.
		$menus = wp_get_nav_menus();
	
		if ( ! empty( $menus ) ) {

			foreach ( $menus as $menu ) {

				// Add each menu to the site map.
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
				$menu_el = new KKW_TreeItem(
					$menu->name,
					$menu->slug,
					''
				);
				$pt[KKW_HOMEPAGE_SLUG]->children[$menu->slug] = $menu_el;
				

				if ( ! empty( $menu_items ) ) {
					// The list of the items of this menu.
					foreach ( $menu_items as $menu_item ) {

						// Add each menu item to the site map.
						$page_el = self::get_tree_item( $menu_item );
						if ( $page_el ) {
							$pt[KKW_HOMEPAGE_SLUG]->children[$menu->slug]->children[$page_el->slug] = $page_el;

						}
					}

				}
			}

		}

		return $pt;
	}

	private static function get_tree_item( $menu_item ) {
		$tree_item = null;
		if ( $menu_item 
						&& ( $menu_item->post_name !== 'home' ) 
						&& ( $menu_item->type === 'post_type' ) 
		) {
			$object_id = $menu_item ? intval( $menu_item->object_id ) : 0;
			$object_id = KKW_MultiLangManager::get_page_by_id( $object_id );
			if ( $object_id ) {
			$wrapper = KKW_ContentsManager::get_wrapped_item( $object_id );
				if ( $wrapper ) {
					$tree_item = new KKW_TreeItem(
						$wrapper->title,
						$wrapper->slug,
						$wrapper->detail_url
					);
				}
				// Add children if it is a post of the blog.
				if ( $wrapper->type === KKW_DEFAULT_POST ) {
					$children = array();
				}
				// Add children if it is a book section.
				if ( $wrapper->type === KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ) {
					
				}

			}
		}
		return $tree_item;
	}

}