<?php
/**
 * KKW Writer Theme: Home featured contents section.
 *
 * @package KK_Writer_Theme
 */

$kkw_extract_image_data = static function ( $kkw_post_id, $kkw_image_size, $kkw_fallback_alt ) {
	$kkw_image_id    = $kkw_post_id ? get_post_thumbnail_id( $kkw_post_id ) : 0;
	$kkw_image_array = $kkw_image_id ? wp_get_attachment_image_src( $kkw_image_id, $kkw_image_size ) : null;
	$kkw_image_src   = ( is_array( $kkw_image_array ) && isset( $kkw_image_array[0] ) ) ? (string) $kkw_image_array[0] : '';
	$kkw_image_alt   = $kkw_image_id ? get_post_meta( $kkw_image_id, '_wp_attachment_image_alt', true ) : '';

	if ( '' === (string) $kkw_image_alt ) {
		$kkw_image_alt = $kkw_fallback_alt;
	}

	return array(
		'src' => (string) $kkw_image_src,
		'alt' => (string) $kkw_image_alt,
	);
};

$kkw_prepare_featured_box = static function ( $kkw_option_key ) use ( $kkw_extract_image_data ) {
	$kkw_option_value = kkw_get_option( $kkw_option_key, 'kkw_opt_hp_layout' );
	$kkw_option_item  = ( is_array( $kkw_option_value ) && isset( $kkw_option_value[0] ) && is_array( $kkw_option_value[0] ) )
		? $kkw_option_value[0]
		: null;

	if ( ! is_array( $kkw_option_item ) ) {
		return null;
	}

	$kkw_box_content_raw = isset( $kkw_option_item['box_content'] ) ? (string) $kkw_option_item['box_content'] : '';
	$kkw_box_content_ids = '' !== $kkw_box_content_raw ? explode( ',', $kkw_box_content_raw ) : array();
	$kkw_selected_id     = isset( $kkw_box_content_ids[0] ) ? (int) $kkw_box_content_ids[0] : 0;
	$kkw_post_id         = $kkw_selected_id ? (int) KKW_ThemeLangManager::get_page_by_id( $kkw_selected_id ) : 0;

	if ( 0 === $kkw_post_id ) {
		return null;
	}

	$kkw_wrapper = KKW_ContentsManager::get_wrapped_item( $kkw_post_id );
	if ( ! is_object( $kkw_wrapper ) ) {
		return null;
	}

	$kkw_title = isset( $kkw_wrapper->title ) ? (string) $kkw_wrapper->title : '';
	$kkw_image = $kkw_extract_image_data( $kkw_post_id, 'featured-post', $kkw_title );

	return array(
		'wrapper' => $kkw_wrapper,
		'image'   => $kkw_image,
	);
};

$kkw_prepare_latest_item = static function ( $kkw_group_slug ) use ( $kkw_extract_image_data ) {
	$kkw_items = KKW_ContentsManager::get_site_post_wrappers(
		array( $kkw_group_slug ),
		'date',
		'DESC',
		1
	);

	if ( ! is_array( $kkw_items ) || empty( $kkw_items[0] ) || ! is_object( $kkw_items[0] ) ) {
		return null;
	}

	$kkw_wrapper = $kkw_items[0];
	$kkw_post_id = isset( $kkw_wrapper->id ) ? (int) $kkw_wrapper->id : 0;
	$kkw_title   = isset( $kkw_wrapper->title ) ? (string) $kkw_wrapper->title : '';
	$kkw_image   = $kkw_extract_image_data( $kkw_post_id, 'small-featured', $kkw_title );

	return array(
		'wrapper' => $kkw_wrapper,
		'image'   => $kkw_image,
	);
};

$kkw_featured_box_1 = $kkw_prepare_featured_box( 'featured_content_1' );
$kkw_featured_box_2 = $kkw_prepare_featured_box( 'featured_content_2' );
$kkw_featured_box_3 = $kkw_prepare_featured_box( 'featured_content_3' );
$kkw_latest_news    = $kkw_prepare_latest_item( KKW_NEWS_GROUP['slug'] );
$kkw_latest_event   = $kkw_prepare_latest_item( KKW_EVENT_GROUP['slug'] );

