<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package KK_Writer_Theme
 */

get_header();
$kkw_section             = '';
$kkw_section_description = '';
$kkw_site_url            = home_url( '/' );
?>

<main class="container" role="main">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo esc_html( $kkw_section ); ?></h1>
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

		<!-- 404 Message -->
		<section class="section bg-white">
			<div class="container">
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
							/* translators: %s: Site home URL. */
								printf(
									wp_kses(
										/* translators: %s: Site home URL. */
										__( 'Click <a href="%s">here</a> to come back or use the menu to continue browsing.', 'kk_writer_theme' ),
										array(
											'a' => array(
												'href' => array(),
											),
										)
									),
									esc_url( $kkw_site_url )
								);
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
