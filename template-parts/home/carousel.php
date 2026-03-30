<?php
/**
 * KKW Writer Theme: Home carousel section.
 *
 * @package KK_Writer_Theme
 */

$kkw_carousel_items = KKW_ContentsManager::get_home_carousel_contents();
$kkw_carousel_items = is_array( $kkw_carousel_items ) ? $kkw_carousel_items : array();

if ( empty( $kkw_carousel_items ) ) {
	return;
}

$kkw_carousel_item_count = count( $kkw_carousel_items );
$kkw_card_height         = (int) KKW_CAROUSEL_CARD_HEIGHT;
$kkw_autoscroll_enabled  = kkw_get_option( 'home_carousel_autoscroll_enabled', 'kkw_opt_hp_layout' );
$kkw_autoscroll_interval = (int) kkw_get_option( 'home_carousel_autoscroll_interval', 'kkw_opt_hp_layout', '5' );
$kkw_autoscroll_interval = $kkw_autoscroll_interval > 0 ? $kkw_autoscroll_interval * 1000 : 5000;
?>

<div id="carouselExampleIndicators" class="mt-4 carousel slide"
	data-bs-touch="true"
	data-bs-wrap="true"
	<?php if ( 'true' === $kkw_autoscroll_enabled ) : ?>
		data-bs-ride="carousel"
		data-bs-interval="<?php echo esc_attr( (string) $kkw_autoscroll_interval ); ?>"
		data-bs-pause="hover"
	<?php endif; ?>>
	<h3 class="visually-hidden">
		<?php echo esc_html__( 'Section that contains a carousel with the most important contents of the site.', 'kk_writer_theme' ); ?>
	</h3>

	<!-- INDICATORS -->
	<div class="carousel-indicators">
		<?php for ( $kkw_indicator_index = 0; $kkw_indicator_index < $kkw_carousel_item_count; $kkw_indicator_index++ ) : ?>
			<?php $kkw_indicator_active = ( 0 === $kkw_indicator_index ); ?>
			<button type="button"
				data-bs-target="#carouselExampleIndicators"
				data-bs-slide-to="<?php echo esc_attr( (string) $kkw_indicator_index ); ?>"
				class="<?php echo esc_attr( $kkw_indicator_active ? 'active' : '' ); ?>"
				aria-current="<?php echo esc_attr( $kkw_indicator_active ? 'true' : 'false' ); ?>"
				aria-label="<?php echo esc_attr( sprintf( 'Slide %d', $kkw_indicator_index + 1 ) ); ?>"></button>
		<?php endfor; ?>
	</div>

	<!-- BEGIN slides -->
	<div class="carousel-inner">
		<?php foreach ( $kkw_carousel_items as $kkw_slide_index => $kkw_slide_item ) : ?>
			<?php
			$kkw_slide_post_id     = isset( $kkw_slide_item->id ) ? (int) $kkw_slide_item->id : 0;
			$kkw_slide_img_id      = $kkw_slide_post_id ? get_post_thumbnail_id( $kkw_slide_post_id ) : 0;
			$kkw_slide_img         = $kkw_slide_img_id ? wp_get_attachment_image_src( $kkw_slide_img_id, 'large' ) : null;
				$kkw_slide_img_src = ( is_array( $kkw_slide_img ) && isset( $kkw_slide_img[0] ) ) ? (string) $kkw_slide_img[0] : '';
				$kkw_slide_img_alt = $kkw_slide_img_id ? get_post_meta( $kkw_slide_img_id, '_wp_attachment_image_alt', true ) : '';
				$kkw_slide_title   = isset( $kkw_slide_item->title ) ? (string) $kkw_slide_item->title : '';
				$kkw_slide_desc    = isset( $kkw_slide_item->description ) ? (string) $kkw_slide_item->description : '';
				$kkw_slide_url     = isset( $kkw_slide_item->detail_url ) ? (string) $kkw_slide_item->detail_url : '';
				/* translators: %s: slide title. */
				$kkw_read_more_aria_label = sprintf( __( 'Read more about: %s', 'kk_writer_theme' ), $kkw_slide_title );

			if ( '' === $kkw_slide_img_alt ) {
				$kkw_slide_img_alt = $kkw_slide_title;
			}
			?>
			<!-- begin slide -->
			<div class="carousel-item <?php echo esc_attr( 0 === $kkw_slide_index ? 'active' : '' ); ?>">
				<div class="card mb-3 primary-bg" style="width: 100%">
					<div class="row g-0 mx-4">
						<!-- slide image -->
						<div class="col-md-3 g-0 p-0 m-0 text-center">
							<a class="kkw_link" href="<?php echo esc_url( $kkw_slide_url ); ?>">
								<img style="max-height: <?php echo esc_attr( (string) $kkw_card_height ); ?>px;"
									src="<?php echo esc_url( $kkw_slide_img_src ); ?>"
									class="img-fluid rounded-start p-3"
									alt="<?php echo esc_attr( $kkw_slide_img_alt ); ?>">
							</a>
						</div>

						<!-- slide text -->
						<div class="col-md-9">
							<div class="card-body" style="width: 95%">
								<h5 class="card-title">
									<a class="kkw_link" href="<?php echo esc_url( $kkw_slide_url ); ?>">
										<b><?php echo esc_html( $kkw_slide_title ); ?></b>
									</a>
								</h5>
									<p class="card-text">
										<?php echo wp_kses_post( $kkw_slide_desc ); ?>
									</p>
									<p class="card-text">
										<small class="text-body-secondary">
											<a class="kkw_link" href="<?php echo esc_url( $kkw_slide_url ); ?>"
												aria-label="<?php echo esc_attr( $kkw_read_more_aria_label ); ?>">
												<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
											&nbsp;<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
										</a>
									</small>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end slide -->
		<?php endforeach; ?>
	</div>
	<!-- END slides -->

	<!-- BUTTONS next and prev -->
	<button class="carousel-control-prev d-none d-md-flex" type="button"
		data-bs-target="#carouselExampleIndicators"
		data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden"><?php echo esc_html__( 'Back', 'kk_writer_theme' ); ?></span>
	</button>
	<button class="carousel-control-next d-none d-md-flex" type="button"
		data-bs-target="#carouselExampleIndicators"
		data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden"><?php echo esc_html__( 'Next', 'kk_writer_theme' ); ?></span>
	</button>
</div>