$kkw_featured_img_width        = (int) KKW_FEATURED_IMG_WIDTH;
$kkw_featured_img_height       = (int) KKW_FEATURED_IMG_HEIGHT;
$kkw_small_featured_img_width  = (int) KKW_SMALL_FEATURED_IMG_WIDTH;
$kkw_small_featured_img_height = (int) KKW_SMALL_FEATURED_IMG_HEIGHT;
?>

<!-- FIRST ROW -->
<div id="fc_first_row" class="row mt-4 mb-1 fc-row">
	<!-- left box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
			<?php if ( null !== $kkw_featured_box_1 ) : ?>
				<?php
				$kkw_fc1_wrapper   = $kkw_featured_box_1['wrapper'];
				$kkw_fc1_image     = $kkw_featured_box_1['image'];
				$kkw_fc1_group_url = isset( $kkw_fc1_wrapper->main_group_url ) ? (string) $kkw_fc1_wrapper->main_group_url : '';
				$kkw_fc1_group     = isset( $kkw_fc1_wrapper->main_group ) ? (string) $kkw_fc1_wrapper->main_group : '';
				$kkw_fc1_title     = isset( $kkw_fc1_wrapper->title ) ? (string) $kkw_fc1_wrapper->title : '';
				$kkw_fc1_desc      = isset( $kkw_fc1_wrapper->description ) ? (string) $kkw_fc1_wrapper->description : '';
				$kkw_fc1_detail    = isset( $kkw_fc1_wrapper->detail_url ) ? (string) $kkw_fc1_wrapper->detail_url : '';
				?>
				<div class="col p-4 d-flex flex-column position-static">
					<strong class="d-inline-block mb-2 text-primary-emphasis">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc1_group_url ); ?>">
							<?php echo esc_html( $kkw_fc1_group ); ?>
						</a>
					</strong>
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc1_detail ); ?>">
						<h4 class="mb-0"><?php echo esc_html( $kkw_fc1_title ); ?></h4>
					</a>
					<p class="card-text mb-auto kkw_featured_text mt-3">
						<?php echo esc_html( clean_and_truncate_text( $kkw_fc1_desc, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
					</p>
					<small class="pt-2 text-body-secondary">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc1_detail ); ?>">
							<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
							&nbsp;<i class="fa-solid fa-arrow-right"></i>
						</a>
					</small>
				</div>
				<div class="col-auto d-none d-lg-block">
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc1_detail ); ?>">
						<img src="<?php echo esc_url( $kkw_fc1_image['src'] ); ?>"
							class="bd-placeholder-img"
							width="<?php echo esc_attr( (string) $kkw_featured_img_width ); ?>"
							height="<?php echo esc_attr( (string) $kkw_featured_img_height ); ?>"
							alt="<?php echo esc_attr( $kkw_fc1_image['alt'] ); ?>">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- right box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
			<?php if ( null !== $kkw_featured_box_2 ) : ?>
				<?php
				$kkw_fc2_wrapper   = $kkw_featured_box_2['wrapper'];
				$kkw_fc2_image     = $kkw_featured_box_2['image'];
				$kkw_fc2_group_url = isset( $kkw_fc2_wrapper->main_group_url ) ? (string) $kkw_fc2_wrapper->main_group_url : '';
				$kkw_fc2_group     = isset( $kkw_fc2_wrapper->main_group ) ? (string) $kkw_fc2_wrapper->main_group : '';
				$kkw_fc2_title     = isset( $kkw_fc2_wrapper->title ) ? (string) $kkw_fc2_wrapper->title : '';
				$kkw_fc2_desc      = isset( $kkw_fc2_wrapper->description ) ? (string) $kkw_fc2_wrapper->description : '';
				$kkw_fc2_detail    = isset( $kkw_fc2_wrapper->detail_url ) ? (string) $kkw_fc2_wrapper->detail_url : '';
				?>
				<div class="col p-4 d-flex flex-column position-static">
					<strong class="d-inline-block mb-2 text-primary-emphasis">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc2_group_url ); ?>">
							<?php echo esc_html( $kkw_fc2_group ); ?>
						</a>
					</strong>
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc2_detail ); ?>">
						<h4 class="mb-0"><?php echo esc_html( $kkw_fc2_title ); ?></h4>
					</a>
					<p class="card-text mb-auto kkw_featured_text mt-3">
						<?php echo esc_html( clean_and_truncate_text( $kkw_fc2_desc, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
					</p>
					<small class="pt-2 text-body-secondary">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc2_detail ); ?>">
							<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
							&nbsp;<i class="fa-solid fa-arrow-right"></i>
						</a>
					</small>
				</div>
				<div class="col-auto d-none d-lg-block">
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc2_detail ); ?>">
						<img src="<?php echo esc_url( $kkw_fc2_image['src'] ); ?>"
							class="bd-placeholder-img"
							width="<?php echo esc_attr( (string) $kkw_featured_img_width ); ?>"
							height="<?php echo esc_attr( (string) $kkw_featured_img_height ); ?>"
							alt="<?php echo esc_attr( $kkw_fc2_image['alt'] ); ?>">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- SECOND ROW -->
