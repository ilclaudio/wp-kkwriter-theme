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
		$meta_tags      = get_post_meta( $post->ID );
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
					<section id="kkw_book_tabs" class="mt-0 pt-0 mb-5" style="min-height: 300px;"
						aria-label="<?php echo __( 'Tabs to switch among contents' , 'kk_writer_theme' ); ?>">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-home-tab"
									data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" 
									aria-controls="nav-home" aria-selected="true">
									<?php echo __( 'Information' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-profile-tab"
									data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" 
									aria-controls="nav-profile" aria-selected="false">
									<?php echo __( 'Reviews' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-contact-tab"
									data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab"
									aria-controls="nav-contact" aria-selected="false">
									<?php echo __( 'Lyrics' , 'kk_writer_theme' ); ?>
								</button>
								<button class="nav-link" id="nav-disabled-tab"
									data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab"
									aria-controls="nav-disabled" aria-selected="false" disabled>
									<?php echo __( 'Tracks' , 'kk_writer_theme' ); ?>
								</button>
							</div>
						</nav>
						<!-- Tabs body -->
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel"
								aria-labelledby="nav-home-tab" tabindex="0">
							a
							</div>
							<div class="tab-pane fade" id="nav-profile" role="tabpanel"
								aria-labelledby="nav-profile-tab" tabindex="0">
							b
							</div>
							<div class="tab-pane fade" id="nav-contact" role="tabpanel"
								aria-labelledby="nav-contact-tab" tabindex="0">
							c
							</div>
							<div class="tab-pane fade" id="nav-disabled" role="tabpanel"
								aria-labelledby="nav-disabled-tab" tabindex="0">
							d
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
