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
	<div class="mb-2 border-bottom">
		<h3 class="visually-hidden">
				<?php echo __( 'Section that contains the main menu of the site.', 'kk_writer_theme' ); ?>
		</h3>
		<nav class="navbar navbar-expand-lg bg-light">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto w-100 justify-content-between">
					<?php
						foreach ( $menu_items as $item ) {
						$wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $item );
					?>
						<li class="nav-item">
							<a class="nav-link <?php if ( $wrapped_item['active'] ) echo 'active'; ?>" aria-current="page"
								href="<?php echo $wrapped_item['link']; ?>">
								<?php echo $wrapped_item['title']; ?>
							</a>
						</li>
					<?php
					}
					?>
						<!-- Language selector (optional) -->
						<?php
							$selettore_visibile = kkw_get_option( 'language_selector_visible', 'kkw_opt_advanced_settings' );
							if ( 'true' === $selettore_visibile ) {
								$current_language = KKW_ThemeLangManager::get_current_language( 'slug' );
								$languages        = KKW_ThemeLangManager::get_all_languages();
								$current_flag     = $languages[$current_language]['flag'];
						?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo $current_flag; ?>" />
							</a>
							<ul class="dropdown-menu">
								<?php
								foreach ( $languages as $item ){
								?>
									<li>
										<a class="dropdown-item" href="<?php echo $item['url']; ?>">
										<img
											src="<?php echo $item['flag']; ?>"
											alt="<?php echo esc_attr( __( 'Flag of the language', 'kk_writer_theme' ) ) . ': ' . $current_language; ?>"
										/>
										<?php echo $item['name']; ?></a>
									</li>
								<?php
								}
								?>
							</ul>
						</li>
						<?php
							}
						?>

					</ul>
				</div>
			</div>
		</nav>
	</div>

<?php
	}
?>