<?php
/**
 * The template for displaying 404 pages (not found)
 * KK Writer Theme: The footer of the site.
 *
 * @package KK_Writer_Theme
 */

get_header();
$section             = ''; // __( 'Page not found', 'kk_writer_theme' );
$section_description = '';
$site_url            = get_site_url();
?>

<main class="container" role="main">

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

		<!-- 404 Message -->
		<section class="section bg-white">
			<div class="container ">
				<article class="article-wrapper">
					<div class="box_404 text-center clearfix mb-5">

						<h1 class="xl"><?php esc_html_e( '404', 'kk_writer_theme' ); ?></h1>
						<h2><?php esc_html_e( 'Page not found', 'kk_writer_theme' ); ?></h2>

						<p class="mt-5 mb-5">
							<?php esc_html_e( 'Page not found', 'kk_writer_theme' ); ?>
							<br />
							<?php esc_html_e( 'Oops! The page you are looking for was not found.', 'kk_writer_theme' ); ?>
							<br />
							<?php
								echo sprintf(
									__( 'Click <a href="%s">here</a> to come back or use the menu to continue browsing.', 'kk_writer_theme' ), $site_url );
							?>
						</p>

					</div>
				</article>
			</div>
		</section>

	</div><!-- body -->
</main><!-- #main -->

<?php
get_footer();
