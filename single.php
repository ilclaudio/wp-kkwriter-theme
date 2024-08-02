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
	?>
		<!-- BODY -->
		<div class="container mt-2">

			<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1><?php echo $section; ?></h1>
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
						<?php echo __( 'Details' , 'kk_writer_theme' ); ?>
					</div>
					<div class="kkw_lateral_menu">
						<ul class="nav flex-column nav-menu">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#">Descrizione</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Date e orari</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Luogo</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled">Contatti</a>
							</li>
						</ul>
					</div>
				</aside>

				<!-- CONTENT column-->
				<article class="col-md-10" aria-label="<?php echo __( 'Article' , 'kk_writer_theme' ); ?>">
					<?php the_content(); ?>
				</article>

			</div>

		</div>
	<?php
	}
	?>

</main>

	




<?php
get_footer();
