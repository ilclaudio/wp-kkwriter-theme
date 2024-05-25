<?php

/**
 *  * The template for displaying 404 pages (not found)
 * KK Writer Theme: The footer of the site.
 *
 * @package KK_Writer_Theme
 */

get_header();
?>

<main id="main-container" class="main-container" role="main">
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>
	<section class="section bg-white">
		<div class="container ">
			<article class="article-wrapper">
				<div class="box_404 text-center clearfix">
					<h1 class="xl"><?php esc_html_e( '404', 'kk_writer_theme' ); ?></h1>
					<h2><?php esc_html_e( 'Page not found', 'kk_writer_theme' ); ?></h2>
					<p>
						<?php _e(
							'Oops! The page you are looking for was not found, <a href="javascript:history.back();"
									title="Return to previous page">Come back</a> or use the menu to continue browsing.',
							'kk_writer_theme'
						);
						?>
					</p>
				</div>
			</article>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();
