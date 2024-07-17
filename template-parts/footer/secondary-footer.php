<?php
	// All the defined locations.
	$locations  = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id    = array_key_exists( KKW_SECONDARY_FOOTER_MENU_LOCATION, $locations ) ? 
		$locations[KKW_SECONDARY_FOOTER_MENU_LOCATION] :
		null;
	// The items of the menu.
	if ( $menu_id ) {
		$menu_items = wp_get_nav_menu_items( $menu_id );
?>


<section id="secondary-footer" class="fill-secondary p-2 text-white text-center small">
		<div class="it-footer-small-prints clearfix">
			<div class="container">
				<h3 class="visually-hidden">__( 'Section useful links', 'kk_writer_theme' );</h3>
				<?php
		foreach ( $menu_items as $item ) {
			echo $item->post_name . ' - ';
		}
	?>
			</div>
		</div>
</section>

<?php
	}
?>
