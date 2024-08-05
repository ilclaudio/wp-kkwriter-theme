<?php
/**
 * KK Writer Theme: The default page for: Articles, Events and News.
 *
 * @package KK_Writer_Theme
 */
  
get_header();

$section = '';
$section_description = '';
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<?php
	while( have_posts() ) {
		the_post();
		$post_wrapper   = KKW_ContentsManager::wrap_search_result( $post );
		$image_wrapper  = KKW_ContentsManager::wrap_image( $post_wrapper, 'full' );
		$icon_name      = KKW_ContentsManager::get_post_icon_by_group( $post_wrapper->main_group );
		$group          = $post_wrapper->main_group;
		$flg_is_event   = $post_wrapper->main_group === 'event';
		$meta_tags      = get_post_meta( $post->ID );
		$start_date_str = '';
		$end_date_str   = '';
		if ( $flg_is_event ) {
			$start_date_str = KKW_ContentsManager::extractDateString( $meta_tags, $post, 'start' );
			$end_date_str   = KKW_ContentsManager::extractDateString( $meta_tags, $post, 'end' );
		}
		$c_address = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_address' );
		$c_person  = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_contact_person' );
		$c_phone   = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_contact_phone' );
		$c_email   = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_contact_mail' );
		$c_link    = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_external_link' );
		$c_video   = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_video_link' );
		// Unserialize gallery data.
		$serialized_gallery = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_gallery' );
		$gallery            = unserialize( $serialized_gallery );
		// Unserialize related book data.
		$serialized_books = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_book_link' );
		$books            = unserialize( $serialized_books );

		/* activation flags */
		$flg_start_date = $start_date_str ? true : false;
		$flg_end_date   = $end_date_str ? true : false;
		$flg_date       = $flg_is_event && ( $flg_start_date || $flg_end_date );
		$flg_place      = $c_address ? true : false;
		$flg_contacts   = $c_person || $c_phone || $c_email ? true : false;
		$flg_video      = $c_video ? true : false;
		$flg_gallery    = ( $gallery && count( $gallery ) ) > 0 ? true : false;
		$flg_rel_books  = ( $books && count( $books ) ) > 0 ? true : false;
	?>
		<!-- BODY -->
		<div class="container mt-2">

			<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1 class="text-color-secondary">
					<?php echo get_the_title(); ?>
				</h1>
				<?php
					if ( $section_description ){
				?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
					<?php echo $section_description; ?>
					</div>
				</div>
				<?php
					}
				?>
			</section>

			<div class="row">

				<!-- NAVIGATION column-->
				<aside class="col-md-2 border-end mb-5">
					<div class="menu-title text-center text-color-secondary">
					<i class="pe-2 fa-solid <?php echo $icon_name; ?>"
							data-bs-toggle="<?php echo $post_wrapper->main_group; ?>"
							title="<?php echo $post_wrapper->main_group; ?> "></i>
						<?php echo __( 'Details' , 'kk_writer_theme' ); ?>
					</div>
					<div class="kkw_lateral_menu">
						<ul class="nav flex-column nav-menu">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#post_description">
									<span><?php echo __( 'Description', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								if ( $flg_date ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#dates_and_hours">
									<span><?php echo __( 'Dates and hours', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
								if ( $flg_place ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#place">
									<span><?php echo __( 'Place', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
								if ( $flg_contacts ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#contacts">
									<span><?php echo __( 'Contacts', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
								if ( $flg_video ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#video">
									<span><?php echo __( 'Video', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
								if ( $flg_gallery ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#photo_gallery">
									<span><?php echo __( 'Photo gallery', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
								if ( $flg_rel_books ) {
							?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#related_book">
									<span><?php echo __( 'Related books', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								}
							?>
						</ul>
					</div>

					<!-- sharing -->
					<div class="mt-5">
						<?php
							get_template_part(
								'template-parts/common/social_sharing',
								null,
								array(),
							);
						?>
					</div>
				</aside>


				<!-- CONTENT column-->
				<section class="col-md-10 pb-3" aria-label="<?php echo __( 'Article' , 'kk_writer_theme' ); ?>">

					<article id="featured_image" class="blog-featured-image kkw_article_section">
						<img src="<?php echo esc_url( $image_wrapper->src ); ?>"
							class="card-img-top img-fluid"
							alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
					</article>

					<article id="post_description" class="kkw_article_section">
						<?php the_content(); ?>
					</article>

					<?php
						if ( $flg_date ) {
					?>
						<article id="dates_and_hours" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Date and hour' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
								<?php
									if ( $flg_start_date ){
								?>
								<p>
									<span class="kkw_article_label"><?php echo __( 'Event start' , 'kk_writer_theme' ); ?>:</span>
									&nbsp;
									<?php echo $start_date_str; ?>
								</p>
								<?php
									} if ( $flg_end_date ) {
								?>
								<p>
									<span class="kkw_article_label"><?php echo __( 'Event end' , 'kk_writer_theme' ); ?>:</span>
									&nbsp;
									<?php echo $end_date_str; ?>
								</p>
								<p>
									<i class="fa-regular fa-calendar-plus fa-lg kkw_article_label"></i>
									<span class="ms-2"><?php echo __( 'Add the event to your calendar (iCal)', 'kk_writer_theme' ); ?></span>
								</p>
							</div>
								<?php
									}
								?>
						</article>
					<?php
						}
						if ( $flg_place ) {
					?>
						<article id="place" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Place' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
								<p>
									<span class="kkw_article_label"><?php echo __( 'Event location address' , 'kk_writer_theme' ); ?>:</span>
									&nbsp;
									<?php echo $c_address; ?>
								</p>
							</div>
						</article>
					<?php
						}
						if ( $flg_contacts ) {
					?>
						<article id="contacts" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Contacts' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
								<ul class="kkw_article_list">
									<?php if ( $c_address ) { ?><li><span class="label"><?php echo __( 'Address' , 'kk_writer_theme' ); ?>:</span> <?php echo esc_attr( $c_address ); ?></li><?php } ?>
									<?php if ( $c_person ) { ?><li><span class="label"><?php echo __( 'Person' , 'kk_writer_theme' ); ?>:</span> <?php echo esc_attr( $c_person ); ?></li><?php } ?>
									<?php if ( $c_phone ) { ?><li><span class="label"><?php echo __( 'Telephone' , 'kk_writer_theme' ); ?>:</span> <?php echo esc_attr( $c_phone ); ?><?php } ?>
									<?php if ( $c_email ) { ?><li><span class="label"><?php echo __( 'E-mail' , 'kk_writer_theme' ); ?>:</span> <?php echo esc_attr( $c_email ); ?></li><?php } ?>
									<?php if ( $c_link ) { ?><li><span class="label"><?php echo __( 'External link' , 'kk_writer_theme' ); ?>:</span> <?php echo esc_attr( $c_email ); ?></li><?php } ?>
								</ul>
							</div>
						</article>
					<?php
						}
						if ( $flg_video ) {
					?>
						<article id="video" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Video' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
								<?php
									get_template_part(
										'template-parts/common/embed_video',
										null,
										array(
											'video'      => $c_video,
											'perc_width' => '50%',
										),
									);
								?>
							</div>
						</article>
					<?php
						}
						if ( $flg_gallery ) {
					?>
						<article id="photo_gallery" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Photo gallery' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
							<?php
									get_template_part(
										'template-parts/common/photo_gallery',
										null,
										array(
											'gallery'      => $gallery,
											'size_string'  => 'item-thumb',
										),
									);
								?>
							</div>
						</article>
					<?php
						}
						if ( $flg_rel_books ) {
					?>
						<article id="related_books" class="kkw_article_section">
							<h4 class="text-color-secondary"><?php echo __( 'Related books' , 'kk_writer_theme' ); ?></h4>
							<div class="p-3">
							<?php
								get_template_part(
									'template-parts/common/related_books',
									null,
									array(
										'books'       => $books,
										'size_string' => 'featured-post',
									),
								);
							?>
							</div>
						</article>
					<?php
						}
					?>
				</section>

			</div>

		</div> <!-- body -->
	<?php
	}
	?>

</main>


<?php
get_footer();
