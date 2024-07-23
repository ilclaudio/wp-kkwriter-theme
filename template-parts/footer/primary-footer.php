<?php
	$title     = kkw_get_option( 'site_title', 'kkw_opt_options' );
	$tagline   = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
	// All the defined locations.
	$locations = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id   = array_key_exists( KKW_PRIMARY_FOOTER_MENU_LOCATION, $locations ) ? 
		$locations[KKW_PRIMARY_FOOTER_MENU_LOCATION] :
		null;
?>

	<div id="primary-footer" class="row m-0 p-0 primary-bg">
		<h3 class="visually-hidden">
			<?php echo __( 'Section primary footer with site name, useful links and links to the socials.', 'kk_writer_theme' ); ?>
		</h3>
		<!-- First row: TAGLINE -->
		<div class="row col-sm-12 p-4 text-left">
				<h1 class="kkw_sitetitle"><a href="<?php echo KKW_PolylangManager::get_home_url(); ?>"><?php echo esc_html( $title, 'kk_writer_theme' ); ?></a></h1>
				<div class="kkw_tagline"><?php echo esc_html( $tagline, 'kk_writer_theme' ); ?></div>
		</div> <!-- first row -->

		<!-- Second row: Menu and socials -->
		<div class="row border-top">

			<!-- PRIMARY FOOTER MENU -->
			<div id="kkw_secondary_links" class="p-4 col-md-8 text-left">
			<?php
				// The items of the menu.
				if ( $menu_id ) {
					$menu_items = wp_get_nav_menu_items( $menu_id );
			?>
				<nav class="m-0 p-0 navbar navbar-expand-lg">
					<div id="navbarNav">
						<ul class="navbar-nav">
						<?php
							foreach ( $menu_items as $item ) {
								$wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $item );
						?>
							<li class="nav-item">
								<a title="<?php echo $wrapped_item['title']; ?>"
									<?php if ( $wrapped_item['type'] === 'custom' ) { ?> target="_blank"<?php } ?>
									class="nav-link m-0 py-0 pr-8 <?php if ( $wrapped_item['active'] ) echo 'active'; ?>"
									href="<?php echo $wrapped_item['link']; ?>">
									<?php echo $wrapped_item['title']; ?>
								</a>
							</li>
						<?php
							}
						?>
						</ul>
					</div>
				</nav>
			<?php
				}
			?>
			</div>

			<!-- SOCIALS -->
			<div id="kkw_footer_socials" class="p-4 col-md-4 text-right" style="text-align: right !important;">
				<?php get_template_part( 'template-parts/common/social_footer' ); ?>
			</div>

		</div> <!-- second row row -->
	
	</div> <!-- Primary Footer -->
