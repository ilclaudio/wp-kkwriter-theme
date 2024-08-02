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
			<aside class="col-md-3 border-end mb-5">
				The navigation menu
			</aside>

			<!-- CONTENT column-->
			<article class="col-md-9" aria-label="<?php echo __( 'Article' , 'kk_writer_theme' ); ?>">
					The article
			</article>

		</div>

	</div>

</main>

<!-- <?php
while(have_posts()) {
	the_post(); ?>
	<h2><?php the_title(); ?></h2>
	<?php the_content(); ?>
	
<?php } ?> -->



<?php
get_footer();
