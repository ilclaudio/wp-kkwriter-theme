<?php
/**
 * KK Writer Theme: Navigation Manager definition.
 *
 * @package KK_Writer_Theme
 */

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
		$root = new KKW_BreadItem( 'Home',  get_site_url(), 'breadcrumb-item' );
		$steps = array();
		array_push( $steps, $root );
		if ( $post ) {
			switch ( $post->post_type ) {
				case 'page':
					$post_parent = $post->post_parent;
					$post_parents = array();
					while ( $post_parent !== 0 ) {
						$post_tmp       = get_post( $post_parent );
						$post_parents[] = new KKW_BreadItem( $post_tmp->post_title, get_permalink( $post_tmp->ID ), 'breadcrumb-item' );
						$post_parent    = $post_tmp->post_parent;
					}
					//reverse array
					$post_parents = count( $post_parents ) > 1 ? array_reverse( $post_parents ) : $post_parents;
					foreach ( $post_parents as $parent ) {
						array_push(
							$steps,
							$parent,
						);
					}
					array_push(
						$steps,
						new KKW_BreadItem( $post->post_title, $post->post_url, 'breadcrumb-item active' ),
					);
					break;
				case 'post':
					// @TODO: distingui kkw_book,articolo, notizia ed evento.
					array_push(
						$steps,
						$post_parents[] = new KKW_BreadItem( 'Blog', get_site_url() . '/blog', 'breadcrumb-item active' )
					);
					break;
				default:
					break;
				}
		}
		return $steps;
	}

}