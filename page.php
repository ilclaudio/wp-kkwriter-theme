<?php
/**
 * KK Writer Theme: The static content template page.
 *
 * @package KK_Writer_Theme
 */

global $post;
get_header();
$section             = $post->post_title;
$section_description = '';
$prologue            = KKW_ContentsManager::get_page_prologue( $post->ID );
$epilogue            = KKW_ContentsManager::get_page_epilogue( $post->ID );
$quote               = KKW_ContentsManager::get_page_quote( $post->ID );
// @TODO: Use this ? $image_metadata      = KKW_ContentsManager::get_image_metadata( $post )
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

		<!-- QUOTES, if present -->
		<?php
		 if( $quote ) {
		?>
		<section class="row pt-2 mb-2">
			<div class="col-md-12 m-0 p-0">
				<div class="px-3 py-0 bg-light border rounded text-end">
						<blockquote class="blockquote">
								<p class="mb-0">
									<?php echo wpautop( wp_kses_post( $quote ) ); ?>
								</p>
						</blockquote>
				</div>
			</div>
		</section>
		<?php
		 }
		?>

		<!-- PROLOGUE, if present -->
		<?php
			if( $prologue ) {
		?>
				<section class="row py-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
						<?php echo wpautop( wp_kses_post( $prologue ) ); ?>
					</div>
				</section>
		<?php
			}
		?>

		<!-- CONTENT of the page -->
		<div class="row px-3 my-3 kkw_page_content">
			<?php the_content(); ?>
		</div>

		<!-- EPILOGUE, if present -->
		<?php
			if( $epilogue ) {
		?>
				<section class="row py-2 mt-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
						<?php echo wpautop( wp_kses_post( $epilogue ) ); ?>
					</div>
				</section>
		<?php
			}
		?>

	</div>



</main>


<?php
get_footer();