<div id="fc_second_row" class="row mb-4 fc-row">
	<!-- left box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
			<?php if ( null !== $kkw_featured_box_3 ) : ?>
				<?php
				$kkw_fc3_wrapper   = $kkw_featured_box_3['wrapper'];
				$kkw_fc3_image     = $kkw_featured_box_3['image'];
				$kkw_fc3_group_url = isset( $kkw_fc3_wrapper->main_group_url ) ? (string) $kkw_fc3_wrapper->main_group_url : '';
				$kkw_fc3_group     = isset( $kkw_fc3_wrapper->main_group ) ? (string) $kkw_fc3_wrapper->main_group : '';
				$kkw_fc3_title     = isset( $kkw_fc3_wrapper->title ) ? (string) $kkw_fc3_wrapper->title : '';
				$kkw_fc3_desc      = isset( $kkw_fc3_wrapper->description ) ? (string) $kkw_fc3_wrapper->description : '';
				$kkw_fc3_detail    = isset( $kkw_fc3_wrapper->detail_url ) ? (string) $kkw_fc3_wrapper->detail_url : '';
				?>
				<div class="col p-4 d-flex flex-column position-static">
					<strong class="d-inline-block mb-2 text-primary-emphasis">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc3_group_url ); ?>">
							<?php echo esc_html( $kkw_fc3_group ); ?>
						</a>
					</strong>
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc3_detail ); ?>">
						<h4 class="mb-0"><?php echo esc_html( $kkw_fc3_title ); ?></h4>
					</a>
					<p class="card-text mb-auto kkw_featured_text mt-3">
						<?php echo esc_html( clean_and_truncate_text( $kkw_fc3_desc, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
					</p>
					<small class="pt-2 text-body-secondary">
						<a class="kkw_link" href="<?php echo esc_url( $kkw_fc3_detail ); ?>">
							<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
							&nbsp;<i class="fa-solid fa-arrow-right"></i>
						</a>
					</small>
				</div>
				<div class="col-auto d-none d-lg-block">
					<a class="kkw_link" href="<?php echo esc_url( $kkw_fc3_detail ); ?>">
						<img src="<?php echo esc_url( $kkw_fc3_image['src'] ); ?>"
							class="bd-placeholder-img"
							width="<?php echo esc_attr( (string) $kkw_featured_img_width ); ?>"
							height="<?php echo esc_attr( (string) $kkw_featured_img_height ); ?>"
							alt="<?php echo esc_attr( $kkw_fc3_image['alt'] ); ?>">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- right box -->
	<div class="col-md-6">
		<div class="row g-0 overflow-hidden flex-md-row mb-4 position-relative">
			<div class="kw_featured_list">
				<ul class="list-unstyled h-100">
					<!-- News box -->
					<li class="h-50">
						<?php if ( null !== $kkw_latest_news ) : ?>
							<?php
							$kkw_news_wrapper   = $kkw_latest_news['wrapper'];
							$kkw_news_image     = $kkw_latest_news['image'];
							$kkw_news_group_url = isset( $kkw_news_wrapper->main_group_url ) ? (string) $kkw_news_wrapper->main_group_url : '';
							$kkw_news_group     = isset( $kkw_news_wrapper->main_group_pl ) ? (string) $kkw_news_wrapper->main_group_pl : '';
							$kkw_news_title     = isset( $kkw_news_wrapper->title ) ? (string) $kkw_news_wrapper->title : '';
							$kkw_news_desc      = isset( $kkw_news_wrapper->description ) ? (string) $kkw_news_wrapper->description : '';
							$kkw_news_detail    = isset( $kkw_news_wrapper->detail_url ) ? (string) $kkw_news_wrapper->detail_url : '';
							?>
							<div id="kkw_news_box" class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center link-body-emphasis text-decoration-none py-2 border rounded">
								<img src="<?php echo esc_url( $kkw_news_image['src'] ); ?>"
									class="ps-2 bd-placeholder-img d-none d-lg-block"
									width="<?php echo esc_attr( (string) $kkw_small_featured_img_width ); ?>"
									height="<?php echo esc_attr( (string) $kkw_small_featured_img_height ); ?>"
									alt="<?php echo esc_attr( $kkw_news_image['alt'] ); ?>">
								<div class="col-lg-8 px-2">
									<a class="kkw_link" href="<?php echo esc_url( $kkw_news_group_url ); ?>">
										<strong class="d-inline-block mt-1 mb-1 text-primary-emphasis text-capitalize">
											<?php echo esc_html( $kkw_news_group ); ?>
										</strong>
									</a>
									<a class="kkw_link" href="<?php echo esc_url( $kkw_news_detail ); ?>">
										<h6 class="mb-0"><?php echo esc_html( clean_and_truncate_text( $kkw_news_title, KKW_SMALL_FEATURED_TEXT_MAX_SIZE ) ); ?></h6>
									</a>
									<p class="mb-0 kkw_featured_text"><?php echo esc_html( clean_and_truncate_text( $kkw_news_desc, 100 ) ); ?></p>
									<small class="text-body-secondary">
										<a class="kkw_link" href="<?php echo esc_url( $kkw_news_detail ); ?>">
											<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
											&nbsp;<i class="fa-solid fa-arrow-right"></i>
										</a>
									</small>
								</div>
							</div>
						<?php endif; ?>
					</li>

					<!-- Event box -->
					<li class="h-50">
						<?php if ( null !== $kkw_latest_event ) : ?>
							<?php
							$kkw_event_wrapper   = $kkw_latest_event['wrapper'];
							$kkw_event_image     = $kkw_latest_event['image'];
							$kkw_event_group_url = isset( $kkw_event_wrapper->main_group_url ) ? (string) $kkw_event_wrapper->main_group_url : '';
							$kkw_event_group     = isset( $kkw_event_wrapper->main_group_pl ) ? (string) $kkw_event_wrapper->main_group_pl : '';
							$kkw_event_title     = isset( $kkw_event_wrapper->title ) ? (string) $kkw_event_wrapper->title : '';
							$kkw_event_desc      = isset( $kkw_event_wrapper->description ) ? (string) $kkw_event_wrapper->description : '';
							$kkw_event_detail    = isset( $kkw_event_wrapper->detail_url ) ? (string) $kkw_event_wrapper->detail_url : '';
							?>
							<div id="kkw_event_box" class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center link-body-emphasis text-decoration-none py-2 border rounded">
								<img src="<?php echo esc_url( $kkw_event_image['src'] ); ?>"
									class="ps-2 bd-placeholder-img d-none d-lg-block"
									width="<?php echo esc_attr( (string) $kkw_small_featured_img_width ); ?>"
									height="<?php echo esc_attr( (string) $kkw_small_featured_img_height ); ?>"
									alt="<?php echo esc_attr( $kkw_event_image['alt'] ); ?>">
								<div class="col-lg-8 px-2">
									<a class="kkw_link" href="<?php echo esc_url( $kkw_event_group_url ); ?>">
										<strong class="d-inline-block mt-1 mb-1 text-primary-emphasis text-capitalize">
											<?php echo esc_html( $kkw_event_group ); ?>
										</strong>
									</a>
									<a class="kkw_link" href="<?php echo esc_url( $kkw_event_detail ); ?>">
										<h6 class="mb-0"><?php echo esc_html( clean_and_truncate_text( $kkw_event_title, KKW_SMALL_FEATURED_TEXT_MAX_SIZE ) ); ?></h6>
									</a>
									<p class="mb-0 kkw_featured_text"><?php echo esc_html( clean_and_truncate_text( $kkw_event_desc, 100 ) ); ?></p>
									<small class="text-body-secondary">
										<a class="kkw_link" href="<?php echo esc_url( $kkw_event_detail ); ?>">
											<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
											&nbsp;<i class="fa-solid fa-arrow-right"></i>
										</a>
									</small>
								</div>
							</div>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
