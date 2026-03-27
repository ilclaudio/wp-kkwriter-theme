<?php
/**
 * KKW Writer Theme primary footer template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_site_title   = kkw_get_option( 'site_title', 'kkw_opt_options' );
$kkw_site_tagline = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
$kkw_locations    = get_nav_menu_locations();
$kkw_menu_id      = isset( $kkw_locations[ KKW_PRIMARY_FOOTER_MENU_LOCATION ] ) ? (int) $kkw_locations[ KKW_PRIMARY_FOOTER_MENU_LOCATION ] : 0;
$kkw_menu_items   = array();

if ( 0 !== $kkw_menu_id ) {
	$kkw_menu_items = wp_get_nav_menu_items( $kkw_menu_id );
	$kkw_menu_items = is_array( $kkw_menu_items ) ? $kkw_menu_items : array();
}
?>

<div id="primary-footer" class="row m-0 p-0 primary-bg">
	<h3 class="visually-hidden">
		<?php echo esc_html__( 'Section primary footer with site name, useful links and links to the socials.', 'kk_writer_theme' ); ?>
	</h3>
	<!-- First row: TAGLINE -->
	<div class="row col-sm-12 p-4 text-left">
		<h1 class="kkw_sitetitle">
			<a href="<?php echo esc_url( KKW_ThemeLangManager::get_home_url() ); ?>"><?php echo esc_html( (string) $kkw_site_title ); ?></a>
		</h1>
		<div class="kkw_tagline"><?php echo esc_html( (string) $kkw_site_tagline ); ?></div>
	</div>

	<!-- Second row: Menu and socials -->
	<div class="m-0 p-0 row border-top">
		<!-- PRIMARY FOOTER MENU -->
		<div id="kkw_secondary_links" class="p-4 col-md-8 text-left">
			<?php if ( ! empty( $kkw_menu_items ) ) : ?>
				<nav class="m-0 p-0 navbar navbar-expand-lg">
					<div id="navbarNav">
						<ul class="navbar-nav">
							<?php foreach ( $kkw_menu_items as $kkw_menu_item ) : ?>
								<?php
								$kkw_wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $kkw_menu_item );
								$kkw_item_title   = isset( $kkw_wrapped_item['title'] ) ? (string) $kkw_wrapped_item['title'] : '';
								$kkw_item_link    = isset( $kkw_wrapped_item['link'] ) ? (string) $kkw_wrapped_item['link'] : '';
								$kkw_item_type    = isset( $kkw_wrapped_item['type'] ) ? (string) $kkw_wrapped_item['type'] : '';
								$kkw_is_active    = ! empty( $kkw_wrapped_item['active'] );
								$kkw_link_classes = $kkw_is_active ? 'nav-link m-0 py-0 pr-8 active' : 'nav-link m-0 py-0 pr-8';

								if ( '' === $kkw_item_title || '' === $kkw_item_link ) {
									continue;
								}
								?>
								<li class="nav-item">
									<a title="<?php echo esc_attr( $kkw_item_title ); ?>"
										<?php if ( 'custom' === $kkw_item_type ) : ?>
											target="_blank" rel="noopener noreferrer"
										<?php endif; ?>
										class="<?php echo esc_attr( $kkw_link_classes ); ?>"
										href="<?php echo esc_url( $kkw_item_link ); ?>">
										<?php echo esc_html( $kkw_item_title ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</nav>
			<?php endif; ?>
		</div>

		<!-- SOCIALS -->
		<div id="kkw_footer_socials" class="p-4 col-md-4 text-right" style="text-align: right !important;">
			<?php get_template_part( 'template-parts/common/social_footer' ); ?>
		</div>
	</div>
</div>
