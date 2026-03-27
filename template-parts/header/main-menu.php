<?php
/**
 * KKW Writer Theme main menu template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_locations = get_nav_menu_locations();
$kkw_menu_id   = isset( $kkw_locations[ KKW_MAIN_MENU_LOCATION ] ) ? (int) $kkw_locations[ KKW_MAIN_MENU_LOCATION ] : 0;

if ( 0 === $kkw_menu_id ) {
	return;
}

$kkw_menu_items = wp_get_nav_menu_items( $kkw_menu_id );
if ( ! is_array( $kkw_menu_items ) || empty( $kkw_menu_items ) ) {
	return;
}
?>
<div class="mb-2 border-bottom">
	<h3 class="visually-hidden">
		<?php echo esc_html__( 'Section that contains the main menu of the site.', 'kk_writer_theme' ); ?>
	</h3>
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto w-100 justify-content-between">
					<?php foreach ( $kkw_menu_items as $kkw_menu_item ) : ?>
						<?php
						$kkw_wrapped_item = KKW_ContentsManager::get_wrapped_menu_item( $kkw_menu_item );
						$kkw_item_link    = isset( $kkw_wrapped_item['link'] ) ? (string) $kkw_wrapped_item['link'] : '';
						$kkw_item_title   = isset( $kkw_wrapped_item['title'] ) ? (string) $kkw_wrapped_item['title'] : '';
						$kkw_is_active    = ! empty( $kkw_wrapped_item['active'] );
						if ( '' === $kkw_item_link || '' === $kkw_item_title ) {
							continue;
						}
						?>
						<li class="nav-item">
							<a class="nav-link <?php echo esc_attr( $kkw_is_active ? 'active' : '' ); ?>" aria-current="page" href="<?php echo esc_url( $kkw_item_link ); ?>">
								<?php echo esc_html( $kkw_item_title ); ?>
							</a>
						</li>
					<?php endforeach; ?>

					<!-- Language selector (optional) -->
					<?php
					$kkw_selector_visible = kkw_get_option( 'language_selector_visible', 'kkw_opt_advanced_settings' );
					if ( 'true' === $kkw_selector_visible ) {
						$kkw_current_language = (string) KKW_ThemeLangManager::get_current_language( 'slug' );
						$kkw_languages        = KKW_ThemeLangManager::get_all_languages();
						$kkw_current_flag     = isset( $kkw_languages[ $kkw_current_language ]['flag'] ) ? (string) $kkw_languages[ $kkw_current_language ]['flag'] : '';
						?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php if ( '' !== $kkw_current_flag ) : ?>
									<img src="<?php echo esc_url( $kkw_current_flag ); ?>" alt="<?php echo esc_attr__( 'Current language flag', 'kk_writer_theme' ); ?>">
								<?php endif; ?>
							</a>
							<ul class="dropdown-menu">
								<?php
								if ( is_array( $kkw_languages ) ) {
									foreach ( $kkw_languages as $kkw_language_item ) {
										if ( ! is_array( $kkw_language_item ) ) {
											continue;
										}

										$kkw_language_url  = isset( $kkw_language_item['url'] ) ? (string) $kkw_language_item['url'] : '';
										$kkw_language_flag = isset( $kkw_language_item['flag'] ) ? (string) $kkw_language_item['flag'] : '';
										$kkw_language_name = isset( $kkw_language_item['name'] ) ? (string) $kkw_language_item['name'] : '';
										$kkw_language_alt  = sprintf(
											/* translators: %s: language name. */
											__( 'Flag of the language: %s', 'kk_writer_theme' ),
											$kkw_language_name
										);

										if ( '' === $kkw_language_url || '' === $kkw_language_name ) {
											continue;
										}
										?>
										<li>
											<a class="dropdown-item" href="<?php echo esc_url( $kkw_language_url ); ?>">
												<?php if ( '' !== $kkw_language_flag ) : ?>
													<img src="<?php echo esc_url( $kkw_language_flag ); ?>" alt="<?php echo esc_attr( $kkw_language_alt ); ?>">
												<?php endif; ?>
												<?php echo esc_html( $kkw_language_name ); ?>
											</a>
										</li>
										<?php
									}
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
