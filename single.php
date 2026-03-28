<?php
/**
 * KK Writer Theme: The default page for: Articles, Events and News.
 *
 * @package KK_Writer_Theme
 */

get_header();

$kkw_section             = '';
$kkw_section_description = '';
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

		<?php
		while ( have_posts() ) {
			the_post();
			$kkw_post_wrapper   = KKW_ContentsManager::wrap_search_result( $post );
			$kkw_image_wrapper  = KKW_ContentsManager::wrap_featured_image( $kkw_post_wrapper, 'large' );
			$kkw_icon_name      = KKW_ContentsManager::get_post_icon_by_group( $kkw_post_wrapper->main_group );
			$kkw_is_event       = strtolower( $kkw_post_wrapper->main_group ) === strtolower( KKW_EVENT_GROUP['slug'] );
			$kkw_meta_tags      = get_post_meta( $kkw_post_wrapper->id );
			$kkw_start_date_str = '';
			$kkw_end_date_str   = '';
			if ( $kkw_is_event ) {
				$kkw_start_date_str = KKW_ContentsManager::extract_date_string( $kkw_meta_tags, $post, 'start' );
				$kkw_end_date_str   = KKW_ContentsManager::extract_date_string( $kkw_meta_tags, $post, 'end' );
			}
			$kkw_address = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_address' );
			$kkw_person  = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_contact_person' );
			$kkw_phone   = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_contact_phone' );
			$kkw_email   = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_contact_mail' );
			$kkw_link    = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_external_link' );
			$kkw_video   = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_video_link' );

			$kkw_serialized_gallery = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_gallery' );
			$kkw_gallery            = maybe_unserialize( $kkw_serialized_gallery );
			$kkw_gallery            = is_array( $kkw_gallery ) ? $kkw_gallery : array();

			$kkw_serialized_books = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_book_link' );
			$kkw_books            = maybe_unserialize( $kkw_serialized_books );
			$kkw_books            = is_array( $kkw_books ) ? $kkw_books : array();

			/* Activation flags */
			$kkw_has_start_date    = ! empty( $kkw_start_date_str );
			$kkw_has_end_date      = ! empty( $kkw_end_date_str );
			$kkw_has_date          = $kkw_is_event && ( $kkw_has_start_date || $kkw_has_end_date );
			$kkw_has_place         = ! empty( $kkw_address );
			$kkw_has_contacts      = ! empty( $kkw_person ) || ! empty( $kkw_phone ) || ! empty( $kkw_email );
			$kkw_has_video         = ! empty( $kkw_video );
			$kkw_has_gallery       = ! empty( $kkw_gallery );
			$kkw_has_related_books = ! empty( $kkw_books );
			?>
			<!-- BODY -->
			<div class="container mt-2">

			<!-- BANNER -->
				<section class="row mb-2 py-4 primary-bg">
					<h1 class="text-color-secondary">
						<?php echo esc_html( get_the_title() ); ?>
					</h1>
					<?php
					if ( $kkw_section_description ) {
						?>
					<div class="col-12">
						<div class="form-group col text-left mb-2">
						<?php echo wp_kses_post( $kkw_section_description ); ?>
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
						<i class="pe-2 fa-solid <?php echo esc_attr( $kkw_icon_name ); ?>"
								data-bs-toggle="<?php echo esc_attr( $kkw_post_wrapper->main_group ); ?>"
								title="<?php echo esc_attr( $kkw_post_wrapper->main_group ); ?>"></i>
							<?php echo esc_html__( 'Details', 'kk_writer_theme' ); ?>
						</div>
						<div class="kkw_lateral_menu">
							<ul class="nav flex-column nav-menu">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#post_description">
										<span><?php echo esc_html__( 'Description', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<?php
								if ( $kkw_has_date ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#dates_and_hours">
										<span><?php echo esc_html__( 'Date and hour', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
									<?php
								}
								if ( $kkw_has_place ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#place">
										<span><?php echo esc_html__( 'Place', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
									<?php
								}
								if ( $kkw_has_contacts ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#contacts">
										<span><?php echo esc_html__( 'Contacts', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
									<?php
								}
								if ( $kkw_has_video ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#video">
										<span><?php echo esc_html__( 'Video', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
									<?php
								}
								if ( $kkw_has_gallery ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#photo_gallery">
										<span><?php echo esc_html__( 'Photo gallery', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
									<?php
								}
								if ( $kkw_has_related_books ) {
									?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#related_books">
										<span><?php echo esc_html__( 'Related books', 'kk_writer_theme' ); ?></span>
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
								'template-parts/common/social-sharing',
								null,
								array(),
							);
						?>
					</div>
				</aside>


					<!-- CONTENT column-->
					<section class="col-md-10 pb-3" aria-label="<?php echo esc_attr__( 'Blog post', 'kk_writer_theme' ); ?>">

						<article id="featured_image" class="blog-featured-image kkw_article_section">
							<img src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
								class="card-img-top img-fluid"
								alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">
						</article>

					<article id="post_description" class="kkw_article_section">
						<?php the_content(); ?>
					</article>

						<?php
						if ( $kkw_has_date ) {
							?>
							<article id="dates_and_hours" class="kkw_article_section">
								<h4 class="text-color-secondary"><?php echo esc_html__( 'Date and hour', 'kk_writer_theme' ); ?></h4>
								<div class="p-3">
								<?php
								if ( $kkw_has_start_date ) {
									?>
									<p>
										<span class="kkw_article_label"><?php echo esc_html__( 'Event start', 'kk_writer_theme' ); ?>:</span>
										&nbsp;
										<?php echo esc_html( $kkw_start_date_str ); ?>
									</p>
									<?php
								}
								if ( $kkw_has_end_date ) {
									?>
									<p>
										<span class="kkw_article_label"><?php echo esc_html__( 'Event end', 'kk_writer_theme' ); ?>:</span>
										&nbsp;
										<?php echo esc_html( $kkw_end_date_str ); ?>
									</p>
										<?php
								}
								?>
									<?php
									if ( $kkw_has_start_date ) {
										$kkw_ics_url = add_query_arg(
											array(
												'feed' => 'ics',
												'eid'  => absint( $kkw_post_wrapper->id ),
											),
											home_url( '/' )
										);
										?>
										<p>
											<a href="<?php echo esc_url( $kkw_ics_url ); ?>">
												<i class="fa-regular fa-calendar-plus fa-lg kkw_article_label"></i>
												<span class="ms-2"><?php echo esc_html__( 'Add the event to your calendar (iCal)', 'kk_writer_theme' ); ?></span>
											</a>
									</p>
										<?php
									}
									?>
							</div>
						</article>
							<?php
						}
						if ( $kkw_has_place ) {
							?>
							<article id="place" class="kkw_article_section">
								<h4 class="text-color-secondary">
								<?php echo esc_html__( 'Place', 'kk_writer_theme' ); ?>
								</h4>
								<div class="p-3">
									<p>
										<span class="kkw_article_label">
										<?php echo esc_html__( 'Event location address', 'kk_writer_theme' ); ?>:
										</span>
										&nbsp;
										<?php echo esc_html( $kkw_address ); ?>
									</p>
								</div>
							</article>
							<?php
						}
						if ( $kkw_has_contacts ) {
							?>
							<article id="contacts" class="kkw_article_section">
								<h4 class="text-color-secondary"><?php echo esc_html__( 'Contacts', 'kk_writer_theme' ); ?></h4>
								<div class="p-3">
									<ul class="kkw_article_list">
									<?php
									if ( $kkw_address ) {
										?>
										<li><span class="label"><?php echo esc_html__( 'Address', 'kk_writer_theme' ); ?>:</span> <?php echo esc_html( $kkw_address ); ?></li>
										<?php
									}
									if ( $kkw_person ) {
										?>
										<li><span class="label"><?php echo esc_html__( 'Person', 'kk_writer_theme' ); ?>:</span> <?php echo esc_html( $kkw_person ); ?></li>
										<?php
									}
									if ( $kkw_phone ) {
										?>
										<li><span class="label"><?php echo esc_html__( 'Telephone', 'kk_writer_theme' ); ?>:</span> <?php echo esc_html( $kkw_phone ); ?></li>
										<?php
									}
									if ( $kkw_email ) {
										?>
										<li><span class="label"><?php echo esc_html__( 'E-mail', 'kk_writer_theme' ); ?>:</span> <?php echo esc_html( $kkw_email ); ?></li>
										<?php
									}
									if ( $kkw_link ) {
										?>
											<li><span class="label">
												<?php echo esc_html__( 'External link', 'kk_writer_theme' ); ?>:</span>
												<a href="<?php echo esc_url( $kkw_link ); ?>" target="_blank" rel="noopener noreferrer">
													<?php echo esc_html( $kkw_link ); ?>
												</a>
											</li>
										<?php
									}
									?>
									</ul>
								</div>
							</article>
							<?php
						}
						if ( $kkw_has_video ) {
							?>
							<article id="video" class="kkw_article_section">
								<h4 class="text-color-secondary"><?php echo esc_html__( 'Video', 'kk_writer_theme' ); ?></h4>
								<div class="p-3">
									<?php
									get_template_part(
										'template-parts/common/embed-video',
										null,
										array(
											'video'      => $kkw_video,
											'perc_width' => '50%',
										),
									);
									?>
								</div>
							</article>
							<?php
						}
						if ( $kkw_has_gallery ) {
							?>
							<article id="photo_gallery" class="kkw_article_section">
								<h4 class="text-color-secondary"><?php echo esc_html__( 'Photo gallery', 'kk_writer_theme' ); ?></h4>
								<div class="p-3">
									<?php
									get_template_part(
										'template-parts/common/photo-gallery',
										null,
										array(
											'gallery'     => $kkw_gallery,
											'size_string' => 'item-thumb',
										),
									);
									?>
								</div>
							</article>
							<?php
						}
						if ( $kkw_has_related_books ) {
							?>
							<article id="related_books" class="kkw_article_section">
								<h4 class="text-color-secondary"><?php echo esc_html__( 'Related books', 'kk_writer_theme' ); ?></h4>
								<div class="p-3">
									<?php
									get_template_part(
										'template-parts/common/related-books',
										null,
										array(
											'books'       => $kkw_books,
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
