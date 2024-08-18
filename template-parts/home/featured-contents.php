<?php
/**
 * KK Writer Theme: The featured contents in the Home Page oif the site.
 *
 * @package KK_Writer_Theme
 */

$auto_on = kkw_get_option( 'home_featured_content_auto_on', 'kkw_opt_hp_layout' );

// BOX 1.
$opt_featured_1 = kkw_get_option( 'featured_content_1', 'kkw_opt_hp_layout' );
$fc1            = count( $opt_featured_1 ) > 0 ? $opt_featured_1[0] : null;
$fc1_id         = $fc1 && array_key_exists('box_content', $fc1 ) ? explode( ',', $fc1['box_content'] )[0] : null;
$fc1_id         = KKW_MultiLangManager::get_page_by_id( $fc1_id ); // Get the post in the right language.
if ( $fc1_id ) {
	$fc1_img_side   = $fc1['box_image_side'];
	$fc1            = KKW_ContentsManager::get_wrapped_item( $fc1_id );
	$fc1_img_id     = get_post_thumbnail_id( $fc1_id );
	$fc1_img_array  = wp_get_attachment_image_src( $fc1_img_id, 'featured-post' );
	$fc1_img_src    = $fc1_img_array ? $fc1_img_array[0] : '';
	$fc1_img_alt    = get_post_meta( $fc1_img_id, '_wp_attachment_image_alt', true );
	$fc1_img_alt    = $fc1_img_alt ? $fc1_img_alt : $fc1->title;
}

// BOX 2.
$opt_featured_2 = kkw_get_option( 'featured_content_2', 'kkw_opt_hp_layout' );
$fc2            = count( $opt_featured_2 ) > 0 ? $opt_featured_2[0] : null;
$fc2_id         = $fc2 && array_key_exists('box_content', $fc2 ) ? explode( ',', $fc2['box_content'] )[0] : null;
$fc2_id         = KKW_MultiLangManager::get_page_by_id( $fc2_id ); // Get the post in the right language.
if ( $fc1_id ) {
	$fc2_img_side   = $fc2['box_image_side'];
	$fc2            = KKW_ContentsManager::get_wrapped_item( $fc2_id );
	$fc2_img_id     = get_post_thumbnail_id( $fc2_id );
	$fc2_img_array  = wp_get_attachment_image_src( $fc2_img_id, 'featured-post' );
	$fc2_img_src    = $fc2_img_array ? $fc2_img_array[0] : '';
	$fc2_img_alt    = get_post_meta( $fc2_img_id, '_wp_attachment_image_alt', true );
	$fc2_img_alt    = $fc2_img_alt ? $fc2_img_alt : $fc2->title;
}

// BOX 3.
$opt_featured_3 = kkw_get_option( 'featured_content_3', 'kkw_opt_hp_layout' );
$fc3            = count( $opt_featured_3 ) > 0 ? $opt_featured_3[0] : null;
$fc3_id         = $fc3 && array_key_exists('box_content', $fc3 ) ? explode( ',', $fc3['box_content'] )[0] : null;
$fc3_id         = KKW_MultiLangManager::get_page_by_id( $fc3_id ); // Get the post in the right language.
$fc3_img_side   = $fc3['box_image_side'];
if ( $fc3_id ) {
	$fc3            = KKW_ContentsManager::get_wrapped_item( $fc3_id );
	$fc3_img_id     = get_post_thumbnail_id( $fc3_id );
	$fc3_img_array  = wp_get_attachment_image_src( $fc3_img_id, 'featured-post' );
	$fc3_img_src    = $fc3_img_array ? $fc3_img_array[0] : '';
	$fc3_img_alt    = get_post_meta( $fc3_img_id, '_wp_attachment_image_alt', true );
	$fc3_img_alt    = $fc3_img_alt ? $fc3_img_alt : $fc3->title;
}

// BOX 4: Last News.
$news_list      = KKW_ContentsManager::get_latest_posts( 'news', 1 );
$news           = count( $news_list ) ? $news_list[0] : null;
if ( $news ) {
	$news_img_id    = $news->id ? get_post_thumbnail_id( $news->id ) : null;
	$news_img_array = $news_img_id ? wp_get_attachment_image_src( $news_img_id, 'small-featured' ) : null;
	$news_img_src   = $news_img_array  ? $news_img_array [0] : '';
	$news_img_alt   = $news_img_id ? get_post_meta( $news_img_id, '_wp_attachment_image_alt', true ) : '';
	$news_img_alt   = $news_img_alt ? $news_img_alt : $news->title;
}

