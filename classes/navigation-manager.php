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
		$meta_tags    = get_post_meta( $post_wrapper->id );
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


		$options        = get_option( 'polylang' );
		$menu_locations = $options['nav_menus']['design-laboratori-wordpress-theme'];

		// // Recupera elenco dei menu per lingua.
		// $menu_items = dli_get_all_menus_by_lang( $lng_slug );
		// $slugs      = dli_get_pt_archive_slugs();
	

		return $pt;
	}

}