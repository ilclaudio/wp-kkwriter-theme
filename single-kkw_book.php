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
		$image_wrapper  = KKW_ContentsManager::wrap_image( $post_wrapper, 'full' );
		$meta_tags      = get_post_meta( $post->ID );
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
					<article class="row">
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
					</article>
					
					<!-- Tabs -->
					<section id="kkw_book_tabs" class="mt-0 pt-0 mb-5" style="min-height: 300px;">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#">Info</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="#">Recensioni</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Testi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" aria-disabled="true">Brani</a>
							</li>
						</ul>
					</section>

				</section>

			</div> <!-- row -->
		</div> <!-- body -->

	<?php
	}
	?>

</main>


<?php
get_footer();