// BOX 5: Last Event.
$event_list      = KKW_ContentsManager::get_latest_posts( 'event', 1 );
$event           = count( $event_list ) ? $event_list[0] : null;
if ( $event ) {
	$event_img_id    = $event->id ? get_post_thumbnail_id( $event->id ) : null;
	$event_img_array = $event_img_id ? wp_get_attachment_image_src( $event_img_id, 'small-featured' ) : null;
	$event_img_src   = $event_img_array  ? $event_img_array [0] : '';
	$event_img_alt   = $event_img_id ? get_post_meta( $event_img_id, '_wp_attachment_image_alt', true ) : '';
	$event_img_alt   = $event_img_alt ? $event_img_alt : $event->title;
}
?>

<!-- FIRST ROW -->
<div id="fc_first_row" class="row mt-4 mb-1 fc-row">
	<h3 class="visually-hidden">
			<?php echo __( 'Section that contains the featured contents of the site: books, events and news.', 'kk_writer_theme' ); ?>
	</h3>
	<!-- left box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<?php
				if ( $fc1_id ) {
			?>
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">
					<a class="kkw_link" href="<?php echo esc_url( $fc1->main_group_url ); ?>">
						<?php echo esc_attr( $fc1->main_group ); ?>
					</a>
				</strong>
				<h4 class="mb-0">
					<?php echo esc_attr( $fc1->title ); ?>
				</h4>
				<p class="card-text mb-auto kkw_featured_text mt-3">
					<?php echo clean_and_truncate_text( $fc1->description, KKW_FEATURED_TEXT_MAX_SIZE ); ?>
				</p>
				<small class="text-body-secondary">
					<a class="kkw_link"
						href="<?php echo esc_url( $fc1->detail_url ); ?>">
						<?php echo __( 'Read more', 'kk_writer_theme' ); ?>
						&nbsp;<i class="fa-solid fa-arrow-right"></i>
					</a>
				</small>
			</div>
			<div class="col-auto d-none d-lg-block">
				<a class="kkw_link"
					href="<?php echo esc_url( $fc1->detail_url ); ?>">
					<img src="<?php echo esc_url( $fc1_img_src ); ?>"
							class="bd-placeholder-img"
							width="<?php echo strval( KKW_FEATURED_IMG_WIDTH ); ?>"
							height="<?php echo strval( KKW_FEATURED_IMG_HEIGHT ); ?>"
							alt="<?php echo esc_attr( $fc1_img_alt ); ?>" />
				</a>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- right box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<?php
				if ( $fc2_id ) {
			?>
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">
					<a class="kkw_link" href="<?php echo esc_url( $fc2->main_group_url ); ?>">
						<?php echo esc_attr( $fc2->main_group ); ?>
					</a>
				</strong>
				<h4 class="mb-0">
					<?php echo esc_attr( $fc2->title ); ?>
				</h4>
				<p class="card-text mb-auto kkw_featured_text mt-3">
					<?php echo clean_and_truncate_text( $fc2->description, KKW_FEATURED_TEXT_MAX_SIZE ); ?>
				</p>
				<small class="text-body-secondary">
					<a class="kkw_link"
						href="<?php echo esc_url( $fc2->detail_url ); ?>">
						<?php echo __( 'Read more', 'kk_writer_theme' ); ?>
						&nbsp;<i class="fa-solid fa-arrow-right"></i>
					</a>
				</small>
			</div>
			<div class="col-auto d-none d-lg-block">
			<a class="kkw_link"
					href="<?php echo esc_url( $fc2->detail_url ); ?>">
					<img src="<?php echo esc_url( $fc2_img_src ); ?>"
							class="bd-placeholder-img"
							width="<?php echo strval( KKW_FEATURED_IMG_WIDTH ); ?>"
							height="<?php echo strval( KKW_FEATURED_IMG_HEIGHT ); ?>"
							alt="<?php echo esc_attr( $fc2_img_alt ); ?>" />
				</a>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>


<!-- SECOND ROW -->
<div id="fc_second_row" class="row mb-4 fc-row">
	<!-- first box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<?php
				if ( $fc3_id ) {
			?>
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">
					<a class="kkw_link" href="<?php echo esc_url( $fc3->main_group_url ); ?>">
						<?php echo esc_attr( $fc3->main_group ); ?>
					</a>
				</strong>
				<h4 class="mb-0">
					<?php echo esc_attr( $fc3->title ); ?>
				</h4>
				<p class="card-text mb-auto kkw_featured_text mt-3">
					<?php echo clean_and_truncate_text( $fc3->description, KKW_FEATURED_TEXT_MAX_SIZE ); ?>
				</p>
				<small class="text-body-secondary">
					<a class="kkw_link"
						href="<?php echo esc_url( $fc3->detail_url ); ?>">
						<?php echo __( 'Read more', 'kk_writer_theme' ); ?>
						&nbsp;<i class="fa-solid fa-arrow-right"></i>
					</a>
				</small>
			</div>
			<div class="col-auto d-none d-lg-block">
				<a class="kkw_link"
					href="<?php echo esc_url( $fc3->detail_url ); ?>">
					<img src="<?php echo esc_url( $fc3_img_src ); ?>"
							class="bd-placeholder-img"
							width="<?php echo strval( KKW_FEATURED_IMG_WIDTH ); ?>"
							height="<?php echo strval( KKW_FEATURED_IMG_HEIGHT ); ?>"
							alt="<?php echo esc_attr( $fc3_img_alt ); ?>" />
				</a>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- second box -->
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div>
				<ul class="list-unstyled">
					<!-- News box -->
					<li>
						<?php
							if ( $news ) {
						?>
							<div class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center
									 link-body-emphasis text-decoration-none border-top">
								<img src="<?php echo esc_url( $news_img_src ); ?>"
									class="bd-placeholder-img d-none d-lg-block"
									width="<?php echo strval( KKW_SMALL_FEATURED_IMG_WIDTH ); ?>"
									height="<?php echo strval( KKW_SMALL_FEATURED_IMG_HEIGHT ); ?>"
									alt="<?php echo esc_attr( $news_img_alt ); ?>" />
								<div class="col-lg-8">
									<strong class="d-inline-block mb-2 text-primary-emphasis text-capitalize">
										<?php echo __( $news->main_group, 'kk_writer_theme' ); ?>
									</strong>
									<h6 class="mb-0">
										<?php echo clean_and_truncate_text( $news->title, KKW_SMALL_FEATURED_TEXT_MAX_SIZE ); ?>
									</h6>
									<p class="mb-0 kkw_featured_text">
										<?php echo clean_and_truncate_text( $news->description, 100 ); ?>
									</p>
									<small class="text-body-secondary">
										<a class="kkw_link"
											href="<?php echo esc_url( $news->detail_url ); ?>">
											<?php echo __( 'Read more', 'kk_writer_theme' ); ?>
											&nbsp;<i class="fa-solid fa-arrow-right"></i>
										</a>
									</small>
								</div>
							</div>
						<?php
							}
						?>
					</li>
					<!-- Event box -->
					<li>
						<?php
							if ( $event ) {
						?>
							<div class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center
									link-body-emphasis text-decoration-none border-top">
								<img src="<?php echo esc_url( $event_img_src ); ?>"
									class="bd-placeholder-img d-none d-lg-block"
									width="<?php echo strval( KKW_SMALL_FEATURED_IMG_WIDTH ); ?>"
									height="<?php echo strval( KKW_SMALL_FEATURED_IMG_HEIGHT ); ?>"
									alt="<?php echo esc_attr( $event_img_alt ); ?>" />
								<div class="col-lg-8">
									<strong class="d-inline-block mb-2 text-primary-emphasis text-capitalize">
									<?php echo __( $event->main_group, 'kk_writer_theme' ); ?>
									</strong>
									<h6 class="mb-0">
										<?php echo clean_and_truncate_text( $event->title, KKW_SMALL_FEATURED_TEXT_MAX_SIZE ); ?>
									</h6>
									<p class="mb-0 kkw_featured_text">
										<?php echo clean_and_truncate_text( $event->description, 100 ); ?>
									</p>
									<small class="text-body-secondary">
										<a class="kkw_link"
											href="<?php echo esc_url( $event->detail_url ); ?>">
											<?php echo __( 'Read more', 'kk_writer_theme' ); ?>
											&nbsp;<i class="fa-solid fa-arrow-right"></i>
										</a>
									</small>
								</div>
							</div>
						<?php
							}
						?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>