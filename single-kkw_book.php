<?php
/**
 * KK Writer Theme: The default page for the books.
 *
 * @package KK_Writer_Theme
 */
  
get_header();

$section = '';
$section_description = '';
$icon_name           = 'fa-book';
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<?php
	while( have_posts() ) {
		the_post();
		$post_wrapper   = KKW_ContentsManager::wrap_search_result( $post );
		$image_wrapper  = KKW_ContentsManager::wrap_featured_image( $post_wrapper, 'full' );
		$meta_tags      = get_post_meta( $post_wrapper->id );
		// Manage front cover.
		$front_cover_id    = $image_wrapper->id;
		$front_image_array = wp_get_attachment_image_src( $front_cover_id, 'full' );
		$front_image_src   = $front_image_array ? esc_url( $front_image_array[0] ) : '';
		// Manage back cover.
		$back_cover_id    = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_back_cover_id' );
		$back_image_array = wp_get_attachment_image_src( $back_cover_id, 'full' );
		$back_image_src   = $back_image_array ? esc_url( $back_image_array[0] ) : '';
		// Unserialize related book data.
		$serialized_books = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_book_link' );
		$books            = unserialize( $serialized_books );
		/* Activation flags */
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
				<aside class="col-md-2 border-end mb-5 mt-3">
					<div class="menu-title text-center text-color-secondary">
						<i class="pe-2 fa-solid <?php echo $icon_name; ?>"
								data-bs-toggle="<?php echo $post_wrapper->main_group; ?>"
								title="<?php echo $post_wrapper->main_group; ?> "></i>
							<?php echo __( 'Details' , 'kk_writer_theme' ); ?>
					</div>
					<div id="kkw_lateral_menu" class="kkw_lateral_menu">
						<ul class="nav flex-column nav-menu">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#nav-description">
									<span><?php echo __( 'Description', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#nav-info">
									<span><?php echo __( 'Informations', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#nav-reviews">
									<span><?php echo __( 'Reviews', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#nav-excerpts">
									<span><?php echo __( 'Excerpts', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" aria-current="page" href="#nav-tracks">
									<span><?php echo __( 'Tracks', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<?php
								if ( $flg_rel_books ) {
							?>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#nav-related-books">
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
				<section class="col-md-10 pb-3" aria-label="<?php echo __( 'Blog post' , 'kk_writer_theme' ); ?>">

					<!-- BOOK IMAGE and description -->
					<section class="row mt-3" aria-label="<?php echo __( 'Image and description of the book' , 'kk_writer_theme' ); ?>">
						<div class="col-12">
							<div id="current_cover_div" class="float-start me-3">
								<a id="current_cover_link" href="<?php echo esc_url( $image_wrapper->src ); ?>" data-lightbox="image-1">
									<img id="current_cover"
										class="img-fluid rounded mb-2 border-img-2"
										src="<?php echo esc_url( $image_wrapper->src ); ?>"
										alt="<?php echo esc_attr( $image_wrapper->alt ); ?>"
									>
								</a>
								<?php
									if ( $back_cover_id && $front_cover_id ) {
								?>
								<div class="row mt-0 pt-0 mb-3 d-none d-lg-block text-center">
									<div class="col-6 text-center d-inline">
											<img id="front_cover"
												style="max-height: 100px; width: auto;"
												class="img-fluid rounded m-0 p-0"
												data-img-src="<?php echo esc_url( $front_image_src ); ?>"
												src="<?php echo esc_url( $front_image_src ); ?>"
												alt="<?php echo __( 'Cover of the book' , 'kk_writer_theme' ); ?>"
											>
									</div>
									<div class="col-6 text-center d-inline">
											<img id="back_cover"
												style="max-height: 100px; width: auto;"
												class="img-fluid rounded m-0 p-0"
												data-img-src="<?php echo esc_url( $back_image_src ); ?>"
												src="<?php echo esc_url( $back_image_src  ); ?>"
												alt="<?php echo __( 'Back cover of the book' , 'kk_writer_theme' ); ?>"
											>
									</div>
								</div>
								<?php
									}
								?>
							</div>
							<span id="nav-description"></span>
							<?php the_content(); ?>
						</div>
					</section>
					
					<!-- BOOK TABS -->
					<section id="kkw_book_tabs" class="mt-3 pt-0 mb-5" style="min-height: 300px;"
						aria-label="<?php echo __( 'Tabs to switch among contents' , 'kk_writer_theme' ); ?>">
						<h4 class="text-color-secondary">
							<?php echo get_the_title(); ?>
						</h4>
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-info-tab"
									data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" 
									aria-controls="nav-info" aria-selected="true">
									<i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;
									<?php echo __( 'Informations' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-reviews-tab"
									data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" 
									aria-controls="nav-reviews" aria-selected="false">
									<i class="fa-solid fa-marker"></i>&nbsp;&nbsp;
									<?php echo __( 'Reviews' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-excerpts-tab"
									data-bs-toggle="tab" data-bs-target="#nav-excerpts" type="button" role="tab"
									aria-controls="nav-excerpts" aria-selected="false">
									<i class="fa-solid fa-signature"></i>&nbsp;&nbsp;
									<?php echo __( 'Excerpts' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-tracks-tab"
									data-bs-toggle="tab" data-bs-target="#nav-tracks" type="button" role="tab"
									aria-controls="nav-tracks" aria-selected="false" disabled>
									<i class="fa-solid fa-microphone"></i>&nbsp;&nbsp;
									<?php echo __( 'Tracks' , 'kk_writer_theme' ); ?>
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
										'template-parts/common/book_info',
										null,
										array(
										'post_wrapper' => $post_wrapper,
										)
									);
								?>
							</div>
							<div class="tab-pane fade" id="nav-reviews" role="tabpanel"
								aria-labelledby="nav-reviews-tab" tabindex="0">
								<!-- Book Reviews -->
								<?php
									get_template_part(
										'template-parts/common/book_reviews',
										null,
										array(
										'post_wrapper' => $post_wrapper,
										)
									);
								?>
							</div>
							<div class="tab-pane fade" id="nav-excerpts" role="tabpanel"
								aria-labelledby="nav-excerpts-tab" tabindex="0">
								<!-- Book Reviews -->
								<?php
									get_template_part(
										'template-parts/common/book_excerpts',
										null,
										array(
											'post_wrapper' => $post_wrapper,
										)
									);
								?>
							</div>
							<div class="tab-pane fade" id="nav-tracks" role="tabpanel"
								aria-labelledby="nav-tracks-tab" tabindex="0">
								<!-- Book Tracks -->
								<?php
									get_template_part(
										'template-parts/common/book_tracks',
										null,
										array(
											'post_wrapper' => $post_wrapper,
										)
									);
								?>
							</div>
						</div>
					</section>

					<!-- RELATED BOOKS -->
					<?php
						if ( $flg_rel_books ) {
					?>
					<section id="nav-related-books" class="mt-5 pt-0 mb-5"
						aria-label="<?php echo __( 'Tabs to switch among contents' , 'kk_writer_theme' ); ?>">
						<h4 class="text-color-secondary"><?php echo __( 'Related books' , 'kk_writer_theme' ); ?></h4>
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
