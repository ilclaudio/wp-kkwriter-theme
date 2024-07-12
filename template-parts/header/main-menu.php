<?php
	// All the defined locations.
	$locations  = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id    = array_key_exists(KKW_MAIN_MENU_LOCATION, $locations) ? 
		$locations[KKW_MAIN_MENU_LOCATION] :
		null;
	// The items of the menu.
	if ( $menu_id ) {
		$menu_items = wp_get_nav_menu_items( $menu_id );
		// title, url, ID
?>

<div class="nav-scroller py-1 mb-3 border-bottom">
	<nav class="nav nav-underline justify-content-between">
		<?php
		foreach ( $menu_items as $item ) {
			$page_id  = KKW_PolylangManager::get_page_by_id( $item->object_id );
			$page     = get_post( $page_id );
			$active   = is_page( $page_id );
			$page_url = get_permalink( $page_id );
			// $parent_id = wp_get_post_parent_id();--> multilevels checks.
		?>
			<a class="nav-item nav-link link-body-emphasis <?php if ( $active ) echo 'active'; ?>"
				href="<?php echo $page_url; ?>">
				<?php echo $page->post_title; ?>
			</a>
		<?php
		}
		?>
	</nav>
</div>

<?php
	} // If the menu exists.
?>
