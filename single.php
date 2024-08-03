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
	while(have_posts()) {
		the_post();
		$post_wrapper  = KKW_ContentsManager::wrap_search_result( $post );
		$image_wrapper = KKW_ContentsManager::wrap_image( $post_wrapper, 'full' );
		$icon_name     = KKW_ContentsManager::get_post_icon_by_group( $post_wrapper->main_group );
		$group         = $post_wrapper->main_group;
	?>
		<!-- BODY -->
		<div class="container mt-2">

			<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1>
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
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#date_and_hour">
									<span><?php echo __( 'Date and hours', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#place">
									<span><?php echo __( 'Place', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#contacts">
									<span><?php echo __( 'Contacts', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#media">
									<span><?php echo __( 'Media', 'kk_writer_theme' ); ?></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#related_book">
									<span><?php echo __( 'Related books', 'kk_writer_theme' ); ?></span>
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

					<article id="featured_image" class="blog-featured-image">
						<img src="<?php echo esc_url( $image_wrapper->src ); ?>"
							class="card-img-top img-fluid"
							alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
					</article>

					<article id="post_description">
						<?php the_content(); ?>
					</article>

					<article id="date_and_hour">
						<h4><?php echo __( 'Date and hour' , 'kk_writer_theme' ); ?></h4>
						<div>
							xxxxxxx
						</div>
					</article>

					<article id="place">
						<h4><?php echo __( 'Place' , 'kk_writer_theme' ); ?></h4>
						<div>
							xxxxxxx
						</div>
					</article>

					<article id="contacts">
						<h4><?php echo __( 'Contacts' , 'kk_writer_theme' ); ?></h4>
						<div>
							xxxxxxx
						</div>
					</article>

					<article id="media">
						<h4><?php echo __( 'Media' , 'kk_writer_theme' ); ?></h4>
						<div>
							xxxxxxx
						</div>
					</article>

					<article id="related_books">
						<h4><?php echo __( 'Related books' , 'kk_writer_theme' ); ?></h4>
						<div>
							xxxxxxx
						</div>
					</article>

				</section>

			</div>

		</div>
	<?php
	}
	?>

</main>

	




<?php
get_footer();
