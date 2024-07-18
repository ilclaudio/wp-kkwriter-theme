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
	<h3 class="visually-hidden">
			<?php echo __( 'Section that contains the main menu of the site.', 'kk_writer_theme' ); ?>
	</h3>
	<nav class="nav nav-underline justify-content-between">
		<?php
		foreach ( $menu_items as $item ) {
			$wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $item );
		?>
			<a class="nav-item nav-link link-body-emphasis <?php if ( $wrapped_item['active'] ) echo 'active'; ?>"
				href="<?php echo $wrapped_item['link']; ?>">
				<?php echo $wrapped_item['title']; ?>
			</a>
		<?php
		}
		?>
	</nav>
</div>

<?php
	}
?>
