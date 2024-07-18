<?php
	// All the defined locations.
	$locations  = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id    = array_key_exists( KKW_SECONDARY_FOOTER_MENU_LOCATION, $locations ) ? 
		$locations[KKW_SECONDARY_FOOTER_MENU_LOCATION] :
		null;
?>

<div id="secondary-footer" class="fill-secondary text-white text-center small">
	<h3 class="visually-hidden">
		<?php echo __( 'Section secondary footer with administrative links', 'kk_writer_theme' ); ?>
	</h3>
	<?php
	// The items of the menu.
	if ( $menu_id ) {
		$menu_items = wp_get_nav_menu_items( $menu_id );
	?>
	<div class="row p-2 col-sm-12">
		<nav class="navbar navbar-expand-lg justify-content-center">
			<div id="navbarNav2">
				<ul class="navbar-nav">
					<?php
						foreach ( $menu_items as $item ) {
							$wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $item );
							// $active       = ( $wrapped_item['type'] !== 'custom' ) && is_page( $wrapped_item['id'] );
					?>
						<li class="nav-item">
							<a title="<?php echo $wrapped_item['title']; ?>"
								<?php if ( $wrapped_item['type'] === 'custom' ) { ?> target="_blank"<?php } ?>
								class="text-color-primary nav-link py-0 px-12 <?php if ( $wrapped_item['active'] ) echo 'active'; ?>"
								href="<?php echo $wrapped_item['link']; ?>">
								&nbsp;&nbsp;
								<?php echo $wrapped_item['title']; ?>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</div>
	</div>
	<?php
		}
	?>
</div>

