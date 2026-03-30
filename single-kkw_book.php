<?php
/**
 * KK Writer Theme: The default page for the books.
 *
 * @package KK_Writer_Theme
 */

get_header();

$kkw_section             = '';
$kkw_section_description = '';
$kkw_icon_name           = 'fa-book';
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

		<?php
		while ( have_posts() ) {
			the_post();
			$kkw_post_wrapper  = KKW_ContentsManager::wrap_search_result( $post );
			$kkw_image_wrapper = KKW_ContentsManager::wrap_featured_image( $kkw_post_wrapper, 'large' );
			$kkw_meta_tags     = get_post_meta( $kkw_post_wrapper->id );
			// Manage front cover.
			$kkw_front_cover_id    = $kkw_image_wrapper->id;
			$kkw_front_image_array = wp_get_attachment_image_src( $kkw_front_cover_id, 'large' );
			$kkw_front_image_src   = $kkw_front_image_array ? esc_url( $kkw_front_image_array[0] ) : '';
			// Manage back cover.
			$kkw_back_cover_id    = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_back_cover_id' );
			$kkw_back_image_array = wp_get_attachment_image_src( $kkw_back_cover_id, 'large' );
			$kkw_back_image_src   = $kkw_back_image_array ? esc_url( $kkw_back_image_array[0] ) : '';
			// Unserialize related book data.
			$kkw_serialized_books = KKW_ContentsManager::extract_meta_tag( $kkw_meta_tags, 'kkw_book_link' );
			$kkw_books            = maybe_unserialize( $kkw_serialized_books );
			$kkw_books            = is_array( $kkw_books ) ? $kkw_books : array();
			/* Activation flags */
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
					<aside class="col-md-2 border-end mb-5 mt-3">
						<div class="menu-title text-center text-color-secondary">
							<i class="pe-2 fa-solid <?php echo esc_attr( $kkw_icon_name ); ?>"
									data-bs-toggle="<?php echo esc_attr( $kkw_post_wrapper->main_group ); ?>"
									title="<?php echo esc_attr( $kkw_post_wrapper->main_group ); ?>"></i>
								<?php echo esc_html__( 'Details', 'kk_writer_theme' ); ?>
						</div>
						<div id="kkw_lateral_menu" class="kkw_lateral_menu">
							<ul class="nav flex-column nav-menu">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#nav-description">
										<span><?php echo esc_html__( 'Description', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#nav-info">
										<span><?php echo esc_html__( 'Informations', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#nav-reviews">
										<span><?php echo esc_html__( 'Reviews', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#nav-excerpts">
										<span><?php echo esc_html__( 'Excerpts', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link disabled" href="#nav-tracks"
										aria-disabled="true"
										tabindex="-1">
										<span><?php echo esc_html__( 'Tracks', 'kk_writer_theme' ); ?></span>
										<span class="visually-hidden"><?php esc_html_e( '(not available for this book)', 'kk_writer_theme' ); ?></span>
									</a>
								</li>
								<?php
								if ( $kkw_has_related_books ) {
									?>
									<li class="nav-item">
										<a class="nav-link" aria-current="page" href="#nav-related-books">
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

					<!-- BOOK IMAGE and description -->
						<section class="row mt-3" aria-label="<?php echo esc_attr__( 'Image and description of the book', 'kk_writer_theme' ); ?>">
						<div id="kkw_book_section" class="container">
							<div class="row">
								<div id="kkw_current_cover_div" class="col-12 col-md-4 float-start">
										<a id="current_cover_link" href="<?php echo esc_url( $kkw_image_wrapper->src ); ?>" data-lightbox="image-1"
									aria-label="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">
										<img id="current_cover"
											class="kkw_cover img-fluid rounded mb-2 border-img-2"
												src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
												alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>"
										>
									</a>
									<?php
									if ( $kkw_back_cover_id && $kkw_front_cover_id ) {
										?>
									<div class="row mt-0 pt-0 mb-3 d-none d-lg-block text-center">
										<div class="col-6 text-center d-inline">
												<img id="front_cover"
													style="max-height: 100px; width: auto;"
													class="kkw_cover_small img-fluid rounded m-0 p-0"
														data-img-src="<?php echo esc_url( $kkw_front_image_src ); ?>"
														src="<?php echo esc_url( $kkw_front_image_src ); ?>"
														alt="<?php echo esc_attr__( 'Cover of the book', 'kk_writer_theme' ); ?>"
												>
										</div>
										<div class="col-6 text-center d-inline">
												<img id="back_cover"
													style="max-height: 100px; width: auto;"
													class="kkw_cover_small img-fluid rounded m-0 p-0"
														data-img-src="<?php echo esc_url( $kkw_back_image_src ); ?>"
														src="<?php echo esc_url( $kkw_back_image_src ); ?>"
														alt="<?php echo esc_attr__( 'Back cover of the book', 'kk_writer_theme' ); ?>"
												>
										</div>
									</div>
										<?php
									}
									?>
								</div>
								<div id="kkw_book_description" class="col-12 col-md-8">
									<span id="nav-description"></span>
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</section>
					
					<!-- BOOK TABS -->
						<section id="kkw_book_tabs" class="mt-3 pt-0 mb-5" style="min-height: 300px;"
							aria-label="<?php echo esc_attr__( 'Tabs to switch among contents', 'kk_writer_theme' ); ?>">
							<h4 class="text-color-secondary">
								<?php echo esc_html( get_the_title() ); ?>
							</h4>
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-info-tab"
									data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" 
									aria-controls="nav-info" aria-selected="true">
									<i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;
										<?php echo esc_html__( 'Informations', 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-reviews-tab"
									data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" 
									aria-controls="nav-reviews" aria-selected="false">
									<i class="fa-solid fa-marker"></i>&nbsp;&nbsp;
										<?php echo esc_html__( 'Reviews', 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-excerpts-tab"
									data-bs-toggle="tab" data-bs-target="#nav-excerpts" type="button" role="tab"
									aria-controls="nav-excerpts" aria-selected="false">
									<i class="fa-solid fa-signature"></i>&nbsp;&nbsp;
										<?php echo esc_html__( 'Excerpts', 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-tracks-tab"
									data-bs-toggle="tab" data-bs-target="#nav-tracks" type="button" role="tab"
									aria-controls="nav-tracks" aria-selected="false" disabled>
									<i class="fa-solid fa-microphone"></i>&nbsp;&nbsp;
										<?php echo esc_html__( 'Tracks', 'kk_writer_theme' ); ?>
								</button>
							</div>
						</nav>
						<!-- Tabs body -->
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-info" role="tabpanel"
								aria-labelledby="nav-info-tab" tabindex="0">
								<!-- Book Informations -->
								<?php
										get_template_part(
											'template-parts/common/book-info',
											null,
											array(
												'post_wrapper' => $kkw_post_wrapper,
											)
										);
								?>
							</div>
							<div class="tab-pane fade" id="nav-reviews" role="tabpanel"
								aria-labelledby="nav-reviews-tab" tabindex="0">
								<!-- Book Reviews -->
								<?php
										get_template_part(
											'template-parts/common/book-reviews',
											null,
											array(
												'post_wrapper' => $kkw_post_wrapper,
											)
										);
								?>
							</div>
							<div class="tab-pane fade" id="nav-excerpts" role="tabpanel"
								aria-labelledby="nav-excerpts-tab" tabindex="0">
								<!-- Book Reviews -->
								<?php
										get_template_part(
											'template-parts/common/book-excerpts',
											null,
											array(
												'post_wrapper' => $kkw_post_wrapper,
											)
										);
								?>
							</div>
							<div class="tab-pane fade" id="nav-tracks" role="tabpanel"
								aria-labelledby="nav-tracks-tab" tabindex="0">
								<!-- Book Tracks -->
								<?php
										get_template_part(
											'template-parts/common/book-tracks',
											null,
											array(
												'post_wrapper' => $kkw_post_wrapper,
											)
										);
								?>
							</div>
						</div>
					</section>

					<!-- RELATED BOOKS -->
					<?php
					if ( $kkw_has_related_books ) {
						?>
						<section id="nav-related-books" class="mt-5 pt-0 mb-5"
							aria-label="<?php echo esc_attr__( 'Tabs to switch among contents', 'kk_writer_theme' ); ?>">
							<h4 class="text-color-secondary"><?php echo esc_html__( 'Related books', 'kk_writer_theme' ); ?></h4>
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
					</section>
						<?php
					}
					?>

				</section> <!-- content column -->
			</div> <!-- row -->
		</div> <!-- body -->

			<?php
		}
		?>

</main>


<?php
get_footer();
