<?php
/**
 * KKW Writer Theme secondary footer template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_locations  = get_nav_menu_locations();
$kkw_menu_id    = isset( $kkw_locations[ KKW_SECONDARY_FOOTER_MENU_LOCATION ] ) ? (int) $kkw_locations[ KKW_SECONDARY_FOOTER_MENU_LOCATION ] : 0;
$kkw_menu_items = array();

if ( 0 !== $kkw_menu_id ) {
	$kkw_menu_items = wp_get_nav_menu_items( $kkw_menu_id );
	$kkw_menu_items = is_array( $kkw_menu_items ) ? $kkw_menu_items : array();
}
?>

<div id="secondary-footer" class="secondary-bg text-white text-center small">
	<h3 class="visually-hidden">
		<?php echo esc_html__( 'Section secondary footer with administrative links', 'kk_writer_theme' ); ?>
	</h3>
	<?php if ( ! empty( $kkw_menu_items ) ) : ?>
		<div class="row p-2 col-sm-12">
			<nav class="navbar navbar-expand-lg justify-content-center">
				<div id="navbarNav2">
					<ul class="navbar-nav">
						<?php foreach ( $kkw_menu_items as $kkw_menu_item ) : ?>
							<?php
							$kkw_wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $kkw_menu_item );
							$kkw_item_title   = isset( $kkw_wrapped_item['title'] ) ? (string) $kkw_wrapped_item['title'] : '';
							$kkw_item_link    = isset( $kkw_wrapped_item['link'] ) ? (string) $kkw_wrapped_item['link'] : '';
							$kkw_item_type    = isset( $kkw_wrapped_item['type'] ) ? (string) $kkw_wrapped_item['type'] : '';
							$kkw_is_active    = ! empty( $kkw_wrapped_item['active'] );
							$kkw_link_classes = $kkw_is_active ? 'text-color-primary nav-link py-0 px-12 active' : 'text-color-primary nav-link py-0 px-12';

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
									&nbsp;&nbsp;
									<?php echo esc_html( $kkw_item_title ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</nav>
		</div>
	<?php endif; ?>
</div>
