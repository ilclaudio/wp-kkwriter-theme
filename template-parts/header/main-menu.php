<?php
	// All the defined locations.
	$locations  = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id    = array_key_exists( KKW_MAIN_MENU_LOCATION, $locations ) ? 
		$locations[KKW_MAIN_MENU_LOCATION] :
		null;
	// The items of the menu.
	if ( $menu_id ) {
		$menu_items = wp_get_nav_menu_items( $menu_id );
?>

<div class="nav-scroller py-1 mb-3 border-bottom">
	<nav class="nav nav-underline justify-content-between">
		<?php
		foreach ( $menu_items as $item ) {
			if ( $item->post_name !== 'home' ) {
				// All menu items.
				$page_id  = KKW_PolylangManager::get_page_by_id( $item->object_id );
					$page     = get_post( $page_id );
					$active   = is_page( $page_id );
					$page_url = get_permalink( $page_id );
					$title    = $page->post_title;
				// $parent_id = wp_get_post_parent_id();--> multilevels checks.
			} else {
				// Only the Home Page.
				$active   = is_home();
				$page_url = KKW_PolylangManager::get_home_url();
				$title    = 'Home';
			}
		?>
			<a class="nav-item nav-link link-body-emphasis <?php if ( $active ) echo 'active'; ?>"
				href="<?php echo $page_url; ?>">
				<?php echo $title; ?>
			</a>
		<?php
		}
		?>
	</nav>
</div>

<?php
	}
?>
