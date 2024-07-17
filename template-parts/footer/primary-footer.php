<?php
	$title     = kkw_get_option( 'site_title', 'kkw_opt_options' );
	$tagline   = kkw_get_option( 'site_tagline', 'kkw_opt_options' );

	// All the defined locations.
	$locations  = get_nav_menu_locations();
	// The menu assigned to that location.
	$menu_id    = array_key_exists( KKW_PRIMARY_FOOTER_MENU_LOCATION, $locations ) ? 
		$locations[KKW_PRIMARY_FOOTER_MENU_LOCATION] :
		null;
?>

	<div id="primary-footer" class="row m-0 p-0 fill-primary">
		<!-- TAGLINE -->
		<div class="row col-sm-12 p-4">
			<div class="text-left">
				<h1 class="kkw_sitetitle"><a href="<?php echo KKW_PolylangManager::get_home_url(); ?>"><?php echo esc_html( $title, 'kk_writer_theme' ); ?></a></h1>
				<div class="kkw_tagline"><?php echo esc_html( $tagline, 'kk_writer_theme' ); ?></div>
			</div>
		</div>

		<div class="row m-0 p-0 border-top">
			<!-- PRIMARY FOOTER MENU -->
			<div id="kkw_secondary_links" class="p-4 col-md-6 text-left">
				<?php
					// The items of the menu.
					if ( $menu_id ) {
						$menu_items = wp_get_nav_menu_items( $menu_id );
						foreach ( $menu_items as $item ) {
							echo $item->post_name . ' - ';
						}
					}
				?>
			</div>
			<div id="kkw_footer_socials" class="p-4 col-md-6 text-right" style="text-align: right !important;">
				<!-- SOCIALS -->
				<?php get_template_part( 'template-parts/common/social_footer' ); ?>
			</div>
		</div>
	
	</div>
