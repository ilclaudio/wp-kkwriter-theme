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
		// Manage back cover.
		$back_cover_id = KKW_ContentsManager::extract_meta_tag( $meta_tags, 'kkw_back_cover_id' );
		// @TODO: get the imahe if exists.
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

					<!-- Image and description -->
					<section class="row" aria-label="<?php echo __( 'Image and description of the book' , 'kk_writer_theme' ); ?>">
						<div class="col-12">
							<div id="kkw_book_img_div" class="float-start me-3">
								<a href="<?php echo esc_url( $image_wrapper->src ); ?>" data-lightbox="image-1">
									<img id="kkw_book_img"
										class="img-fluid rounded mb-5"
										src="<?php echo esc_url( $image_wrapper->src ); ?>"
										alt="<?php echo esc_attr( $image_wrapper->alt ); ?>"
									>
								</a>
							</div>
							<?php the_content(); ?>
						</div>
					</section>
					
					<!-- Tabs header-->
					<section id="kkw_book_tabs" class="mt-5 pt-0 mb-5" style="min-height: 300px;"
						aria-label="<?php echo __( 'Tabs to switch among contents' , 'kk_writer_theme' ); ?>">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-info-tab"
									data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" 
									aria-controls="nav-info" aria-selected="true">
									<i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;
									<?php echo __( 'Information' , 'kk_writer_theme' ); ?>
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


				</section> <!-- content column -->

			</div> <!-- row -->
		</div> <!-- body -->

	<?php
	}
	?>

</main>


<?php
get_footer();
